<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation et nettoyage des données d'entrée
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Vérifier si les champs sont vides
    if (empty($nom) || empty($prenom) || empty($adresse) || empty($telephone) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Veuillez remplir tous les champs correctement.";
        exit;
    }

    try {
        // Modification de l'hôte pour pointer vers le serveur MariaDB
        // Assurez-vous que l'IP est correcte dans votre réseau Docker personnalisé
        $dsn = 'mysql:host=192.168.27.189;dbname=Clientvoiture;charset=utf8';
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 5
        );

        // Connexion à la base de données
        $pdo = new PDO($dsn, 'karl', 'apache2', $options);

        // Préparer et exécuter la requête d'insertion
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
        // Gestion des erreurs de connexion et d'exécution de la requête
        echo "Erreur : " . $e->getMessage();
    }
}
?>





