       <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                    <i class="bx bx-chevron-right fs-4 lh-0"></i>
                    <span class="fw-bold ms-2">
                        @yield('title', 'Dashboard Anggota') </span>
                </div>
            </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                

                <!-- User -->
                 <ul class="navbar-nav flex-row align-items-center ms-auto">
                  <li class="nav-item me-3">
                    <span class="fw-semibold">{{ Auth::user()->name }}</span>
                    <small class="text-muted d-block" style="font-size: 10px; margin-top: -5px;">{{ Auth::user()->role }}</small>
                  </li>

                  <li class="nav-item ms-3">
                    <div class="avatar avatar-online">
                      <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </li>
                </ul>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->
