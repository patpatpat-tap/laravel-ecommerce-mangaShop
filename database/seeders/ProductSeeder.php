<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories
        $shonen = Category::where('slug', 'shonen')->first();
        $shojo = Category::where('slug', 'shojo')->first();
        $seinen = Category::where('slug', 'seinen')->first();
        $isekai = Category::where('slug', 'isekai')->first();
        $fantasy = Category::where('slug', 'fantasy')->first();
        $romance = Category::where('slug', 'romance')->first();
        $horror = Category::where('slug', 'horror')->first();
        $scifi = Category::where('slug', 'sci-fi')->first();
        $comedy = Category::where('slug', 'comedy')->first();

        $products = [
            // Shonen
            [
                'name' => 'One Piece Vol. 1',
                'description' => 'Join Monkey D. Luffy and his pirate crew in search of the ultimate treasure, the One Piece!',
                'category_id' => $shonen->id,
                'price' => 9.99,
                'stock' => 50,
                'author' => 'Eiichiro Oda',
                'publisher' => 'Viz Media',
                'pages' => 200,
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400',
            ],
            [
                'name' => 'Naruto Vol. 1',
                'description' => 'Follow Naruto Uzumaki on his journey to become the greatest ninja in his village!',
                'category_id' => $shonen->id,
                'price' => 9.99,
                'stock' => 45,
                'author' => 'Masashi Kishimoto',
                'publisher' => 'Viz Media',
                'pages' => 192,
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400',
            ],
            [
                'name' => 'Dragon Ball Z Vol. 1',
                'description' => 'Goku and friends battle powerful enemies to protect Earth in this classic action series!',
                'category_id' => $shonen->id,
                'price' => 9.99,
                'stock' => 40,
                'author' => 'Akira Toriyama',
                'publisher' => 'Viz Media',
                'pages' => 184,
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400',
            ],
            [
                'name' => 'My Hero Academia Vol. 1',
                'description' => 'In a world where most people have superpowers, Izuku Midoriya dreams of becoming a hero!',
                'category_id' => $shonen->id,
                'price' => 9.99,
                'stock' => 60,
                'author' => 'Kohei Horikoshi',
                'publisher' => 'Viz Media',
                'pages' => 192,
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400',
            ],
            [
                'name' => 'Demon Slayer Vol. 1',
                'description' => 'Tanjiro Kamado becomes a demon slayer to save his sister and avenge his family!',
                'category_id' => $shonen->id,
                'price' => 9.99,
                'stock' => 55,
                'author' => 'Koyoharu Gotouge',
                'publisher' => 'Viz Media',
                'pages' => 192,
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400',
            ],

            // Shojo
            [
                'name' => 'Fruits Basket Vol. 1',
                'description' => 'A heartwarming story about Tohru Honda and the mysterious Sohma family with a zodiac curse.',
                'category_id' => $shojo->id,
                'price' => 9.99,
                'stock' => 35,
                'author' => 'Natsuki Takaya',
                'publisher' => 'Yen Press',
                'pages' => 200,
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400',
            ],
            [
                'name' => 'Ouran High School Host Club Vol. 1',
                'description' => 'Haruhi Fujioka joins an elite host club in this hilarious reverse harem comedy!',
                'category_id' => $shojo->id,
                'price' => 9.99,
                'stock' => 30,
                'author' => 'Bisco Hatori',
                'publisher' => 'Viz Media',
                'pages' => 192,
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400',
            ],

            // Seinen
            [
                'name' => 'Berserk Vol. 1',
                'description' => 'A dark fantasy epic following Guts, a mercenary warrior in a brutal medieval world.',
                'category_id' => $seinen->id,
                'price' => 14.99,
                'stock' => 25,
                'author' => 'Kentaro Miura',
                'publisher' => 'Dark Horse Comics',
                'pages' => 224,
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400',
            ],
            [
                'name' => 'Tokyo Ghoul Vol. 1',
                'description' => 'Ken Kaneki becomes a half-ghoul and must navigate between human and ghoul worlds.',
                'category_id' => $seinen->id,
                'price' => 12.99,
                'stock' => 40,
                'author' => 'Sui Ishida',
                'publisher' => 'Viz Media',
                'pages' => 224,
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400',
            ],

            // Isekai
            [
                'name' => 'That Time I Got Reincarnated as a Slime Vol. 1',
                'description' => 'Satoru Mikami is reincarnated as a slime in a fantasy world with incredible powers!',
                'category_id' => $isekai->id,
                'price' => 12.99,
                'stock' => 50,
                'author' => 'Fuse',
                'publisher' => 'Kodansha Comics',
                'pages' => 192,
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400',
            ],
            [
                'name' => 'Overlord Vol. 1',
                'description' => 'A gamer finds himself trapped in his favorite MMORPG as his powerful character!',
                'category_id' => $isekai->id,
                'price' => 13.99,
                'stock' => 45,
                'author' => 'Kugane Maruyama',
                'publisher' => 'Yen Press',
                'pages' => 256,
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400',
            ],

            // Fantasy
            [
                'name' => 'Fullmetal Alchemist Vol. 1',
                'description' => 'Two brothers use alchemy to search for the Philosopher\'s Stone to restore their bodies.',
                'category_id' => $fantasy->id,
                'price' => 9.99,
                'stock' => 55,
                'author' => 'Hiromu Arakawa',
                'publisher' => 'Viz Media',
                'pages' => 192,
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400',
            ],
            [
                'name' => 'Attack on Titan Vol. 1',
                'description' => 'Humanity fights for survival against giant humanoid Titans in this intense series!',
                'category_id' => $fantasy->id,
                'price' => 10.99,
                'stock' => 60,
                'author' => 'Hajime Isayama',
                'publisher' => 'Kodansha Comics',
                'pages' => 208,
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400',
            ],

            // Romance
            [
                'name' => 'Kimi ni Todoke Vol. 1',
                'description' => 'Sawako Kuronuma tries to make friends despite being misunderstood due to her appearance.',
                'category_id' => $romance->id,
                'price' => 9.99,
                'stock' => 40,
                'author' => 'Karuho Shiina',
                'publisher' => 'Viz Media',
                'pages' => 192,
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400',
            ],

            // Horror
            [
                'name' => 'Junji Ito\'s Uzumaki Vol. 1',
                'description' => 'A town becomes obsessed with spirals in this terrifying horror masterpiece.',
                'category_id' => $horror->id,
                'price' => 19.99,
                'stock' => 20,
                'author' => 'Junji Ito',
                'publisher' => 'Viz Media',
                'pages' => 208,
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400',
            ],

            // Sci-Fi
            [
                'name' => 'Ghost in the Shell Vol. 1',
                'description' => 'In a cyberpunk future, cyborg police officer Motoko Kusanagi hunts cybercriminals.',
                'category_id' => $scifi->id,
                'price' => 16.99,
                'stock' => 30,
                'author' => 'Masamune Shirow',
                'publisher' => 'Kodansha Comics',
                'pages' => 368,
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400',
            ],

            // Comedy
            [
                'name' => 'One-Punch Man Vol. 1',
                'description' => 'Saitama can defeat any enemy with one punch, but he\'s bored with being too powerful!',
                'category_id' => $comedy->id,
                'price' => 9.99,
                'stock' => 65,
                'author' => 'ONE',
                'publisher' => 'Viz Media',
                'pages' => 200,
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400',
            ],
            [
                'name' => 'Gintama Vol. 1',
                'description' => 'In an alternate Edo period, samurai Gintoki Sakata takes odd jobs with his friends.',
                'category_id' => $comedy->id,
                'price' => 9.99,
                'stock' => 35,
                'author' => 'Hideaki Sorachi',
                'publisher' => 'Viz Media',
                'pages' => 192,
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400',
            ],
        ];

        $created = 0;
        $skipped = 0;

        foreach ($products as $product) {
            $slug = Str::slug($product['name']);
            
            $existing = Product::where('slug', $slug)->first();
            
            if (!$existing) {
                Product::create([
                    'category_id' => $product['category_id'],
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'slug' => $slug,
                    'price' => $product['price'],
                    'stock' => $product['stock'],
                    'image' => $product['image'],
                    'author' => $product['author'],
                    'publisher' => $product['publisher'],
                    'pages' => $product['pages'],
                    'is_active' => true,
                ]);
                $created++;
            } else {
                $skipped++;
            }
        }

        if ($created > 0) {
            $this->command->info("Products seeded successfully! Created: {$created}, Skipped: {$skipped}");
        } else {
            $this->command->info("All products already exist. Skipped: {$skipped}");
        }
    }
}
