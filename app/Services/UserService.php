<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

/**
 * User business logic (Laravel 11 – professional structure).
 */
class UserService
{
    public function __construct(
        protected User $user
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->user->newQuery()->orderByDesc('id')->paginate($perPage);
    }

    public function find(int $id): ?User
    {
        return $this->user->find($id);
    }

    public function create(array $data): User
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $this->user->create($data);
    }

    public function update(User $user, array $data): bool
    {
        if (isset($data['password']) && ! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        return $user->update($data);
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }

    public function providers(int $perPage = 15): LengthAwarePaginator
    {
        return $this->user->newQuery()
            ->where('type', USER_TYPES['agency'])
            ->orderByDesc('id')
            ->paginate($perPage);
    }
}
