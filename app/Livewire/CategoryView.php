<?php

namespace App\Livewire;

use App\Models\Content;
use App\Models\SiteSetting;
use Livewire\Component;

class CategoryView extends Component
{
    public $search = '';
    public int $perPage = 12;
    protected int $perPageStep = 12;

    public $category;

    public function updatingSearch(): void
    {
        $this->perPage = $this->perPageStep;
    }

    public function loadMore(): void
    {
        $this->perPage += $this->perPageStep;
    }

    public function mount($category){
        // Get Category
        $this->category = $category;
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
            ->where('category', $this->category)
            ->when($this->search, function ($q) {
                $q->where('title', 'like', "%{$this->search}%");
            })
            ->latest();

        $contents = (clone $query)->take($this->perPage)->get();

        return view('livewire.category-view', [
            'category' => $this->category,
            'contents' => $contents,
            'hasMoreContents' => (clone $query)->count() > $contents->count(),
        ])->layout('layouts.guestLayoutLivewire', [
            'title'    => 'Category - '.$this->category.' - '.$siteTitle,
        ]);
    }
}
