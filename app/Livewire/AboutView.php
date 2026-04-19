<?php

namespace App\Livewire;

use App\Models\SiteSetting;
use Livewire\Component;

class AboutView extends Component
{
    public function render()
    {
        $siteTitle = SiteSetting::current()->site_title;

        return view('livewire.about-view', [
            'title' => 'About'
        ])->layout('layouts.guestLayoutLivewire', [
            'title' => "About - {$siteTitle}"
        ]);
    }
}
