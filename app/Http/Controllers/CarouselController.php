<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\HeroCarousel;
use App\Models\Promo;

class CarouselController extends Controller
{
    public function index()
    {
        $datas = HeroCarousel::all();
        $title = 'Yakin hapus foto?';
        $text = "Data foto akan terhapus permanen!";
        confirmDelete($title, $text);
        return view('admin.carousel.hero-carousel-index', compact('datas'));
    }

    public function carouselPromoIndex()
    {
        $datas = Promo::all();
        $title = 'Yakin hapus foto?';
        $text = "Data foto akan terhapus permanen!";
        confirmDelete($title, $text);
        return view('admin.carousel.carousel-promo', compact('datas'));
    }

    public function carouselGalleryIndex()
    {
        $datas = Gallery::all();
        $title = 'Yakin hapus foto?';
        $text = "Data foto akan terhapus permanen!";
        confirmDelete($title, $text);
        return view('admin.carousel.carousel-gallery', compact('datas'));
    }

    public function carouselHeroCreate()
    {
        return view('admin.carousel.form-carousel-hero');
    }

    public function carouselPromoCreate()
    {
        return view('admin.carousel.form-carousel-promo');
    }

    public function carouselGalleryCreate()
    {
        return view('admin.carousel.form-carousel-gallery');
    }
}
