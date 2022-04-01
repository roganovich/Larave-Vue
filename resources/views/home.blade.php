@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (Auth::check())
                                <p>{{ Auth::user()->name }}</p>
                                <p>{{ Auth::user()->email }}</p>
                                <p>{{ __('You are logged in!') }}</p>
                        @else
                                <p>{{ __('You are not logged in!') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
