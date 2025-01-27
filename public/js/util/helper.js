function setColor(data, colors) {
    let bgColors = []
    let indexColor = 0

    for(item of data) {
        bgColors.push(colors[indexColor])

        indexColor++
    }

    return bgColors
}

// Function to put text in center of a chart
function putTextInChart(id, number, name) {
    Chart.register({
        id: name,
        beforeDraw(chart) {
            if (chart.canvas.id != id) return;

            const { width } = chart;
            const { height } = chart;
            const ctx = chart.ctx;
            const text = `${number}%`; // Texte à afficher.
            const fontSize = (height / 125).toFixed(2); // Taille du texte ajustée à la hauteur.
            ctx.save();
            ctx.font = `${fontSize}em sans-serif`;
            ctx.textBaseline = 'middle';
            ctx.textAlign = 'center';
            ctx.fillStyle = '#000'; // Couleur du texte.
            ctx.fillText(text, width / 2, (height / 1.85)); // Centrer le texte.
            ctx.restore();
        }
    });
}