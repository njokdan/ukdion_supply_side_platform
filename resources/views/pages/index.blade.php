@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>{{ $title }} | supply side platform</h1>
        <p>You can view campaigns, but you need to login to create,edit,update and delete</p>
        
        <br>
        {{-- <div class="col-6 align-center"> --}}
        <h3>Features</h3>
        <ol class="list-group list-group-numbered">
            <li class="list-group-item">Create Campaigns</li>
            <li class="list-group-item">Daily Campaign Cron mail</li>
            <li class="list-group-item">View Campaigns</li>
            <li class="list-group-item">Edit and Update a Campaign</li>
            <li class="list-group-item">Delete a Campaign</li>
            <li class="list-group-item">Campaigns creative image uploaded to cloudinary</li>
            <li class="list-group-item">Preview Campaigns on pop ups</li>
        </ol>
        {{-- <div> --}}
        <p>Please Note: You need to signup and log in, to create a campaign</p>
        @guest
            {{-- <a class="btn btn-primary" href="{{ route('login') }}" role="button">{{ __('Login') }}</a>
            @if (Route::has('register'))
                <a class="btn btn-success" href="{{ route('register') }}" role="button">{{ __('Register') }}</a>
            @endif --}}
        @endguest
    </div>
@endsection