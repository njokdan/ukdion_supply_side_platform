@extends('layouts.app')

@section('content')
    <h1>Edit Campaigns</h1>
    <form name="campaign-upload-form" method="POST" action="{{ url('update') }}" accept-charset="utf-8" enctype="multipart/form-data">
     @csrf

        <div class="form-group">
            {{-- <label for="name">Campaign Name:</label> --}}
            <input type="hidden" class="form-control" id="name" name="id" value="{{$campaign->id}}" placeholder="Campaign Name" required/>
        </div>

        <div class="form-group">
            <label for="name">Campaign Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$campaign->name}}" placeholder="Campaign Name" required/>
        </div>
        <div class="form-group">
            <label for="date_from">Date From:</label>
            <input type="date" class="form-control" id="date_from" name="date_from" value={{$campaign->date_from}} required>
        </div>
        <div class="form-group">
            <label for="date_to">Date From:</label>
            <input type="date" class="form-control" id="date_to" name="date_to" value={{$campaign->date_to}} required>
        </div>
        <div class="form-group">
            <label for="total_budget">Total Budget:</label>
            <input type="text" class="form-control" id="total_budget" name="total_budget" placeholder="Total Budget" value={{$campaign->total_budget}} required/>
        </div>
        <div class="form-group">
            <label for="daily_budget">Daily Budget:</label>
            <input type="text" class="form-control" id="daily_budget" name="daily_budget" placeholder="Daily Budget" value={{$campaign->daily_budget}} required/>
        </div>
        <div class="form-group">
            <label>Creative Upload:</label>
            <input type="file" name="cover_image[]" id="cover_image" multiple placeholder="Select multiple files"/>
        </div>
        @error('cover_image')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
        <div class="col-md-12">
            <div class="mt-1 text-center">
                <div class="images-preview-div"> </div>
            </div>  
        </div>
         <div class="form-group">
            <input type="submit" value="Submit" class="btn btn-primary" />
        </div>

    </form>

    {{-- {!! Form::open(['action' => ['PostsController@update', $campaign->id], 'method' => 'POST', 'enctype' => 'multipart/form-data' ]) !!}
        <div class="form-group">
            {{Form::label('title', 'Name')}}
            {{Form::text('name', $campaign->name, ['class' => 'form-control', 'placeholder' => 'Campaign Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('title', 'From')}}
            {{Form::input('date_from', 'date', $campaign->date_from, ['class' => 'form-control', 'placeholder' => 'Date'])}}
        </div>
        <div class="form-group">
            {{Form::label('title', 'To')}}
            {{Form::input('date_to', 'date', $campaign->date_to, ['class' => 'form-control', 'placeholder' => 'Date'])}}
        </div>
        <div class="form-group">
            {{Form::label('title', 'Total Budget')}}
            {{Form::text('total_budget', $campaign->total_budget, ['class' => 'form-control', 'placeholder' => 'Total Budget'])}}
        </div>
        <div class="form-group">
            {{Form::label('title', 'Daily Budget')}}
            {{Form::text('daily_budget', $campaign->daily_budget, ['class' => 'form-control', 'placeholder' => 'Daily Budget'])}}
        </div>
        {{-- <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', $post->id, ['class' => 'form-control', 'placeholder' => 'Body Text'])}}
        </div>}}
        <div class="form-group">
            {{Form::label('title', 'Creative Upload')}}
            {{Form::file('cover_image[]')}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Save',  ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!} --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        $(function() {
        // Multiple images preview with JavaScript
        var multiImgPreview = function(input, imgPreviewPlaceholder) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#cover_image').on('change', function() {
            multiImgPreview(this, 'div.imgPreview');
        });
        });    
    </script>
@endsection