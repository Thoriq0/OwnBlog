<?php

namespace App\Livewire;

use App\Models\Content;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        return view('livewire.admin-dashboard', [
            'totalPosts'      => Content::count(),
            'publishedPosts'  => Content::where('status', 'published')->count(),
            'draftPosts'      => Content::where('status', 'draft')->count(),
            'categoriesCount' => Content::distinct('category')->count('category'),
            'recentPosts'     => Content::latest()->take(5)->get(),
        ])->layout('layouts.adminLayout', [
            'title' => 'Dashboard',
        ]);
    }
}
