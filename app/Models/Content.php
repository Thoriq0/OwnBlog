<?php

namespace App\Models;

use App\Support\ContentDocument;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class Content extends Model
{
    /** @use HasFactory<\Database\Factories\ContentFactory> */
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function getContentsAttribute($value): string
    {
        return ContentDocument::read($this->attributes['content_path'] ?? null, $value);
    }

    public function getMarkdownContentAttribute(): string
    {
        return $this->contents;
    }

    public function getContentHtmlAttribute(): HtmlString
    {
        return new HtmlString(Str::markdown($this->markdown_content, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]));
    }

    public function getContentPreviewTextAttribute(): string
    {
        if (! empty($this->attributes['excerpt'])) {
            return (string) $this->attributes['excerpt'];
        }

        return Str::of(strip_tags($this->content_html->toHtml()))
            ->squish()
            ->toString();
    }

    public function getBannerUrlAttribute(): ?string
    {
        $bannerPath = $this->attributes['banner_path'] ?? null;

        if (! $bannerPath) {
            return null;
        }

        return Storage::disk('public')->url($bannerPath);
    }

    public function getHasBannerAttribute(): bool
    {
        return ! empty($this->attributes['banner_path']);
    }

    public function getCategoryLabelAttribute(): string
    {
        return Str::headline(str_replace('-', ' ', (string) $this->category));
    }

    public static function buildExcerpt(string $markdown, int $limit = 260): string
    {
        return Str::of(strip_tags(Str::markdown($markdown, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ])))
            ->squish()
            ->limit($limit)
            ->toString();
    }

    public static function resolveBannerPath(string $slug, ?string $preferredFilename = null): ?string
    {
        $storage = Storage::disk('public');
        $directory = "contents/{$slug}";

        if ($preferredFilename && $storage->exists("{$directory}/{$preferredFilename}")) {
            return "{$directory}/{$preferredFilename}";
        }

        foreach (['jpg', 'jpeg', 'png', 'webp'] as $ext) {
            $path = "{$directory}/banner.{$ext}";

            if ($storage->exists($path)) {
                return $path;
            }
        }

        return null;
    }
}
