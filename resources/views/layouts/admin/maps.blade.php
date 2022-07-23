{{-- <x-admin-app>
    <x-slot:content>
        <div id="map"></div>
    </x-slot:content>
    @push('head')
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
    @endpush
    @push('foot')
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
    @endpush
</x-admin-app> --}}
<x-map-app>
</x-map-app>
