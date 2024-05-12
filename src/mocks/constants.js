const url = '../server/fetch_creneaux_data.php';
const params = {
  method: 'GET',
  headers: {
    'Content-Type': 'application/json',
  },
};
let creneaux;

fetch(url, params)
  .then(response => response.json())
  .then(data => {
    console.log(data);
    creneaux = data;
  })
  .catch(error => console.error('Fetch error:', error));

// creneaux = [
//   {
//     matiere: "Calculus",
//     salle: "Salle 104",
//     enseignant: "Said Jabour",
//     type_cours: "TP",
//     heure_debut: "08:00",
//     heure_fin: "09:15",
//     date_cours: "2024-05-06",
//   },
//   {
//     matiere: "Algebra",
//     salle: "Salle 104",
//     enseignant: "Said Jabour",
//     type_cours: "CM",
//     heure_debut: "09:30",
//     heure_fin: "10:45",
//     date_cours: "2024-05-07",
//   },
//   {
//     matiere: "OOP",
//     salle: "Salle 104",
//     enseignant: "Said Jabour",
//     type_cours: "TD",
//     heure_debut: "11:00",
//     heure_fin: "13:00",
//     date_cours: "2024-05-06",
//   },
// ];

// const profile = {
//   nom: "Johnny",
//   prenom: "English",
//   statut: "Etudiant",
// };
