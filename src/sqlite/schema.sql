PRAGMA foreign_key = on;

CREATE TABLE administratifs (
    id_administratif INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(30) NOT NULL,
    mot_de_passe VARCHAR(20) NOT NULL,
    date_inscription DATE NOT NULL,
    UNIQUE (nom)
);

CREATE TABLE matieres (
    nom VARCHAR(20) PRIMARY KEY
);
INSERT INTO matieres(nom) VALUES ('Prog Web'), ('POO'), ('COO'), ('Anglais'), ('Chimie'), ('Géologie');

CREATE TABLE enseignants (
    id_enseignant INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(30) NOT NULL,
    mot_de_passe VARCHAR(20) NOT NULL,
    date_inscription DATE NOT NULL,
    UNIQUE (nom)
);

CREATE TABLE salles (
    nom VARCHAR(20) PRIMARY KEY
);
INSERT INTO salles(nom) VALUES ('S16'), ('P1OO'), ('S23'), ('G007'), ('G309'), ('E7');

CREATE TABLE departements (
    nom VARCHAR(6) PRIMARY KEY
);
INSERT INTO departements (nom) VALUES ('MATH'), ('INFO'), ('SVT'), ('CHIMIE');

CREATE TABLE promotions (
    nom VARCHAR(50) PRIMARY KEY
);
INSERT INTO promotions (nom) VALUES ('Promo L3 MATH 2024'), ('Promo L3 INFO 2024'), ('Promo L3 SVT 2024'), ('Promo L3 CHIMIE 2024');

CREATE TABLE etudiants (
    id_etudiant INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(30) NOT NULL,
    promotion VARCHAR,
    departement VARCHAR,
    mot_de_passe VARCHAR(20) NOT NULL,
    date_inscription DATE NOT NULL,
    FOREIGN KEY (promotion) REFERENCES promotions(nom),
    FOREIGN KEY (departement) REFERENCES departements(nom),
    UNIQUE (nom)
);

CREATE TABLE creneaux (
    id_creneau INTEGER PRIMARY KEY AUTOINCREMENT,
    matiere VARCHAR,
    enseignant VARCHAR,
    salle VARCHAR,
    promotion VARCHAR,
    departement VARCHAR,
    heure_debut TIME NOT NULL,
    heure_fin TIME NOT NULL,
    date_cours DATE NOT NULL,
    type_cours VARCHAR(2) CHECK(type_cours IN ('CM', 'TD', 'TP')),
    FOREIGN KEY (matiere) REFERENCES matieres(matiere),
    FOREIGN KEY (enseignant) REFERENCES enseignants(nom),
    FOREIGN KEY (salle) REFERENCES salles(nom),
    FOREIGN KEY (promotion) REFERENCES promotions(nom),
    FOREIGN KEY (departement) REFERENCES departements(nom)
);