@extends('layouts.app')

@section('content')
    <h1>Campaigns</h1>
    @if(count($campaigns)>0)
        @foreach ($campaigns as $campaign)
            <div class="well">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="campaigns/{!!$campaign->id!!}">{!!$campaign->name !!}</a></h3>
                        <small>Written on {!!$campaign->created_at!!} By {!!$campaign->name!!}</small>
                    </div>
                    <div class="col-md-8 col-sm-8">
                    <a href="#" type="button" class="btn btn-primary" data-toggle="modal" data-target="#p{{$campaign->id}}">
                        Preview
                    </a> 
                    </div>
                </div>
            </div>
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
                        $cld = new Cloudinary();

                        ?>
                            @if(!empty($images))
                                    @foreach($images as $image)
                                        {{-- <img style="width:auto" src="/storage/cover_images/{{$image}}"> --}}
                                        <img style="width:auto" src="/image/upload/v1637132013/{{$image}}">
                                        {{-- {{dd($image)}} --}}
                                        {{-- {{cl_image_tag($image)}} --}}
                                        {{-- {{$cld->imageTag($image)}} --}}
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
        @endforeach
        {{-- {!! $campaigns->render() !!} --}}
        {{-- {{$campaigns->links()}} --}}
    @else

        <p>No campaigns found</p>

    @endif
@endsection