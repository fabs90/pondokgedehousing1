<main id="main" class="main">

    <div class="pagetitle">
        <div class="row">
            <div class="col-12">
                <h1>@yield('pagename')</h1>

            </div>
            <div class="col-12">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                        @yield('page-breadcrumb')
                    </ol>
                </nav>
            </div>
        </div>

    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            @yield('dashboard-content')
        </div>
    </section>

</main><!-- End #main -->
