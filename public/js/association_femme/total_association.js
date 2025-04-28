// Generic function to get and put total association
// either in region or in district
function putTotalAssociation(loader, url, htmlElement, call) {
  loader.style.display = "flex";

  fetch(url)
    .then((res) => {
      return res.json();
    })
    .then((res) => {
      if (res[0].total === 0) {
        htmlElement.innerHTML = "0 association";
        loader.style.display = "none";
      } else {
        htmlElement.innerHTML = `${res[0].total} associations`;
        loader.style.display = "none";
      }
      // Si l'appelle est une apelle API
      if (call) {
        // Detruire toutes les entités de canvas pour
        // normalisation
        window.canvasElement[0].destroy();
        window.canvasElement[1].destroy();
        window.canvasElement[2].destroy();

        // Reconstruction des canvas
        window.normalizeAssociation(
          "textOfNif",
          chartWithNif,
          res[1].percentageWithNifStat,
          1
        );
        window.normalizeAssociation(
          "textOfPresident",
          chartWithPresident,
          res[1].percentageWithPresident,
          2
        );
        window.normalizeAssociation(
          "textOfRecepisse",
          chartWithReceipt,
          res[1].percentageWithNumeroRecepisse,
          3
        );

        // Detruire l'ancien canvas densityAssociation
        window.canvasElementForDensityAssociation.destroy();
        // Reconstruire le canvas
        window.associationDensity(chartForHistogramOfAssociation, res[2]);
      }
    });
}

function totalAssociation() {
  const regionSelect = document.getElementById("region");
  const regionName = document.getElementById("regionName");
  const districtSelect = document.getElementById("district");
  const districtName = document.getElementById("districtName");
  const numberOfAssociation = document.getElementById("numberOfAssociation");
  let loadingOfTotalAssociation = document.querySelectorAll(".loading")[0];

  // When item on region select tag was selected
  regionSelect.onchange = (event) => {
    let regionId = event.target.value;
    let urlToSelectDistrict = `/api/district/${regionId}`;
    window.urlToHaveTotalInRegion = `/api/total/region/${regionId}`;
    let districtOption = "<option value='none'>District</option>";

    if (regionId === "none") {
      // Trunk the "district" select tag
      districtSelect.replaceChildren();

      districtSelect.innerHTML = districtOption;

      // Ajouter le nom de region dans la partie associationDensity
      regionName2.innerHTML = "event.target.selectedOptions[0].textContent";

      putTotalAssociation(
        loadingOfTotalAssociation,
        `/api/total`,
        numberOfAssociation,
        true
      );

      regionName.innerHTML = "Region";
      districtName.innerHTML = "District";
    } else {
      // Add the region name to the regionName attribute
      regionName.innerHTML = event.target.selectedOptions[0].textContent;
      // Initialize district name while region name change
      districtName.innerHTML = "District";
      // Ajouter le nom de region dans la partie associationDensity
      regionName2.innerHTML = event.target.selectedOptions[0].textContent;

      // Get the total of association in one region
      putTotalAssociation(
        loadingOfTotalAssociation,
        urlToHaveTotalInRegion,
        numberOfAssociation,
        true
      );

      // Set the relatives districts to selected region
      fetch(urlToSelectDistrict)
        .then((res) => {
          return res.json();
        })
        .then((res) => {
          // Trunk the "district" select tag
          districtSelect.replaceChildren();

          for (response of res) {
            districtOption += `<option value=${response.id}>${response.nom}</option>`;
          }

          districtSelect.innerHTML = districtOption;
        });
    }
  };

  // When item on district select tag was selected
  districtSelect.onchange = async (event) => {
    let districtId = event.target.value;
    let urlToHaveTotalInDistrict = `/api/total/district/${districtId}`;

    if (districtId === "none") {
      // initialiser le nom de district
      districtName.innerHTML = "District";
      // Get the total of association in one region
      putTotalAssociation(
        loadingOfTotalAssociation,
        window.urlToHaveTotalInRegion,
        numberOfAssociation,
        false
      );
      return 0;
    } else {
      // Add the district name to the districtName attribute
      districtName.innerHTML = event.target.selectedOptions[0].textContent;

      // Get the total of association in one district
      putTotalAssociation(
        loadingOfTotalAssociation,
        urlToHaveTotalInDistrict,
        numberOfAssociation,
        false
      );
    }
  };
}
