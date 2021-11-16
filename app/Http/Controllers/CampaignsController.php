<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\Campaign;

use DB;//direct mysql

class CampaignsController extends Controller
{ 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth',['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //
        $campaigns = Campaign::orderBy('created_at','desc')->paginate(3);
       return view('campaigns.index')->with('campaigns',$campaigns);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('campaigns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $this->validate($request, [
            'name' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'total_budget' => 'required',
            'daily_budget' => 'required',
            'cover_image' => 'required',
            'cover_image.*' => 'mimes:jpg,png,jpeg,gif,svg'
        ]);

        //Handle file upload
        if($request->hasFile('cover_image')){
            $formInput=$request->all();
            $fileNameToStore=array();
            $nam = "Azure";
            if($files=$request->file('cover_image')){
                foreach($files as $key => $file){
                    $name=$file->getClientOriginalName();
                    $filename = pathinfo($name, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $newname = $filename.'_'.time().'.'.$extension;
                    $path = $file->storeAs('public/cover_images', $newname);
                    $fileNameToStore[]=$newname;
    
                }
                
            }
            
        } else {
            $fileNameToStore = ['noimage.jpg'];
        }

        

        $campaign = new Campaign;
        $campaign->name = $request->input('name');
        $campaign->date_from = $request->input('date_from');
        $campaign->date_to = $request->input('date_to');
        $campaign->total_budget = $request->input('total_budget');
        $campaign->daily_budget = $request->input('daily_budget');
        $campaign->cover_image = json_encode($fileNameToStore);
        $campaign->save();

        return redirect('/campaigns')->with('success','Campaigns Created');
    }

    public function newupdate(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'total_budget' => 'required',
            'daily_budget' => 'required',
            'cover_image.*' => 'mimes:jpg,png,jpeg,gif,svg'
        ]);
        
        //Handle file upload
        if($request->hasFile('cover_image')){
            $formInput=$request->all();
            $fileNameToStore=array();
            $nam = "Azure";
            if($files=$request->file('cover_image')){
                foreach($files as $key => $file){
                    $name=$file->getClientOriginalName();
                    $filename = pathinfo($name, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $newname = $filename.'_'.time().'.'.$extension;
                    $path = $file->storeAs('public/cover_images', $newname);
                    $fileNameToStore[]=$newname;
                    
                    
                }
               
            }
            
        } else {
            $fileNameToStore = ["noimage.jpg"];
        }
        
        $campaign = Campaign::find($request->input('id'));
        $campaign->name = $request->input('name');
        $campaign->date_from = $request->input('date_from');
        $campaign->date_to = $request->input('date_to');
        $campaign->total_budget = $request->input('total_budget');
        $campaign->daily_budget = $request->input('daily_budget');
        $campaign->cover_image = json_encode($fileNameToStore);
        $campaign->save();
        
        
        return redirect('/campaigns')->with('success','Campaigns Updated');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //\
        $campaign = Campaign::find($id);
        return view('campaigns.show')->with('campaign', $campaign);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $campaign = Campaign::find($id);

        //Check for correct user
        if(!Auth()->user()->id)
        {
            return redirect('/campaigns')->with('error', 'Unauthorized Page');

        }

        return view('campaigns.edit')->with('campaign', $campaign);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

         //Handle file upload
         if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get Just Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get Just Extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            //run php artisan storage:link
        }

        //return 123;
        $campaign = Campaign::find($id);
        $campaign->title = $request->input('title');
        $campaign->body = $request->input('body');

        if($request->hasFile('cover_image')){
            $campaign->cover_image = $fileNameToStore;
        }

        $campaign->save();

        return redirect('/campaigns')->with('success','Campaign Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $campaign = Campaign::find($id);
        //Check for correct user
        if(Auth()->user()->id !== $campaign->user_id)
        {
            return redirect('/campaigns')->with('error', 'Unauthorized Page');

        }
        if($campaign->cover_image != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/cover_images/'.$campaign->cover_image);
        }
        $campaign->delete();
        return redirect('/campaigns')->with('success','Campaign Removed');
    }

    public function newdestroy(Request $request)
    {
        //
        // $campaign = Campaign::find($id);
        $campaign = Campaign::find($request->input('id'));
        //Check for correct user
        if(!Auth()->user()->id)
        {
            return redirect('/campaigns')->with('error', 'Unauthorized Page');

        }
        $images = json_decode($campaign->cover_image);
        if(!empty($images)){
            foreach($images as $image){
                if($image != 'noimage.jpg'){
                    // Delete Image
                    Storage::delete('public/cover_images/'.$image);
                }
            }
        }
        
        $campaign->delete();
        return redirect('/campaigns')->with('success','Campaign Removed');
    }
}
