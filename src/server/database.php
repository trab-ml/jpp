<?php
error_reporting(E_ALL);
$databaseFile = "../sqlite/planning.db";

$db = new SQLite3($databaseFile);

if (!$db) {
    die("Connection failed: " . $db->lastErrorMsg());
}