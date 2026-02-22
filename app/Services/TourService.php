<?php

namespace App\Services;

use App\Tour;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Tour business logic (Laravel 11 – professional structure).
 */
class TourService
{
    public function __construct(
        protected Tour $tour
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->tour->newQuery()->with(['agency'])->orderByDesc('id')->paginate($perPage);
    }

    public function find(int $id): ?Tour
    {
        return $this->tour->with(['agency', 'destination', 'benefits'])->find($id);
    }

    public function create(array $data): Tour
    {
        return $this->tour->create($data);
    }

    public function update(Tour $tour, array $data): bool
    {
        return $tour->update($data);
    }

    public function delete(Tour $tour): bool
    {
        return $tour->delete();
    }

    public function byAgency(int $agencyId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->tour->newQuery()
            ->where('agency_id', $agencyId)
            ->orderByDesc('id')
            ->paginate($perPage);
    }
}
