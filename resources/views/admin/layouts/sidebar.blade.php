  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
              <a class="nav-link " href="{{ route('dashboard.index') }}">
                  <i class="bi bi-grid"></i>
                  <span>Dashboard</span>
              </a>
          </li><!-- End Dashboard Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" data-bs-target="#components-nav-carousel" data-bs-toggle="collapse">
                  <i class="bi bi-image"></i><span>Carousel</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="components-nav-carousel" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('carousel.menu-utama') }}">
                          <i class="bi bi-circle"></i><span>Menu Utama</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('carousel.promo') }}">
                          <i class="bi bi-circle"></i><span>Promo</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('carousel.gallery') }}">
                          <i class="bi bi-circle"></i><span>Galeri</span>
                      </a>
                  </li>
              </ul>
          </li><!-- End Components Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" data-bs-target="#components-nav-artikel" data-bs-toggle="collapse"
                  href="#">
                  <i class="bi bi-newspaper"></i><span>Informasi</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="components-nav-artikel" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('article.index') }}">
                          <i class="bi bi-circle"></i><span>Atur Informasi</span>
                      </a>
                  </li>
              </ul>
          </li>
          <li class="nav-item">
              <a class="nav-link collapsed" data-bs-target="#components-nav-kontak" data-bs-toggle="collapse"
                  href="#">
                  <i class="bi bi-person-lines-fill"></i><span>Kontak</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="components-nav-kontak" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('contact.index') }}">
                          <i class="bi bi-circle"></i><span>Atur Kontak</span>
                      </a>
                  </li>
              </ul>
          </li>


      </ul>

  </aside><!-- End Sidebar-->
