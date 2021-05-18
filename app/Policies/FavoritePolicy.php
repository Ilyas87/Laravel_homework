<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class FavoritePolicy
{

    use HandlesAuthorization;

    public function view(User $user, Model $model)
    {
        return $user->id == $model->id;
    }
}
