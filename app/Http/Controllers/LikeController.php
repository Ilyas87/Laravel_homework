<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function toggleLike(Car $car){
        $this->authorize('toggle-like', $car);

        $user = auth()->user();
        $car->likers()->toggle($user);

        if (request()->wantsJson()) {
            return [
                'status' => 'ok'
            ];
        }

        return back();
    }
}
