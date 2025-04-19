const map = L.map('map').setView([-6.2088, 106.8456], 13); // Jakarta

map.zoomControl.remove();
L.control.zoom({ position: 'topright' }).addTo(map);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

// ====================
// REVERSE GEOCODE
// ====================
async function reverseGeocode(lat, lon) {
    const url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`;
    const response = await fetch(url);
    const data = await response.json();
    return data.display_name || "Lokasi tidak ditemukan";
}

// Klik di peta → update Lokasi Asal
map.on('click', async function(e) {
    const { lat, lng } = e.latlng;

    if (window.asalMarker) map.removeLayer(window.asalMarker);
    window.asalMarker = L.marker([lat, lng]).addTo(map);

    const address = await reverseGeocode(lat, lng);
    document.getElementById('fromLocation').value = address;
});

// ====================
// AUTOCOMPLETE
// ====================
function setupAutocomplete(inputId, suggestionsId, markerType) {
    const input = document.getElementById(inputId);
    const suggestions = document.getElementById(suggestionsId);
    let timeout;

    input.addEventListener('input', function () {
        clearTimeout(timeout);
        const query = this.value.trim();

        if (query.length < 3) {
            suggestions.style.display = 'none';
            return;
        }

        timeout = setTimeout(() => {
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    suggestions.innerHTML = '';
                    if (data.length === 0) {
                        suggestions.style.display = 'none';
                        return;
                    }

                    data.forEach(location => {
                        const li = document.createElement('li');
                        li.textContent = location.display_name;
                        li.classList.add('list-group-item', 'list-group-item-action');
                        li.style.cursor = 'pointer';
                        li.addEventListener('click', function () {
                            input.value = location.display_name;
                            suggestions.style.display = 'none';

                            const lat = location.lat;
                            const lon = location.lon;

                            if (markerType === 'asal') {
                                if (window.asalMarker) map.removeLayer(window.asalMarker);
                                window.asalMarker = L.marker([lat, lon]).addTo(map);
                            } else if (markerType === 'tujuan') {
                                if (window.tujuanMarker) map.removeLayer(window.tujuanMarker);
                                window.tujuanMarker = L.marker([lat, lon]).addTo(map);
                            }

                            map.setView([lat, lon], 15);
                        });

                        suggestions.appendChild(li);
                    });

                    suggestions.style.display = 'block';
                });
        }, 300);
    });

    document.addEventListener('click', function (e) {
        if (!suggestions.contains(e.target) && e.target !== input) {
            suggestions.style.display = 'none';
        }
    });
}

setupAutocomplete('fromLocation', 'fromSuggestions', 'asal');
setupAutocomplete('toLocation', 'toSuggestions', 'tujuan');

