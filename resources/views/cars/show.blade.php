@extends('layouts.app')

@section('content')
    <div class="flex p-4 bg-white overflow-hidden shadow-sm sm:rounded-md">
        <div>
            <div class="text-2xl">{{ $car->name }} {{ $car->year }} года</div>
            <div class="mt-4 mr-3 border rounded-md" style="height: 600px; width: 900px;">
                <img src="{{ Storage::url($car->image) }}" style="height: 100%; width: 100%; object-fit: cover;">
            </div>
        </div>
        <div class="w-64">
            <div class="flex justify-around" style="height: 38px">
               <a href="{{ route('cars.edit', $car) }}" class="btn btn-light border">
                    Редактировать
                </a>
                <form action="{{ route('cars.destroy', $car) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-light border">Удалить</button>
                </form>
            </div>
            <div class="pl-5 pt-2 flex flex-col">
                <div class="pt-2 inline-flex">
                    <div class="pr-2">
                        <strong>Цвет</strong>
                    </div>
                    <span>{{ $car->color }}</span>
                </div>
                <div class="pt-2 inline-flex">
                    <div class="pr-2">
                        <strong>Объем двигателя, л</strong>
                    </div>
                    <span>{{ $car->engane }}</span>
                </div>
                <div class="pt-2 inline-flex">
                    <div class="pr-2">
                        <strong>Пробег</strong>
                    </div>
                    <span>{{ $car->mileage }}</span>
                </div>
                <div class="pt-2 inline-flex">
                    <div class="pr-2">
                        <strong>Коробка передач</strong>
                    </div>
                    <span>{{ $car->transmission }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
