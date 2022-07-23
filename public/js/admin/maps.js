const map = L.map("map", {
    zoomControl: false,
    center: [-2.267562387075492, 112.85822389019435],
    zoom: 13,
    layers: [
        new BaseLayer().ArcGis,
        wilayahAdministrasiPamalian,
        objekUmumDesa.bringToFront(),
    ],
});
const currentMarkers = [];
const layerGroup = new L.LayerGroup().addTo(map);
const daftarTanah = new L.GeoJSON.AJAX(`${baseUrl}/api/tanah`, {
    style: function (feature) {
        if (feature.properties.registration.is_register) {
            return {
                color: "#0f0f0f",
                weight: 0.5,
                fillColor: "#ff8c00",
                fillOpacity: 0.6,
            };
        } else {
            return {
                color: "#0f0f0f",
                weight: 0.5,
                fillColor: "#008000",
                fillOpacity: 0.6,
            };
        }
    },
    onEachFeature: function (feature, layer) {
        let popupMessage;
        layer
            .bindTooltip(feature.properties.pemilik.nama, {
                permanent: true,
                direction: "center",
                className: "no-background",
            })
            .openTooltip();
        if (feature.properties.registration.is_register) {
            popupMessage = /*html*/ `
                <h6>Terdaftar <i class="bi bi-patch-check-fill text-info"></i></h6>
                <small class="d-block">No. Register Desa : ${
                    feature.properties.registration.desa.nomor
                }</small>
                <small class="d-block">Tgl. Register Desa : ${
                    feature.properties.registration.desa.tanggal
                }</small>
                <hr/>
                <small class="d-block">No. Register Kecamatan : ${
                    feature.properties.registration.kecamatan.nomor ?? "-"
                }</small>
                <small class="d-block">Tgl. Register Kecamatan : ${
                    feature.properties.registration.kecamatan.tanggal ?? "-"
                }</small>
            `;
        } else {
            popupMessage = /*html*/ `
                <h6>Belum Terdaftar</h6>
                <a href="${baseUrl}/admin/surat/${feature.properties.id}" target="_blank" class="btn btn-primary btn-sm text-light">Daftarkan Sekarang</a>
            `;
        }
        layer.bindPopup(popupMessage);

        layer.on({
            click: function (e) {
                map.fitBounds(e.target._bounds);
                if (currentMarkers.length != 0) {
                    layerGroup.clearLayers();
                    currentMarkers.length = 0;
                }
                const pointIcon = L.icon({
                    iconUrl: `${baseUrl}/vendor/leaflet/images/marker.png`,
                    iconAnchor: [20, 32], // point of the icon which will correspond to marker's location
                    popupAnchor: [0, -32],
                });

                const coordinates = feature.geometry.coordinates[0];
                coordinates.pop();
                coordinates.forEach((val, i) => {
                    const point = [val[1].toFixed(6), val[0].toFixed(6)];
                    const name = "P" + (i + 1);
                    const markers = new L.marker(point, {
                        icon: pointIcon,
                    });
                    markers.bindTooltip(name, {
                        permanent: true,
                        direction: "center",
                        className: "no-background",
                        offset: L.point(10, -10),
                    });
                    markers.bindPopup(`${point[0]},${point[1]}`);
                    layerGroup.addLayer(markers);
                    currentMarkers.push(markers);
                });
            },
            mouseover: function (e) {
                this.setStyle({
                    color: "#1B2430",
                    weight: 3,
                    fillOpacity: 1,
                });
            },
            mouseout: function (e) {
                this.setStyle({
                    color: "#0f0f0f",
                    weight: 0.5,
                    fillOpacity: 0.6,
                });
            },
        });
    },
});

map.addLayer(daftarTanah.bringToFront());

let prevZoom = map.getZoom();
map.on({
    zoomend: function (e) {
        const currZoom = map.getZoom();
        const diff = prevZoom - currZoom;
        if (diff > 0) {
            console.log("zoom out");
        } else if (diff < 0) {
            if (currZoom >= 18) {
                console.log("change map");
            }
            // alert("zoomed in" + currZoom);
        } else {
            alert("no change");
        }
        prevZoom = currZoom;
    },
    click: function (e) {
        layerGroup.clearLayers();
        console.log("clikc map");
        console.log(e);
    },
    contextmenu: function (event) {
        let latlng = event.latlng;

        let items = document.createElement("ul");
        items.className = "list-group";
        let popup = L.popup({ minWidth: 300 })
            .setLatLng(event.latlng)
            .setContent(items)
            .openOn(map); // openOn => popup is closed if another popup is opened

        // build elements in the popup + close popup on action
        let item = document.createElement("li");
        item.className = "list-group-item";
        items.appendChild(item);
        let link = document.createElement("a");
        link.className = "list-group-item list-group-item-action";
        item.appendChild(link);
        link.textContent = `${latlng}`;
        link.href = "#";
        link.addEventListener(
            "click",
            (e) => {
                this.scene.add(new Marker(event.latlng.lat, event.latlng.lng));
                popup.remove();
                e.preventDefault();
            },
            false
        );
    },
});

const layerControlZoom = L.control.zoom({ position: "bottomright" }).addTo(map);
const layerControl = new L.control.layers(new BaseLayer()).addTo(map);
layerControl.addOverlay(objekUmumDesa, "Objek Umum Desa");
layerControl.addOverlay(hgu, "Inklave Desa");
layerControl.addOverlay(wilayahRT, "Batas RT");
