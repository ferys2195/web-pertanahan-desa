const wilayahAdministrasiPamalian = new L.GeoJSON.AJAX(
    [`${baseUrl}/assets/geojson/pamalian.geojson`],
    { onEachFeature: popUp }
);
const hgu = new L.GeoJSON.AJAX(
    [`${baseUrl}/assets/geojson/hgu.geojson`],
    { style: polystyle },
    { onEachFeature: popUp }
);
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
const objekUmumDesa = new L.GeoJSON.AJAX(
    [`${baseUrl}/assets/geojson/objek-umum.geojson`],
    {
        pointToLayer: function (feature, latlng) {
            const myIcon = L.icon({
                iconUrl: `${baseUrl}/vendor/leaflet/images/location.png`,
                iconAnchor: [5, 32], // point of the icon which will correspond to marker's location
                popupAnchor: [0, -32],
            });
            return L.marker(latlng, { icon: myIcon }).bindTooltip(
                feature.properties.name,
                { closeButton: false, offset: L.point(0, -20) }
            );
        },
    }
);
