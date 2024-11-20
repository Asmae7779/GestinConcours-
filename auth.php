<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'identification</title>
    <style>
        body {
            background-color: #fde7e7; /* Couleur rose claire pour le fond de la page */
            font-family: Arial, sans-serif; /* Police de caractères */
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff; /* Fond blanc pour le formulaire */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre légère */
        }

        .container h2 {
            margin-bottom: 20px;
            color: #333; /* Couleur de texte */
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555; /* Couleur du texte des labels */
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc; /* Bordure grise */
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #ff80ab; /* Couleur rose pour le bouton */
            border: none;
            border-radius: 5px;
            color: #fff; /* Couleur du texte du bouton */
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #ff527b; /* Couleur rose plus foncée au survol du bouton */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Formulaire d'identification</h2>
        <form action="auth.php" method="POST">
            <div class="form-group">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prenom d'utilisateur :</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="annee">Année :</label>
                <select id="annee" name="annee">
                    <option value="3">3eme annee</option>
                    <option value="4">4eme annee</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Se connecter</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php
require_once('BD.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $prenom= $_POST['prenom'];
    $password = $_POST['password'];
    $annee = $_POST['annee'];
    if($username=='admin' && $password=='admin' && $prenom=='admin'){
        $_SESSION['user_type'] = 'admin';
        $_SESSION['username'] = $username;
        $_SESSION['prenom'] = $prenom;
        header("Location: administration.php");
    }
    else{
        $query = "SELECT * FROM etud3a WHERE NOM='$username' AND MDP='$password'";
        $result = $bd->query($query);
        $rowCount1 = $result->rowCount();
        $query2 = "SELECT * FROM etud4a WHERE NOM='$username' AND MDP='$password'";
        $result2 = $bd->query($query2);
        $rowCount2 = $result2->rowCount();
        echo".$rowCount1.";
        echo".$rowCount2.";
        if ($rowCount1 == 1 || $rowCount2 == 1) {
            
            $_SESSION['user_type'] = 'etudiant';
            $_SESSION['username'] = $username;
            $_SESSION['prenom'] = $prenom;
            echo".<br>.hooooo.<br>.";
            header("Location:recap.php");
             // Arrêter l'exécution du script après la redirection
        }}
    
}


?>
