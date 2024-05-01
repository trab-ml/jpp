CREATE TABLE administratifs (
    id_administratif INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(30) NOT NULL,
    createdAt DATE NOT NULL
);

CREATE TABLE matieres (
    id_matiere INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(20) NOT NULL
);

CREATE TABLE enseignants (
    id_enseignant INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(30) NOT NULL,
    createdAt DATE NOT NULL
);

CREATE TABLE salles (
    id_salle INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(20) NOT NULL
);

CREATE TABLE crenaux (
    id_matiere INTEGER,
    id_enseignant INTEGER,
    id_salle INTEGER,
    createdAt Date NOT NULL,
    heure_debut TIME,
    heure_fin TIME,
    type VARCHAR(2) NOT NULL, -- CM | TD | TP
    FOREIGN KEY (id_matiere) REFERENCES matieres(id_matiere),
    FOREIGN KEY (id_enseignant) REFERENCES enseignants(id_enseignant),
    FOREIGN KEY (id_salle) REFERENCES salles(id_salle)
);

CREATE TABLE departements (
    id_departement INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(6) NOT NULL -- MATH | INFO | SVT | CHIMIE
);

CREATE TABLE promotions (
    id_promotion INTEGER PRIMARY KEY AUTOINCREMENT,
    id_departement INTEGER,
    nom VARCHAR(50) NOT NULL,
    createdAt DATE NOT NULL,
    FOREIGN KEY (id_departement) REFERENCES departements(id_departement)
);

CREATE TABLE etudiants (
    id_etudiant INTEGER PRIMARY KEY AUTOINCREMENT,
    id_promotion INTEGER,
    nom VARCHAR(30) NOT NULL,
    createdAt DATE NOT NULL,
    FOREIGN KEY (id_promotion) REFERENCES promotions(id_promotion)
);
