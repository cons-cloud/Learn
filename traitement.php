<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Username = $_POST['username'];
    $Password = $_POST['password'];
   
    $host = "127.0.0.1:50167";
    $dbUsername = "root";
    $dbPassword = "root";
    $dbname = "LEARN";

    // Connexion à la base de données
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Préparer et exécuter la requête SQL
    $query = "SELECT * FROM enrollment WHERE enrollment='$enrollment' AND user='$user' AND course='$course' AND date_inscription='$date_inscription' AND statut='$statut'";
    $result = $conn->query($query);

    // Vérifier les résultats
    if ($result->num_rows == 1) {
        echo "Record found!";
        exit();
    } else {
        echo "No record found!";
        exit();
    }

    $sql = "INSERT INTO registrations (name, email, course) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $course);
    
    if ($stmt->execute()) {
        echo "Inscription réussie !";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }


    // Récupérer les données du formulaire
$title = $_POST['title'];
$description = $_POST['description'];

// Gestion de l'upload de l'image
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Vérifiez si le fichier est une image réelle
$check = getimagesize($_FILES["image"]["tmp_name"]);
if($check === false) {
    die("Le fichier n'est pas une image.");
}

// Autoriser certains formats de fichiers
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    die("Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.");
}

// Vérifiez si le fichier existe déjà
if (file_exists($target_file)) {
    die("Désolé, le fichier existe déjà.");
}

// Tenter de déplacer le fichier téléchargé dans le dossier cible
if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    die("Désolé, une erreur est survenue lors du téléchargement de votre fichier.");
}

// Préparer et exécuter la requête d'insertion
$sql = "INSERT INTO courses (title, description, image) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $title, $description, $target_file);

if ($stmt->execute()) {
    echo "Cours ajouté avec succès !";
} else {
    echo "Erreur : " . $sql . "<br>" . $conn->error;
}

    // Fermer la connexion
    $stmt->close();
    $conn->close();
}

?>
