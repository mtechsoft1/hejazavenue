<?php

use Illuminate\Database\Seeder;
use App\Destination;
class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Destination::create([
            'destination_name' => 'Naran - Kaghan',
            'destination_image' => 'https://media-cdn.tripadvisor.com/media/photo-s/1a/26/04/66/most-beautiful-leak-s.jpg'
        ]);

        Destination::create([
            'destination_name' => 'Fairy Meadows',
            'destination_image' => 'https://i.pinimg.com/originals/e1/52/fd/e152fd3ebb8992bd0614c5d5ad70fd9a.jpg',
        ]);

        Destination::create([
            'destination_name' => 'Hunza Valley',
            'destination_image' => 'https://media-cdn.tripadvisor.com/media/photo-s/1a/3a/ca/7f/passu-cones.jpg',
        ]);
    }
}
