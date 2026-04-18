<?php

namespace App\Livewire;

use App\Models\Content;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class HomeView extends Component
{

    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'tailwind';

    public $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }
    
    public function render(){

        return view('livewire.home-view', [
            'contents' => Content::where('status', 'published')
                        ->when($this->search, function($q){
                            $q->where('title', 'like', "%{$this->search}%");
                        })
                        ->paginate(6),

            'topPosts' => Content::where('status', 'published')
                        ->orderBy('views', 'desc')
                        ->take(4)
                        ->get(),
        ])->layout('layouts.guestLayoutLivewire', [
            'title'    => 'OwnBlog',
        ]);
    }
}
