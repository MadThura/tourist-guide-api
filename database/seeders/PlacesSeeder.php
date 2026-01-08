<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PlacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $places = $this->readPlacesFile();

        DB::table('places')->insert($places);
    }

    /**
     * Read and format places file
     */
    private function readPlacesFile(): array
    {
        // $path = 'data/places.txt'; // storage/app/data/places.txt

        // if (!Storage::exists($path)) {
        //     throw new \Exception('places.txt not found');
        // }
        // $data = json_decode(Storage::get($path), true);

        $path = storage_path('app/data/places.txt');

        if (!file_exists($path)) {
            throw new \Exception('places.txt not found');
        }

        $data = json_decode(file_get_contents($path), true);



        return collect($data)->map(fn($place) => [
            'id' => $place['id'],
            'name'        => $place['name'],
            'description' => $place['description'],
            'location'    => $place['location'],
            'latitude'    => $place['latitude'],
            'longitude'   => $place['longitude'],
            'image'       => $place['image'],
            'category_id' => $place['category_id'],
            'created_at'  => now(),
            'updated_at'  => now(),
        ])->toArray();
    }
}
