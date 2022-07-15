@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('order.index') }}

        <div class="row mt-2 justify-content-center basket-body">
            <div class="card col-md-12 col-lg-12 p-2">
                <div class="card-body">
                    <h1 class="my-2">{{ __('order.show') }} #{{ $order->id }}</h1>
                    <div class="row">
                        <div class="col-4">
                            <div class="fw-bold">{{ __('order.info') }}</div>
                            <ol class="list-group list-group-flush">
                                <li class="list-group-item border-0">
                                    <div class="ms-2 me-auto">
                                        <span class="fw-bold">{{ __('order.id') }}:</span>
                                        {{ $order->id }}
                                    </div>
                                </li>
                                <li class="list-group-item border-0">
                                    <div class="ms-2 me-auto">
                                        <span class="fw-bold">{{ __('order.created_at') }}:</span>
                                        {{ $order->created_at }}
                                    </div>
                                </li>
                                <li class="list-group-item border-0">
                                    <div class="ms-2 me-auto">
                                        <span class="fw-bold">{{ __('order.status') }}:</span>
                                        {{ $order->status }}
                                    </div>
                                </li>
                                <li class="list-group-item border-0">
                                    <div class="ms-2 me-auto">
                                        <span class="fw-bold">{{ __('order.amount') }}:</span>
                                        {{ $order->amount }}
                                    </div>
                                </li>
                                <li class="list-group-item border-0">
                                    <div class="ms-2 me-auto">
                                        <span class="fw-bold">{{ __('order.manager') }}:</span>
                                        {{ $order->manager_id }}
                                    </div>
                                </li>
                            </ol>
                        </div>
                        <div class="col-8">
                            @if($order->items)
                                <div class="fw-bold">{{ __('order.items') }}</div>
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
                                        @foreach($order->items as $item)
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
                                                    {{ $item->product->fullTitle  }}
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
                                                <td>{{ number_format($item->price, 2, '.', ' ') }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>{{ number_format($item->amount, 2, '.', ' ') }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th colspan="3"></th>
                                            <th class="text-end">{{ __('basket.total') }}:</th>
                                            <th>{{ count($order->items) }}</th>
                                            <th>{{ number_format($order->amount, 2, '.', ' ') }}</th>
                                            <th></th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
