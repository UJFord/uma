// * FUNCTIONS
// navbar tag button onlclick show markers
let activeMarkers = [];
let showMarkers = (category, coordinates) => {

} 



let map = L.map('map').setView([5.9267, 124.9948], 11); 

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
	maxZoom: 19,
	minZoom: 0,
	attribution: '© OpenStreetMap',
}).addTo(map);

// * Map Zoom Control Positioning
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

// * Change the position of the Zoom Control to a newly created placeholder.
map.zoomControl.setPosition('verticalcenterright');

// * SHOW MARKERS ON TAGS CLICKING

// crops
let cropsBtn = document.querySelector('#crop-btn')
cropsBtn.onclick = function () {
    alert('Button clicked!');
    console.log('Button clicked!');
};

// practices
let praxBtn = document.querySelector('#prax-btn')
praxBtn.onclick = function () {
    alert('Button clicked!');
};

// tribes
let tribeBtn = document.querySelector('#tribe-btn')
tribeBtn.onclick = function () {
	alert('Button clicked!');
};

// farm
let farmBtn = document.querySelector('#farm-btn')
farmBtn.onclick = function () {
	alert('Button clicked!');
};
