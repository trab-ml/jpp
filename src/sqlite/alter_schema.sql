CREATE UNIQUE INDEX unique_enseignant_salle_heure_debut_heure_fin_date_cours 
ON creneaux (enseignant, salle, heure_debut, heure_fin, date_cours);