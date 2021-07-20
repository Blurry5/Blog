<?php
$mysqli = new mysqli("localhost", "root", "Nfdeammd1!", "blog");
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

?>