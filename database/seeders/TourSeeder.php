<?php

namespace Database\Seeders;

use App\Tour;
use Illuminate\Database\Seeder;

/**
 * Seeds tours (Laravel 11 structure).
 * Depends on: UserSeeder (agencies), DestinationSeeder.
 */
class TourSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            'trip_image' => 'tour_images/default.jpg',
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8_years' => 'Kids Between 3 to 8 Years will be Charged 50% & Given Jumper Seat',
            'kids_above_8_years' => 'Kids above 8 Years will be Charged full',
            'attractions' => '#Naran #Lake_Saifulmalook #Lulusar_Lake #Babusar #Batakundi #Kaghan #KiwaiWaterfall #Bonfire # TripShrip',
        ];

        $tours = [
            ['agency_id' => 4, 'destination_id' => 1, 'trip_name' => '4 Days trip to Naran - Kaghan', 'trip_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'trip_start_date' => '2025-10-09', 'trip_end_date' => '2025-10-13', 'trip_total_days' => 4, 'trip_duration' => '3 Days 4 Nights'],
            ['agency_id' => 5, 'destination_id' => 1, 'trip_name' => '4 Days trip to Naran - Kaghan', 'trip_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'trip_start_date' => '2025-10-13', 'trip_end_date' => '2025-10-17', 'trip_total_days' => 4, 'trip_duration' => '3 Days 4 Nights'],
            ['agency_id' => 6, 'destination_id' => 1, 'trip_name' => '5 Days trip to Naran - Kaghan', 'trip_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'trip_start_date' => '2025-10-15', 'trip_end_date' => '2025-10-20', 'trip_total_days' => 5, 'trip_duration' => '5 Days 4 Nights'],
        ];

        foreach ($tours as $data) {
            Tour::create(array_merge($defaults, $data));
        }
    }
}
