@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('basket.index') }}

        <div class="row mt-2 justify-content-center basket-body">
            <div class="card col-md-12 col-lg-12 p-2">
                <div class="card-body">
                    <h1 class="my-2">{{ __('basket.index') }}</h1>
                    @php
                        $items = $basket->contents();
                    @endphp
                    @if($items)
                        <div class="card-images mt-3" id="products-lightbox">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>#</th>
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
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{ $i++ }}
                                        </td>
                                        <td>
                                            {{ $item->name }}
                                            <div>
                                                <small>
                                                    {{ __('points.index') }}:
                                                    <a href="{{ route('points.show', ['slug' => $item->point->slug]) }}"
                                                       class="">{{ $item->point->title }}</a></small>,
                                                 {{ mb_strtolower( trans('points.city')) }}
                                                <a href="{{ route('points.index', ['city' => $item->point->city]) }}">
                                                    {{ $item->point->city }}</a></small>
                                            </div>
                                        </td>
                                        <td>{{ number_format($item->price, 2, '.', ' ') }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->total(), 2, '.', ' ') }}</td>
                                        <td>
                                            <a class="basket-pills btn rounded-circle btn-sm border border-1 border-dark" href="{{ route('basket.plus', ['identifier'=>$item->identifier]) }}"
                                               title="{{ __('basket.plus') }}">+</a>
                                            <a class="basket-pills btn rounded-circle btn-sm border border-1 border-dark" href="{{ route('basket.minus', ['identifier'=>$item->identifier]) }}"
                                               title="{{ __('basket.minus') }}">-</a>
                                            <a class="basket-pills btn btn-danger btn-sm rounded-circle border border-1 border-dark"  href="{{ route('basket.delete', ['identifier'=>$item->identifier]) }}"
                                               title="{{ __('basket.delete')}}">X</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <th>
                                    <tr>
                                        <th colspan="4"></th>
                                        <th>{{ __('basket.total') }}: {{ number_format($basket->total(), 2, '.', ' ') }}</th>
                                        <th></th>
                                    </tr>
                                </th>
                                </tfoot>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
