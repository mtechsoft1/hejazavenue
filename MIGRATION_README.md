# Laravel 11 + Tailwind Migration – Professional Structure

This document describes the professional refactor applied to the project.

## 1. Laravel 11

- **composer.json**: Updated to Laravel 11, PHP ^8.2, Sanctum ^4, laravel/ui ^4.6, Stripe ^17, fakerphp/faker, nunomaduro/collision ^8.1, PHPUnit ^10.5.
- **Middleware**: Replaced `CheckForMaintenanceMode` with `PreventRequestsDuringMaintenance` in `app/Http/Kernel.php`.
- **Autoload**: `Database\Seeders` points to `database/seeders/` (Laravel 11 standard).

**After pull, run:**
```bash
composer update
php artisan vendor:publish --tag=sanctum-migrations  # if using Sanctum
php artisan migrate
```

## 2. Vite + Tailwind

- **package.json**: Laravel Mix removed. Added Vite, laravel-vite-plugin, Tailwind 3, PostCSS, Autoprefixer, @tailwindcss/forms, @tailwindcss/typography.
- **vite.config.js**: Laravel plugin with `resources/css/app.css` and `resources/js/app.js`.
- **tailwind.config.js**: Content from `resources/views/**/*.blade.php` and `resources/js/**/*.js`.
- **postcss.config.js**: tailwindcss + autoprefixer.
- **resources/css/app.css**: `@tailwind base; @tailwind components; @tailwind utilities;`
- **resources/js/app.js**: Imports `./bootstrap` (axios/CSRF if present).

**Commands:**
```bash
npm install
npm run dev    # development with HMR
npm run build  # production build
```

Layouts use `@vite(['resources/css/app.css', 'resources/js/app.js'])` instead of the Tailwind CDN.

## 3. Blade Structure

### Guest / Front

- **layouts/guest.blade.php**: Main guest layout (head, header, navbar, content, footer, scripts).
- **layouts/components/head.blade.php**: Meta, title, Vite, extra styles.
- **layouts/components/header.blade.php**: Optional top bar.
- **components/navbar.blade.php**: Existing sticky navbar (unchanged).
- **layouts/components/footer.blade.php**: Footer with Support, Discover, Terms, About.

Use in views: `@extends('layouts.guest')` and `@section('content')`.

### Admin

- **layouts/admin/master.blade.php**: Admin layout (sidebar + content area).
- **layouts/components/admin/sidebar.blade.php**: Sidebar nav (Users, Destinations, Tours, Bookings, Reviews, Contact).
- **layouts/components/admin/header.blade.php**: Top bar with sidebar toggle, user name, View Site, Logout.
- **layouts/components/admin/footer.blade.php**: Simple admin footer.

Use in admin views: `@extends('layouts.admin.master')` and `@section('content')`.  
Existing admin views still extend `layouts.admin.app`; you can migrate them to `layouts.admin.master` when ready.

## 4. Routes (Laravel 11 Style)

- **routes/web.php**: All routes use class-based syntax, e.g. `[UserNavigationController::class, 'index']`.
- Grouped with `Route::prefix()->as()->middleware()->group()`.
- Auth::routes(['verify' => true]).
- Logout: `Route::get('/logout', ...)->name('logout')`.
- Dev helpers under `Route::prefix('dev')`.

No route files were split; everything stays in `web.php` for clarity. You can later move admin/user/agency routes into `routes/admin.php`, `routes/user.php`, etc. and load them in `RouteServiceProvider` or `bootstrap/app.php`.

## 5. Services

Business logic moved into service classes:

- **app/Services/UserService.php**: paginate, find, create, update, delete, providers.
- **app/Services/TourService.php**: paginate, find, create, update, delete, byAgency.
- **app/Services/BookingService.php**: paginate, find, updateStatus, byUser, byTour.

Controllers can inject these and call e.g. `$this->userService->paginate(15)`. Existing controllers were not refactored; you can gradually switch them to use services.

## 6. Seeders (Laravel 11 Structure)

- **database/seeders/DatabaseSeeder.php**: Calls UserSeeder, DestinationSeeder, TourSeeder, TourBookingSeeder, NotificationSeeder, TourPickupPointSeeder, GallarySeeder (namespace `Database\Seeders`).
- **database/seeders/UserSeeder.php**: Admin + sample users + agencies (uses `App\User` and `USER_TYPES`).
- **database/seeders/DestinationSeeder.php**: Naran–Kaghan, Fairy Meadows, Hunza Valley.
- **database/seeders/TourSeeder.php**: Sample tours (depends on users/destinations).
- **database/seeders/TourBookingSeeder.php**: Sample bookings (uses `status`).
- **database/seeders/NotificationSeeder.php**: One sample notification.
- **database/seeders/TourPickupPointSeeder.php**: One sample pickup point.
- **database/seeders/GallarySeeder.php**: Gallery entries for tours 1–4.

**Run seeders:**
```bash
php artisan db:seed
# or
php artisan db:seed --class=UserSeeder
```

The old `database/seeds/` folder is unchanged; the app now uses `database/seeders/` and `Database\Seeders` namespace only.

## 7. File Structure Summary

```
app/
  Services/
    UserService.php
    TourService.php
    BookingService.php
  (rest unchanged)

database/
  seeders/           ← New (Laravel 11)
    DatabaseSeeder.php
    UserSeeder.php
    DestinationSeeder.php
    TourSeeder.php
    TourBookingSeeder.php
    NotificationSeeder.php
    TourPickupPointSeeder.php
    GallarySeeder.php
  seeds/             ← Old (kept for reference; not used by artisan db:seed)

resources/
  css/
    app.css         ← Tailwind entry
  js/
    app.js
    bootstrap.js
  views/
    layouts/
      guest.blade.php
      admin/
        master.blade.php
      components/
        head.blade.php
        header.blade.php
        footer.blade.php
        admin/
          sidebar.blade.php
          header.blade.php
          footer.blade.php
```

## 8. Next Steps

1. Run `composer update` and fix any dependency conflicts.
2. Run `npm install && npm run build` and confirm frontend loads.
3. Optionally migrate more views from `layouts.app` to `layouts.guest` and from `layouts.admin.app` to `layouts.admin.master`.
4. Refactor controllers to use `UserService`, `TourService`, `BookingService` where appropriate.
5. Remove `database/seeds` and any references once you are satisfied with `database/seeders`.

All changes are backward-compatible: existing layouts and controllers continue to work; new structure is additive.
