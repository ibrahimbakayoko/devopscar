<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $sujet = $_POST['sujet'];
    $message = $_POST['message'];

    try {
        $dsn = 'mysql:host=127.0.0.1;dbname=Clientvoiture;charset=utf8';
        $pdo = new PDO($dsn, 'karl', 'apache2');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO contacts (nom, prenom, adresse, telephone, email, sujet, message) 
                VALUES (:nom, :prenom, :adresse, :telephone, :email, :sujet, :message)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':adresse' => $adresse,
            ':telephone' => $telephone,
            ':email' => $email,
            ':sujet' => $sujet,
            ':message' => $message
        ]);
        echo "Message envoyé avec succès !";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>


