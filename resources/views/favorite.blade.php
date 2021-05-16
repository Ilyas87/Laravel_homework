@extends('layouts.app')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-md">
        <div class="p-6">
            <h3>
                Избранное
            </h3>
        </div>
    </div>

    @component('components.car-list', [
        'cars' =>  $user->favorites()->latest()->simplePaginate(10)
    ])
    @endcomponent
@endsection
