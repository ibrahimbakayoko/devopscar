<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation and sanitization of inputs
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $adresse = filter_input(INPUT_POST, 'adresse', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if (!$email) {
        echo "Veuillez fournir une adresse e-mail valide.";
        exit();
    }

    try {
        $dsn = 'mysql:host=192.168.27.189:3306;dbname=Clientvoiture;charset=utf8mb4';
        $pdo = new PDO($dsn, 'karl', 'apache2');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
        error_log($e->getMessage());
        echo "Une erreur est survenue. Veuillez réessayer plus tard.";
    }
}
?>







