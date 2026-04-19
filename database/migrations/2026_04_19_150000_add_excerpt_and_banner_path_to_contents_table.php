<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->text('excerpt')->nullable()->after('content_path');
            $table->string('banner_path')->nullable()->after('excerpt');
        });

        $localDisk = Storage::disk('local');
        $publicDisk = Storage::disk('public');
        $bannerFormats = ['jpg', 'jpeg', 'png', 'webp'];

        DB::table('contents')->orderBy('id')->get()->each(function ($content) use ($localDisk, $publicDisk, $bannerFormats) {
            $markdown = (string) ($content->contents ?? '');

            if (! empty($content->content_path) && $localDisk->exists($content->content_path)) {
                $markdown = $localDisk->get($content->content_path);
            }

            $plainText = Str::of(strip_tags(Str::markdown($markdown, [
                'html_input' => 'strip',
                'allow_unsafe_links' => false,
            ])))
                ->squish()
                ->limit(260)
                ->toString();

            if ($plainText === '') {
                $plainText = "Ringkasan untuk artikel {$content->title}.";
            }

            $bannerPath = null;

            foreach ($bannerFormats as $ext) {
                $path = "contents/{$content->slug}/banner.{$ext}";

                if ($publicDisk->exists($path)) {
                    $bannerPath = $path;
                    break;
                }
            }

            DB::table('contents')
                ->where('id', $content->id)
                ->update([
                    'excerpt' => $plainText,
                    'banner_path' => $bannerPath,
                ]);
        });
    }

    public function down(): void
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->dropColumn(['excerpt', 'banner_path']);
        });
    }
};
