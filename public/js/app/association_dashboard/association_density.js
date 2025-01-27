function associationDensity(chartId, data) {
    let label = []
    let total = []

    for(item of data) {
        label.push(item.name)
        total.push(item.membre)
    }

    new Chart(chartId, {
        type: 'bar',
        data: {
            labels: label,
            datasets: [{
                label: 'My First Dataset',
                data: total,
                backgroundColor: setColor(data, color)
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            onResize: (chart, size) => {
                size.height = 300,
                chart.update()
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    })

    chartId.style.height = "250px"
}