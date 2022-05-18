@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('points.index') }}

        {!! $navFilter !!}

        <h1 class="mt-2">{{ __('points.index') }}</h1>

        <div class="row mt-2 justify-content-left">
            @foreach ($items as $item)
                <div class="card col-md-4 col-lg-3 p-2">
                    <div class="card-body">
                        <h3 class="card-title"><a href="{{ route('points.show', ['id' => $item->id]) }}"
                                                  class="">{{ $item->title }}</a>
                        </h3>

                        @if ($item->type)
                            <div class="card-address fw-bold text-success">
                                <a class="fw-bold text-success"
                                   href="{{ route('points.index', ['city' => $item->city]) }}">
                                    {{ $item->city }}
                                </a>
                            </div>
                        @endif

                        @if ($item->type)
                            <div class="point_type_block">
                                <a class="fw-bold text-success"
                                   href="{{ route('points.index', ['type' => $item->type->title]) }}">
                                    {{ $item->type->title }}
                                </a>
                            </div>
                        @endif

                        @if ($item->thumb)
                            <img class="thumb m-1" src="{{URL::asset($item->thumb)}}" title="{{ $item->title }}"
                                 alt="{{ $item->title }}"/>
                        @endif
                        <a href="{{ route('points.show', ['id' => $item->id]) }}"
                           class="btn btn-primary position-absolute bottom-0 end-0 m-2">{{ __('default.follow') }}</a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-2">
            {{ $items->links('pagination')}}
        </div>

        @if($item->map_longitude)
            <div class="card-map mt-3">
                <hr>
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

    <script src="https://api-maps.yandex.ru/2.1/?apikey={{ config('app.yandex_map_api')  }}&lang=ru_RU" type="text/javascript">
    </script>
    <script src="{{ asset('js/points.js')}}"></script>

@endsection
