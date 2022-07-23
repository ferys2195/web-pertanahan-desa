const baseUrl = location.origin;
function utmToLatLng(x, y) {
    const item = L.utm(x, y, 49, "M");
    const coord = item.latLng();
    return {
        x: coord.lat.toFixed(6),
        y: coord.lng.toFixed(6),
    };
}
function getDistance(origin, destination) {
    // return distance in meters
    const lon1 = toRadian(origin[1]),
        lat1 = toRadian(origin[0]),
        lon2 = toRadian(destination[1]),
        lat2 = toRadian(destination[0]);

    const deltaLat = lat2 - lat1;
    const deltaLon = lon2 - lon1;

    const a =
        Math.pow(Math.sin(deltaLat / 2), 2) +
        Math.cos(lat1) * Math.cos(lat2) * Math.pow(Math.sin(deltaLon / 2), 2);
    const c = 2 * Math.asin(Math.sqrt(a));
    const EARTH_RADIUS = 6371;
    return c * EARTH_RADIUS * 1000;
}

function toRadian(degree) {
    return (degree * Math.PI) / 180;
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
