@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('points.show', $item) }}

        {!! $navFilter !!}

        <div class="row mt-2 justify-content-center">
            <div class="card col-md-12 col-lg-12 p-2">
                <div class="card-body">
                    <h1>{{ $item->type->title }} {{ $item->title }}</h1>

                    <div class="card-address fw-bold text-success">
                        {{ $item->country }} / {{ $item->city }} /  {{ $item->address }}
                    </div>

                    <div class="card-text mt-2">
                        {!! $item->description !!}
                    </div>

                    @if($item->imagesList)
                        <div class="card-images mt-3" id="points-lightbox">
                            <h3 class="my-2">{{ __('points.images') }}</h3>
                            @foreach($item->imagesList as $image)
                                <a href="{{URL::asset($image)}}" data-toggle="lightbox" data-gallery="points-gallery">
                                    <img class="thumb"
                                         src="{{URL::asset($image)}}"
                                         title="{{ $item->title }}"
                                         alt="{{ $item->title }}"
                                    >
                                </a>
                            @endforeach
                        </div>
                    @endif

                    @if($item->map_longitude)
                        <div class="card-map mt-3">
                            <div id="map"
                                 data-longitude="{{ $item->map_longitude }}"
                                 data-latitude="{{ $item->map_latitude }}"
                                 data-zoom="{{ $item->map_zoom }}"
                                 data-points="{{ $map_point }}"
                                 style="width: 100%; height: 400px">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>



        <script src="https://api-maps.yandex.ru/2.1/?apikey={{ config('app.yandex_map_api')  }}&lang=ru_RU" type="text/javascript">
        </script>
        <script src="{{ asset('js/points.js')}}"></script>

@endsection
