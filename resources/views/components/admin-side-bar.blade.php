<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">GIS Pertanahan Desa</span>
            <small>Desa Pamalian Kec. Kota Besi</small>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Main Menu
            </li>

            <li class="sidebar-item active">
                <a class="sidebar-link" href="/admin">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.tanah.index') }}">
                    <i class="align-middle" data-feather="table"></i> <span class="align-middle">Daftar
                        Pengukuran</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.maps') }}">
                    <i class="align-middle" data-feather="map"></i> <span class="align-middle">Peta
                        Pertanahan</span>
                </a>
            </li>

            <li class="sidebar-header">
                Tools
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.verify') }}">
                    <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Verifikasi
                        Surat Tanah</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="ui-buttons.html">
                    <i class="align-middle" data-feather="pen-tool"></i> <span class="align-middle">Pemetaan
                        Tanah</span>
                </a>
            </li>

            <li class="sidebar-header">
                Backup & Restore
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="charts-chartjs.html">
                    <i class="align-middle" data-feather="upload"></i> <span class="align-middle">Export
                        Database</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="maps-google.html">
                    <i class="align-middle" data-feather="download"></i> <span class="align-middle">Import
                        Database</span>
                </a>
            </li>

            <li class="sidebar-header">
                Lainnya
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.settings') }}" id="link-settings">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Pengaturan</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="ui-buttons.html">
                    <i class="align-middle" data-feather="help-circle"></i> <span class="align-middle">Bantuan</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
