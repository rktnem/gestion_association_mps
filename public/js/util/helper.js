function setColor(data, colors) {
    let bgColors = []
    let indexColor = 0

    for(item of data) {
        bgColors.push(colors[indexColor])

        indexColor++
    }

    return bgColors
}