
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
           <a href="{{route('admin.home')}}" class="app-brand-link">
          <span class="app-brand-logo demo">
            <img src="{{ asset('assets/img/favicon/4deb6dda65c141e2fa8d2fa0c6bfc75b-removebg-preview.png') }}" 
                alt="Logo" 
                width="65" 
                style="margin-right: 10px;">
          </span>
          
          <span class="app-brand-text demo menu-text fw-bolder">e-perpus</span>
        </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
    
         <li class="menu-item {{ Request::is('home*', 'dashboard*', '/', 'admin/dashboard*') ? 'active' : '' }}">
            <a href="{{ route('admin.home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

          <li class="menu-item {{ Request::is('buku*') ? 'active' : '' }}">
              <a href="{{ route('buku.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-library"></i>
                  <div data-i18n="Tables">Buku</div>
              </a>
          </li>

          <li class="menu-item {{ Request::is('petugas*') ? 'active' : '' }}">
              <a href="{{ route('petugas.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-id-card"></i>
                  <div data-i18n="Tables">Petugas</div>
              </a>
          </li>

          <li class="menu-item {{ Request::is('anggota*') ? 'active' : '' }}">
              <a href="{{ route('anggota.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-group"></i>
                  <div data-i18n="Tables">Anggota</div>
              </a>
          </li>

          <li class="menu-item {{ Request::is('peminjaman*') ? 'active' : '' }}">
              <a href="{{ route('peminjaman.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-export"></i>
                  <div data-i18n="Tables">Peminjaman</div>
              </a>
          </li>

        <li class="menu-item {{ Request::is('pengembalian*') ? 'active' : '' }}">
            <a href="{{ route('pengembalian.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-history"></i>
                <div data-i18n="Tables">Pengembalian</div>
            </a>
        </li>
</ul>
        </aside>