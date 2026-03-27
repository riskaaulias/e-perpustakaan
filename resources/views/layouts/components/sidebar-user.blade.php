
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
           <a href="{{route('user.dashboard')}}" class="app-brand-link">
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
        <li class="menu-item {{ request()->is('dashboard*') ? 'active' : '' }}">
            <a href="{{ route('user.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('katalog*') ? 'active' : '' }}">
            <a href="{{ route('user.katalog') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-book-content"></i>
                <div>Katalog Buku</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('riwayat*') ? 'active' : '' }}">
            <a href="{{ route('user.riwayat') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-history"></i>
                <div>Riwayat Pinjam</div>
            </a>
        </li>

       <li class="flex-grow-1" style="list-style: none;"></li>
            <hr class="my-2 mx-3">
            <li class="menu-item pb-4">
            <a href="{{ route('logout') }}" 
                class="menu-link text-danger" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="menu-icon tf-icons bx bx-power-off"></i>
                <div data-i18n="Logout">Keluar Akun</div>
            </a>
            
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</aside>