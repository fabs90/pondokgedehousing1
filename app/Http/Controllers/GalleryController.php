<?php

namespace App\Http\Controllers;

use App\Models\ContactService;
use App\Models\Gallery;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use RealRashid\SweetAlert\Facades\Alert;

class GalleryController extends Controller
{
    public function showGallery()
    {
        $images = Gallery::all();
        $satpam = ContactService::all();
        return view('personal.gallery', compact('images', 'satpam'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('input_gambar')) {
            // Generate filename
            $fileName = time() . '-' . $request->file('input_gambar')->getClientOriginalName();

            try {
                $request->file('input_gambar')->storeAs('gallery', $fileName, 'public');
                // create new instance
                $gallery = new Gallery();
                $gallery->image = $fileName;
                $gallery->keterangan = $request->input_keterangan;
                $gallery->save();
                toast('Gambar galeri berhasil ditambah!', 'success');
                return redirect()->back();

            } catch (\Throwable $e) {
                Alert::error('Error', 'Terjadi error : ' . $e);
                return redirect()->back();
            }

        } else {
            toast("Data gagal diproses!", "error");
            return redirect()->back();
        }
    }

    public function edit($slug)
    {
        $gallery = Gallery::where('image', $slug)->firstOrFail();
        if (!$gallery) {
            toast('Data tidak ditemukan!', 'error');
            return redirect()->back();
        }
        return view('admin.carousel.form-edit-gallery', compact('gallery'));
    }

    public function update(Request $request, $slug)
    {
        // Find data from slug
        $gallery = Gallery::where('image', $slug)->firstOrFail();

        if (!$gallery) {
            toast('Data tidak ditemukan', 'error');
            return redirect()->back();
        }

        // cek apakah ada gambar masuk
        if ($request->hasFile('input_gambar')) {
            // Delete the old image )
            if (file_exists(public_path('/storage/gallery/' . $gallery->image))) {
                unlink(public_path('/storage/gallery/' . $gallery->image));
            }
        }

        // Store and set the new image
        $gallery->image = time() . '-' . $request->file('input_gambar')->getClientOriginalName();
        $request->file('input_gambar')->storeAs('gallery', $gallery->image, 'public');

        $gallery->fill([
            'keterangan' => $request->input('input_keterangan', $gallery->keterangan),
        ]);
        $gallery->save();
        toast('Data berhasil di update!', 'success');
        return redirect()->route('carousel.gallery.edit', ['slug' => $gallery->image]);
    }
    public function destroy($slug)
    {
        try {
            $data = Gallery::where('image', $slug)->firstOrFail();
            unlink(public_path('storage/gallery/' . $data->image));
            $data->delete();
            toast('Foto berhasil dihapus!', 'success');
            return redirect()->route('carousel.gallery');
        } catch (ModelNotFoundException $e) {
            toast('Foto tidak ditemukan!', 'error');
            return redirect()->route('carousel.gallery')->setStatusCode(Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            logger()->error($e->getMessage());

            toast('Terjadi error, foto gagal dihapus!', 'error');
            return redirect()->route('carousel.gallery')->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}