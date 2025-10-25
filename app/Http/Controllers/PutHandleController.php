<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PutHandleController extends Controller
{
    
    // Show Edit
    // public function showEdit($slug){

    //     // Get Record
    //     $getContent = Content::where('slug', $slug)->firstOrFail();

    //     // Debug
    //     // dd($getContent);

    //     // view
    //     return view('contents.editedText', [
    //         'title' => 'Edited Text',
    //         'content' => $getContent
    //     ]);
    // }

    // Update

    public function updateContent(Request $request, $id){
        try {
            $request->validate([
                'title'     => [
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
                            // Hapus semua tag HTML
                            $clean = trim(strip_tags($value));
                            
                            if ($clean === '' || strlen($clean) === 0) {
                                $fail('Isi kontennya jangan kosong dong bro 😡');
                            }
                        },
                    ],
                'banner'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ], [
                'title.required'      => 'Judul wajib diisi, masa kosong 😡',
                'title.regex'    => 'Judul Jangan angka semuanya dong !!',
                'slug.required'       => 'Slug jangan kosong dong!',
                'categories.required' => 'Pilih kategori dulu bro!',
                'status.required'     => 'Status wajib dipilih!',
                'banner.uploaded'     => 'Lo upload apaan? Wallpaper NASA? Max 2MB aja napa 😤',
                'banner.image'        => 'Yang lo upload tuh bukan gambar 😤',
                'banner.mimes'        => 'Format banner cuma boleh JPG atau PNG 😠',
                'banner.max'          => collect([
                    'Woy ukuran bannernya kegedean bro 😤',
                    '2MB tuh batasnya, jangan ngelunjak 😡',
                    'Banner segede gaban ngapain? Maks 2MB aja 🚫',
                ])->random(),
            ]);

            $content = Content::findOrFail($id);
            $oldSlug = $content->slug;

            // rename folder
            if ($oldSlug !== $request->slug) {
                $oldFolder = 'contents/' . $oldSlug;
                $newFolder = 'contents/' . $request->slug;

                if (Storage::disk('public')->exists($oldFolder)) {
                    Storage::disk('public')->move($oldFolder, $newFolder);
                } else {
                    Storage::disk('public')->makeDirectory($newFolder);
                }
            } else {
                $newFolder = 'contents/' . $oldSlug;
            }

            // upload banner baru (jika ada)
            if ($request->hasFile('banner')) {
                $file     = $request->file('banner');
                $filename = 'banner.' . $file->getClientOriginalExtension();
                $filePath = $newFolder . '/' . $filename;

                Storage::disk('public')->deleteDirectory($newFolder);
                Storage::disk('public')->makeDirectory($newFolder);

                $manager = new ImageManager(new Driver());
                $image   = $manager->read($file->getPathname());

                $compressed = $file->getClientOriginalExtension() === 'png'
                    ? $image->toPng(70)
                    : $image->toJpeg(70);

                Storage::put($filePath, (string) $compressed);
            }

            $content->update([
                'title'    => $request->title,
                'slug'     => $request->slug,
                'category' => $request->categories,
                'tags'     => $request->tags,
                'status'   => $request->status,
                'contents' => $request->content,
            ]);

            $msg = $request->status === 'published'
                ? 'Text Updated & Published'
                : 'Text Updated as Draft';

            return redirect()->route('your-text')->with('success', $msg);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            \Log::error('Update content error: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while updating the content.');
        }

    }
}
