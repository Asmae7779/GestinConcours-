<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fde7e7; /* Couleur de fond rose claire */
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff; /* Fond blanc pour le contenu */
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #ff80ab; /* Couleur rose pour les titres */
            text-align: center;
        }

        p {
            color: #555; /* Couleur du texte */
        }

        button {
            background-color: #ff80ab; /* Couleur rose pour les boutons */
            color: #fff; /* Couleur du texte des boutons */
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #ff527b; /* Couleur rose plus foncée au survol */
        }
        input {
            background-color: #ff80ab; /* Couleur rose pour les boutons */
            color: #fff; /* Couleur du texte des boutons */
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input {
            background-color: #ff527b; /* Couleur rose plus foncée au survol */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Administration</h1>
        <p>Bienvenue, <?php session_start(); echo $_SESSION['username']; ?>!</p>
        <p>Que souhaitez-vous faire ?</p>
        <button onclick="window.location.href = 'lister.php';">Lister toutes les inscriptions</button>
        <form action="chercher.php">
        <input type="submit" name="submit" value="faire une recherche">
        </form>
    </div>
    
</body>
</html>
