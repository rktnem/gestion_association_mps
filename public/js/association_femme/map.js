function showMap(markersData) {
    // Initialisation de la carte
    const map = L.map('map').setView([-18, 47], 6);

    // Ajout d'une couche de tuiles (OSM ici)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Ajout des marqueurs
    markersData.forEach(data => {
        const marker = L.marker([data.lat, data.lng]).addTo(map);

        marker.addEventListener('click', () => {
            console.log(data.id)
        })
    });
}