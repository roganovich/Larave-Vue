@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('basket.index') }}

        <div class="row mt-2 justify-content-center basket-body">
            <div class="card col-md-12 col-lg-12 p-2">
                <div class="card-body">
                    <h1 class="my-2">{{ __('basket.index') }}</h1>
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
                                            <a href="{{ route('products.show', ['brand_slug'=>$item->product->brand->slug,'product_slug' => $item->product->slug]) }}"
                                               title="{{ __('default.follow') }}">
                                                {{ $i++ }}
                                            </a>
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
                                                    <a href="{{ route('points.show', ['slug' => $item->point->slug]) }}"
                                                       class="">{{ $item->point->title }}</a></small>,
                                                {{ mb_strtolower( trans_choice('points.city', 1)) }}
                                                <a href="{{ route('points.index', ['city' => $item->point->city]) }}">
                                                    {{ $item->point->city }}</a></small>
                                            </div>
                                        </td>
                                        <td>{{ number_format($item->product->price, 2, '.', ' ') }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->total(), 2, '.', ' ') }}</td>
                                        <td class="text-end">
                                            <div class="btn-group">
                                                <a class="btn btn-outline-secondary"
                                                   href="{{ route('products.show', ['brand_slug'=>$item->product->brand->slug,'product_slug' => $item->product->slug]) }}"
                                                   title="{{ __('default.follow') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                        <path
                                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                        <path
                                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                    </svg>
                                                </a>
                                                <a class="btn btn-outline-secondary"
                                                   href="{{ route('basket.plus', ['identifier'=>$item->identifier]) }}"
                                                   title="{{ __('basket.plus') }}">+</a>
                                                <a class="btn btn-outline-secondary"
                                                   href="{{ route('basket.minus', ['identifier'=>$item->identifier]) }}"
                                                   title="{{ __('basket.minus') }}">-</a>
                                                <a class="btn btn-outline-secondary "
                                                   href="{{ route('basket.delete', ['identifier'=>$item->identifier]) }}"
                                                   title="{{ __('basket.delete')}}">X</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>

                                <tr>
                                    <th colspan="3"></th>
                                    <th class="text-end">{{ __('basket.total') }}:</th>
                                    <th>{{ $basket->totalItems() }}</th>
                                    <th>{{ number_format($basket->total(), 2, '.', ' ') }}</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th colspan="7" class="text-end">
                                        <a class="btn btn-success" href="{{ route('order.create') }}"
                                           title="{{ __('basket.toorder') }}">
                                            {{ __('basket.toorder') }}
                                        </a>
                                        <a class="btn btn-danger" href="{{ route('basket.clear') }}"
                                           title="{{ __('basket.clear') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd"
                                                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg>
                                        </a>
                                    </th>
                                </tr>

                                </tfoot>
                            </table>

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
