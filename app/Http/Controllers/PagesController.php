<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    //
    public function index(){
        $title = "Welcome to laravel";
        //return view('pages.index',compact('title'));//passing variable to view 1
        return view('pages.index')->with('title', $title);//passing variable to view 2
        //return 'INDEX';
    }

    public function about(){
        $title = "Welcome to About Page";
        return view('pages.about')->with('title',$title);
        //return 'INDEX';
    }

    public function services(){
        $data = array(
            'title' => 'Services',
            'services' => ['Campaign 1', 'Campaign 2', 'Campaign 3']
        );
        return view('pages.services')->with($data);
        //return 'INDEX';
    }
}
