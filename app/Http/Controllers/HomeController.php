<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function landing()
    {
        return view('landing');
    }

    public function index(Request $request)
    {
        $query = Product::with('category')->where('is_active', true);

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }

        $products = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('home', compact('products', 'categories'));
    }

    public function dashboard(Request $request)
    {
        $categories = Category::all();
        
        // Get featured manga series - prioritize Jujutsu Kaisen
        // Group products by series (everything before "Vol." or "Volume")
        $allProducts = Product::with('category')
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->latest()
            ->get();
        
        // Group products by series name
        $seriesGroups = [];
        foreach ($allProducts as $product) {
            // Extract series name (remove "Vol.", "Volume", etc.)
            $seriesName = preg_replace('/\s*(Vol\.|Volume|Vol)\s*\d+.*$/i', '', $product->name);
            $seriesName = trim($seriesName);
            
            if (!isset($seriesGroups[$seriesName])) {
                $seriesGroups[$seriesName] = [];
            }
            $seriesGroups[$seriesName][] = $product;
        }
        
        // Prioritize Jujutsu Kaisen - search directly in products first
        $featuredSeriesName = null;
        $featuredSeriesProducts = collect();
        $featuredProduct = null;
        
        // First, try to find Jujutsu Kaisen products directly
        $jujutsuProducts = Product::with('category')
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->where(function($q) {
                $q->where('name', 'like', '%Jujutsu%')
                  ->orWhere('name', 'like', '%jujutsu%')
                  ->orWhere('name', 'like', '%JUJUTSU%');
            })
            ->latest()
            ->get();
        
        if ($jujutsuProducts->count() > 0) {
            // Found Jujutsu Kaisen products
            $featuredSeriesName = 'Jujutsu Kaisen';
            $featuredSeriesProducts = $jujutsuProducts; // Get all volumes for carousel
            $featuredProduct = $jujutsuProducts->first();
        } else if (!empty($seriesGroups)) {
            // Check in grouped series
            $foundJujutsuKaisen = false;
            
            foreach ($seriesGroups as $seriesName => $products) {
                $normalizedSeriesName = strtolower(trim($seriesName));
                if (stripos($normalizedSeriesName, 'jujutsu') !== false) {
                    $featuredSeriesName = 'Jujutsu Kaisen';
                    $featuredSeriesProducts = collect($products); // Get all volumes for carousel
                    $featuredProduct = collect($products)->first();
                    $foundJujutsuKaisen = true;
                    break;
                }
            }
            
            // If Jujutsu Kaisen not found, get the series with the most volumes
            if (!$foundJujutsuKaisen) {
                uasort($seriesGroups, function($a, $b) {
                    return count($b) - count($a);
                });
                
                $featuredSeriesName = array_key_first($seriesGroups);
                $featuredSeriesProducts = collect($seriesGroups[$featuredSeriesName]); // Get all volumes for carousel
                $featuredProduct = collect($seriesGroups[$featuredSeriesName])->first();
            }
        } else {
            // Fallback if no products
            $featuredProduct = Product::with('category')
                ->where('is_active', true)
                ->where('stock', '>', 0)
                ->latest()
                ->first();
            
            if ($featuredProduct) {
                $extractedName = preg_replace('/\s*(Vol\.|Volume|Vol)\s*\d+.*$/i', '', $featuredProduct->name);
                // If it contains Jujutsu, use "Jujutsu Kaisen", otherwise use extracted name
                if (stripos($extractedName, 'jujutsu') !== false) {
                    $featuredSeriesName = 'Jujutsu Kaisen';
                } else {
                    $featuredSeriesName = trim($extractedName);
                }
                $featuredSeriesProducts = collect([$featuredProduct]); // Single product, no carousel needed
            }
        }
        
        // Get best sellers - products with most orders, excluding Jujutsu Kaisen
        $bestSellers = Product::with('category')
            ->withCount('orderItems')
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->where(function($q) {
                $q->where('name', 'not like', '%Jujutsu%')
                  ->where('name', 'not like', '%jujutsu%')
                  ->where('name', 'not like', '%JUJUTSU%');
            })
            ->orderBy('order_items_count', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(12)
            ->get();
        
        // If no best sellers (no orders yet), get diverse products excluding Jujutsu Kaisen
        if ($bestSellers->count() < 6) {
            $bestSellers = Product::with('category')
                ->where('is_active', true)
                ->where('stock', '>', 0)
                ->where(function($q) {
                    $q->where('name', 'not like', '%Jujutsu%')
                      ->where('name', 'not like', '%jujutsu%')
                      ->where('name', 'not like', '%JUJUTSU%');
                })
                ->inRandomOrder()
                ->take(12)
                ->get();
        }

        // Get newly added mangas (latest products, but exclude monthly releases to avoid duplicates)
        $newlyAdded = Product::with('category')
            ->where('is_active', true)
            ->where(function($q) {
                $q->whereMonth('created_at', '!=', now()->month)
                  ->orWhereYear('created_at', '!=', now()->year);
            })
            ->latest()
            ->take(12)
            ->get();

        // Handle search if provided
        $searchQuery = null;
        $searchResults = collect();
        
        if ($request->has('search') && $request->search) {
            $searchQuery = $request->search;
            $searchResults = Product::with('category')
                ->where('is_active', true)
                ->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('description', 'like', '%' . $request->search . '%')
                      ->orWhere('author', 'like', '%' . $request->search . '%');
                })
                ->when($request->has('category') && $request->category, function ($q) use ($request) {
                    $q->where('category_id', $request->category);
                })
                ->latest()
                ->get();
        }

        return view('dashboard', compact('categories', 'featuredSeriesName', 'featuredSeriesProducts', 'featuredProduct', 'bestSellers', 'newlyAdded', 'searchQuery', 'searchResults'));
    }
}
