@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('wikipages.index') }}

        {!! $navFilter !!}

        <h1 class="mt-2">{{ __('wikipages.index') }} {{ ($parent) ? $parent->title : '' }}</h1>

        @if($parent)
            <div class="row mt-2 justify-content-center">
                <div class="card col-md-12 col-lg-12 p-2">
                    <div class="card-body">
                        <p class="card-text">{!! $parent->description !!}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="row mt-2 justify-content-left">
            @foreach ($items as $item)
                <div class="card col-md-4 col-lg-3 p-2">
                    <img src="{{ $item->pageThumb }}" class="card-img-top" title="{{ $item->title }}" alt="{{ $item->title }}">
                    <div class="card-body">
                        <h3 class="card-title"><a href="{{ route('wikipages.show', ['id' => $item->id]) }}"
                           class="">{{ $item->title }}</a>
                        </h3>
                        @if ($item->parent)
                                <a class="fw-bold text-success" href="{{ route('wikipages.show', ['id' => $item->parent->id]) }}">
                                    {{ $item->parent->title }}
                                </a>
                        @endif
                        <p class="card-text">{!! $item->description !!}</p>
                        <div class=" position-absolute bottom-0 start-0 m-2">
                            {{ $item->created_at->format('d.m.Y') }}
                        </div>
                        <a href="{{ route('wikipages.show', ['id' => $item->id]) }}"
                           class="btn btn-primary position-absolute bottom-0 end-0 m-2">{{ __('default.follow') }}</a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-2">
            {{ $items->links('pagination')}}
        </div>
    </div>
@endsection
