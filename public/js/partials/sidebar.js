let minimize =  document.getElementById("minimize");
let sidebar = document.getElementById("sidebar");
let state = false;

minimize.addEventListener("click", () => {
    /**
     * Rotate the toogle button to the right direction
     **/ 
    sidebar.classList.toggle("expanded");

    if (!state) {
        minimize.style.transform = "rotateZ(0deg)";

        state = true;
    }
    else {
        minimize.style.transform = "rotateZ(-180deg)";

        state = false;
    }
})