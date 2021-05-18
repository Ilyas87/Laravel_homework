<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function favorite(User $user){
        $this->authorize('view', $user);
        return view('favorite', [
            'user' => $user
        ]);
    }

    public function toggleFavorite(Car $car)
    {
        $this->authorize('toggle-favorite', $car);

        $user = auth()->user();
        $car->followers()->toggle($user);

        if (request()->wantsJson()) {
            return [
                'status' => 'ok'
            ];
        }

        return back();
    }
}
