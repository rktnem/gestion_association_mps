function totalCommuneAssociation(chartId, data) {
    let totalForEachCommune = []
    let nameCommune = []

    for(commune of data) {
        totalForEachCommune.push(commune.total)
        nameCommune.push(commune.name)
    }

	new Chart(chartId, {
        type: 'bar',
        data: {
            labels: nameCommune,
            datasets: [{
                label: 'Densite des associations',
                barThickness: 25,
                data: totalForEachCommune,
                borderWidth: 1,
                backgroundColor: '#198754',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            onResize: (chart, size) => {
                size.height = 300
                chart.update()
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            },
        }
    });

    chartId.style.height = "200px"
}