<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    try {
        // Modification de l'hôte pour pointer vers le serveur distant
        $dsn = 'mysql:host=192.168.27.174;dbname=Clientvoiture;charset=utf8';
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 5
        );
        $pdo = new PDO($dsn, 'karl', 'apache2', $options);
        
        $sql = "INSERT INTO contacts (nom, prenom, adresse, telephone, email) 
                VALUES (:nom, :prenom, :adresse, :telephone, :email)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':adresse' => $adresse,
            ':telephone' => $telephone,
            ':email' => $email
        ]);
        echo "Message envoyé avec succès !";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>




