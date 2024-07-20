<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DetailPostController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HeroCarouselController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\TrackTraffic;
use App\Models\Article;
use App\Models\ContactService;
use App\Models\Gallery;
use App\Models\HeroCarousel;
use App\Models\Promo;
use App\Models\Traffic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware([TrackTraffic::class])->group(function () {
    Route::get('/', function () {
        $contacts = ContactService::all();
        $galleryPrev = Gallery::latest()->take(5)->get();
        $promos = Promo::all();
        $carouselUtama = HeroCarousel::all();
        $articles = Article::orderBy('id', 'desc')->take(3)->get();
        return view('personal.homeContent', compact('contacts', 'galleryPrev', 'promos', 'carouselUtama', 'articles'));
    })->name('landing.index');

    Route::get('/gallery', [GalleryController::class, 'showGallery'])->name('gallery');
    Route::get('/detail/{slug}', [DetailPostController::class, 'show'])->name('showDetail');

    Auth::routes();
});

// Admin
Route::middleware([isAdmin::class])->group(function () {
    Route::get('/dashboard', function () {
        $carouselUtama = HeroCarousel::all()->count();
        $carouselPromo = Promo::all()->count();
        $carouselGaleri = Gallery::all()->count();
        $informasi = Article::all()->count();
        $kontak = ContactService::all()->count();
        $trafficWeb = Traffic::where('type', 'web')->get();
        return view('admin.dashboard', compact('carouselUtama', 'carouselPromo', 'carouselGaleri', 'informasi', 'kontak', 'trafficWeb'));
    })->name('dashboard.index');

    // Carousel
    Route::get('/dashboard/carousel/menu-utama', [CarouselController::class, 'index'])->name('carousel.menu-utama');
    Route::get('/dashboard/carousel/menu-utama/create', [CarouselController::class, 'CarouselHeroCreate'])->name('carousel.menu-utama.create');
    Route::post('/dashboard/carousel/menu-utama/store', [HeroCarouselController::class, 'store'])->name('carousel.menu-utama.store');
    Route::get('/dashboard/carousel/menu-utama/edit/{slug}', [HeroCarouselController::class, 'edit'])->name('carousel.menu-utama.edit');
    Route::patch('/dashboard/carousel/menu-utama/{slug}/update', [HeroCarouselController::class, 'update'])->name('carousel.menu-utama.update');
    Route::delete('/dashboard/carousel/menu-utama/{slug}/delete', [HeroCarouselController::class, 'destroy'])->name('carousel.menu-utama.destroy');

    Route::get('/dashboard/carousel/promo', [CarouselController::class, 'carouselPromoIndex'])->name('carousel.promo');
    Route::get('/dashboard/carousel/promo/create', [CarouselController::class, 'CarouselPromoCreate'])->name('carousel.promo.create');
    Route::post('/dashboard/carousel/promo/store', [PromoController::class, 'store'])->name('carousel.promo.store');
    Route::get('/dashboard/carousel/promo/{slug}/edit', [PromoController::class, 'edit'])->name('carousel.promo.edit');
    Route::delete('/dashboard/carousel/promo/{slug}/destroy', [PromoController::class, 'destroy'])->name('carousel.promo.destroy');
    Route::patch('/dashboard/carousel/promo/{slug}/update', [PromoController::class, 'update'])->name('carousel.promo.update');

    Route::get('/dashboard/carousel/gallery', [CarouselController::class, 'carouselGalleryIndex'])->name('carousel.gallery');
    Route::get('/dashboard/carousel/gallery/create', [CarouselController::class, 'carouselGalleryCreate'])->name('carousel.gallery.create');
    Route::post('/dashboard/carousel/gallery/store', [GalleryController::class, 'store'])->name('carousel.gallery.store');
    Route::get('/dashboard/carousel/gallery/edit/{slug}', [GalleryController::class, 'edit'])->name('carousel.gallery.edit');
    Route::patch('/dashboard/carousel/gallery/{slug}/update', [GalleryController::class, 'update'])->name('carousel.gallery.update');
    Route::delete('/dashboard/carousel/gallery/{slug}/destroy', [GalleryController::class, 'destroy'])->name('carousel.gallery.destroy');

    // Article
    Route::get('/dashboard/article/', [ArticleController::class, 'index'])->name('article.index');
    Route::get('/dashboard/article/create', [ArticleController::class, 'create'])->name('article.create');
    Route::get('/dashboard/article/edit/{slug}', [ArticleController::class, 'edit'])->name('article.edit');
    Route::post('/dashboard/article/store', [ArticleController::class, 'store'])->name('article.store');
    Route::patch('/dashboard/article/{slug}/update', [ArticleController::class, 'update'])->name('article.update');
    Route::delete('dashboard/article/{slug}/destroy', [ArticleController::class, 'destroy'])->name('article.destroy');

    // Contact
    Route::get('/dashboard/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/dashboard/contact', [ContactController::class, 'store'])->name('contact.store');
    Route::delete('/dashboard/contact/{id}/destroy', [ContactController::class, 'destroy'])->name('contact.destroy');

    // Role
    Route::post('/dashboard/contact/role', [RoleController::class, 'store'])->name('role.store');
    Route::delete('/dashboard/contact/role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
