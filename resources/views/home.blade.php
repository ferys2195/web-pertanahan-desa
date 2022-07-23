<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web GIS Desa Pamalian</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/vendor/leaflet/leaflet.css" />
    <script src="/vendor/leaflet/leaflet.js"></script>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header>
        <button class="btn btn-outline-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            Show Workbench <i class="bi bi-list"></i>
        </button>
    </header>
    <main>
        <div id="content">
            <div id="map"></div>
        </div>
        <aside>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" data-bs-backdrop="false" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Atur Peta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div>
                        <div class="form-check form-switch form-check-reverse d-flex justify-content-between">
                            <label class="form-check-label" for="switch-hgu">Tampilkan Peta HGU</label>
                            <input class="form-check-input" type="checkbox" id="switch-hgu">
                        </div>
                    </div>
                    <div>
                        <div class="form-check form-switch form-check-reverse d-flex justify-content-between">
                            <label class="form-check-label" for="switch-hgu">Tampilkan Peta Wilayah RT</label>
                            <input class="form-check-input" type="checkbox" id="switch-wilayah-rt">
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/vendor/axios/axios.min.js"></script>
    <script src="/vendor/leaflet/plugin/leaflet.ajax.js"></script>
    <script src="/vendor/leaflet/plugin/L.LatLng.UTM.js"></script>
    <script src="/vendor/leaflet/plugin/leaflet-bing-layer.min.js"></script>

    <script src="/js/app.js"></script>
    <script src="/js/maps/base-layer.js"></script>
    <script src="/js/maps/desa-layer.js"></script>
    <script src="/js/home.js"></script>
    <script>
        const switchHGU = document.getElementById("switch-hgu");
        const switchWilayahRT = document.getElementById("switch-wilayah-rt");
        switchHGU.addEventListener("change", () => {
            if (switchHGU.checked) showHGU();
            else hideHGU();
        });
        switchWilayahRT.addEventListener("change", () => {
            if (switchWilayahRT.checked) showWilayahRT();
            else hideWilayahRT();
        });

    </script>
</body>
</html>
