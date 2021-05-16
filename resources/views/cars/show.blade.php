@extends('layouts.app')

@section('content')
    @if(Auth::user())
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
                                    data-url="{{ route('cars.favorite', $car) }}"
                            >
                            </button>
                        </li>
                    @endcan

                    @can('update', $car)
                        @if($car->image)
                            <li class="mr-5">
                                <form action="{{ route('cars.removeImage', $car) }}" method="POST" class="m-0">
                                    @csrf @method('PUT')
                                    <button class="btn btn-light border">Удалить фото</button>
                                </form>
                            </li>
                        @endif
                    @endcan

                    @if($car->image)
                        <li class="mr-5">
                            <form action="{{ route("cars.downloadImage", $car) }}" method="GET" class="m-0">
                                <button class="btn btn-light border">Скачать фото</button>
                            </form>
                        </li>
                    @endif

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
        <div class="text-2xl">{{ $car->name }}</div>
        <div class="flex mt-4">
            <div class="border rounded-md" style="height: 600px; width: 900px;">
                <img src="{{ Storage::url($car->carImage()) }}" style="height: 100%; width: 100%; object-fit: cover;">
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

    @can('toggleFavorite', $car)
        <script>
            var favoriteButton = document.getElementById('toggle-favorite');
            var isFavorite = favoriteButton.dataset.is === 'true';

            const setFavoriteButtonText = () => {
                let favoriteText = favoriteButton.dataset.favorite;
                let unfavoriteText = favoriteButton.dataset.unfavorite;

                favoriteButton.innerText = isFavorite ? unfavoriteText : favoriteText;
            }

            document.addEventListener('DOMContentLoaded', () => {
                setFavoriteButtonText();

                favoriteButton.addEventListener('click', () => {
                    axios.post(favoriteButton.dataset.url)
                        .then((response) => {
                            if (response.data.status === 'ok') {
                                isFavorite = !isFavorite;
                                favoriteButton.dataset.is = isFavorite ? 'true' : 'false';
                            }
                        })
                        .finally(() => {
                            setFavoriteButtonText();
                        })
                });
            });
        </script>
    @endcan

@endsection
