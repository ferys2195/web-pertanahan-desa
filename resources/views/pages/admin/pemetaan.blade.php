@extends('layouts.admin-pemetaan-layout')
@section('title', 'Peta Pertanahan')
@section('offcanvas-body')
    <label for="fileInput" class="mb-1"><small>Pilih File GPX</small></label>
    <input type="file" id="fileInput" class="form-control">
    <div class="mb-2">
        <small id="coordinate-selected"></small>
    </div>

    <div class="mb-2 d-none" id="save-layout">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy"
                viewBox="0 0 16 16">
                <path d="M11 2H9v3h2z" />
                <path
                    d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z" />
            </svg> Simpan
        </button>
        <small class="d-block text-info mt-1">Simpan Bidang ke Daftar Pengukuran</small>
    </div>
@endsection
@section('additional-template')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nama Pemilik</h1>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="exampleFormControlInput1"
                        placeholder="Masukan Nama Pemilik">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <div>
                        <button type="button" class="btn btn-sm btn-primary">Simpan</button>
                        <button type="button" class="btn btn-sm btn-outline-primary">Simpan & Buatkan Surat</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('foot')
    <script>
        const p1 = [-2.52010, 112.94731];
        const p2 = [-2.51984, 112.94761];
        const distance = getDistance(p1, p2)
        console.log("jarak");
        console.log(distance.toFixed(2));
    </script>
    <script>
        const saveLayout = document.getElementById("save-layout");
        const coordinateSelection = [];
        let polygon = null;
        const coorsel = document.getElementById('coordinate-selected');
        document.getElementById('fileInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const text = e.target.result;
                    const parser = new DOMParser();
                    const xmlDoc = parser.parseFromString(text, "application/xml");

                    const waypoints = xmlDoc.getElementsByTagName('wpt');
                    for (let i = 0; i < waypoints.length; i++) {
                        const wpt = waypoints[i];
                        const lat = parseFloat(wpt.getAttribute('lat'));
                        const lon = parseFloat(wpt.getAttribute('lon'));
                        const name = wpt.getElementsByTagName('name')[0]?.textContent || 'Waypoint';

                        // Tambahkan Marker ke Peta
                        const markerGPX = L.marker([lat, lon], {
                            icon: L.icon({
                                iconUrl: `${baseUrl}/vendor/leaflet/images/marker.png`,
                                iconAnchor: [20,
                                    32
                                ], // point of the icon which will correspond to marker's location
                                popupAnchor: [0, -32],
                            })
                        }).addTo(map);
                        markerGPX.on('mouseover', function(e) {
                            markerGPX.bindPopup(
                                `<h6>${name}</h6>
                                <small>UTM: ${markerGPX.getLatLng().utm()}</small>`
                            ).openPopup();
                        });

                        // Opsi tambahan: Menutup popup saat mouse keluar dari markerGPX
                        markerGPX.on('mouseout', function(e) {
                            markerGPX.closePopup();
                        });
                        markerGPX.on('click', function(e) {
                            coordinateSelection.push([lat, lon]);
                            updatePolygon();
                        });
                    }
                };
                reader.readAsText(file);
            }
        });

        function updatePolygon() {
            // Jika poligon sudah ada, hapus dari peta
            if (polygon) {
                map.removeLayer(polygon);
            }

            // Membuat poligon baru dari koordinat yang dipilih
            polygon = L.polygon(coordinateSelection, {
                color: 'red'
            }).addTo(map);
            const coorUtm = coordinateSelection.map(coord => {
                const newLatlng = L.latLng(coord[0], coord[1]);
                const toUtm = newLatlng.utm();
                return toUtm;
            })
            const convertData = (data) => {
                return data.map(obj => ({
                    x: Math.round(obj.x).toString(),
                    y: Math.round(obj.y).toString()
                }));
            };

            const output = {
                data: convertData(coorUtm),
                type: "UTM",
                zone: coorUtm[0].zone.toString() + coorUtm[0].band // assuming all objects have the same zone and band
            };
            const coorview = coorUtm.map((coord, index) =>
                `P${index+1} = X : ${coord.x.toFixed()} Y : ${coord.y.toFixed()}` + "\n")
            coorsel.innerText = coorview

            if (output.data.length > 2) {
                saveLayout.classList.toggle("d-none")
                console.log("yes")
            }
        }
    </script>
@endpush
