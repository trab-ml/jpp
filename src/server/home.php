<?php
session_start();
require_once './check_auth.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Emploi du temps</title>
    <link rel="stylesheet" href="../style/scheulePageStyle.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/schedule.js"></script>
</head>

<body>
    <h1>Emploi du temps</h1>

    <div class="calendar">
        <div class="profile">
            <h2>Profile</h2>
            <div class="profile-info">
                <p> <?php echo $_SESSION['nom']; ?> </p>
                <p> <?php echo $_SESSION['statut']; ?> </p>
                <?php echo $_SESSION['statut'] == "admin" ? "<a href='./dashboard.php'>dashboard</a>" : "" ?>
            </div>
        </div>
        <div class="timeline">
            <div class="time-marker">8</div>
            <div class="time-marker">9</div>
            <div class="time-marker">10</div>
            <div class="time-marker">11</div>
            <div class="time-marker">12</div>
            <div class="time-marker">13</div>
            <div class="time-marker">14</div>
            <div class="time-marker">15</div>
            <div class="time-marker">16</div>
            <div class="time-marker">17</div>
            <div class="time-marker">18</div>
        </div>
        <div class="days">
            <div class="day" id="day-1">
                <div class="week-day">Lundi</div>
            </div>
            <div class="day" id="day-2">
                <div class="week-day">Mardi</div>
            </div>
            <div class="day" id="day-3">
                <div class="week-day">Mercredi</div>
            </div>
            <div class="day" id="day-4">
                <div class="week-day">Jeudi</div>
            </div>
            <div class="day" id="day-5">
                <div class="week-day">Vendredi</div>
            </div>
        </div>
    </div>
</body>
</html>