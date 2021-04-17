<?php

namespace App\Policies;

use App\Models\Car;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CarPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->id == Auth::id();
    }

    public function update(User $user, Car $car)
    {
        return $user->id == $car->user_id;
    }

    public function delete(User $user, Car $car)
    {
        return $user->id == $car->user_id;
    }
}
