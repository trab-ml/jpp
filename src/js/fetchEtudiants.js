const STUDENTS_HANDLER_URL = 'http://localhost/dev/jpp/src/server/etudiants.php';
const GET_STUDENT_HEADER_PARAMS = {
    method: 'GET',
    headers: {
        'Content-Type': 'application/json',
    },
};

$(document).ready(async () => {
    let etudiants = [];

    try {
        const response = await fetch(STUDENTS_HANDLER_URL, GET_STUDENT_HEADER_PARAMS);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        etudiants = await response.json();
        createHtmlEtudiant(etudiants);

        $("#btn-etudiant").click(() => {
            $(".content").empty();
            $("#createCreneauModal").remove();
            createHtmlEtudiant(etudiants);
        });
    } catch (error) {
        console.error('Fetch error:', error);
    }
});

const createHtmlEtudiant = (etudiants) => {
    $(".content").html(`<table class="content-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Departement</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>`);

    etudiants.map((etudiant) => {
        $(".content-table tbody").append(`<tr>
            <td>${etudiant.id}</td>
            <td>${etudiant.nom}</td>
            <td>${etudiant.departement}</td>
            <td>
                <button type='button' class='delete-btn'>
                    <a href='http://localhost/dev/jpp/src/server/etudiants.php?to_delete=${etudiant.id}' class='delete-link'>delete</a>
                </button>
            </td>
        </tr>`);
    });

    $(".content").append(
        "<button type='button' class='add-btn'>Ajouter un etudiant</button>"
    );

    $("body").append(`<div id="createStudentModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="studentForm">
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" autocomplete="off"><br>

                <label for="promotion">Promotion:</label><br>
                <input type="text" id="studentForm__promotion" name="promotion"><br>

                <label for="departement">Departement:</label><br>
                <input type="text" id="departement" name="departement"><br>

                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" autocomplete="off"><br>

                <label for="date-inscription">Date Inscription:</label><br>
                <input type="date" id="date-inscription" name="date-inscription"><br>
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>`);

    const modal = document.getElementById("createStudentModal");
    const btn = document.getElementsByClassName("add-btn")[0];
    const span = document.getElementsByClassName("close")[0];

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

    document.getElementById("studentForm").addEventListener("submit", function (e) {
        e.preventDefault();
        const nom = $("#name").val();
        const promotion = $("#promotion").val();
        const departement = $("#departement").val();
        const mot_de_passe = $("#password").val();
        const date_inscription = $("#date-inscription").val();

        const data = {
            nom,
            promotion,
            departement,
            mot_de_passe,
            date_inscription,
        };

        fetch(STUDENTS_HANDLER_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => console.log(data))
            .catch((error) => {
                console.error('Error:', error);
            });

        modal.style.display = "none";
        window.location.reload();
    });
};
