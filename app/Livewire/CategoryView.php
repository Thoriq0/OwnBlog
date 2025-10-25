<?php

namespace App\Livewire;

use App\Models\Content;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class CategoryView extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'tailwind';

    public $search = '';

    public $category;

    public function mount($category){
        // Get Category
        $this->category = $category;
    }

    public function render()
    {
        $query = Content::where('category', $this->category)
            ->when($this->search, function ($q) {
                $q->where('title', 'like', "%{$this->search}%");
            });

        return view('livewire.category-view', [
            'category' => $this->category,
            'contents' => $query->paginate(12),
        ])->layout('layouts.guestLayoutLivewire', [
            'title'    => 'Category - '.$this->category,
        ]);
    }
}
