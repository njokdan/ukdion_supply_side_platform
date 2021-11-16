@extends('layouts.app')

@section('content')
    <h1>Create Posts</h1>
    <form name="campaign-upload-form" method="POST" action="{{ url('create') }}" accept-charset="utf-8" enctype="multipart/form-data">
     @csrf
        <div class="form-group">
            <label for="name">Campaign Name:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Campaign Name" required/>
        </div>
        <div class="form-group">
            <label for="date_from">Date From:</label>
            <input type="date" class="form-control" id="date_from" name="date_from" required>
        </div>
        <div class="form-group">
            <label for="date_to">Date From:</label>
            <input type="date" class="form-control" id="date_to" name="date_to" required>
        </div>
        <div class="form-group">
            <label for="total_budget">Total Budget:</label>
            <input type="text" class="form-control" id="total_budget" name="total_budget" placeholder="Total Budget" required/>
        </div>
        <div class="form-group">
            <label for="daily_budget">Daily Budget:</label>
            <input type="text" class="form-control" id="daily_budget" name="daily_budget" placeholder="Daily Budget" required/>
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
    {{-- {!! Form::open(['action' => 'CampaignsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data' ]) !!}
        <div class="form-group">
            {{Form::label('title', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Campaign Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('title', 'From')}}
            {{Form::input('date', 'date_from', null, ['class' => 'form-control', 'placeholder' => 'Date'])}}
        </div>
        <div class="form-group">
            {{Form::label('title', 'To')}}
            {{Form::input('date', 'date_to', null, ['class' => 'form-control', 'placeholder' => 'Date'])}}
        </div>
        <div class="form-group">
            {{Form::label('title', 'Total Budget')}}
            {{Form::text('total_budget', '', ['class' => 'form-control', 'placeholder' => 'Total Budget'])}}
        </div>
        <div class="form-group">
            {{Form::label('title', 'Daily Budget')}}
            {{Form::text('daily_budget', '', ['class' => 'form-control', 'placeholder' => 'Daily Budget'])}}
        </div>
        {{-- <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Body Text'])}}
        </div> }}
        <div class="form-group">
            {{Form::label('title', 'Creative Upload')}}
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Submit',  ['class' => 'btn btn-primary'])}}
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