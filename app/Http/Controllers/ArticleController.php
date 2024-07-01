<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ArticleController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        $articles = Article::all();

        $title = 'Yakin hapus data?';
        $text = "Data akan terhapus permanen!";
        confirmDelete($title, $text);
        return view('admin.article.article-index', compact('categories', 'articles'));
    }

    public function create()
    {
        return view('admin.article.article-add-form');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'input_judul' => ['required'],
            'input_category' => ['required', 'in:1,2,3'],
        ],
            [
                'input_judul.required' => 'Silakan isi kolom judul',
                'input_category.required' => "Silakan isi kolom category",
                'input_category.in' => "Masukan pilihan yang benar!",
            ]);

        if ($request->hasFile('input_gambar') && $validated) {
            // Generate filename
            $fileName = time() . '-' . $request->file('input_gambar')->getClientOriginalName();

            try {
                // Store image in the images folder
                $request->file('input_gambar')->storeAs('images', $fileName, 'public');

                // Create a new Article instance
                $article = new Article();
                $article->category_id = $request->input_category;
                $article->judul = $request->input_judul;
                $article->isi = $request->input_isi;
                $article->gambar = $fileName;
                $article->slug = Str::slug($request->input_judul);
                $article->created_at = now();
                $article->save();

                toast('Informasi berhasil ditambah!', 'success');
                return redirect()->route('article.create')->with('success', 'data berhasil ditambah');
            } catch (Exception $e) {
                Alert::error('Error', 'Terjadi error : ' . $e);
                return redirect()->back();
            }
        }

        return redirect()->route('article.index');

    }

    public function edit($slug)
    {
        $datas = Article::where('slug', $slug)->first();
        return view('admin.article.article-edit', compact('datas'));
    }

    public function update(Request $request, $slug)
    {
        // Find data from slug
        $article = Article::where('slug', $slug)->first();

        if (!$article) {
            toast('Data tidak ditemukan', 'error');
            return redirect()->back();
        }

        // cek apakah ada gambar masuk
        if ($request->hasFile('input_gambar')) {
            // Delete the old image )
            if (file_exists(public_path('/storage/images/' . $article->gambar))) {
                unlink(public_path('/storage/images/' . $article->gambar));
            }

            // Store and set the new image
            $article->gambar = time() . '-' . $request->file('input_gambar')->getClientOriginalName();
            $request->file('input_gambar')->storeAs('images', $article->gambar, 'public');
        }
// update only field that user write
        $article->fill([
            'category_id' => $request->input('input_category', $article->category_id),
            'judul' => $request->input('input_judul', $article->judul),
            'isi' => $request->input('input_isi', $article->isi),
            'slug' => Str::slug($request->input('input_judul', $article->slug)),
        ]);
        // save the update
        $article->save();

        toast('Data berhasil di update!', 'success');
        return redirect(route('article.edit', ['slug' => $article->slug]));

    }

    public function destroy($slug)
    {
        $data = Article::where('slug', $slug)->first();
        if ($data != null) {
            unlink(public_path('storage/images/' . $data->gambar));
            $data->delete();
            toast('Informasi berhasil dihapus!', 'success');
            return redirect()->route('article.index');
        } else {
            toast('Terjadi error!', 'error');
            return redirect()->route('article.index')->withErrors('Data gagal dihapus :(');
        }
    }

}
