// Fonction pour charger les emplois du temps en fonction de la semaine sélectionnée
function chargerEmploisDuTemps() {
    var semaine = $('#semaine').val();
    var vue = $('#vue').val();

    // Appel AJAX pour récupérer les emplois du temps depuis le serveur
    $.ajax({
        url: 'chargerEmploisDuTemps.php',
        type: 'GET',
        data: { semaine: semaine, vue: vue },
        success: function(data) {
            // Mettre à jour le contenu de la div emplois-du-temps avec les emplois du temps reçus
            $('#emplois-du-temps').html(data);
        },
        error: function(xhr, status, error) {
            console.error('Erreur lors du chargement des emplois du temps : ' + error);
        }
    });
}

// Fonction pour changer la vue (liste ou semainier)
function changerVue() {
    // Recharger les emplois du temps avec la nouvelle vue sélectionnée
    chargerEmploisDuTemps();
}

// Charger les emplois du temps au chargement de la page
$(document).ready(function() {
    chargerEmploisDuTemps();
});
