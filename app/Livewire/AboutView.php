<?php

namespace App\Livewire;

use Livewire\Component;

class AboutView extends Component
{
    public function render()
    {
        return view('livewire.about-view', [
            'title' => 'About'
        ])->layout('layouts.guestLayoutLivewire', [
            'title' => 'About'
        ]);
    }
}
