function densiteBesoin(needs) {
    const chartOfNeeds = document.getElementById("chartOfNeeds")
    const regionInNeed = document.getElementById("regionInNeed")
    let neededChart
    let config = {}
    let loaderOfNeeded = document.querySelectorAll(".loading")[1]

    // Charge data on loading
    config = showNeeded(needs, neededChart)

    neededChart = new Chart(chartOfNeeds, config)

    // Charge data when a region was selected
    regionInNeed.onchange = (event) => {
        let regionId = event.target.value

        loaderOfNeeded.style.display = "flex"

        fetch(`/api/besoin/${regionId}`)
        .then(res => {
            return res.json()
        })
        .then(needs => {
            config = showNeeded(needs, neededChart)

            neededChart = new Chart(chartOfNeeds, config)

            loaderOfNeeded.style.display = "none"
        })
    }
}

function showNeeded(needs, neededChart) {
    let name = []
    let total = []

    if(neededChart) {
        neededChart.destroy()
    }

    for(need of needs) {
        name.push(need.besoin)
        total.push(need.total)
    }

    const data = {
        labels: name,
        datasets: [{
            label: 'Besoin',
            data: total,
            backgroundColor: setColor(needs, color),
        }]
    };

    const config = {
        type: 'polarArea',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            onResize: (chart, size) => {
                size.height = 300
                chart.update()
            }
        }
    }

    return config
}

function test() {
    console.log("Test");
}