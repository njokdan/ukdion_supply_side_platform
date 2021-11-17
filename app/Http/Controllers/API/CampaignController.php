<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
// use Illuminate\Database\Eloquent\Relations\HasMany;

class CampaignController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $campaigns;
    public function index()
    {
       
        $campaigns = Campaign::all()->paginate(3);
       
        return response()->json([new CampaignResource($campaigns), 'Campaigns fetched.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'total_budget' => 'required',
            'daily_budget' => 'required',
            // 'cover_image' => 'image|nullable|max:1999'
            'cover_image' => 'required',
            'cover_image.*' => 'mimes:jpg,png,jpeg,gif,svg'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        //Handle file upload
        if($request->hasFile('cover_image')){
            $formInput=$request->all();
            $fileNameToStore=array();
            $fileNameToStore0=array();
            $nam = "Azure";
            if($files=$request->file('cover_image')){
                foreach($files as $key => $file){
                    $name=$file->getClientOriginalName();
                    $filename = pathinfo($name, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $newname = $filename.'_'.time().'.'.$extension;
                    $uploadedFileUrl = Cloudinary::upload($file->getRealPath())->getSecurePath();
                    $path = $file->storeAs('public/cover_images', $newname);
                    $fileNameToStore[]=$newname;
                    $fileNameToStore0[]=$uploadedFileUrl;
    
                }
                
            }
            
        } else {
            $fileNameToStore = ['noimage.jpg'];
            $fileNameToStore0 = ['https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.shutterstock.com%2Fsearch%2Fno%2Bcompany&psig=AOvVaw18WTCRZs1q6aijlhRN9Eu8&ust=1637218595553000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCPCE8dvonvQCFQAAAAAdAAAAABA2'];
        }

        

        $campaign = new Campaign;
        $campaign->name = $request->input('name');
        $campaign->date_from = $request->input('date_from');
        $campaign->date_to = $request->input('date_to');
        $campaign->total_budget = $request->input('total_budget');
        $campaign->daily_budget = $request->input('daily_budget');
        $campaign->cover_image = json_encode($fileNameToStore0);
        $campaign->save();
        
        return response()->json(['Campaign created successfully.', new CampaignResource($campaign)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campaign = Campaign::find($id);
        if (is_null($campaign)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new CampaignResource($campaign)]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'total_budget' => 'required',
            'daily_budget' => 'required',
            'cover_image.*' => 'mimes:jpg,png,jpeg,gif,svg'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }



        //Handle file upload
        if($request->hasFile('cover_image')){
            $formInput=$request->all();
            $fileNameToStore=array();
            $fileNameToStore0=array();
            $nam = "Azure";
            if($files=$request->file('cover_image')){
                foreach($files as $key => $file){
                    $name=$file->getClientOriginalName();
                    $filename = pathinfo($name, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $newname = $filename.'_'.time().'.'.$extension;
                    $uploadedFileUrl = Cloudinary::upload($file->getRealPath())->getSecurePath();
                    $path = $file->storeAs('public/cover_images', $newname);
                    $fileNameToStore[]=$newname;
                    $fileNameToStore0[]=$uploadedFileUrl;
                }
               
            }
            
        } 
        // else {
        //     $fileNameToStore = ['noimage.jpg'];
        // }

        

        
        $campaign = Campaign::find($request->input('id'));
        $campaign->name = $request->input('name');
        $campaign->date_from = $request->input('date_from');
        $campaign->date_to = $request->input('date_to');
        $campaign->total_budget = $request->input('total_budget');
        $campaign->daily_budget = $request->input('daily_budget');
        if($request->hasFile('cover_image')){
            $campaign->cover_image = json_encode($fileNameToStore0);
        }
        $campaign->save();
        
        return response()->json(['Campaign updated successfully.', new ProgramResource($campaign)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        return response()->json('Campaign deleted successfully');
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
                    //Storage::delete('public/cover_images/'.$image);

                    Cloudinary::destroy($image);
                }
            }
        }
        
        $campaign->delete();
        return redirect('/campaigns')->with('success','Campaign Removed');
    }
}
