@extends('layouts.app')

@yield('dropdown')

@section('content')
    <div class="overflow-hidden shadow-sm sm:rounded-md">
        <div class="p-6 bg-white border-b border-gray-200">
            <p>
                Имя: <strong class="text-capitalize">{{ $user->name }}</strong> <br/>
                Дата регистрации: <strong>{{ date_format($user->created_at, 'd-m-Y') }}</strong> <br/>
                Количество добавленных объявлений: <strong>{{ $user->cars()->count() }}</strong>
            </p>
        </div>
    </div>
@endsection
