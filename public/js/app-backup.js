const baseUrl = location.origin;
const wilayahAdministrasiPamalian = new L.GeoJSON.AJAX(
    [`${baseUrl}/assets/geojson/pamalian.geojson`],
    { onEachFeature: popUp }
);
const hgu = new L.GeoJSON.AJAX(
    [`${baseUrl}/assets/geojson/hgu.geojson`],
    { style: polystyle },
    { onEachFeature: popUp }
);

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

const wilayahRT = new L.GeoJSON.AJAX([`${baseUrl}/assets/geojson/rt.geojson`], {
    style: function (feature) {
        return {
            color: feature.properties.stroke, //Outline color
            weight: 0, //feature.properties.strokeWidth,
            fillColor: feature.properties.fill,
            fillOpacity: feature.properties.fillOpacity,
        };
    },
    onEachFeature: function (feature, layer) {
        layer
            .bindTooltip(feature.properties.name, {
                permanent: true,
                direction: "center",
                className: "no-background",
            })
            .openTooltip();
        layer.on("mouseover", function (e) {
            this.setStyle({
                color: "#1B2430",
                weight: 2,
                fillOpacity: 1,
            });
        });
        layer.on("mouseout", function (e) {
            this.setStyle({
                color: feature.properties.stroke, //Outline color
                weight: 0, //feature.properties.strokeWidth,
                fillOpacity: feature.properties.fillOpacity,
            });
        });
    },
}).bringToBack();

const baseLayer = () => {
    const osm = L.tileLayer(
        "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
        {
            minZoom: 14,
            attribution:
                '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        }
    );
    const bingAeril = L.tileLayer.bing(
        "AuhiCJHlGzhg93IqUH_oCpl_-ZUrIE6SPftlyGYUvr9Amx5nzA-WqGcPquyFZl4L",
        {
            minZoom: 14,
        }
    );
    const googleEarth = L.tileLayer(
        "http://mt0.google.com/vt/lyrs=s&hl=en&x={x}&y={y}&z={z}",
        {
            minZoom: 14,
        }
    );
    const arcGISOnline = L.tileLayer(
        "//server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
        {
            minZoom: 14,
            attribution:
                "&copy; Esri &mdash; Sources: Esri, DigitalGlobe, Earthstar Geographics, CNES/Airbus DS, GeoEye, USDA FSA, USGS, Getmapping, Aerogrid, IGN, IGP, swisstopo, and the GIS User Community",
        }
    );
    return {
        OpenStreetMap: osm,
        Aeril: bingAeril,
        GoogleErth: googleEarth,
        ArcGis: arcGISOnline,
    };
};

const map = L.map("map", {
    zoomControl: false,
    center: [-2.267562387075492, 112.85822389019435],
    zoom: 14,
    layers: [
        baseLayer().ArcGis,
        wilayahAdministrasiPamalian,
        daftarTanah.bringToFront(),
    ],
});

const loadMaps = () => {
    L.control.zoom({ position: "bottomright" }).addTo(map);
    L.control.layers(baseLayer()).addTo(map);
};

const loadTanahWarga = async () => {
    const suratWarga = await getSPT();
    suratWarga.forEach((tanah) => {
        const titikKoordinat = [];
        tanah.coordinates.data.forEach((data) => {
            const latLng = utmToLatLng(data.x, data.y);
            const point = [latLng.x, latLng.y];
            titikKoordinat.push(point);
        });
        const createPolygon = L.polygon(titikKoordinat, {
            color: "#14C38E",
        })
            .addTo(map)
            .bringToFront();
        const popUpData = /*html*/ `
            <h6>${tanah.pemilik.nama} <i class="bi bi-patch-check-fill text-info"></i></h6>
            <small>Telah terdaftar di Desa dan Kecamatan</small>
        `;
        createPolygon.bindPopup(popUpData);
    });
};
function utmToLatLng(x, y) {
    const item = L.utm(x, y, 49, "M");
    const coord = item.latLng();
    return {
        x: coord.lat.toFixed(6),
        y: coord.lng.toFixed(6),
    };
}
function popUp(f, l) {
    const out = [];
    if (f.properties) {
        for (key in f.properties) {
            out.push(key + ": " + f.properties[key]);
        }
        l.bindPopup(out.join("<br />"));
    }
}
function polystyle() {
    return {
        fillColor: "yellow",
        weight: 1,
        opacity: 1,
        color: "white", //Outline color
        fillOpacity: 0.3,
    };
}

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

loadMaps();
//loadTanahWarga();
