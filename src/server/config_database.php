<?php
$databaseFile = "../sqlite/planning.db";

$db = new SQLite3($databaseFile);

if (!$db) {
    die("Connection échouée: " . $db->lastErrorMsg());
}
