function showUserAction(state) {
  if (state) {
    $("#userAction").css("display", "block");
    $("#userCount #caret").css("transform", "rotate(180deg)");
  } else {
    $("#userAction").css("display", "none");
    $("#userCount #caret").css("transform", "rotate(90deg)");
  }
}

$(document).ready(() => {
  let state = false;

  $("#userCount").on("click", () => {
    state = !state;
    showUserAction(state);
  });
});
