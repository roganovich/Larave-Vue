@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('products.show', $item) }}

        <div class="row mt-2 justify-content-center">
            <div class="card col-md-12 col-lg-12 p-2">
                <div class="card-body">
                    <h1>{{ $item->text }}</h1>

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
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/products.js')}}"></script>

@endsection
