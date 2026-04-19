<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Support\ContentDocument;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    /**
     * Seed the application's content records.
     */
    public function run(): void
    {
        $bannerUrls = [
            'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80',
        ];

        $contents = [
            ['title' => 'Laravel Routing Notes for Personal Projects', 'category' => 'tech-notes', 'status' => 'published', 'tags' => 'Laravel, Routing, PHP', 'views' => 420],
            ['title' => 'Clean Blade Components for Reusable Layouts', 'category' => 'tech-notes', 'status' => 'published', 'tags' => 'Blade, Laravel, UI', 'views' => 350],
            ['title' => 'Small Debugging Habits That Save Me Hours', 'category' => 'tech-notes', 'status' => 'published', 'tags' => 'Debugging, Workflow', 'views' => 390],
            ['title' => 'Building a Markdown Blog Admin from Scratch', 'category' => 'projects', 'status' => 'published', 'tags' => 'Project, Laravel, Markdown', 'views' => 520],
            ['title' => 'Notes from Refactoring an Old Side Project', 'category' => 'projects', 'status' => 'draft', 'tags' => 'Refactor, Project', 'views' => 120],
            ['title' => 'Creating a Lightweight CMS for My Own Needs', 'category' => 'projects', 'status' => 'published', 'tags' => 'CMS, Product', 'views' => 470],
            ['title' => 'Tutorial Membuat Slug Otomatis yang Aman', 'category' => 'tutorials', 'status' => 'published', 'tags' => 'Tutorial, Slug, Laravel', 'views' => 610],
            ['title' => 'Tutorial Upload Banner dan Simpan ke Storage', 'category' => 'tutorials', 'status' => 'published', 'tags' => 'Tutorial, Storage, Upload', 'views' => 560],
            ['title' => 'Tutorial Menghubungkan Livewire dengan Filter Pencarian', 'category' => 'tutorials', 'status' => 'draft', 'tags' => 'Tutorial, Livewire, Search', 'views' => 140],
            ['title' => 'Belajar Menulis Dokumentasi untuk Diri Sendiri', 'category' => 'writing', 'status' => 'published', 'tags' => 'Writing, Documentation', 'views' => 230],
            ['title' => 'Cara Menjaga Ritme Saat Bangun Produk Sendiri', 'category' => 'writing', 'status' => 'published', 'tags' => 'Writing, Product, Habit', 'views' => 280],
            ['title' => 'Draft Ide Konten untuk Seri Belajar Laravel', 'category' => 'writing', 'status' => 'draft', 'tags' => 'Writing, Planning', 'views' => 90],
            ['title' => 'Cerita Di Balik Project Blog Pribadi Ini', 'category' => 'stories', 'status' => 'published', 'tags' => 'Story, Project', 'views' => 300],
            ['title' => 'Hal Kecil yang Bikin Semangat Ngoding Balik Lagi', 'category' => 'stories', 'status' => 'published', 'tags' => 'Story, Motivation', 'views' => 260],
            ['title' => 'Catatan Saat Ngerjain Ulang Dashboard Admin', 'category' => 'stories', 'status' => 'draft', 'tags' => 'Story, Dashboard', 'views' => 110],
            ['title' => 'Menyusun Struktur Folder Konten yang Gampang Dirawat', 'category' => 'tech-notes', 'status' => 'published', 'tags' => 'Structure, Filesystem', 'views' => 410],
            ['title' => 'Eksperimen Theme Toggle untuk Guest dan Admin', 'category' => 'projects', 'status' => 'published', 'tags' => 'Theme, Dark Mode, UI', 'views' => 455],
            ['title' => 'Tutorial Preview Markdown Real Time di Form Editor', 'category' => 'tutorials', 'status' => 'published', 'tags' => 'Markdown, Editor, Preview', 'views' => 590],
            ['title' => 'Menjaga Konsistensi UI Saat Fitur Terus Bertambah', 'category' => 'writing', 'status' => 'published', 'tags' => 'UI, Consistency', 'views' => 275],
            ['title' => 'Perjalanan Kecil Membenahi Blog Sampai Nyaman Dipakai', 'category' => 'stories', 'status' => 'published', 'tags' => 'Story, Progress', 'views' => 330],
        ];

        foreach ($contents as $index => $item) {
            $slug = Str::slug($item['title']);
            $contentPath = ContentDocument::write($slug, '');
            $excerpt = "Catatan singkat tentang {$item['title']} untuk demo tampilan listing guest dan admin.";

            Storage::disk('public')->makeDirectory(ContentDocument::directory($slug));
            $this->storeBannerIfMissing($slug, $bannerUrls[$index % count($bannerUrls)]);

            Content::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $item['title'],
                    'category' => $item['category'],
                    'tags' => $item['tags'],
                    'status' => $item['status'],
                    'author' => 'Thoriq',
                    'views' => $item['views'],
                    'contents' => '',
                    'content_path' => $contentPath,
                    'excerpt' => $excerpt,
                    'banner_path' => Content::resolveBannerPath($slug, 'banner.jpg'),
                    'created_at' => now()->subDays(30 - $index),
                    'updated_at' => now()->subDays(max(0, 20 - $index)),
                ]
            );
        }
    }

    private function storeBannerIfMissing(string $slug, string $url): void
    {
        $path = ContentDocument::directory($slug) . '/banner.jpg';

        if (Storage::disk('public')->exists($path)) {
            return;
        }

        try {
            $response = Http::timeout(20)
                ->retry(2, 400)
                ->accept('image/jpeg,image/*')
                ->get($url);

            if (! $response->successful()) {
                return;
            }

            Storage::disk('public')->put($path, $response->body());
        } catch (\Throwable $exception) {
            report($exception);
        }
    }
}
