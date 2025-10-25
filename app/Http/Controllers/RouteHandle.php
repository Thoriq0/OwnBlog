<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class RouteHandle extends Controller
{
    
    // Admin Route

    // Dashboard Admin
    public function showDashboard(){
        return view('contents.dashboard', [
            'title' => 'Dashboard',
        ]);
    }
    // Your Text / Own Text
    public function showTextList(){
        return view('contents.yourText', [
            'title' => 'Your Text',
            'contents' => Content::paginate(10),
        ]);
    }
    // New Text / Write Text
    public function newTextWrite(){
        return view('contents.newText', [
            'title' => 'New Text',
        ]);
    }

}
