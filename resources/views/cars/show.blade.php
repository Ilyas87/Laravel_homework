@extends('layouts.app')

@section('content')
    <div class="flex p-4 bg-white overflow-hidden shadow-sm sm:rounded-md">
        <div class="mr-3">
            <div class="flex justify-between">
                <div class="text-2xl">{{ $car->name }}</div>
                <div class="flex">
                    <div class="mr-5">
                        @if($car->image)
                            @can('update', $car)
                                <form action="{{ route('cars.removeImage', $car) }}" method="post">
                                    @csrf @method('put')
                                    <button class="btn btn-light border">Удалить фото</button>
                                </form>
                            @endcan
                        @endif
                    </div>
                    <div>
                        @if($car->image)
                            <form action="{{ route("cars.downloadImage", $car) }}" method="get">
                                <button class="btn btn-light border">Скачать фото</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-4 border rounded-md" style="height: 600px; width: 900px;">
                <img src="{{ Storage::url($car->carImage()) }}" style="height: 100%; width: 100%; object-fit: cover;">
            </div>
        </div>
        <div class="w-64">
            <div class="flex justify-around" style="height: 38px">
                @can('update', $car)
                    <a href="{{ route('cars.edit', $car) }}" class="btn btn-light border">
                        Редактировать
                    </a>
                @endcan
                @can('delete', $car)
                    <form action="{{ route('cars.destroy', $car) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-light border">Удалить</button>
                    </form>
                @endcan
            </div>
            <div class="pl-5 pt-3 flex flex-col">
                <div class="pt-2 inline-flex">
                    <div class="pr-2">
                        <strong>Год</strong>
                    </div>
                    <span>{{ $car->year }}</span>
                </div>
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
                        <strong>Пробег, км</strong>
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
