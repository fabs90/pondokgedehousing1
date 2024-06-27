<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Promo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PromoController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('input_gambar')) {
            // Generate filename
            $fileName = time() . '-' . $request->file('input_gambar')->getClientOriginalName();

            try {
                $request->file('input_gambar')->storeAs('promo', $fileName, 'public');
                // create new instance
                $promo = new Promo();
                $promo->gambar = $fileName;
                $promo->keterangan = $request->input_keterangan;
                $promo->slug = Str::slug($request->file('input_gambar')->getClientOriginalName());
                $promo->save();
                toast('Gambar promo berhasil ditambah!', 'success');
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
        $gallery = Gallery::where('gambar', $slug)->firstOrFail();
        if (!$gallery) {
            toast('Data tidak ditemukan!', 'error');
            return redirect()->back();
        }
        return view('admin.carousel.form-edit-gallery', compact('gallery'));
    }

    public function update(Request $request, $slug)
    {
        // Find data from slug
        $gallery = Gallery::where('gambar', $slug)->firstOrFail();

        if (!$gallery) {
            toast('Data tidak ditemukan', 'error');
            return redirect()->back();
        }

        // cek apakah ada gambar masuk
        if ($request->hasFile('input_gambar')) {
            // Delete the old gambar )
            if (file_exists(public_path('/storage/promo/' . $gallery->gambar))) {
                unlink(public_path('/storage/promo/' . $gallery->gambar));
            }

        }

        // Store and set the new image
        $gallery->gambar = time() . '-' . $request->file('input_gambar')->getClientOriginalName();
        $request->file('input_gambar')->storeAs('promo', $gallery->gambar, 'public');

        $gallery->fill([
            'keterangan' => $request->input('input_keterangan', $gallery->keterangan),
            'slug' => Str::slug($request->input($gallery->gambar, $gallery->slug)),
        ]);
        $gallery->save();
        toast('Data berhasil di update!', 'success');
        return redirect()->route('carousel.gallery.edit', ['slug' => $gallery->gambar]);
    }
    public function destroy($slug)
    {
        try {
            $data = Promo::where('slug', $slug)->firstOrFail();
            unlink(public_path('storage/promo/' . $data->gambar));
            $data->delete();
            toast('Foto berhasil dihapus!', 'success');
            return redirect()->route('carousel.promo');
        } catch (ModelNotFoundException $e) {
            toast('Foto tidak ditemukan!', 'error');
            return redirect()->route('carousel.promo')->setStatusCode(Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            logger()->error($e->getMessage());

            toast('Terjadi error, foto gagal dihapus! '+$e, 'error');
            return redirect()->route('carousel.promo')->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
