<?php
    $car = $car ?? null;
?>

@extends('layouts.app')

@section('content')
    <div class="container flex justify-center">
        <div class="bg-white rounded-md">
            <div class="p-4">
                <div class="text-2xl">{{ $car ? 'Редактирование объявление' : 'Новое объявление' }}</div>
                <div class="pt-3" style="width: 800px">
                    <form action="{{ $car ? route('cars.update', $car) : route('cars.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                        @csrf

                        @if($car)
                            @method('put')
                        @endif

                        <div class="col-md-12">
                            <label for="name" class="">Наименования автомобиля</label>
                            <input type="text" value="{{ old('name', $car->name ?? null) }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name">

                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="year" class="">Год</label>
                            <input type="text" placeholder="yyyy" value="{{ old('year', $car->year ?? null) }}" class="form-control @error('year') is-invalid @enderror" name="year" id="year">

                            @error('year')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="engine" class="">Объем двигателя, л</label>
                            <input type="text" placeholder="0.0" value="{{ old('engine', $car->engine ?? null) }}" class="form-control @error('engine') is-invalid @enderror" name="engine" id="engine">

                            @error('engine')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="mileage" class="">Пробег, км</label>
                            <input type="text" placeholder="1000" value="{{ old('mileage', $car->mileage ?? null) }}" class="form-control @error('mileage') is-invalid @enderror" name="mileage" id="mileage">

                            @error('mileage')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="color">Цвет</label>
                            <input type="text" value="{{ old('color', $car->color ?? null) }}" class="form-control @error('color') is-invalid @enderror" name="color" id="color">

                            @error('color')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="transmission">Коробка передач</label>
                            <select name="transmission" id="transmission" class="cursor-pointer border form @error('transmission') is-invalid @enderror">
                                <option selected disabled hidden>Выберите...</option>
                                <option>Автомат</option>
                                <option>Механика</option>
                                <option>Вариатор</option>
                            </select>

                            @error('transmission')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="image">Фотография</label>
                            <input type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" id="image">

                            @error('image')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <button class="btn btn-light border">{{ $car ? 'Обновить объявление' : 'Подать объявление' }}</button>
                            <a href="{{ $car ? route('cars.show', [ 'car' => $car]) : route('cars.index') }}" class="btn btn-light border ml-3">Назад</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
