<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class SiteSetting extends Model
{
    protected static ?self $resolvedCurrent = null;

    protected $fillable = [
        'site_title',
        'site_logo_path',
        'connect_1_label',
        'connect_1_url',
        'connect_2_label',
        'connect_2_url',
        'connect_3_label',
        'connect_3_url',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => static::flushCache());
        static::deleted(fn () => static::flushCache());
    }

    public static function defaults(): array
    {
        return [
            'site_title' => 'OwnBlog',
            'site_logo_path' => null,
            'connect_1_label' => 'GitHub',
            'connect_1_url' => 'https://github.com/Thoriq0',
            'connect_2_label' => 'Twitter/X',
            'connect_2_url' => 'https://x.com/Thoriq527',
            'connect_3_label' => 'Email',
            'connect_3_url' => 'mailto:thoriq.ahmad1301@gmail.com',
        ];
    }

    public static function fallback(): self
    {
        return static::make(static::defaults());
    }

    public static function current(): self
    {
        if (static::$resolvedCurrent instanceof self) {
            return static::$resolvedCurrent;
        }

        if (! Schema::hasTable('site_settings')) {
            return static::$resolvedCurrent = static::fallback();
        }

        $setting = static::query()->find(1);

        if ($setting) {
            return static::$resolvedCurrent = $setting;
        }

        $setting = new static(static::defaults());
        $setting->forceFill(['id' => 1])->save();

        return static::$resolvedCurrent = $setting;
    }

    public static function flushCache(): void
    {
        static::$resolvedCurrent = null;
    }

    public function getLogoUrlAttribute(): string
    {
        if (! $this->site_logo_path) {
            return asset('images/ownblog.png');
        }

        return Storage::disk('public')->url($this->site_logo_path);
    }

    public function getConnectLinksAttribute(): array
    {
        $links = [];

        foreach (range(1, 3) as $index) {
            $label = trim((string) $this->{"connect_{$index}_label"});
            $url = trim((string) $this->{"connect_{$index}_url"});

            if ($label !== '' && $url !== '') {
                $links[] = [
                    'label' => $label,
                    'url' => $url,
                ];
            }
        }

        return $links;
    }
}
