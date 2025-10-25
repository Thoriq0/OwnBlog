<?php

namespace App\Livewire;

use App\Models\Content;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class PostedView extends Component
{

    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'tailwind';

    public $search = '';

    public function render()
    {
        return view('livewire.posted-view', [
            'contents' => Content::where('status', 'published')
                        ->when($this->search, function($q){
                            $q->where('title', 'like', "%{$this->search}%");
                        })
                        ->paginate(12),
        ])->layout('layouts.guestLayoutLivewire', [
            'title'    => 'Posts',
        ]);
    }
}
