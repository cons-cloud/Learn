<?php
$conn = new mysqli($servername, $username, $password, $dbname);


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("INSERT INTO inscriptions (nom, email, cours) VALUES (:nom, :email, :cours)");
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':cours', $cours);

    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $cours = $_POST['cours'];

    $stmt->execute();
    echo "Nouvelle inscription créée avec succès";
} catch(PDOException $e) {
    echo "Erreur: " . $e->getMessage();





    if(isset($_POST["ok"])){
        $nom = $_POST["nom"];
        $email = $_POST["email"];
        $cours = $_POST["cours"];



}

$conn = null;







?>