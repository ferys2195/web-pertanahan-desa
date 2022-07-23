<div class="container">
    <a class="navbar-brand" href="#">SiPanah</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-5">
            <a class="nav-link" href="/admin">Beranda</a>
            <a class="nav-link" href="{{ route('admin.tanah.index') }}">Daftar Pengukuran</a>
            <a class="nav-link" href="{{ route('admin.maps') }}">Peta Pertanahan</a>
            <a class="nav-link" href="/admin/verify">Verifikasi Surat Tanah</a>
            <a class="nav-link" href="/admin/verify">Export/Import Data</a>
        </div>
        <div class="navbar-nav ms-auto">
            <li class="nav-item dropdown  ms-auto">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">Edit Profile</a></li>
                    <li><a class="dropdown-item" href="#">Change Password</a></li>
                    <li><a class="dropdown-item" href="#" id="link-logout">Logout</a></li>
                </ul>
            </li>
        </div>
    </div>
</div>
