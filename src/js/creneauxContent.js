const createHtmlCreneaux = () => {
  console.log("we are in creneaux");

  $(".content").html(`
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Matiere</th>
                        <th>Salle</th>
                        <th>Enseignant</th>
                        <th>Type Cours</th>
                        <th>Heure Debut</th>
                        <th>Heure Fin</th>
                        <th>Date Cours</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Rows will go here -->
                </tbody>
            </table>
  `);

  creneaux.map((creneau) => {
    $(".content-table tbody").append(`
            <tr>
                <td>${creneau.id}</td>
                <td>${creneau.matiere}</td>
                <td>${creneau.salle}</td>
                <td>${creneau.enseignant}</td>
                <td>${creneau.type_cours}</td>
                <td>${creneau.heure_debut}</td>
                <td>${creneau.heure_fin}</td>
                <td>${creneau.date_cours}</td>
                <td><button type='button' class='delete-btn'>delete</button></td>
            </tr>
    `);
  });

  $(".delete-btn").click(() => {
    console.log("Delete button was clicked");
    // PHP
    // make request to the database to delete the student
    // !!!!!
  });

  $(".content").append(
    "<button type='button' class='add-btn'>Ajouter un creneau</button>"
  );

  $("body").append(`
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="creneauForm">
            <label for="matiere">Matiere:</label><br>
            <input type="text" id="matiere" name="matiere"><br>
            <label for="salle">Salle:</label><br>
            <input type="text" id="salle" name="salle"><br>
            <label for="enseignant">Enseignant:</label><br>
            <input type="text" id="enseignant" name="enseignant"><br>
            <label for="type_cours">Type Cours:</label><br>
            <input type="text" id="type_cours" name="type_cours"><br>
            <label for="promotion">Promotion:</label><br>
            <input type="text" id="promotion" name="promotion"><br>
            <label for="heure_debut">Heure Debut:</label><br>
            <input type="time" id="heure_debut" name="heure_debut"><br>
            <label for="heure_fin">Heure Fin:</label><br>
            <input type="time" id="heure_fin" name="heure_fin"><br>
            <label for="date_cours">Date Cours:</label><br>
            <input type="date" id="date_cours" name="date_cours"><br>
            <button type="submit" id="submit">Submit</button>
            </form>
        </div>
    </div>
  `);

  var modal = document.getElementById("myModal");
  var span = document.getElementsByClassName("close")[0];
  var btn = document.getElementsByClassName("add-btn")[0];

  btn.onclick = function () {
    modal.style.display = "block";
  };
  span.onclick = function () {
    modal.style.display = "none";
  };

  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };

  var submitBtn = document.getElementById("creneauForm");

  submitBtn.addEventListener("submit", (e) => {
    e.preventDefault();
    console.log("Form was submitted");
    // PHP
    // make request to the database to add the student
    // !!!!!

    const matiere = $("#matiere").val();
    const salle = $("#salle").val();
    const enseignant = $("#enseignant").val();
    const type_cours = $("#type_cours").val();
    const heure_debut = $("#heure_debut").val();
    const heure_fin = $("#heure_fin").val();
    const date_cours = $("#date_cours").val();

    console.log(
      matiere,
      salle,
      enseignant,
      type_cours,
      heure_debut,
      heure_fin,
      date_cours
    );
  });
};
