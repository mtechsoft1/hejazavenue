<?php

namespace Database\Seeders;

use App\Destination;
use Illuminate\Database\Seeder;

/**
 * Seeds destinations (Laravel 11 structure).
 */
class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = [
            ['destination_name' => 'Naran - Kaghan', 'destination_image' => 'https://media-cdn.tripadvisor.com/media/photo-s/1a/26/04/66/most-beautiful-leak-s.jpg'],
            ['destination_name' => 'Fairy Meadows', 'destination_image' => 'https://i.pinimg.com/originals/e1/52/fd/e152fd3ebb8992bd0614c5d5ad70fd9a.jpg'],
            ['destination_name' => 'Hunza Valley', 'destination_image' => 'https://media-cdn.tripadvisor.com/media/photo-s/1a/3a/ca/7f/passu-cones.jpg'],
        ];

        foreach ($destinations as $data) {
            Destination::create($data);
        }
    }
}
