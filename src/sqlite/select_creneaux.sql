.mode box
.print 'Créneaux Admins';
SELECT * FROM creneaux;

.print 'Créneaux pour Johnny English (Enseignant)';
SELECT * FROM creneaux WHERE creneaux.enseignant = 'Johnny English';

.print 'Créneaux pour Jeanne Darc (Etudiant)';
-- SELECT * FROM etudiants
-- JOIN creneaux ON etudiants.promotion = creneaux.promotion
--     AND etudiants.departement = creneaux.departement
-- WHERE etudiants.nom = 'Jeanne Darc';

SELECT creneaux.matiere AS matiere,
    creneaux.enseignant AS enseignant,
    creneaux.salle AS salle,
    creneaux.promotion AS promotion,
    creneaux.departement AS departement,
    creneaux.heure_debut AS heure_debut,
    creneaux.heure_fin AS heure_fin,
    creneaux.date_cours AS date_cours,
    creneaux.type_cours AS type_cours
FROM etudiants
JOIN creneaux ON etudiants.promotion = creneaux.promotion
    AND etudiants.departement = creneaux.departement
WHERE etudiants.nom = 'Jeanne Darc';