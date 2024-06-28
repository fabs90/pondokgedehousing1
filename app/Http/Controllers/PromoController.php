<?php

namespace App\Http\Controllers;

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
        $promo = Promo::where('slug', $slug)->firstOrFail();
        if (!$promo) {
            toast('Data tidak ditemukan!', 'error');
            return redirect()->back();
        }
        return view('admin.carousel.form-edit-promo', compact('promo'));
    }

    public function update(Request $request, $slug)
    {
        // Find data from slug
        $promo = Promo::where('slug', $slug)->firstOrFail();

        if (!$promo) {
            toast('Data tidak ditemukan', 'error');
            return redirect()->back();
        }

        // Check if a new image has been uploaded
        if ($request->hasFile('input_gambar')) {
            // Delete the old image
            if (file_exists(public_path('/storage/promo/' . $promo->gambar))) {
                unlink(public_path('/storage/promo/' . $promo->gambar));
            }

            // Store and set the new image
            $promo->gambar = time() . '-' . $request->file('input_gambar')->getClientOriginalName();
            $request->file('input_gambar')->storeAs('promo', $promo->gambar, 'public');

            // Update the slug based on the new image name
            $promo->slug = Str::slug(pathinfo($request->file('input_gambar')->getClientOriginalName(), PATHINFO_FILENAME));
        } else {
            // If no new image, update the slug based on the current value
            $promo->slug = Str::slug($promo->slug);
        }

        $promo->fill([
            'keterangan' => $request->input('input_keterangan', $promo->keterangan),
        ]);

        $promo->save();

        toast('Data berhasil di update!', 'success');
        return redirect()->route('carousel.promo.edit', ['slug' => $promo->slug]);
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