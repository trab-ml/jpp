-- Table pour stocker les départements
CREATE TABLE departements (
    id INTEGER PRIMARY KEY,
    nom TEXT NOT NULL
);

-- Table pour stocker les promotions
CREATE TABLE promotions (
    id INTEGER PRIMARY KEY,
    nom TEXT NOT NULL,
    departement_id INTEGER,
    FOREIGN KEY (departement_id) REFERENCES departements(id)
);

-- Table pour stocker les enseignants
CREATE TABLE enseignants (
    id INTEGER PRIMARY KEY,
    nom TEXT NOT NULL,
    prenom TEXT NOT NULL
);

-- Table pour stocker les matières
CREATE TABLE matieres (
    id INTEGER PRIMARY KEY,
    nom TEXT NOT NULL
);

-- Table pour stocker les salles
CREATE TABLE salles (
    id INTEGER PRIMARY KEY,
    nom TEXT NOT NULL
);

-- Table pour stocker les créneaux des emplois du temps
CREATE TABLE emplois_du_temps (
    id INTEGER PRIMARY KEY,
    date DATE NOT NULL,
    debut TIME NOT NULL,
    fin TIME NOT NULL,
    type_c TEXT NOT NULL,
    matiere_id INTEGER,
    enseignant_id INTEGER,
    salle_id INTEGER,
    promotion_id INTEGER,
    FOREIGN KEY (matiere_id) REFERENCES matieres(id),
    FOREIGN KEY (enseignant_id) REFERENCES enseignants(id),
    FOREIGN KEY (salle_id) REFERENCES salles(id),
    FOREIGN KEY (promotion_id) REFERENCES promotions(id)
);
