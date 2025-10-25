<?php

namespace App\Livewire;

use App\Models\Content;
use Livewire\Component;

class SingleView extends Component
{
    public $post;
    public $title;

    public function mount($slug)
    {
        // Get SingleContent
        $getContent = Content::where('slug', $slug)->firstOrFail();

        $getContent->increment('views');

        $this->post = $getContent;
        $this->title = $getContent->title;
    }

    public function render()
    {
        return view('livewire.single-view', [
            'title' => $this->title,
            'post' => $this->post
        ])->layout('layouts.guestLayoutLivewire', [
            'title' => $this->title,
        ]);
    }
}
