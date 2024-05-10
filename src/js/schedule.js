$(document).ready(() => {
  // the first week that we are going to get is the current week
  ({ startOfWeek, endOfWeek } = getWeekDetails());
  console.log("Start of week: " + startOfWeek);
  console.log("End of week: " + endOfWeek);

  // make sql query to retrieve all creneaux between startofweek and endofweek

  // i created this mock result to facilitate the demonstration

  $(".profile").append(
    `<div class="profile-info">
          <p>${profile.nom} ${profile.prenom}</p>
          <p>${profile.statut}</p>
      </div>`
  );

  creneaux.map((creneau) => {
    let dayOfWeek = new Date(creneau.date).getDay();

    console.log("Day of the week" + dayOfWeek);

    let titleSpace = 50;

    let creneauMinutes =
      parseInt(creneau.debut.split(":")[1]) +
      (parseInt(creneau.debut.split(":")[0]) - 8) * 60;

    let marginTop = creneauMinutes + titleSpace;

    let height =
      parseInt(creneau.fin.split(":")[1]) +
      (parseInt(creneau.fin.split(":")[0]) - 8) * 60 -
      creneauMinutes;

    $(`#day-${dayOfWeek}`).append(
      `<div class="event" style="margin-top:${marginTop}px; height:${height}px; ">
        <strong>${creneau.nom_matiere} - ${creneau.type_cours}</strong>
        <br>
        ${creneau.salle}
        <br>
        ${creneau.enseignant}
        </div>`
    );
  });
});

function formatDate(date) {
  var year = date.getFullYear();
  var month = date.getMonth() + 1; // getMonth() returns 0-11, so we need to add 1
  var day = date.getDate();

  // Pad month and day with leading zeros if necessary
  if (month < 10) month = "0" + month;
  if (day < 10) day = "0" + day;

  return year + "-" + month + "-" + day;
}

function getWeekDetails() {
  var now = new Date();
  var dayOfWeek = now.getDay(); // 0-6 where 0 is Sunday
  var numDay = now.getDate();

  var startOfWeek = new Date(now); // Start of week as Monday
  startOfWeek.setDate(numDay - dayOfWeek + (dayOfWeek === 0 ? -6 : 1)); // Adjust to previous Monday

  var endOfWeek = new Date(now); // End of week as Friday
  endOfWeek.setDate(numDay + (5 - dayOfWeek + (dayOfWeek === 0 ? 6 : 0))); // Adjust to next Friday

  return {
    startOfWeek: formatDate(startOfWeek),
    endOfWeek: formatDate(endOfWeek),
  };
}
