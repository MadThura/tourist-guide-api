<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = $this->readPlacesFile();

        DB::table('images')->insert($images);
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

        $path = storage_path('app/data/images.txt');

        if (!file_exists($path)) {
            throw new \Exception('images.txt not found');
        }

        $data = json_decode(file_get_contents($path), true);

        return collect($data)->map(fn($image) => [
            'place_id'        => $image['place_id'],
            'path' => $image['path'],
            'created_at'  => now(),
            'updated_at'  => now(),
        ])->toArray();
    }
}
