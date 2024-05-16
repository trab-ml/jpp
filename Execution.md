Le projet a été réalisé en utilisant php, js, html et css.

### Structure du projet:

1. Login page:
   - dans cette page tout type d'utilisateur peut se connecter: admin, enseignant et etudiant
2. Main page
   - page pour consulter l'emploi du temps
   - Etudiants:
   - juste consultation de l'emploi du temps
     Admin et Enseignants:
   - suppression, ajout et modification de l'emploi du temps
3. Admin Page:
   - cette page est disponible juste aux admins
   - permet de créer des comptes d'utilisateur

### Execution

Pour pouvoir executer l'application vous devez avoir installé sur votre machine une application serveur comme Xampp pour l'executer.
Vous placez le projet dans le dossier htdocs et vous devez vous assurer que la config `execution=sqlite3` est presente dans le fichier php.ini.
Après avoir demarrer le serveur, vous allez dans le navigateur et vous rentrer ce lien: `http://localhost/jpp/index.html` et vous allez être envoyer sur la page Connexion. Vous avez trois types d'identifiants: etudiant, admin et enseignant. Voici 3 examples de compte:

1. Etudiant - username:'Albert Eteint' password:'ae33!'
2. Admin - username:'Alice Smith' password: 'as23!'
3. Enseignant - username:'Bob Dupont' password: 'bd35!'
