$(document).ready(async () => {
  // const url = 'http://localhost/dev/jpp/src/server/fetch_creneaux_data.php';
  const url = "http://localhost/jpp/src/server/fetch_creneaux_data.php";
  const params = {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  };

  try {
    const response = await fetch(url, params);
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    const creneaux = await response.json();
    if (!creneaux) {
      throw new Error("creneaux is not defined");
    }
    creneaux.map((creneau) => {
      const dayOfWeek = new Date(creneau.date_cours).getDay();
      const titleSpace = 50;

      const [startHour, startMinute] = creneau.heure_debut
        .split(":")
        .map(Number);
      const creneauMinutes = startMinute + (startHour - 8) * 60;

      const marginTop = creneauMinutes + titleSpace;

      const [endHour, endMinute] = creneau.heure_fin.split(":").map(Number);
      const height = endMinute + (endHour - 8) * 60 - creneauMinutes;

      $(`#day-${dayOfWeek}`).append(
        `<div class="event" style="margin-top:${marginTop}px; height:${height}px; ">
          <strong>${creneau.matiere} - ${creneau.type_cours}</strong>
          <br>
          ${creneau.salle}
          <br>
          ${creneau.enseignant}
          </div>`
      );
    });
  } catch (error) {
    console.error("Fetch error:", error);
  }
});
