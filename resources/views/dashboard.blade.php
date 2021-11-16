@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <a href="/posts/create" class="btn btn-primary">Create Campaign</a>
                        @if(count($posts)>0)
                            <h3>Your Blog Posts</h3>
                            {{-- {{ __('You are logged in!') }} --}}

                            <table class="table table-striped">
                                <tr>
                                    <th>Title</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach ($campaigns as $campaign)
                                    <tr>
                                        <td>{{$campaign->name}}</td>
                                        <td><a href="/campaigns/{{$campaign->id}}/edit" class="btn btn-primary">Edit</a></td>
                                        <td>
                                            {!!Form::open(['action' => ['CampaignsController@destroy', $campaign->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                                {{Form::hidden('_method','DELETE')}}
                                                {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
                                            {!!Form::close()!!}
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            Launch demo modal
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else

                            <p>You have No campaigns found</p>

                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
