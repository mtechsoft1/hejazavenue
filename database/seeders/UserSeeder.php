<?php

namespace Database\Seeders;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

/**
 * Seeds users: admin, sample users, agencies (Laravel 11 structure).
 */
class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'type' => USER_TYPES['admin'],
            'profile_image' => 'profile_images/dhwlGDke1O.jpeg',
            'email_verified_at' => Carbon::now(),
        ]);

        foreach ($this->sampleUsers() as $user) {
            User::create($user);
        }

        foreach ($this->sampleAgencies() as $agency) {
            User::create($agency);
        }
    }

    /** @return array<int, array<string, mixed>> */
    private function sampleUsers(): array
    {
        return [
            [
                'name' => 'Kamran',
                'email' => 'kamranabrar90@gmail.com',
                'phone' => '+923236691890',
                'password' => bcrypt('12345678'),
                'type' => USER_TYPES['user'],
                'email_verified_at' => Carbon::now(),
                'profile_image' => 'profile_images/dhwlGDke1O.png',
            ],
            [
                'name' => 'Ahmad',
                'email' => 'ahmad@gmail.com',
                'phone' => '+923216691890',
                'password' => bcrypt('12345678'),
                'type' => USER_TYPES['user'],
                'email_verified_at' => Carbon::now(),
                'profile_image' => 'profile_images/dhwlGDke1O.png',
            ],
        ];
    }

    /** @return array<int, array<string, mixed>> */
    private function sampleAgencies(): array
    {
        return [
            ['name' => 'Syed Ali Bukhari', 'company_name' => 'Bukhari Travels', 'email' => 'bukhari@gmail.com', 'phone' => '+923247091890', 'password' => bcrypt('12345678'), 'type' => USER_TYPES['agency'], 'email_verified_at' => Carbon::now(), 'profile_image' => 'https://www.trips.pk/Resources/CompnyImg/Bukhari-travelers.jpg'],
            ['name' => 'Malik Ahmad', 'company_name' => 'Malik Travel & Tours', 'email' => 'malik_travel@gmail.com', 'phone' => '+923226621590', 'password' => bcrypt('12345678'), 'type' => USER_TYPES['agency'], 'email_verified_at' => Carbon::now(), 'profile_image' => 'https://www.trips.pk/Resources/CompnyImg/Malik-tours.jpg'],
            ['name' => 'Subhan Ahmad', 'company_name' => 'Fatimah Travels & Tours', 'email' => 'fatimah@gmail.com', 'phone' => '+923256297896', 'password' => bcrypt('12345678'), 'type' => USER_TYPES['agency'], 'email_verified_at' => Carbon::now(), 'profile_image' => 'https://www.trips.pk/Resources/CompnyImg/Fatimah-and-Faroq-Travels.jpg'],
            ['name' => 'Shahzaib Nazir', 'company_name' => 'Tour Buddies', 'email' => 'tour_buddies@gmail.com', 'phone' => '+923216624590', 'password' => bcrypt('12345678'), 'type' => USER_TYPES['agency'], 'email_verified_at' => Carbon::now(), 'profile_image' => 'https://www.trips.pk/Resources/CompnyImg/tour-buddies-logo.jpg'],
            ['name' => 'Asif Ahmad', 'company_name' => 'AFAF RABANA', 'email' => 'afaf@gmail.com', 'phone' => '+923226395870', 'password' => bcrypt('12345678'), 'type' => USER_TYPES['agency'], 'email_verified_at' => Carbon::now(), 'profile_image' => 'https://www.trips.pk/Resources/CompnyImg/1127.png'],
            ['name' => 'Sharjeel Khan', 'company_name' => 'Crown Travel & Tours', 'email' => 'crown@gmail.com', 'phone' => '+923316631890', 'password' => bcrypt('12345678'), 'type' => USER_TYPES['agency'], 'email_verified_at' => Carbon::now(), 'profile_image' => 'https://www.trips.pk/Resources/CompnyImg/Crown-Travel-and-tours.jpg'],
            ['name' => 'Malik Haris', 'company_name' => 'Haris Travels & Tours', 'email' => 'haris@gmail.com', 'phone' => '+923316631890', 'password' => bcrypt('12345678'), 'type' => USER_TYPES['agency'], 'email_verified_at' => Carbon::now(), 'profile_image' => 'https://www.trips.pk/Resources/CompnyImg/Haris-Travel-and-tours.jpg'],
        ];
    }
}
