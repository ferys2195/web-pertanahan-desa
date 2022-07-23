const daftarTanah = new L.GeoJSON.AJAX(`${baseUrl}/api/tanah`, {
    style: function (feature) {
        if (feature.properties.registration.is_register) {
            return {
                color: "#0f0f0f", //feature.properties.stroke, //Outline color
                weight: 0.5,
                fillColor: "#ff8c00", //feature.properties.fill,
                fillOpacity: 0.6,
            };
        } else {
            return {
                color: "#0f0f0f", //feature.properties.stroke, //Outline color
                weight: 0.5, //feature.properties.strokeWidth,
                fillColor: "#008000", //feature.properties.fill,
                fillOpacity: 0.6, //feature.properties.fillOpacity,
            };
        }
    },
    onEachFeature: function (feature, layer) {
        let popupMessage;
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
                <small>Belum Terdaftar</small>
            `;
        }
        layer.bindPopup(popupMessage);
        layer.on("mouseover", function (e) {
            this.setStyle({
                color: "#1B2430",
                weight: 3,
                fillOpacity: 1,
            });
        });
        layer.on("mouseout", function (e) {
            this.setStyle({
                color: "#0f0f0f", //feature.properties.stroke, //Outline color
                weight: 0.5, //feature.properties.strokeWidth,
                fillOpacity: 0.6, //feature.properties.fillOpacity,
            });
        });
    },
});

const map = L.map("map", {
    zoomControl: false,
    center: [-2.267562387075492, 112.85822389019435],
    zoom: 13,
    layers: [
        new BaseLayer().ArcGis,
        wilayahAdministrasiPamalian,
        daftarTanah.bringToFront(),
    ],
});

const layerControlZoom = L.control.zoom({ position: "bottomright" }).addTo(map);
const layerControl = new L.control.layers(new BaseLayer()).addTo(map);

function showHGU() {
    hgu.addTo(map);
}
function showWilayahRT() {
    wilayahRT.addTo(map);
}
function hideWilayahRT() {
    map.removeLayer(wilayahRT);
}
function hideHGU() {
    map.removeLayer(hgu);
}
