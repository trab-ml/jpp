let mainPage = "etudiants";

$(document).ready(() => {
  console.log("all good");
  createHtmlEtudiant();

  $("#btn-etudiant").click(() => {
    if (mainPage !== "etudiants") {
      $(".content").empty();
      $("#myModal").remove();
      mainPage = "etudiants";
      createHtmlEtudiant();
    }
  });

  $("#btn-creneau").click(() => {
    if (mainPage !== "creneaux") {
      $(".content").empty();
      $("#myModal").remove();
      mainPage = "creneaux";
      createHtmlCreneaux();
    }
  });
});
