<?php

namespace App\Models;

use App\Support\ContentDocument;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        return Str::of(strip_tags($this->content_html->toHtml()))
            ->squish()
            ->toString();
    }

    public function getCategoryLabelAttribute(): string
    {
        return Str::headline(str_replace('-', ' ', (string) $this->category));
    }
}
