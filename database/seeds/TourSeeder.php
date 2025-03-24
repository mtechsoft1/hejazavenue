<?php

use Illuminate\Database\Seeder;
use App\Tour;
class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tour::create([
            'agency_id' => 4,
            'destination_id' => 1,
            'trip_image' => 'tour_images/default.jpg',
            'trip_name' => '4 Days trip to Naran - Kaghan',
            'trip_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'trip_start_date' => '2021-10-09',
            'trip_end_date' => '2021-10-13',
            'trip_total_days' => 4,
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',  
            'kids_between_3_to_8_years' => 'Kids Between 3 to 8 Years will be Charged 50% & Given Jumper Seat',      
            'kids_above_8_years' => 'Kids above 8 Years will be Charged full',  
            'attractions' => '#Naran #Lake_Saifulmalook #Lulusar_Lake #Babusar #Batakundi #Kaghan #KiwaiWaterfall #Bonfire # TripShrip',
            'trip_duration' => '3 Days 4 Nights',         
        ]);

        Tour::create([
            'agency_id' => 5,
            'destination_id' => 1,
            'trip_image' => 'tour_images/default.jpg',
            'trip_name' => '4 Days trip to Naran - Kaghan',
            'trip_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'trip_start_date' => '2021-10-13',
            'trip_end_date' => '2021-10-17',
            'trip_total_days' => 4,
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',  
            'kids_between_3_to_8_years' => 'Kids Between 3 to 8 Years will be Charged 50% & Given Jumper Seat',      
            'kids_above_8_years' => 'Kids above 8 Years will be Charged full',  
            'attractions' => '#Naran #Lake_Saifulmalook #Lulusar_Lake #Babusar #Batakundi #Kaghan #KiwaiWaterfall #Bonfire # TripShrip',
            'trip_duration' => '3 Days 4 Nights',         
        ]);

        Tour::create([
            'agency_id' => 6,
            'destination_id' => 1,
            'trip_image' => 'tour_images/default.jpg',
            'trip_name' => '5 Days trip to Naran - Kaghan',
            'trip_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'trip_start_date' => '2021-10-12',
            'trip_end_date' => '2021-10-17',
            'trip_total_days' => 5,
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',  
            'kids_between_3_to_8_years' => 'Kids Between 3 to 8 Years will be Charged 50% & Given Jumper Seat',      
            'kids_above_8_years' => 'Kids above 8 Years will be Charged full',  
            'attractions' => '#Naran #Lake_Saifulmalook #Lulusar_Lake #Babusar #Batakundi #Kaghan #KiwaiWaterfall #Bonfire # TripShrip',
            'trip_duration' => '4 Days 5 Nights',        
        ]);

        Tour::create([
            'agency_id' => 7,
            'destination_id' => 1,
            'trip_image' => 'tour_images/default.jpg',
            'trip_name' => '5 Days trip to Naran - Kaghan',
            'trip_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'trip_start_date' => '2021-10-11',
            'trip_end_date' => '2021-10-17',
            'trip_total_days' => 5,
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',  
            'kids_between_3_to_8_years' => 'Kids Between 3 to 8 Years will be Charged 50% & Given Jumper Seat',      
            'kids_above_8_years' => 'Kids above 8 Years will be Charged full',  
            'attractions' => '#Naran #Lake_Saifulmalook #Lulusar_Lake #Babusar #Batakundi #Kaghan #KiwaiWaterfall #Bonfire # TripShrip',
            'trip_duration' => '4 Days 5 Nights',        
        ]);

        //

        Tour::create([
            'agency_id' => 6,
            'destination_id' => 2,
            'trip_image' => 'tour_images/default.jpg',
            'trip_name' => '4 Days trip to Fairy Meadows',
            'trip_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'trip_start_date' => '2021-10-09',
            'trip_end_date' => '2021-10-13',
            'trip_total_days' => 4,
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',  
            'kids_between_3_to_8_years' => 'Kids Between 3 to 8 Years will be Charged 50% & Given Jumper Seat',      
            'kids_above_8_years' => 'Kids above 8 Years will be Charged full',  
            'attractions' => '#NangaPurbat #Diamer #Gilgit #Bonfire # TripShrip',
            'trip_duration' => '3 Days 4 Nights',          
        ]);

        Tour::create([
            'agency_id' => 5,
            'destination_id' => 2,
            'trip_image' => 'tour_images/default.jpg',
            'trip_name' => '4 Days trip to Fairy Meadows',
            'trip_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'trip_start_date' => '2021-10-13',
            'trip_end_date' => '2021-10-17',
            'trip_total_days' => 4,
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',  
            'kids_between_3_to_8_years' => 'Kids Between 3 to 8 Years will be Charged 50% & Given Jumper Seat',      
            'kids_above_8_years' => 'Kids above 8 Years will be Charged full',  
            'attractions' => '#NangaPurbat #Diamer #Gilgit #Bonfire # TripShrip',
            'trip_duration' => '3 Days 4 Nights',        
        ]);

        Tour::create([
            'agency_id' => 7,
            'destination_id' => 2,
            'trip_image' => 'tour_images/default.jpg',
            'trip_name' => '5 Days trip to Fairy Meadows',
            'trip_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'trip_start_date' => '2021-10-12',
            'trip_end_date' => '2021-10-17',
            'trip_total_days' => 5,
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',  
            'kids_between_3_to_8_years' => 'Kids Between 3 to 8 Years will be Charged 50% & Given Jumper Seat',      
            'kids_above_8_years' => 'Kids above 8 Years will be Charged full',  
            'attractions' => '#NangaPurbat #Diamer #Gilgit #Bonfire # TripShrip',
            'trip_duration' => '4 Days 5 Nights',       
        ]);

        Tour::create([
            'agency_id' => 4,
            'destination_id' => 2,
            'trip_image' => 'tour_images/default.jpg',
            'trip_name' => '5 Days trip to Fairy Meadows',
            'trip_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'trip_start_date' => '2021-10-11',
            'trip_end_date' => '2021-10-17',
            'trip_total_days' => 5,
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',  
            'kids_between_3_to_8_years' => 'Kids Between 3 to 8 Years will be Charged 50% & Given Jumper Seat',      
            'kids_above_8_years' => 'Kids above 8 Years will be Charged full',  
            'attractions' => '#NangaPurbat #Diamer #Gilgit #Bonfire # TripShrip',
            'trip_duration' => '4 Days 5 Nights',        
        ]);

        //

        Tour::create([
            'agency_id' => 7,
            'destination_id' => 3,
            'trip_image' => 'tour_images/default.jpg',
            'trip_name' => '4 Days trip to Hunza Valley',
            'trip_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'trip_start_date' => '2021-10-09',
            'trip_end_date' => '2021-10-13',
            'trip_total_days' => 4,
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',  
            'kids_between_3_to_8_years' => 'Kids Between 3 to 8 Years will be Charged 50% & Given Jumper Seat',      
            'kids_above_8_years' => 'Kids above 8 Years will be Charged full',  
            'attractions' => '#BaltitFort #AttabadLake #KhabariResidence #Bonfire # TripShrip',
            'trip_duration' => '3 Days 4 Nights',        
        ]);

        Tour::create([
            'agency_id' => 6,
            'destination_id' => 3,
            'trip_image' => 'tour_images/default.jpg',
            'trip_name' => '4 Days trip to Hunza Valley',
            'trip_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'trip_start_date' => '2021-10-13',
            'trip_end_date' => '2021-10-17',
            'trip_total_days' => 4,
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',  
            'kids_between_3_to_8_years' => 'Kids Between 3 to 8 Years will be Charged 50% & Given Jumper Seat',      
            'kids_above_8_years' => 'Kids above 8 Years will be Charged full',  
            'attractions' => '#BaltitFort #AttabadLake #KhabariResidence #Bonfire # TripShrip',
            'trip_duration' => '3 Days 4 Nights',        
        ]);

        Tour::create([
            'agency_id' => 5,
            'destination_id' => 3,
            'trip_image' => 'tour_images/default.jpg',
            'trip_name' => '5 Days trip to Hunza Valley',
            'trip_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'trip_start_date' => '2021-10-12',
            'trip_end_date' => '2021-10-17',
            'trip_total_days' => 5,
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',  
            'kids_between_3_to_8_years' => 'Kids Between 3 to 8 Years will be Charged 50% & Given Jumper Seat',      
            'kids_above_8_years' => 'Kids above 8 Years will be Charged full',  
            'attractions' => '#BaltitFort #AttabadLake #KhabariResidence #Bonfire # TripShrip',
            'trip_duration' => '4 Days 5 Nights',       
        ]);

        Tour::create([
            'agency_id' => 4,
            'destination_id' => 3,
            'trip_image' => 'tour_images/default.jpg',
            'trip_name' => '5 Days trip to Hunza Valley',
            'trip_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'trip_start_date' => '2021-10-11',
            'trip_end_date' => '2021-10-16',
            'trip_total_days' => 5,
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',  
            'kids_between_3_to_8_years' => 'Kids Between 3 to 8 Years will be Charged 50% & Given Jumper Seat',      
            'kids_above_8_years' => 'Kids above 8 Years will be Charged full',  
            'attractions' => '#BaltitFort #AttabadLake #KhabariResidence #Bonfire # TripShrip',
            'trip_duration' => '4 Days 5 Nights',         
        ]);
    }
}
