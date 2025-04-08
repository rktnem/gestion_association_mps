function setColor(data, colors) {
  let bgColors = [];
  let indexColor = 0;

  for (item of data) {
    bgColors.push(colors[indexColor]);

    indexColor++;
  }

  return bgColors;
}

function selectDistrict(selectCommune, id) {
  let communeOption = "";
  let url = "/api/commune";

  selectCommune.empty();

  fetch(`${url}/${id}`)
    .then((res) => {
      return res.json();
    })
    .then((res) => {
      for (let i = 0; i < res.length; i++) {
        communeOption += `<option value=${res[i].id}>${res[i].nom}</option>`;
      }

      selectCommune.html(communeOption);
    });
}
