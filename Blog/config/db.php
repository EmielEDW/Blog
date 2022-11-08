<?php

// MySQLI (MySQL Improved) is een extentie waardoor je met de database kan interacten 
// (Voordelen van MySQLI --> Het is makkelijker en als je een PHP programmeur wil zijn weet je het best.)
// We werken locaal in via phpMyAdmin.

// Maken van de connectie --> parameters zijn: (host, login-username, login-password, db_name)
// (!!!) Ik kon deze voor een of andere reden niet in de config zetten, dan komt er een error. (!!!)
$conn = mysqli_connect('localhost', 'root', '', 'db_blog');

// Check de connectie
if (mysqli_connect_errno()) {
    // Connectie failed (toon een error over wat er precies verkeerd is gegaan)
    echo 'Failed to connect to MySQL ' . mysqli_connect_errno();
}
