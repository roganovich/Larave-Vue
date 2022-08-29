@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('products.index') }}
        <h1 class="mt-2">{{ __('products.index') }}</h1>

        <div class="row mt-2 justify-content-left">
            <div class="col-md-3 col-lg-2">
                {!! $navFilter !!}
            </div>
            <div class="col-md-9 col-lg-10">
                <div class="row mt-2 justify-content-left">
                    @foreach ($items as $item)
                        <div class="card col-md-6 col-lg-4 p-2">
                            <img src="{{ $item->productThumb }}" class="card-img-top" title="{{ $item->fullTitle }}" alt="{{ $item->fullTitle }}">
                            <div class="card-body">
                                <h3 class="card-title"><a href="{{ route('products.show', ['brand_slug'=>$item->brand->slug,'product_slug' => $item->slug]) }}"
                                                          class="">{{ $item->fullTitle }} </a>
                                </h3>
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        <div class="card-address fw-bold">
                                            @if ($item->brand)
                                                <a class="fw-bold text-success"
                                                   href="{{ route('products.index', ['Product[brand]' => $item->brand->slug]) }}">
                                                    #{{ $item->brand->title }}
                                                </a>
                                            @endif
                                        </div>
                                        <div class="card-address fw-bold">
                                            @if ($item->categoriesList)
                                                @foreach ($item->categoriesList as $category)
                                                    <a class="fw-bold text-info"
                                                       href="{{ route('products.index', ['Product[category]' =>$category->slug]) }}">
                                                        #{{ $category->title }}
                                                    </a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <a href="{{ route('products.show', ['brand_slug'=>$item->brand->slug,'product_slug' => $item->slug]) }}" title="{{ __('default.follow') }}"
                                           class="btn btn-success position-absolute bottom-0 end-0 m-2">
                                            {{ __('default.price') }} {{ $item->price }} {{ __('default.rub') }} </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-2">
            {{ $items->links('pagination')}}
        </div>
    </div>
@endsection
