<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class DeleteHandleController extends Controller
{
    //

    public function destroyContent($id)
{
    try {
        $content = Content::findOrFail($id);

        // Hapus folder/banner
        $folder = 'contents/' . $content->slug;
        if (Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->deleteDirectory($folder);
        }

        $content->delete();

        return back()->with('success', 'Konten berhasil dihapus 🗑️');
    } catch (\Throwable $e) {
        \Log::error('DestroyContent error: ' . $e->getMessage());

        if (str_contains($e->getMessage(), 'No query results')) {
            $msg = '😕 Konten gak ditemukan, udah dihapus kali bro.';
        } elseif (str_contains($e->getMessage(), 'SQLSTATE')) {
            $msg = '⚠️ Error database waktu hapus konten, coba lagi ya bro.';
        } elseif (str_contains($e->getMessage(), 'permission')) {
            $msg = '🚫 Gagal hapus file, mungkin izin foldernya salah.';
        } else {
            $msg = '💀 Gagal hapus konten... bahkan Thanos pun bingung.';
        }

        return back()->with('error', $msg);
    }
}

}
