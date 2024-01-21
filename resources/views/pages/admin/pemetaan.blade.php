@extends('layouts.admin-pemetaan-layout')
@section('title', 'Peta Pertanahan')
@section('offcanvas-body')
    <label for="fileInput" class="mb-1"><small>Pilih File GPX</small></label>
    <input type="file" id="fileInput" class="form-control" accept=".gpx">
    <div class="mb-2">
        <small id="coordinate-selected"></small>
    </div>

    <div class="mb-2 d-none" id="save-layout">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addToPengukuranModal">
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
    <div class="modal fade" id="addToPengukuranModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addToPengukuranModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addToPengukuranModalLabel">Nama Pemilik</h1>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center gap-1 py-2 d-none" id="success-alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </svg>
                        <small class="text-success">
                            Berhasil Ditambahkan
                        </small>
                    </div>
                    <div class="input-group was-validated">
                        <input type="text" class="form-control" id="nama-pemilik" placeholder="Masukan Nama Pemilik"
                            aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                        <div class="invalid-feedback">
                            Nama Tidak Boleh Kosong !
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between" disabled>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <div>
                        <button type="button" id="btn-save" class="btn btn-sm btn-primary">Simpan</button>
                        <button type="button" id="btn-save-create" class="btn btn-sm btn-outline-primary">Simpan &
                            Buatkan
                            Surat</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('foot')
    <script>
        const saveLayout = document.getElementById("save-layout");
        const coordinateSelection = [];
        let polygon = null;
        let output = null;
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

            output = {
                data: convertData(coorUtm),
                type: "UTM",
                zone: coorUtm[0].zone.toString() + coorUtm[0].band // assuming all objects have the same zone and band
            };
            const coorview = coorUtm.map((coord, index) =>
                `P${index+1} = X : ${coord.x.toFixed()} Y : ${coord.y.toFixed()}` + "\n")
            coorsel.innerText = coorview

            if (output.data.length > 2) saveLayout.classList.remove("d-none")
            else saveLayout.classList.add("d-none")
        }
    </script>
    <script>
        const btnSave = document.getElementById('btn-save')
        const btnSaveAndCreateSuratTanah = document.getElementById('btn-save-create')
        const namaPemilik = document.getElementById('nama-pemilik')
        btnSave.addEventListener('click', async (e) => {
            const target = e.target
            if (namaPemilik.value.length == 0) {
                return
            }
            loadingButton(e.target)
            disableButton()
            const body = {
                'nama': namaPemilik.value,
                'coordinates': output,
                'registration': {
                    'is_register': false
                }
            }
            const save = await saveFloating(body)
            if (save.success) {
                document.getElementById('success-alert').classList.remove('d-none')
                setInterval(() => {
                    location.reload()
                }, 2000);
            }
        });
        btnSaveAndCreateSuratTanah.addEventListener('click', async (e) => {
            if (namaPemilik.value.length == 0) {
                return
            }
            loadingButton(e.target)
            disableButton()
            const body = {
                'nama': namaPemilik.value,
                'coordinates': output,
                'registration': {
                    'is_register': false
                }
            }
            const save = await saveFloating(body)
            if (save.success) {
                window.location.href = '/admin/surat/' + save.data.id
            }
        });

        async function saveFloating(payload) {
            const req = await fetch('/api/tanah', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            const res = await req.json()
            return res
        }

        function loadingButton(element) {
            // element.setAttribute('disabled', 'disabled')
            element.innerHTML = `
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                <span class="visually-hidden">Loading...</span>
            `
        }

        function disableButton() {
            let modalFooter = document.querySelector('.modal-footer');

            // Temukan semua tombol di dalam modal footer
            let buttons = modalFooter.querySelectorAll('button');

            // Loop melalui setiap tombol dan disable
            buttons.forEach(button => {
                button.disabled = true;
            });
        }
    </script>
@endpush
