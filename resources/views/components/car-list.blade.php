@if($cars->isEmpty())
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-md m-1 my-2">
        <div class="p-6">
            <h5>
                Нет добавленных объявлений
            </h5>
        </div>
    </div>
@else

    <div class="flex flex-row flex-wrap">
        @foreach($cars as $car)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-md m-1 my-2" style="width: 235px">
                <div class="p-6">
                    <a href="{{ route('cars.show', ['car' => $car]) }}" class="text-decoration-none text-gray-500 hover:text-black">
                        <div class="text-2xl flex-wrap" style="height: 64px;">{{ $car->name }}</div>
                        <div class="mb-3">{{ $car->year }} года</div>
                        <div style="height: 252px">
                            <img src="{{ Storage::url($car->carImage()) }}" class="rounded-md" style="height: 100%; width: 100%; object-fit: cover;">
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="py-2 flex justify-center">
        {{ $cars->withQueryString()->links() }}
    </div>
@endif
