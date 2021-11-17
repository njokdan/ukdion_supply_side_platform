@extends('layouts.app')

@section('content')
<a href="/campaigns" class="btn btn-default">Go Back</a>
    <h1>Campaign Name: {{$campaign->name}}</h1>
    <h1>Campaign From: {{$campaign->date_from}}</h1>
    <h1>Campaign To:{{$campaign->date_to}}</h1>
    <h1>Campaign Total Budget:{{$campaign->total_budget}}</h1>
    <h1>Campaign Daily budget:{{$campaign->daily_budget}}</h1>
    {{-- <img style="width:100%" src="/storage/cover_images/{{$campaign->cover_image}}"> --}}
        <br><br>
    {{-- <div>
        {!!$campaign->body!!}
    </div> --}}
    <hr>
    <small>Written on {{$campaign->created_at}} 
    {{-- /*By {{$campaign->user->name}} --}}
    </small>
    <!-- Block against user not signed in -->
    @if(!Auth::guest())
        <!-- Block against user signed in but post doesn't belong to user -->
        <!-- Hence, Can Only delete or edit your own post -->
        {{-- @if(Auth::user()->id === $campaign->user_id) --}}
            <hr>
            <a href="/campaigns/{{$campaign->id}}/edit" class="btn btn-success">Edit</a>

            <form name="campaign-upload-form" method="POST" action="{{ url('/campaigns/delete') }}" accept-charset="utf-8" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    {{-- <label for="name">Campaign Name:</label> --}}
                    <input type="hidden" class="form-control" id="name" name="id" value="{{$campaign->id}}" placeholder="Campaign Name" required/>
                </div>
                <div class="form-group">
                    <input type="submit" value="Delete" class="btn btn-danger" />
                </div>
            </form>
            {{-- {!!Form::open(['action' => ['CampaignsController@destroy', $campaign->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}  --}}
            
        {{-- @endif       --}}
    @endif
    <a href="#" type="button" class="btn btn-primary" data-toggle="modal" data-target="#p{{$campaign->id}}">
            Preview
            </a> 

    <!-- Modal -->
        <div class="modal fade" id="p{{$campaign->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php  $images = json_decode($campaign->cover_image);
                        ?>
                            @if(!empty($images))
                                    @foreach($images as $image)
                                        {{-- <img style="width:auto" src="/storage/cover_images/{{$image}}"> --}}
                                        <img  src="{{$image}}">
                                    @endforeach
                            @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                    </div>
                </div>
            </div>
        </div>
@endsection