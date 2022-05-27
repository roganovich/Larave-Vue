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
                            <div class="card-body">
                                <h3 class="card-title"><a href="{{ route('products.show', ['id' => $item->id]) }}"
                                                          class="">{{ $item->text }} </a>
                                </h3>

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

                                @if ($item->thumb)
                                    <img class="thumb m-1" src="{{URL::asset($item->thumb)}}" title="{{ $item->text }}"
                                         alt="{{ $item->text }}"/>
                                @endif
                                <div>

                                </div>
                                <a href="{{ route('products.show', ['id' => $item->id]) }}" title="{{ __('default.follow') }}"
                                   class="btn btn-primary position-absolute bottom-0 end-0 m-2">{{ $item->price }}</a>
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
