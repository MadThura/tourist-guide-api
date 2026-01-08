<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use App\Models\Place;
use App\Models\Review;
use App\Models\Setting;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Setting::factory()->create([
            'app_name' => 'Tourist Guide Api',
            'contact_email' => 'email@gmail.com',
            'contact_phone' => '09777888222',
            'contact_address' => 'Yangon',
            'footer_text' => 'Footer'
        ]);

        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminpassword'),
            'role' => 'admin'
        ]);
        $admin->createToken('admin-token')->plainTextToken;

        $user = User::factory()->create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('userpassword'),
            'role' => 'user'
        ]);
        $admin->createToken('admin-token')->plainTextToken;

        $users = User::factory(10)->create();
        foreach ($users as $user) {
            $user->createToken('user-token')->plainTextToken;
        }

        // $categories = [
        //     'Pagodas',
        //     'Restaurants',
        //     'Museums',
        //     'Parks',
        //     'Shopping Center',
        //     'Local Market',
        //     'Hotels',
        //     'Historical landmarks',
        //     'Souvenirs',
        // ];

        // foreach ($categories as $category) {
        //     Category::factory()->create([
        //         'name' => $category,
        //     ]);
        // }

        $this->call([
            CategoriesSeeder::class,
            PlacesSeeder::class,  // MUST be first
            ImagesSeeder::class,
        ]);

        // Category::

        // Place::factory(20)->create();
        // Category::factory(10)->create();
        // Review::factory(20)->create();
        // Image::factory(20)->create();
    }
}
