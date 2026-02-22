<?php

namespace Database\Seeders;

use App\Gallary;
use Illuminate\Database\Seeder;

/**
 * Seeds gallery images/videos for tours (Laravel 11 structure).
 * Depends on: TourSeeder.
 */
class GallarySeeder extends Seeder
{
    public function run(): void
    {
        // TourSeeder creates 3 tours (ids 1, 2, 3) – only seed galleries for existing tours
        $tourIds = \App\Tour::pluck('id')->toArray();
        if (empty($tourIds)) {
            return;
        }
        foreach ($tourIds as $tourId) {
            Gallary::create([
                'tour_id' => $tourId,
                'image' => 'gallary_images/1.jpg',
                'video' => 'gallary_videos/video.mp4',
            ]);
        }
    }
}
