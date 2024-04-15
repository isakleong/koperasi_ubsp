<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo align-items-center">
                <img width="60" src="/main/assets/static/images/logo/UBSP-logos_transparent.png" alt="Logo">
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"></li>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ Str::contains(request()->route()->getName(), 'dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboards">Dashboard</div>
            </a>
        </li>
        <!-- End of Dashboards -->

        <!-- Master Data -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">master data</span></li>
        <li class="menu-item {{ Str::contains(request()->route()->getName(), 'user') ? 'active' : '' }}">
            <a href="/admin/menu/user" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Basic">Anggota</div>
            </a>
        </li>
        <li class="menu-item {{ Str::contains(request()->route()->getName(), 'account_category') ? 'active' : '' }}">
            <a href="/admin/account_category" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div data-i18n="Basic">Kategori Akun</div>
            </a>
        </li>
        <li class="menu-item {{ Str::contains(request()->route()->getName(), 'account.') ? 'active' : '' }}">
            <a href="/admin/account" class="menu-link">
                <i class="menu-icon tf-icons bx bx-archive"></i>
                <div data-i18n="Basic">Daftar Akun</div>
            </a>
        </li>
        <li class="menu-item {{ Str::contains(request()->route()->getName(), 'company') || Str::contains(request()->route()->getName(), 'config') ? 'active open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Extended UI">Pengaturan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Str::contains(request()->route()->getName(), 'company') ? 'active' : '' }}">
                    <a href="/admin/company" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Profile UBSP</div>
                    </a>
                </li>
                <li class="menu-item {{ Str::contains(request()->route()->getName(), 'config') ? 'active' : '' }}">
                    <a href="/admin/config" class="menu-link">
                        <div data-i18n="Text Divider">Konfigurasi Data</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End of Master Data -->

        <!-- Transaction Data -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">transaksi</span></li>
        <li class="menu-item {{ Str::contains(request()->route()->getName(), 'transaction') ? 'active' : '' }}">
            <a href="/admin/menu/transaction" class="menu-link">
                <i class="menu-icon tf-icons bx bx-wallet"></i>
                <div data-i18n="Basic">Transaksi</div>
            </a>
        </li>

        <li class="menu-item {{ Str::contains(request()->route()->getName(), 'posting') ? 'active' : '' }}">
            <a href="/admin/menu/posting" class="menu-link">
                <i class="menu-icon tf-icons bx bx-send"></i>
                <div data-i18n="Basic">Posting Jurnal</div>
            </a>
        </li>

        <li class="menu-item {{ Str::contains(request()->route()->getName(), 'simpanan') ? 'active' : '' }}">
            <a href="/admin/menu/simpanan" class="menu-link">
                <i class="menu-icon tf-icons bx bx-wallet"></i>
                <div data-i18n="Basic">Simpanan</div>
            </a>
        </li>

        {{-- <li class="menu-item {{ Str::contains(request()->route()->getName(), 'kredit') ? 'active' : '' }}">
            <a href="/admin/menu/kredit" class="menu-link">
                <i class="menu-icon tf-icons bx bx-credit-card-front"></i>
                <div data-i18n="Basic">Kredit</div>
            </a>
        </li>
        <li class="menu-item {{ Str::contains(request()->route()->getName(), 'angsuran') ? 'active' : '' }}">
            <a href="/admin/menu/angsuran" class="menu-link">
                <i class="menu-icon tf-icons bx bx-money"></i>
                <div data-i18n="Basic">Angsuran</div>
            </a>
        </li> --}}

        <!-- End of Transaction Data -->

        <!-- Report Data -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">laporan</span></li>
        <li class="menu-item {{ Str::contains(request()->route()->getName(), 'journal') ? 'active' : '' }}">
            <a href="/admin/journal" class="menu-link">
                <i class="menu-icon tf-icons bx bx-book-open"></i>
                <div data-i18n="Basic">Jurnal Harian</div>
            </a>
        </li>
        <li class="menu-item {{ Str::contains(request()->route()->getName(), 'general-ledger') ? 'active' : '' }}">
            <a href="/admin/general-ledger" class="menu-link">
                <i class="menu-icon tf-icons bx bx-book-bookmark"></i>
                <div data-i18n="Basic">Buku Besar</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="/admin/menu/user" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-chart"></i>
                <div data-i18n="Basic">Neraca Saldo</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="/admin/menu/user" class="menu-link">
                <i class="menu-icon tf-icons bx bx-line-chart"></i>
                <div data-i18n="Basic">Laba Rugi</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="/admin/menu/user" class="menu-link">
                <i class="menu-icon tf-icons bx bx-network-chart"></i>
                <div data-i18n="Basic">Neraca</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="/admin/menu/user" class="menu-link">
                <i class="menu-icon tf-icons bx bx-coin-stack"></i>
                <div data-i18n="Basic">Hutang</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="/admin/menu/user" class="menu-link">
                <i class="menu-icon tf-icons bx bx-money-withdraw"></i>
                <div data-i18n="Basic">Piutang</div>
            </a>
        </li>
        <!-- End of Transaction Data -->

    </ul>
</aside>