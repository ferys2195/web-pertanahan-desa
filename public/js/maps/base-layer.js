// const baseLayer = () => {
//     const osm = L.tileLayer(
//         "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
//         {
//             minZoom: 13,
//             attribution:
//                 '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
//         }
//     );
//     const bingAeril = L.tileLayer.bing(
//         "AuhiCJHlGzhg93IqUH_oCpl_-ZUrIE6SPftlyGYUvr9Amx5nzA-WqGcPquyFZl4L",
//         {
//             minZoom: 13,
//         }
//     );
//     const googleEarth = L.tileLayer(
//         "http://mt0.google.com/vt/lyrs=s&hl=en&x={x}&y={y}&z={z}",
//         {
//             minZoom: 13,
//         }
//     );
//     const arcGISOnline = L.tileLayer(
//         "//server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
//         {
//             minZoom: 13,
//             attribution:
//                 "&copy; Esri &mdash; Sources: Esri, DigitalGlobe, Earthstar Geographics, CNES/Airbus DS, GeoEye, USDA FSA, USGS, Getmapping, Aerogrid, IGN, IGP, swisstopo, and the GIS User Community",
//         }
//     );
//     return {
//         OpenStreetMap: osm,
//         Aeril: bingAeril,
//         GoogleErth: googleEarth,
//         ArcGis: arcGISOnline,
//     };
// };

class BaseLayer {
    osm = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        minZoom: 13,
        attribution:
            '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    });
    bingAeril = L.tileLayer.bing(
        "AuhiCJHlGzhg93IqUH_oCpl_-ZUrIE6SPftlyGYUvr9Amx5nzA-WqGcPquyFZl4L",
        {
            minZoom: 13,
        }
    );
    googleEarth = L.tileLayer(
        "http://mt0.google.com/vt/lyrs=s&hl=en&x={x}&y={y}&z={z}",
        {
            minZoom: 13,
        }
    );
    arcGISOnline = L.tileLayer(
        "//server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
        {
            minZoom: 13,
            attribution:
                "&copy; Esri &mdash; Sources: Esri, DigitalGlobe, Earthstar Geographics, CNES/Airbus DS, GeoEye, USDA FSA, USGS, Getmapping, Aerogrid, IGN, IGP, swisstopo, and the GIS User Community",
        }
    );

    constructor() {
        return {
            OpenStreetMap: this.osm,
            Aeril: this.bingAeril,
            GoogleErth: this.googleEarth,
            ArcGis: this.arcGISOnline,
        };
    }
}
