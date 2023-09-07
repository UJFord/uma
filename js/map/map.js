var map = L.map("map").setView([5.9267, 124.9948], 11);

L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
    minZoom: 0,
    attribution: "© OpenStreetMap",
}).addTo(map);


/* Map Zoom Control Positioning */
    function addControlPlaceholders(map) {
        var corners = map._controlCorners,
            l = 'leaflet-',
            container = map._controlContainer;

        function createCorner(vSide, hSide) {
            var className = l + vSide + ' ' + l + hSide;

            corners[vSide + hSide] = L.DomUtil.create('div', className, container);
        }

        createCorner('verticalcenter', 'left');
        createCorner('verticalcenter', 'right');
    }
    addControlPlaceholders(map);

    // Change the position of the Zoom Control to a newly created placeholder.
    map.zoomControl.setPosition('verticalcenterright');


// Tags overflow
$('.toggle').click(function(){
    $('.nav').toggleClass("justify-content-end");
    $('.toggle').toggleClass("text-light");
});