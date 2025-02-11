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
        // Modification de l'hôte pour pointer vers le serveur distant
        $dsn = 'mysql:host=192.168.27.174;dbname=Clientvoiture;charset=utf8';
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 5
        );
        $pdo = new PDO($dsn, 'karl', 'apache2', $options);
        
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


