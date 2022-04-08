@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('points.show', $item) }}

        {!! $typesNav !!}

        <div class="row mt-2 justify-content-center">
            <div class="card col-md-12 col-lg-12 p-2">
                <div class="card-body">
                    <h1>{{ $item->type->title }} {{ $item->title }}</h1>
                    <p class="card-text">{!! $item->description !!}</p>

                    <div id="map"
                         data-longitude="{{ $item->map_longitude }}"
                         data-latitude="{{ $item->map_latitude }}"
                         data-zoom="{{ $item->map_zoom }}"
                         style="width: 100%; height: 400px"></div>

                </div>
            </div>
        </div>
    </div>



        <script src="https://api-maps.yandex.ru/2.1/?apikey={{ config('app.yandex_map_api')  }}&lang=ru_RU" type="text/javascript">
        </script>
        <script src="{{ asset('js/map.js')}}"></script>

@endsection
