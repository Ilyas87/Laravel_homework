@extends('layouts.app')

@section('content')
    @if(auth()->user())
        <div class="flex justify-center mb-2 bg-white overflow-hidden shadow-sm sm:rounded-md">
            <div class="p-3">
                <ul class="flex p-0 m-0">
                    @can('toggleFavorite', $car)
                        <li class="mr-5">
                            <button class="btn btn-light border"
                                    type="button"
                                    id="toggle-favorite"
                                    data-is="{{ $car->followers()->where('user_id', auth()->id())->exists() ? 'true' : 'false' }}"
                                    data-favorite="Добавить в избранное"
                                    data-unfavorite="Удалить из избранного"
                                    data-url="{{ route('cars.favorite', $car) }}">
                            </button>
                        </li>
                    @endcan

                    @can('update', $car)
                        <li class="mr-5">
                            <form action="{{ route('cars.removeImage', $car) }}" method="POST" class="m-0">
                                @csrf
                                @method('PUT')

                                @if($car->image)
                                    <button class="btn btn-light border">Удалить фото</button>
                                @else
                                    <button class="btn btn-light border" disabled>Удалить фото</button>
                                @endif
                            </form>
                        </li>
                    @endcan

                    @can('downloadImage', $car)
                        <li class="mr-5">
                            <form action="{{ route("cars.downloadImage", $car) }}" method="GET" class="m-0">
                                @if($car->image)
                                    <button class="btn btn-light border">Скачать фото</button>
                                @else
                                    <button class="btn btn-light border" disabled>Скачать фото</button>
                                @endif
                            </form>
                        </li>
                    @endcan

                    @can('update', $car)
                        <li class="mr-5">
                            <a href="{{ route('cars.edit', $car) }}" class="btn btn-light border">
                                Редактировать
                            </a>
                        </li>
                    @endcan

                    @can('delete', $car)
                        <li class="mr-5">
                            <form action="{{ route('cars.destroy', $car) }}" method="POST" class="m-0">
                                @csrf
                                @method('delete')

                                <button class="btn btn-light border">Удалить объявление</button>
                            </form>
                        </li>
                    @endcan
                </ul>
            </div>
        </div>
    @endif

    <div class="p-4 bg-white overflow-hidden shadow-sm sm:rounded-md">
        <div class="flex justify-between">
            <div class="text-2xl">{{ $car->name }}</div>
            <div class="flex items-center">
                @can('toggleLike', $car)
                    <button type="button"
                            id="toggle-like"
                            data-is="{{ $car->likers()->where('user_id', auth()->id())->exists() ? 'true' : 'false' }}"
                            data-url="{{ route('cars.like', $car) }}"
                    >
                        <img id="image" src="" alt="" class="w-7 h-7">
                    </button>
                @endcan
            </div>
        </div>
        <div class="flex mt-4">
            <div class="border rounded-md" style="height: 600px; width: 900px;">
                <img src="{{ Storage::url($car->carImage()) }}" style="height: 100%; width: 100%; object-fit: cover;" alt="">
            </div>

            <ul class="m-0">
                <li class="flex mb-2">
                    <div class="font-bold pr-2">Год</div>
                    <span>{{ $car->year }}</span>
                </li>
                <li class="flex mb-2">
                    <div class="font-bold pr-2">Цвет</div>
                    <span>{{ $car->color }}</span>
                </li>
                <li class="flex mb-2">
                    <div class="font-bold pr-2">Объем двигателя, л</div>
                    <span>{{ $car->engane }}</span>
                </li>
                <li class="flex mb-2">
                    <div class="font-bold pr-2">Пробег, км</div>
                    <span>{{ $car->mileage }}</span>
                </li>
                <li class="flex mb-2">
                    <div class="font-bold pr-2">Коробка передач</div>
                    <span>{{ $car->transmission }}</span>
                </li>
            </ul>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" defer></script>
    <script src="{{ asset('js/like.js') }}" defer></script>
    <script src="{{ asset('js/favorite.js') }}" defer></script>
@endpush
