window.canvasElement = ["", "", ""];

window.normalizeAssociation = (textId, chartId, data, order) => {
  document.getElementById(textId).innerHTML = `${data}%`;

  window.canvasElement[order - 1] = new Chart(chartId, {
    type: "doughnut",
    data: {
      datasets: [
        {
          data: [data, 100 - data],
          backgroundColor: ["#198754", "rgb(255, 255, 255)"],
        },
      ],
    },
    options: {
      cutout: "65%",
      responsive: false,
      maintainAspectRatio: false,
    },
  });
};
