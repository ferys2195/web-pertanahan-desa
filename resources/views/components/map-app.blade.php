<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator | Laravel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?JetBrains+Mono:wght@700&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin-style.css">
    <link rel="stylesheet" href="/vendor/leaflet/leaflet.css" />
    <script src="/vendor/leaflet/leaflet.js"></script>

    <style>
        #map {
            height: 100vh;
        }

        .leaflet-tooltip.no-background {
            background: transparent;
            border: none;
            box-shadow: none;
            color: white;
        }

    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg fixed-top bg-white">
            @include('layouts._nav')
        </nav>
    </header>
    <main class="mt-5">
        <div id="content">
            <div id="map"></div>
        </div>
    </main>
    <aside>
        <form action="http://127.0.0.1:8000/admin/logout" method="post" id="form-logout">
            <input type="hidden" name="_token" value="BWpD0OMyHJAimnfKc9A46vMPi1jJUPCWJS8I1xeE"> </form>
    </aside>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById("link-logout").addEventListener("click", () => {
            Swal.fire({
                title: 'Do you want to Logout?'
                , showCancelButton: true
                , confirmButtonText: 'Ya'
            , }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    document.getElementById("form-logout").submit();
                }
            })
        });

    </script>
    <script src="/vendor/axios/axios.min.js"></script>
    <script src="/vendor/leaflet/plugin/leaflet.ajax.js"></script>
    <script src="/vendor/leaflet/plugin/L.LatLng.UTM.js"></script>
    <script src="/vendor/leaflet/plugin/leaflet-bing-layer.min.js"></script>
    <script src="/js/app.js"></script>
    <script src="/js/maps/base-layer.js"></script>
    <script src="/js/maps/desa-layer.js"></script>
    <script src="/js/admin/maps.js"></script>
    <script>
        const p1 = [-2.52010, 112.94731];
        const p2 = [-2.51984, 112.94761];
        const distance = getDistance(p1, p2)
        console.log("jarak");
        console.log(distance.toFixed(2));

    </script>
</body>
</html>
