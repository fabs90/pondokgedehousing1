<?php

namespace App\Http\Controllers;

use App\Models\HeroCarousel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class HeroCarouselController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('input_gambar')) {
            // Generate filename
            $fileName = time() . '-' . $request->file('input_gambar')->getClientOriginalName();

            try {
                $request->file('input_gambar')->storeAs('hero_carousel', $fileName, 'public');
                // create new instance
                $promo = new HeroCarousel();
                $promo->gambar = $fileName;
                $promo->keterangan = $request->input_keterangan;
                $promo->slug = Str::slug($request->file('input_gambar')->getClientOriginalName());
                $promo->save();
                toast('Gambar menu utama berhasil ditambah!', 'success');
                return redirect()->back();

            } catch (\Throwable $e) {
                Alert::error('Error', 'Terjadi error : ' . $e);
                return redirect()->back();
            }

        } else {
            Alert::error("Terjadi Error", "Data tidak daoat diproses");
            return redirect()->back();
        }
    }

    public function edit($slug)
    {
        $image = HeroCarousel::where('slug', $slug)->firstOrFail();
        if (!$image) {
            toast('Data tidak ditemukan!', 'error');
            return redirect()->back();
        }
        return view('admin.carousel.form-edit-heroCarousel', compact('image'));
    }

    public function update(Request $request, $slug)
    {
// Find data from slug
        $image = HeroCarousel::where('slug', $slug)->firstOrFail();

        if (!$image) {
            toast('Data tidak ditemukan', 'error');
            return redirect()->back();
        }

// cek apakah ada gambar masuk
        if ($request->hasFile('input_gambar')) {
            // Delete the old gambar
            if (file_exists(public_path('/storage/hero_carousel/' . $image->gambar))) {
                unlink(public_path('/storage/hero_carousel/' . $image->gambar));
            }

            // Store and set the new image
            $image->gambar = time() . '-' . $request->file('input_gambar')->getClientOriginalName();
            $request->file('input_gambar')->storeAs('hero_carousel', $image->gambar, 'public');

        }

        $image->fill([
            'keterangan' => $request->input('input_keterangan', $image->keterangan),
            'slug' => Str::slug($request->input($image->gambar, $image->slug)),
        ]);
        $image->save();
        toast('Data berhasil di update!', 'success');
        return redirect()->route('carousel.menu-utama.edit', ['slug' => $image->slug]);
    }

    public function destroy($slug)
    {
        try {
            $data = HeroCarousel::where('slug', $slug)->firstOrFail();
            unlink(public_path('storage/hero_carousel/' . $data->gambar));
            $data->delete();
            toast('Foto berhasil dihapus!', 'success');
            return redirect()->route('carousel.menu-utama');
        } catch (ModelNotFoundException $e) {
            toast('Foto tidak ditemukan!', 'error');
            return redirect()->route('carousel.menu-utama')->setStatusCode(Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            logger()->error($e->getMessage());

            toast('Terjadi error, foto gagal dihapus! '+$e, 'error');
            return redirect()->route('carousel.menu-utama')->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}