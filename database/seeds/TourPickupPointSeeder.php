<?php

use Illuminate\Database\Seeder;
use App\TourPickupPoint;
class TourPickupPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TourPickupPoint::create([
            'tour_id' => 1,
            'pickup_city' => 'Karachi',
            'per_seat_fare' => 7500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 12000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 19000,
            'family_package_fare_currency' => 'PKR',    
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',       
            'pickup_point' => 'Daewoo Terminal Karachi',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '10:00 AM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 1,
            'pickup_city' => 'Multan',
            'per_seat_fare' => 5500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 10000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 16000,
            'family_package_fare_currency' => 'PKR',  
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',          
            'pickup_point' => 'Daewoo Terminal Multan',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '06:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 1,
            'pickup_city' => 'Lahore',
            'per_seat_fare' => 5000,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 9000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 15000,
            'family_package_fare_currency' => 'PKR',  
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',          
            'pickup_point' => 'Daewoo Terminal Lahore',
            'pickup_point_latitude' => '31.506432',
            'pickup_point_longitude' => '74.3243776',
            'pickup_date' => '2021-10-10',
            'pickup_time' => '10:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 1,
            'pickup_city' => 'Islamabad',
            'per_seat_fare' => 4500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 8000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 13000,
            'family_package_fare_currency' => 'PKR',   
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',         
            'pickup_point' => 'Daewoo Terminal Islamabad',
            'pickup_point_latitude' => '32.5453805',
            'pickup_point_longitude' => '72.321204',
            'pickup_date' => '2021-10-11',
            'pickup_time' => '05:00 AM'
        ]);       

        //

        TourPickupPoint::create([
            'tour_id' => 2,
            'pickup_city' => 'Karachi',
            'per_seat_fare' => 7500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 12000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 19000,
            'family_package_fare_currency' => 'PKR',  
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',          
            'pickup_point' => 'Daewoo Terminal Karachi',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '10:00 AM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 2,
            'pickup_city' => 'Multan',
            'per_seat_fare' => 5500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 10000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 16000,
            'family_package_fare_currency' => 'PKR',  
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',          
            'pickup_point' => 'Daewoo Terminal Multan',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '06:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 2,
            'pickup_city' => 'Lahore',
            'per_seat_fare' => 5000,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 9000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 15000,
            'family_package_fare_currency' => 'PKR', 
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',           
            'pickup_point' => 'Daewoo Terminal Lahore',
            'pickup_point_latitude' => '31.506432',
            'pickup_point_longitude' => '74.3243776',
            'pickup_date' => '2021-10-10',
            'pickup_time' => '10:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 2,
            'pickup_city' => 'Islamabad',
            'per_seat_fare' => 4500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 8000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 13000,
            'family_package_fare_currency' => 'PKR',  
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',          
            'pickup_point' => 'Daewoo Terminal Islamabad',
            'pickup_point_latitude' => '32.5453805',
            'pickup_point_longitude' => '72.321204',
            'pickup_date' => '2021-10-11',
            'pickup_time' => '05:00 AM'
        ]);

        //

        TourPickupPoint::create([
            'tour_id' => 3,
            'pickup_city' => 'Karachi',
            'per_seat_fare' => 7500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 12000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 19000,
            'family_package_fare_currency' => 'PKR',  
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',          
            'pickup_point' => 'Daewoo Terminal Karachi',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '10:00 AM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 3,
            'pickup_city' => 'Multan',
            'per_seat_fare' => 5500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 10000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 16000,
            'family_package_fare_currency' => 'PKR',  
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',          
            'pickup_point' => 'Daewoo Terminal Multan',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '06:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 3,
            'pickup_city' => 'Lahore',
            'per_seat_fare' => 5000,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 9000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 15000,
            'family_package_fare_currency' => 'PKR',  
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',          
            'pickup_point' => 'Daewoo Terminal Lahore',
            'pickup_point_latitude' => '31.506432',
            'pickup_point_longitude' => '74.3243776',
            'pickup_date' => '2021-10-10',
            'pickup_time' => '10:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 3,
            'pickup_city' => 'Islamabad',
            'per_seat_fare' => 4500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 8000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 13000,
            'family_package_fare_currency' => 'PKR', 
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',           
            'pickup_point' => 'Daewoo Terminal Islamabad',
            'pickup_point_latitude' => '32.5453805',
            'pickup_point_longitude' => '72.321204',
            'pickup_date' => '2021-10-11',
            'pickup_time' => '05:00 AM'
        ]);

        //

        TourPickupPoint::create([
            'tour_id' => 4,
            'pickup_city' => 'Karachi',
            'per_seat_fare' => 7500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 12000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 19000,
            'family_package_fare_currency' => 'PKR', 
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',           
            'pickup_point' => 'Daewoo Terminal Karachi',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '10:00 AM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 4,
            'pickup_city' => 'Multan',
            'per_seat_fare' => 5500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 10000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 16000,
            'family_package_fare_currency' => 'PKR', 
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',           
            'pickup_point' => 'Daewoo Terminal Multan',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '06:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 4,
            'pickup_city' => 'Lahore',
            'per_seat_fare' => 5000,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 9000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 15000,
            'family_package_fare_currency' => 'PKR', 
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',           
            'pickup_point' => 'Daewoo Terminal Lahore',
            'pickup_point_latitude' => '31.506432',
            'pickup_point_longitude' => '74.3243776',
            'pickup_date' => '2021-10-10',
            'pickup_time' => '10:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 4,
            'pickup_city' => 'Islamabad',
            'per_seat_fare' => 4500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 8000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 13000,
            'family_package_fare_currency' => 'PKR', 
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',           
            'pickup_point' => 'Daewoo Terminal Islamabad',
            'pickup_point_latitude' => '32.5453805',
            'pickup_point_longitude' => '72.321204',
            'pickup_date' => '2021-10-11',
            'pickup_time' => '05:00 AM'
        ]);

        //

        TourPickupPoint::create([
            'tour_id' => 5,
            'pickup_city' => 'Karachi',
            'per_seat_fare' => 7500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 12000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 19000,
            'family_package_fare_currency' => 'PKR',  
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',          
            'pickup_point' => 'Daewoo Terminal Karachi',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '10:00 AM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 5,
            'pickup_city' => 'Multan',
            'per_seat_fare' => 5500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 10000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 16000,
            'family_package_fare_currency' => 'PKR',  
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',          
            'pickup_point' => 'Daewoo Terminal Multan',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '06:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 5,
            'pickup_city' => 'Lahore',
            'per_seat_fare' => 5000,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 9000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 15000,
            'family_package_fare_currency' => 'PKR', 
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',           
            'pickup_point' => 'Daewoo Terminal Lahore',
            'pickup_point_latitude' => '31.506432',
            'pickup_point_longitude' => '74.3243776',
            'pickup_date' => '2021-10-10',
            'pickup_time' => '10:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 5,
            'pickup_city' => 'Islamabad',
            'per_seat_fare' => 4500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 8000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 13000,
            'family_package_fare_currency' => 'PKR',  
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',          
            'pickup_point' => 'Daewoo Terminal Islamabad',
            'pickup_point_latitude' => '32.5453805',
            'pickup_point_longitude' => '72.321204',
            'pickup_date' => '2021-10-11',
            'pickup_time' => '05:00 AM'
        ]);

        //

        TourPickupPoint::create([
            'tour_id' => 6,
            'pickup_city' => 'Karachi',
            'per_seat_fare' => 7500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 12000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 19000,
            'family_package_fare_currency' => 'PKR',  
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',          
            'pickup_point' => 'Daewoo Terminal Karachi',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '10:00 AM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 6,
            'pickup_city' => 'Multan',
            'per_seat_fare' => 5500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 10000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 16000,
            'family_package_fare_currency' => 'PKR', 
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',           
            'pickup_point' => 'Daewoo Terminal Multan',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '06:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 6,
            'pickup_city' => 'Lahore',
            'per_seat_fare' => 5000,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 9000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 15000,
            'family_package_fare_currency' => 'PKR', 
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',           
            'pickup_point' => 'Daewoo Terminal Lahore',
            'pickup_point_latitude' => '31.506432',
            'pickup_point_longitude' => '74.3243776',
            'pickup_date' => '2021-10-10',
            'pickup_time' => '10:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 6,
            'pickup_city' => 'Islamabad',
            'per_seat_fare' => 4500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 8000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 13000,
            'family_package_fare_currency' => 'PKR',   
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',         
            'pickup_point' => 'Daewoo Terminal Islamabad',
            'pickup_point_latitude' => '32.5453805',
            'pickup_point_longitude' => '72.321204',
            'pickup_date' => '2021-10-11',
            'pickup_time' => '05:00 AM'
        ]);

        //

        TourPickupPoint::create([
            'tour_id' => 7,
            'pickup_city' => 'Karachi',
            'per_seat_fare' => 7500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 12000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 19000,
            'family_package_fare_currency' => 'PKR',    
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',        
            'pickup_point' => 'Daewoo Terminal Karachi',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '10:00 AM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 7,
            'pickup_city' => 'Multan',
            'per_seat_fare' => 5500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 10000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 16000,
            'family_package_fare_currency' => 'PKR', 
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',           
            'pickup_point' => 'Daewoo Terminal Multan',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '06:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 7,
            'pickup_city' => 'Lahore',
            'per_seat_fare' => 5000,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 9000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 15000,
            'family_package_fare_currency' => 'PKR', 
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',           
            'pickup_point' => 'Daewoo Terminal Lahore',
            'pickup_point_latitude' => '31.506432',
            'pickup_point_longitude' => '74.3243776',
            'pickup_date' => '2021-10-10',
            'pickup_time' => '10:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 7,
            'pickup_city' => 'Islamabad',
            'per_seat_fare' => 4500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 8000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 13000,
            'family_package_fare_currency' => 'PKR', 
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',           
            'pickup_point' => 'Daewoo Terminal Islamabad',
            'pickup_point_latitude' => '32.5453805',
            'pickup_point_longitude' => '72.321204',
            'pickup_date' => '2021-10-11',
            'pickup_time' => '05:00 AM'
        ]);

        //

        TourPickupPoint::create([
            'tour_id' => 8,
            'pickup_city' => 'Karachi',
            'per_seat_fare' => 7500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 12000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 19000,
            'family_package_fare_currency' => 'PKR', 
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',           
            'pickup_point' => 'Daewoo Terminal Karachi',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '10:00 AM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 8,
            'pickup_city' => 'Multan',
            'per_seat_fare' => 5500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 10000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 16000,
            'family_package_fare_currency' => 'PKR', 
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',           
            'pickup_point' => 'Daewoo Terminal Multan',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '06:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 8,
            'pickup_city' => 'Lahore',
            'per_seat_fare' => 5000,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 9000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 15000,
            'family_package_fare_currency' => 'PKR',  
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',          
            'pickup_point' => 'Daewoo Terminal Lahore',
            'pickup_point_latitude' => '31.506432',
            'pickup_point_longitude' => '74.3243776',
            'pickup_date' => '2021-10-10',
            'pickup_time' => '10:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 8,
            'pickup_city' => 'Islamabad',
            'per_seat_fare' => 4500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 8000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 13000,
            'family_package_fare_currency' => 'PKR', 
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',           
            'pickup_point' => 'Daewoo Terminal Islamabad',
            'pickup_point_latitude' => '32.5453805',
            'pickup_point_longitude' => '72.321204',
            'pickup_date' => '2021-10-11',
            'pickup_time' => '05:00 AM'
        ]);

        //

        TourPickupPoint::create([
            'tour_id' => 9,
            'pickup_city' => 'Karachi',
            'per_seat_fare' => 7500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 12000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 19000,
            'family_package_fare_currency' => 'PKR',  
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',          
            'pickup_point' => 'Daewoo Terminal Karachi',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '10:00 AM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 9,
            'pickup_city' => 'Multan',
            'per_seat_fare' => 5500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 10000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 16000,
            'family_package_fare_currency' => 'PKR',  
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',          
            'pickup_point' => 'Daewoo Terminal Multan',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '06:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 9,
            'pickup_city' => 'Lahore',
            'per_seat_fare' => 5000,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 9000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 15000,
            'family_package_fare_currency' => 'PKR', 
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',           
            'pickup_point' => 'Daewoo Terminal Lahore',
            'pickup_point_latitude' => '31.506432',
            'pickup_point_longitude' => '74.3243776',
            'pickup_date' => '2021-10-10',
            'pickup_time' => '10:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 9,
            'pickup_city' => 'Islamabad',
            'per_seat_fare' => 4500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 8000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 13000,
            'family_package_fare_currency' => 'PKR',  
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',          
            'pickup_point' => 'Daewoo Terminal Islamabad',
            'pickup_point_latitude' => '32.5453805',
            'pickup_point_longitude' => '72.321204',
            'pickup_date' => '2021-10-11',
            'pickup_time' => '05:00 AM'
        ]);

        //

        TourPickupPoint::create([
            'tour_id' => 10,
            'pickup_city' => 'Karachi',
            'per_seat_fare' => 7500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 12000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 19000,
            'family_package_fare_currency' => 'PKR',  
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',          
            'pickup_point' => 'Daewoo Terminal Karachi',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '10:00 AM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 10,
            'pickup_city' => 'Multan',
            'per_seat_fare' => 5500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 10000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 16000,
            'family_package_fare_currency' => 'PKR',  
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',          
            'pickup_point' => 'Daewoo Terminal Multan',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '06:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 10,
            'pickup_city' => 'Lahore',
            'per_seat_fare' => 5000,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 9000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 15000,
            'family_package_fare_currency' => 'PKR', 
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',           
            'pickup_point' => 'Daewoo Terminal Lahore',
            'pickup_point_latitude' => '31.506432',
            'pickup_point_longitude' => '74.3243776',
            'pickup_date' => '2021-10-10',
            'pickup_time' => '10:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 10,
            'pickup_city' => 'Islamabad',
            'per_seat_fare' => 4500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 8000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 13000,
            'family_package_fare_currency' => 'PKR', 
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',           
            'pickup_point' => 'Daewoo Terminal Islamabad',
            'pickup_point_latitude' => '32.5453805',
            'pickup_point_longitude' => '72.321204',
            'pickup_date' => '2021-10-11',
            'pickup_time' => '05:00 AM'
        ]);

        //

        TourPickupPoint::create([
            'tour_id' => 11,
            'pickup_city' => 'Karachi',
            'per_seat_fare' => 7500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 12000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 19000,
            'family_package_fare_currency' => 'PKR', 
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',           
            'pickup_point' => 'Daewoo Terminal Karachi',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '10:00 AM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 11,
            'pickup_city' => 'Multan',
            'per_seat_fare' => 5500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 10000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 16000,
            'family_package_fare_currency' => 'PKR',
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',            
            'pickup_point' => 'Daewoo Terminal Multan',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '06:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 11,
            'pickup_city' => 'Lahore',
            'per_seat_fare' => 5000,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 9000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 15000,
            'family_package_fare_currency' => 'PKR',  
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',          
            'pickup_point' => 'Daewoo Terminal Lahore',
            'pickup_point_latitude' => '31.506432',
            'pickup_point_longitude' => '74.3243776',
            'pickup_date' => '2021-10-10',
            'pickup_time' => '10:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 11,
            'pickup_city' => 'Islamabad',
            'per_seat_fare' => 4500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 8000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 13000,
            'family_package_fare_currency' => 'PKR',  
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',          
            'pickup_point' => 'Daewoo Terminal Islamabad',
            'pickup_point_latitude' => '32.5453805',
            'pickup_point_longitude' => '72.321204',
            'pickup_date' => '2021-10-11',
            'pickup_time' => '05:00 AM'
        ]);

        //

        TourPickupPoint::create([
            'tour_id' => 12,
            'pickup_city' => 'Karachi',
            'per_seat_fare' => 7500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 12000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 19000,
            'family_package_fare_currency' => 'PKR',  
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',          
            'pickup_point' => 'Daewoo Terminal Karachi',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '10:00 AM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 12,
            'pickup_city' => 'Multan',
            'per_seat_fare' => 5500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 10000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 16000,
            'family_package_fare_currency' => 'PKR', 
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',           
            'pickup_point' => 'Daewoo Terminal Multan',
            'pickup_point_latitude' => '31.403247',
            'pickup_point_longitude' => '74.2560357',
            'pickup_date' => '2021-10-09',
            'pickup_time' => '06:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 12,
            'pickup_city' => 'Lahore',
            'per_seat_fare' => 5000,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 9000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 15000,
            'family_package_fare_currency' => 'PKR',  
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',          
            'pickup_point' => 'Daewoo Terminal Lahore',
            'pickup_point_latitude' => '31.506432',
            'pickup_point_longitude' => '74.3243776',
            'pickup_date' => '2021-10-10',
            'pickup_time' => '10:00 PM'
        ]);

        TourPickupPoint::create([
            'tour_id' => 12,
            'pickup_city' => 'Islamabad',
            'per_seat_fare' => 4500,
            'per_seat_fare_currency' => 'PKR',
            'couple_package_fare' => 8000,
            'couple_package_fare_currency' => 'PKR',
            'family_package_fare' => 13000,
            'family_package_fare_currency' => 'PKR',
            'kids_under_3_years' => 'Kids Under 3 Years will be Free',
            'kids_between_3_to_8' => 'Kids between 3 to 8 years will be charge 50% and give jumper seat',
            'kids_above_8_years' => 'Kids above 8 years will be charge full',            
            'pickup_point' => 'Daewoo Terminal Islamabad',
            'pickup_point_latitude' => '32.5453805',
            'pickup_point_longitude' => '72.321204',
            'pickup_date' => '2021-10-11',
            'pickup_time' => '05:00 AM'
        ]);
    }
}
