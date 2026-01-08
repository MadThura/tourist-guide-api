<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = $this->readPlacesFile();

        DB::table('categories')->insert($categories);
    }

    /**
     * Read and format places file
     */
    private function readPlacesFile(): array
    {
        // $path = 'data/images.txt'; // storage/app/data/places.txt

        // if (!Storage::exists($path)) {
        //     throw new \Exception('places.txt not found');
        // }

        // $data = json_decode(Storage::get($path), true);

        $path = storage_path('app/data/categories.txt');

        if (!file_exists($path)) {
            throw new \Exception('categories.txt not found');
        }

        $data = json_decode(file_get_contents($path), true);

        return collect($data)->map(fn($category) => [
            'id' => $category['id'],
            'name'        => $category['name'],
            'created_at'  => now(),
            'updated_at'  => now(),
        ])->toArray();
    }
}
