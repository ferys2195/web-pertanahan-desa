<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('assets/templates/admin-kit/img/icons/icon-48x48.png') }}" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>@yield('title', 'Administrator') | {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/vendor/leaflet/leaflet.css" />
    <script src="/vendor/leaflet/leaflet.js"></script>

    <style>
        #map {
            height: 100vh;
            width: 100%;
        }

        @media screen and (max-width: 920px) {
            #map {
                height: 520px;
                width: 100%;
            }
        }


        media .leaflet-tooltip.no-background {
            background: transparent;
            border: none;
            box-shadow: none;
            color: white;
        }
    </style>
    @stack('head')
</head>

<body>
    <header>
        <nav class="navbar bg-body-tertiary">
            <a class="navbar-brand" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling"
                aria-controls="offcanvasScrolling">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                    class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </a>
        </nav>
    </header>
    <aside>
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
            id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Main Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                @yield('offcanvas-body')
            </div>
        </div>
    </aside>
    <main>
        <div id="map"></div>
        @yield('additional-template')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/vendor/axios/axios.min.js"></script>
    <script src="/vendor/leaflet/plugin/leaflet.ajax.js"></script>
    <script src="/vendor/leaflet/plugin/L.LatLng.UTM.js"></script>
    <script src="/vendor/leaflet/plugin/leaflet-bing-layer.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-gpx/1.7.0/gpx.min.js"></script>
    <script src="/js/app.js"></script>
    <script src="/js/maps/base-layer.js"></script>
    <script src="/js/maps/desa-layer.js"></script>
    <script src="/js/admin/maps.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var headerHeight = document.querySelector('header').offsetHeight;
            var mapElement = document.querySelector('#map');
            mapElement.style.height = `calc(100vh - ${headerHeight}px)`;
        });
        const bsOffcanvas = new bootstrap.Offcanvas('#offcanvasScrolling')
        bsOffcanvas.show()
    </script>

    @stack('foot')
</body>

</html>
