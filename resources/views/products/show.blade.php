@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('products.show', $item) }}

        <div class="row mt-2 justify-content-center">
            <div class="card col-md-12 col-lg-12 p-2">
                <div class="card-body">
                    <h1>{{ $item->fullTitle }}</h1>

                    @if ($item->brand)
                        <div class="card-address fw-bold text-success">
                            <a class="fw-bold text-success"
                               href="{{ route('products.index', ['Product[brand]' => $item->brand->slug]) }}">
                                {{ $item->brand->title }}
                            </a>
                        </div>
                    @endif

                    @if ($item->categoriesList)
                        @foreach ($item->categoriesList as $category)
                            <div class="card-address fw-bold text-success">
                                <a class="fw-bold text-info"
                                   href="{{ route('products.index', ['Product[category]' =>$category->slug]) }}">
                                    {{ $category->title }}
                                </a>
                            </div>
                        @endforeach
                    @endif

                    <div class="card-text mt-2">
                        {!! $item->description !!}
                    </div>

                    @if($item->imagesList)
                        <div class="card-images mt-3" id="products-lightbox">
                            <h3 class="my-2">{{ __('products.images') }}</h3>
                            @foreach($item->imagesList as $image)
                                <a href="{{URL::asset($image)}}" data-toggle="lightbox" data-gallery="products-gallery">
                                    <img class="thumb"
                                         src="{{URL::asset($image)}}"
                                         title="{{ $item->text }}"
                                         alt="{{ $item->text }}"
                                    >
                                </a>
                            @endforeach
                        </div>
                    @endif

                    @if($item->restList)
                        <div class="card-images mt-3" id="products-lightbox">
                            <h3 class="my-2">{{ __('products.rests') }}</h3>
                            <table class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Склад</th>
                                        <th>Остатки</th>
                                        <th>Цена</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($item->restList as $i=>$rest)
                                        <tr>
                                            <td>{{ $i+1 }}</td>
                                            <td>{{ $rest->point->title }}</td>
                                            <td>{{ $rest->qty }}</td>
                                            <td>
                                                <a class="btn btn-success btn-sm" href="#" title="{{ __('default.addtobasket') }} {{ $item->fullTitle }}">
                                                    {{ $item->price }}
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                                                        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/products.js')}}"></script>

@endsection
