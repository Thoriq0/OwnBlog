<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class PostHandleController extends Controller
{
    public function newText(Request $request)
{
    try {
        $request->validate([
            'title'      => [
                'required',
                'string',
                'regex:/^(?!.*\d{2,}).*$/',
            ],
            'slug'       => 'required|string',
            'categories' => 'required|string',
            'tags'       => 'nullable|string',
            'status'     => 'required|string',
            'content'    => [
                'required',
                function ($attribute, $value, $fail) {
                    $clean = trim(strip_tags($value));
                    if ($clean === '' || strlen($clean) === 0) {
                        $fail('Isi kontennya jangan kosong dong bro 😡');
                    }
                },
            ],
            'banner'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'title.required'      => 'Judul wajib diisi, masa kosong 😤',
            'title.regex'    => 'Judul Jangan angka semuanya dong !!',
            'slug.required'       => 'Slug jangan kosong dong!',
            'categories.required' => 'Pilih kategori dulu bro!',
            'status.required'     => 'Status wajib dipilih!',
            'content.required'    => 'Isi kontennya dulu bro!',
            'banner.image'        => 'Yang lo upload tuh bukan gambar 😤',
            'banner.mimes'        => 'Format banner cuma boleh JPG atau PNG 😠',
            'banner.max'          => 'Bro, file lo kegedean! Server gue ngos-ngosan 🥵 (max 2MB)',
        ]);

        $folder = 'contents/' . $request->slug;
        Storage::disk('public')->makeDirectory($folder);

        if ($request->hasFile('banner')) {
            $file     = $request->file('banner');
            $filename = 'banner.' . $file->getClientOriginalExtension();
            $filePath = $folder . '/' . $filename;

            $manager = new ImageManager(new Driver());
            $image   = $manager->read($file->getPathname());

            $compressed = $file->getClientOriginalExtension() === 'png'
                ? $image->toPng(70)
                : $image->toJpeg(70);

            Storage::put($filePath, (string) $compressed);
        }


        $insert = Content::create([
            'title'    => $request->title,
            'slug'     => $request->slug,
            'category' => $request->categories,
            'tags'     => $request->tags,
            'status'   => $request->status,
            'author'   => 'Thoriq',
            'views'    => 0,
            'contents' => $request->content,
        ]);

        $msg = $request->status === 'published'
                ? 'Text Published'
                : 'Text Saved as Draft';
        return back()->with('success', $msg);

    } catch (\Throwable $e) {
        \Log::error('PostHandleController error: ' . $e->getMessage());

        if (str_contains($e->getMessage(), 'SQLSTATE')) {
            $msg = '⚠️ Database error waktu nyimpen data, coba lagi ya bro.';
        } elseif (str_contains($e->getMessage(), 'image') || str_contains($e->getMessage(), 'GD')) {
            $msg = '🖼️ Gagal proses gambar, mungkin filenya rusak bro.';
        } elseif (str_contains($e->getMessage(), 'uploaded')) {
            $msg = '🤣 Bro! File lo kegedean, server sampe pingsan. Max 2MB aja.';
        } else {
            $msg = '💀 Terjadi error misterius... kayak mantan lo, susah ditebak.';
        }

        return back()->with('error', $msg);
    }
}

}
