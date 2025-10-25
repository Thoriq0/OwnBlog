<?php

namespace App\Livewire;

use Livewire\Component;

class AdminNewText extends Component
{
    public function render()
    {
        return view('livewire.admin-new-text')->layout('layouts.adminLayout', [
            'title' => 'New Text'
        ]);
    }
}
