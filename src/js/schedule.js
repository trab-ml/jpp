$(document).ready(async () => {
  const url = 'http://localhost/dev/jpp/src/server/fetch_creneaux_data.php';
  const params = {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
    },
  };

  try {
    const response = await fetch(url, params);
    console.log(response);
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    const creneaux = await response.json();
    if (!creneaux) {
      throw new Error('creneaux is not defined');
    }
    console.log(`Les créneaux: ${creneaux}`);

    const { startOfWeek, endOfWeek } = getWeekDetails();
    console.log(`Start of week: ${startOfWeek}`);
    console.log(`End of week: ${endOfWeek}`);

    creneaux.map((creneau) => {
      const dayOfWeek = new Date(creneau.date_cours).getDay();
      console.log(`Day of the week: ${dayOfWeek}`);

      const titleSpace = 50;

      const [startHour, startMinute] = creneau.heure_debut.split(":").map(Number);
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
    console.error('Fetch error:', error);
  }
});

function formatDate(date) {
  const year = date.getFullYear();
  const month = (date.getMonth() + 1).toString().padStart(2, '0');
  const day = date.getDate().toString().padStart(2, '0');

  return `${year}-${month}-${day}`;
}

function getWeekDetails() {
  const now = new Date();
  const dayOfWeek = now.getDay();
  const numDay = now.getDate();

  const startOfWeek = new Date(now);
  startOfWeek.setDate(numDay - dayOfWeek + (dayOfWeek === 0 ? -6 : 1));

  const endOfWeek = new Date(now);
  endOfWeek.setDate(numDay + (5 - dayOfWeek + (dayOfWeek === 0 ? 6 : 0)));

  return {
    startOfWeek: formatDate(startOfWeek),
    endOfWeek: formatDate(endOfWeek),
  };
}
