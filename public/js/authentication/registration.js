$(document).ready(() => {
  let api = "/api/employee";

  $("#registration_form_matricule").on("change", () => {
    fetch(`${api}/${$("#registration_form_matricule").val()}`)
      .then((res) => {
        return res.json();
      })
      .then((res) => {
        $("#registration_form_name").val(res[0].nom);
        $("#registration_form_firstname").val(res[0].prenom);
        $("#registration_form_email").val(res[0].email);
        $("#registration_form_directions").val(res[1].direction).change();
        $("#registration_form_services").val(res[1].service).change();
        $("#registration_form_fonction").val(res[0].fonctionId).change();
      });
  });
});
