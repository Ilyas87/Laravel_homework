@extends('layouts.app')

@section('content')

    @component('components.car-list', ['cars' => $cars])
    @endcomponent

@endsection
