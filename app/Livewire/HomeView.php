<?php

namespace App\Livewire;

use App\Models\Content;
use App\Models\SiteSetting;
use Livewire\Component;

class HomeView extends Component
{
    public $search = '';
    public int $perPage = 6;
    protected int $perPageStep = 6;

    public function updatingSearch(): void
    {
        $this->perPage = $this->perPageStep;
    }

    public function loadMore(): void
    {
        $this->perPage += $this->perPageStep;
    }
    
    public function render(){
        $siteTitle = SiteSetting::current()->site_title;

        $query = Content::query()
            ->select([
                'id',
                'title',
                'slug',
                'category',
                'author',
                'created_at',
                'excerpt',
                'banner_path',
            ])
            ->where('status', 'published')
            ->when($this->search, function($q){
                $q->where('title', 'like', "%{$this->search}%");
            })
            ->latest();

        $contents = (clone $query)->take($this->perPage)->get();
        $totalContents = (clone $query)->count();

        return view('livewire.home-view', [
            'contents' => $contents,
            'hasMoreContents' => $totalContents > $contents->count(),
            'topPosts' => Content::query()
                        ->select([
                            'id',
                            'title',
                            'slug',
                            'category',
                            'created_at',
                            'views',
                        ])
                        ->where('status', 'published')
                        ->orderBy('views', 'desc')
                        ->take(4)
                        ->get(),
        ])->layout('layouts.guestLayoutLivewire', [
            'title'    => $siteTitle,
        ]);
    }
}
