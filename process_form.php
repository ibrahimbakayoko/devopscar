<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation et assainissement des entrées
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $adresse = filter_input(INPUT_POST, 'adresse', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    // Vérification de l'email
    if (!$email) {
        echo "Veuillez fournir une adresse e-mail valide.";
        exit();
    }

    // Validation du numéro de téléphone (format français attendu)
    if (!preg_match('/^0[1-9](\s?\d{2}){4}$/', $telephone)) {
        echo "Veuillez fournir un numéro de téléphone valide.";
        exit();
    }

    try {
        // Utilisation de variables d'environnement pour les informations de connexion
        $host = getenv('DB_HOST');
        $dbname = getenv('DB_NAME');
        $username = getenv('DB_USER');
        $password = getenv('DB_PASSWORD');

        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
        $pdo = new PDO($dsn, $username, $password);
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
        // Enregistrement de l'erreur dans les logs du serveur
        error_log($e->getMessage());
        echo "Une erreur est survenue. Veuillez réessayer plus tard.";
    }
}
?>






