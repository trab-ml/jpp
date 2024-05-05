CREATE TABLE administratifs (
    id_administratif INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(30) NOT NULL,
    mot_de_passe VARCHAR(20) NOT NULL,
    date_creation DATE NOT NULL
);

CREATE TABLE matieres (
    id_matiere INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(20) NOT NULL
);

CREATE TABLE enseignants (
    id_enseignant INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(30) NOT NULL,
    mot_de_passe VARCHAR(20) NOT NULL,
    date_creation DATE NOT NULL
);

CREATE TABLE salles (
    id_salle INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(20) NOT NULL
);

CREATE TABLE crenaux (
    id_matiere INTEGER,
    id_enseignant INTEGER,
    id_salle INTEGER,
    heure_debut TIME,
    heure_fin TIME,
    type VARCHAR(2) NOT NULL, -- CM | TD | TP
    date_creation Date NOT NULL,
    FOREIGN KEY (id_matiere) REFERENCES matieres(id_matiere),
    FOREIGN KEY (id_enseignant) REFERENCES enseignants(id_enseignant),
    FOREIGN KEY (id_salle) REFERENCES salles(id_salle)
);

CREATE TABLE EnumTable (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    value VARCHAR(30) NOT NULL
);

INSERT INTO EnumTable (value) VALUES ('MATH'), ('INFO'), ('SVT'), ('CHIMIE');

CREATE TABLE departements (
    id_departement INTEGER PRIMARY KEY AUTOINCREMENT,
    nom INTEGER NOT NULL,
    FOREIGN KEY (nom) REFERENCES EnumTable(id)
);

CREATE TABLE promotions (
    id_promotion INTEGER PRIMARY KEY AUTOINCREMENT,
    id_departement INTEGER,
    nom VARCHAR(50) NOT NULL,
    date_creation DATE NOT NULL,
    FOREIGN KEY (id_departement) REFERENCES departements(id_departement)
);

CREATE TABLE etudiants (
    id_etudiant INTEGER PRIMARY KEY AUTOINCREMENT,
    id_promotion INTEGER,
    nom VARCHAR(30) NOT NULL,
    mot_de_passe VARCHAR(20) NOT NULL,
    date_creation DATE NOT NULL,
    FOREIGN KEY (id_promotion) REFERENCES promotions(id_promotion)
);
