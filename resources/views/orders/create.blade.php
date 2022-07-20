@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('order.create') }}

        <div class="row mt-2 justify-content-center basket-body">
            <div class="card col-md-12 col-lg-12 p-2">
                <div class="card-body">
                    <h1 class="my-2">{{ __('order.create') }}</h1>
                    @if($basket->contents())
                        <div class="card-images mt-3" id="products-lightbox">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
                                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                            <path
                                                d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z"/>
                                        </svg>
                                    </th>
                                    <th>Название</th>
                                    <th>Цена</th>
                                    <th>Кол-во</th>
                                    <th>Сумма</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = 1
                                @endphp
                                @foreach($basket->contents() as $item)
                                    <tr>
                                        <td>
                                            {{ $i++ }}
                                        </td>
                                        <td>
                                            <img src="{{ $item->product->productThumb }}" class="product-thumb"
                                                 title="{{ $item->product->fullTitle }}"
                                                 alt="{{ $item->product->fullTitle }}">
                                        </td>
                                        <td>
                                            {{ $item->product->fullTitle }}
                                            <div>
                                                <small>
                                                    {{ __('points.index') }}:
                                                    {{ $item->point->title }}</small>,
                                                {{ mb_strtolower( trans_choice('points.city', 1)) }}
                                                {{ $item->point->city }}</small>
                                            </div>
                                        </td>
                                        <td>{{ number_format($item->product->price, 2, '.', ' ') }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->total(), 2, '.', ' ') }}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="3"></th>
                                    <th class="text-end">{{ __('order.amount') }}:</th>
                                    <th>{{ $basket->totalItems() }}</th>
                                    <th>{{ number_format($basket->total(), 2, '.', ' ') }}</th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    @endif

                    <form name="OrderForm" action="{{ route('order.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="orderPointId" class="form-label">{{ __('order.point_id') }}</label>
                            @foreach($points as $point)
                                <div class="form-check">
                                    <input class="form-check-input select_point"
                                           type="radio"
                                           name="point_id"
                                           value="{{$point->id}}"
                                           id="orderPointId{{$point->id}}"
                                           data-longitude="{{ $point->map_longitude }}"
                                           data-latitude="{{ $point->map_latitude }}"
                                           data-zoom="{{ $point->map_zoom }}">
                                    <label class="form-check-label" for="orderPointId{{$point->id}}">
                                        <b>{{ $point->city }}</b>:
                                        {{ $point->title }},
                                        {{ $point->address }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label for="orderComment" class="form-label">{{ __('order.comment') }}</label>
                            <textarea class="form-control" id="orderComment" rows="3" name="comment"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('default.save') }}</button>
                    </form>

                    <div class="card-map mt-3">
                        <div id="map"
                             data-longitude="{{ $point->map_longitude }}"
                             data-latitude="{{ $point->map_latitude }}"
                             data-zoom="{{ $point->map_zoom }}"
                             data-points="{{ $map_point }}"
                             style="width: 100%; height: 400px">
                        </div>
                    </div>

                    <script src="https://api-maps.yandex.ru/2.1/?apikey={{ config('app.yandex_map_api')  }}&lang=ru_RU"
                            type="text/javascript">
                    </script>
                    <script src="{{ asset('js/order.js')}}"></script>

                </div>
            </div>
        </div>
    </div>
@endsection
