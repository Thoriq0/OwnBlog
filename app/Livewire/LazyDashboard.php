<?php

namespace App\Livewire;

use App\Models\Content;
use Livewire\Component;

class LazyDashboard extends Component
{   
    public $totalPosts;
    public $publishedPosts;
    public $draftPosts;
    public $categoriesCount;
    public $recentPosts;

    public function mount(){
        $this->totalPosts      = Content::count();
        $this->publishedPosts  = Content::where('status', 'published')->count();
        $this->draftPosts      = Content::where('status', 'draft')->count();
        $this->categoriesCount = Content::distinct('category')->count('category');
        $this->recentPosts     = Content::latest()->take(5)->get();
    }

    public function placeholder(){
    return <<<'HTML'
    <style>
        .loader-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 300px; /* tinggi area konten */
        }

        .loader {
            height: 60px;
            aspect-ratio: 1;
            border: 3px solid #524656;
            position: relative;
        }

        .loader:before,
        .loader:after {
            content: "";
            position: absolute;
            width: 20%;
            aspect-ratio: 1;
            border-radius: 50%;
            background: #CF4647;
            animation: 
                l8-0 .57s infinite alternate linear -.13s,
                l8-1 .35s infinite alternate linear -.23s;
        }

        .loader:after {
            background: #45ADA8;
            animation: 
                l8-0 .29s infinite alternate linear -.11s,
                l8-1 .51s infinite alternate linear -.34s;
        }

        @keyframes l8-0 {
            0%,5%  {bottom: 0%}
            95%,to {bottom: 80%}
        }

        @keyframes l8-1 {
            0%,5%  {left: 0%}
            95%,to {left: 80%}
        }
    </style>

    <div class="loader-wrapper">
        <div class="loader"></div>
    </div>
    HTML;
}



    public function render()
    {
        return view('livewire.lazy-dashboard');
    }
}
