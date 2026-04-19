<?php

namespace App\Livewire;

use App\Models\Content;
use App\Models\SiteSetting;
use Livewire\Component;

class PostedView extends Component
{
    public $search = '';
    public int $perPage = 12;
    protected int $perPageStep = 12;

    public function updatingSearch(): void
    {
        $this->perPage = $this->perPageStep;
    }

    public function loadMore(): void
    {
        $this->perPage += $this->perPageStep;
    }

    public function render()
    {
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

        return view('livewire.posted-view', [
            'contents' => $contents,
            'hasMoreContents' => (clone $query)->count() > $contents->count(),
        ])->layout('layouts.guestLayoutLivewire', [
            'title'    => "Posts - {$siteTitle}",
        ]);
    }
}
