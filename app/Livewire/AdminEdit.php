<?php

namespace App\Livewire;

use App\Models\Content;
use Livewire\Component;

class AdminEdit extends Component
{
    public $getContent;

    public function mount($slug){
        $this->getContent = Content::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.admin-edit', [
            'title' => 'Edited Text',
            'content' => $this->getContent
        ])->layout('layouts.adminLayout', [
            'title' => $this->getContent->title . ' - Edit'
        ]);
    }
}
