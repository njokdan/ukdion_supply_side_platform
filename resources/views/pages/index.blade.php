@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>{{ $title }} | Just a test</h1>
        <p>This is Laravel training</p>
        @guest
            <a class="btn btn-primary" href="{{ route('login') }}" role="button">{{ __('Login') }}</a>
            @if (Route::has('register'))
                <a class="btn btn-success" href="{{ route('register') }}" role="button">{{ __('Register') }}</a>
            @endif
        @endguest
    </div>
@endsection