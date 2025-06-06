window.associationDensity = (chartId, data) => {
  let label = [];
  let total = [];

  for (item of data) {
    label.push(item.name);
    total.push(item.membre);
  }

  window.canvasElementForDensityAssociation = new Chart(chartId, {
    type: "bar",
    data: {
      labels: label,
      datasets: [
        {
          label: "My First Dataset",
          data: total,
          backgroundColor: setColor(data, color),
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      onResize: (chart, size) => {
        (size.height = 600), chart.update();
      },
      indexAxis: "y",
      scales: {
        x: {
          beginAtZero: true,
        },
      },
    },
  });

  chartId.style.height = "525px";
};
