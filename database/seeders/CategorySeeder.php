<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Shonen',
                'description' => 'Action-packed manga targeted at young male readers, featuring adventure, friendship, and determination.',
            ],
            [
                'name' => 'Shojo',
                'description' => 'Romance and drama-focused manga targeted at young female readers, often featuring emotional stories.',
            ],
            [
                'name' => 'Seinen',
                'description' => 'Mature manga targeted at adult male readers, featuring complex themes and sophisticated storytelling.',
            ],
            [
                'name' => 'Josei',
                'description' => 'Mature manga targeted at adult female readers, focusing on realistic relationships and life experiences.',
            ],
            [
                'name' => 'Isekai',
                'description' => 'Fantasy genre where characters are transported to another world, often featuring RPG-like elements.',
            ],
            [
                'name' => 'Fantasy',
                'description' => 'Manga featuring magical worlds, supernatural elements, and fantastical creatures.',
            ],
            [
                'name' => 'Romance',
                'description' => 'Manga focusing on romantic relationships, love stories, and emotional connections.',
            ],
            [
                'name' => 'Horror',
                'description' => 'Manga featuring suspense, supernatural elements, and psychological thrills.',
            ],
            [
                'name' => 'Sci-Fi',
                'description' => 'Manga featuring futuristic technology, space exploration, and scientific concepts.',
            ],
            [
                'name' => 'Comedy',
                'description' => 'Lighthearted manga focused on humor, gags, and entertaining situations.',
            ],
        ];

        $created = 0;
        $skipped = 0;

        foreach ($categories as $category) {
            $slug = Str::slug($category['name']);
            
            $existing = Category::where('slug', $slug)->first();
            
            if (!$existing) {
                Category::create([
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'slug' => $slug,
                ]);
                $created++;
            } else {
                $skipped++;
            }
        }

        if ($created > 0) {
            $this->command->info("Categories seeded successfully! Created: {$created}, Skipped: {$skipped}");
        } else {
            $this->command->info("All categories already exist. Skipped: {$skipped}");
        }
    }
}
