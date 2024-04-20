<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <span>
                @php
                    $routeName = request()->route()->getName();
                    switch ($routeName) {
                        case Str::contains($routeName, 'dashboard'):
                            echo 'Dashboard';
                            break;
                        case Str::contains($routeName, 'user'):
                            echo 'Anggota';
                            break;
                        case Str::contains($routeName, 'account_category'):
                            echo 'Kategori Akun';
                            break;
                        case Str::contains($routeName, 'account.'):
                            echo 'Akun';
                            break;
                        case Str::contains($routeName, ['company', 'config']):
                            echo 'Pengaturan';
                            break;
                        case Str::contains($routeName, 'transaction'):
                            echo 'Transaksi';
                            break;
                        case Str::contains($routeName, 'posting'):
                            echo 'Posting';
                            break;
                        case Str::contains($routeName, 'journal'):
                            echo 'Jurnal Harian';
                            break;
                        case Str::contains($routeName, 'general-ledger'):
                            echo 'Buku Besar';
                            break;
                        default:
                            echo 'tba'; // To be assigned
                            break;
                    }
                @endphp
            </span>
        </div>
    </div>

    <ul class="navbar-nav flex-row align-items-center ms-auto">
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                    <span class="avatar-initial rounded-circle bg-label-primary"><i class="bx bxs-user-pin"></i></span>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="/admin/logout">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
