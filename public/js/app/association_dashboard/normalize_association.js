function normalizeAssociation(labelId, id, data, name) {
    putTextInChart(labelId, data, name)

    new Chart(id, {
        type: 'doughnut',
        data: {
                datasets: [{
                data: [data, (100 - data)],
                backgroundColor: [
                '#198754',
                'rgb(255, 255, 255)'
                ],
            }]
        },
        options: {
            cutout: '65%',
            responsive: false,
            maintainAspectRatio: false 
        },
        plugin: [name]
    });
}

function setChange(id, labelId, data, name) {
    const chart = document.getElementById(id);

    normalizeAssociation(labelId, chart, data, name)
}