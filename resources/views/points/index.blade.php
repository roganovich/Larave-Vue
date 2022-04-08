@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('points.index') }}

        {!! $typesNav !!}

        <h1 class="mt-2">{{ __('points.index') }}</h1>

        <div class="row mt-2 justify-content-left">
            @foreach ($items as $item)
                <div class="card col-md-4 col-lg-3 p-2">
                    <div class="card-body">
                        <h3 class="card-title"><a href="{{ route('points.show', ['id' => $item->id]) }}"
                           class="">{{ $item->title }}</a>
                        </h3>
                        @if ($item->type)
                                <a class="fw-bold text-success" href="{{ route('points.index', ['type_id' => $item->type_id]) }}">
                                    {{ $item->type->title }}
                                </a>
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
    </div>
@endsection
