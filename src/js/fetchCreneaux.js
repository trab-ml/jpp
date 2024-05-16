const CRENEAUX_HANDLER_URL = 'http://localhost/dev/jpp/src/server/fetch_creneaux_data.php';
const GET_CRENEAUX_HEADER_PARAMS = {
    method: 'GET',
    headers: {
        'Content-Type': 'application/json',
    },
};
$(document).ready(async () => {
    let creneaux = [];

    try {
        const response = await fetch(CRENEAUX_HANDLER_URL, GET_CRENEAUX_HEADER_PARAMS);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        creneaux = await response.json();
        createHtmlCreneaux(creneaux);
        $("#btn-creneau").click(() => {
            $(".content").empty();
            $("#createStudentModal").remove();
            createHtmlCreneaux(creneaux);
        });
    } catch (error) {
        console.error('Fetch error:', error);
    }
});

const createHtmlCreneaux = (creneaux) => {
    $(".content").html(`<table class="content-table">
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
        <tbody></tbody>
    </table>`);

    creneaux.map((creneau) => {
        $(".content-table tbody").append(`<tr>
            <td>${creneau.id}</td>
            <td>${creneau.matiere}</td>
            <td>${creneau.salle}</td>
            <td>${creneau.enseignant}</td>
            <td>${creneau.type_cours}</td>
            <td>${creneau.heure_debut}</td>
            <td>${creneau.heure_fin}</td>
            <td>${creneau.date_cours}</td>
            <td>
                <button type='button' class='delete-btn'>
                    <a href='http://localhost/dev/jpp/src/server/creneaux.php?to_delete=${creneau.id}' class='delete-link'>delete</a>
                </button>
            </td>
        </tr>`);
    });

    $(".content").append(
        "<button type='button' class='add-btn'>Ajouter un creneau</button>"
    );

    $("body").append(`<div id="createCreneauModal" class="modal">
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
                <input type="text" id="creneauForm__promotion" name="promotion"><br>
                
                <label for="departement">Departement:</label><br>
                <input type="text" id="creneauForm__departement" name="departement"><br>
                
                <label for="heure_debut">Heure Debut:</label><br>
                <input type="time" id="heure_debut" name="heure_debut"><br>
                
                <label for="heure_fin">Heure Fin:</label><br>
                <input type="time" id="heure_fin" name="heure_fin"><br>
                
                <label for="date_cours">Date Cours:</label><br>
                <input type="date" id="date_cours" name="date_cours"><br>
                <button type="submit" id="submit">Submit</button>
            </form>
        </div>
    </div>`);

    const modal = document.getElementById("createCreneauModal");
    const span = document.getElementsByClassName("close")[0];
    const btn = document.getElementsByClassName("add-btn")[0];

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

    document.getElementById("creneauForm").addEventListener("submit", (e) => {
        e.preventDefault();
        const matiere = $("#matiere").val();
        const salle = $("#salle").val();
        const enseignant = $("#enseignant").val();
        const type_cours = $("#type_cours").val();
        const promotion = $("#creneauForm__promotion").val();
        const departement = $("#creneauForm__departement").val();
        const heure_debut = $("#heure_debut").val();
        const heure_fin = $("#heure_fin").val();
        const date_cours = $("#date_cours").val();

        const data = {
            matiere,
            salle,
            enseignant,
            type_cours,
            promotion,
            departement,
            heure_debut,
            heure_fin,
            date_cours
        };

        fetch("http://localhost/dev/jpp/src/server/creneaux.php", {
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
