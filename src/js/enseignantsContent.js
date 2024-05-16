const createHtmlEnseignant = () => {
  console.log("It was clicked");

  $(".content").html(`
              <table class="content-table">
                  <thead>
                      <tr>
                          <th>Id</th>
                          <th>Nom</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      <!-- Rows will go here -->
                  </tbody>
              </table>
          `);

  // PHP
  // make request to the database to retrieve the data
  enseignants.map((enseignant) => {
    $(".content-table tbody").append(`
              <tr>
                  <td>${enseignant.id}</td>
                  <td>${enseignant.nom}</td>
                  <td><button type='button' class='delete-btn'>delete</button></td>
              </tr>
          `);
  });

  $(".delete-btn").click(() => {
    console.log("Delete button was clicked");
    // PHP
    // make request to the database to delete the enseignant
    // !!!!!
  });

  $(".content").append(
    "<button type='button' class='add-btn'>Ajouter un enseignant</button>"
  );

  $("body").append(`
    <div id="myModal" class="modal">
      <div class="modal-content">

        <span class="close">&times;</span>
        <form id="enseignantForm">

          <label for="id">ID:</label><br>
          <input type="text" id="id" name="id"><br>

          <label for="name">Name:</label><br>
          <input type="text" id="name" name="name"><br>

          <label for="password">Password:</label><br>
          <input type="password" id="password" name="password"><br>

          <label for="date-inscription">Date Inscription:</label><br>
          <input type="date" id="date-inscription" name="date-inscription"><br>

          <input type="submit" value="Submit">
        </form>
      </div>
    </div>
  `);

  var modal = document.getElementById("myModal");
  var btn = document.getElementsByClassName("add-btn")[0];
  var span = document.getElementsByClassName("close")[0];

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

  var submitBtn = document.getElementById("enseignantForm");

  submitBtn.addEventListener("submit", function (e) {
    e.preventDefault();

    // PHP
    // these values should be send to the database
    // !!!!!
    var id = $("#id").val();
    var name = $("#name").val();

    var password = $("#password").val();
    var date_inscription = $("#date-inscription").val();

    console.log(id, name, password, date_inscription);

    // Clear the input fields
    $("#id").val("");
    $("#name").val("");
    $("#password").val("");
    $("#date-inscription").val("");

    modal.style.display = "none";
  });
};
