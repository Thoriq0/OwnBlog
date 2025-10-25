<?php

namespace App\Livewire;

use App\Models\Content;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class AdminTextList extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';
    public $status = '';
    public $category = '';

    protected $paginationTheme = 'tailwind';

    public function updating($field)
    {
        if (in_array($field, ['search', 'status', 'category'])) {
            $this->resetPage();
        }
    }
    
    public function resetFilters()
    {
        $this->reset(['status', 'category', 'search']);
    }

    public function render()
    {
        $contents = Content::query()
            ->when($this->search, fn($q) => 
                $q->where('title', 'like', "%{$this->search}%")
            )
            ->when($this->status, fn($q) => 
                $q->where('status', $this->status)
            )
            ->when($this->category, fn($q) => 
                $q->where('category', $this->category)
            )
            ->orderByDesc('created_at')
            ->paginate(10);

        $categories = Content::select('category')->distinct()->pluck('category');

        return view('livewire.admin-text-list', [
            'contents' => $contents,
            'categories' => $categories,
        ])->layout('layouts.adminLayout', [
            'title' => 'Your Text'
        ]);
    }
}
