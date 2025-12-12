<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Manga;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        // Get stats
        $totalUsers = User::count();
        $totalAdmins = User::where('is_admin', true)->count();
        $totalMangas = Manga::count();
        
        // Get categories from file
        $filePath = 'categories.json';
        $categories = [];
        if (Storage::exists($filePath)) {
            $categories = json_decode(Storage::get($filePath), true);
        }
        $totalCategories = count($categories);

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalMangas',
            'totalCategories'
        ));
    }
}
