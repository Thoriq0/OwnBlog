<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContentDocument
{
    public static function directory(string $slug): string
    {
        return 'contents/' . $slug;
    }

    public static function markdownPath(string $slug): string
    {
        return self::directory($slug) . '/content.md';
    }

    public static function write(string $slug, string $markdown): string
    {
        $path = self::markdownPath($slug);

        Storage::disk('local')->put($path, rtrim($markdown) . PHP_EOL);

        return $path;
    }

    public static function rename(string $oldSlug, string $newSlug): string
    {
        if ($oldSlug === $newSlug) {
            return self::markdownPath($newSlug);
        }

        $oldPath = self::markdownPath($oldSlug);
        $newPath = self::markdownPath($newSlug);

        Storage::disk('local')->makeDirectory(self::directory($newSlug));

        if (Storage::disk('local')->exists($oldPath)) {
            Storage::disk('local')->move($oldPath, $newPath);
            Storage::disk('local')->deleteDirectory(self::directory($oldSlug));
        }

        return $newPath;
    }

    public static function renamePublicDirectory(string $oldSlug, string $newSlug): void
    {
        if ($oldSlug === $newSlug) {
            return;
        }

        $oldDirectory = self::directory($oldSlug);
        $newDirectory = self::directory($newSlug);

        if (Storage::disk('public')->exists($oldDirectory)) {
            Storage::disk('public')->makeDirectory($newDirectory);

            foreach (Storage::disk('public')->allFiles($oldDirectory) as $file) {
                $relativePath = Str::after($file, $oldDirectory . '/');
                Storage::disk('public')->move($file, $newDirectory . '/' . $relativePath);
            }

            Storage::disk('public')->deleteDirectory($oldDirectory);
            return;
        }

        Storage::disk('public')->makeDirectory($newDirectory);
    }

    public static function delete(string $slug): void
    {
        Storage::disk('local')->deleteDirectory(self::directory($slug));
        Storage::disk('public')->deleteDirectory(self::directory($slug));
    }

    public static function read(?string $path, ?string $fallback = ''): string
    {
        if ($path && Storage::disk('local')->exists($path)) {
            return Storage::disk('local')->get($path);
        }

        return (string) $fallback;
    }
}
