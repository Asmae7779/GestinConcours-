<?php
session_start();


if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'etudiant') {
    header("Location: authen.php"); 
    exit();
}

require_once('BD.php');
require_once('fpdf/fpdf.php');

$username = $_SESSION['username'];
$query = "SELECT * FROM etud3a WHERE NOM='$username'";
$result = $bd->query($query);
$row = $result->fetch(PDO::FETCH_ASSOC);

$username = $_SESSION['username'];



    
if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $date_naissance = $_POST['Date']; 
    $diplome = $_POST['diplome'];
    $niveau = $_POST['niveau'];
    $etablissement = $_POST['etab'];
    $photo = $_POST['photo'];
    $cv = $_POST['cv'];
    $mdp = $_POST['mdp']; 
    if($niveau=='3eme annee'){
        $query = "UPDATE etud3a SET NOM='$nom', PRENOM='$prenom', EMAIL='$email', DATE_DE_NAISSANCE='$date_naissance', DIPLOME='$diplome', NIVEAU='$niveau', ETABLISSEMENT_ORIGINE='$etablissement', PHOTOPATH='$photo', CV='$cv', MDP='$mdp' WHERE NOM='$username'";
        $result = $bd->query($query);
    }
    else{
        $query = "UPDATE etud3a SET NOM='$nom', PRENOM='$prenom', EMAIL='$email', DATE_DE_NAISSANCE='$date_naissance', DIPLOME='$diplome', NIVEAU='$niveau', ETABLISSEMENT_ORIGINE='$etablissement', PHOTOPATH='$photo', CV='$cv', MDP='$mdp' WHERE NOM='$username'";
        $result = $bd->query($query);
    }
   

    if ($result) {
        echo".<br>.Votre Information son Modifier avec succes !";
        header("Refresh: 1"); 
       
    } else {
        echo "Une erreur s'est produite lors de la mise à jour des donnees.";
    }
}
if (isset($_POST['supprimer'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $niveau = $_POST['niveau'];
    if($niveau=='3eme annee'){
        $query = "DELETE FROM etud3a WHERE NOM='$nom' AND PRENOM='$prenom'";
        $statement = $bd->prepare($query);
        $result = $statement->execute();
    }
    else{
        $query = "DELETE FROM etud4a WHERE NOM='$nom' AND PRENOM='$prenom'";
        $statement = $bd->prepare($query);
        $result = $statement->execute();
    }
    
    
    if ($result) {
        echo".<br>.Votre Compte suprimee avec succes !";
        header("location: inscription.php"); 
       
    } else {
        echo "Une erreur s'est produite lors de la suppression des donnees.";
    }
}



?>

<<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif de la candidature</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fde7e7; /* Couleur de fond rose claire */
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #ff80ab; /* Couleur rose pour le titre */
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff; /* Fond blanc pour le tableau */
        }

        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #ff80ab; /* Couleur rose pour les en-têtes */
            color: white;
        }
        input[type="submit"] {
            background-color: #ff69b4; /* Pink */
            color: #fff;
            border: 2;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #d46a9f; /* Darker Pink */
        }
        input[type="button"] {
            background-color: #ff69b4; /* Pink */
            color: #fff;
            border: 2;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="button"]:hover {
            background-color: #d46a9f; /* Darker Pink */
        }
    </style>
</head>
<body>
    <h1>Récapitulatif de la candidature</h1>
    <form action="recap.php" method="POST">
        <table>
            <tr>
                <th>Champ</th>
                <th>Valeur</th>
            </tr>
            <tr>
                <td>Nom</td>
                <td><input type="text" name="nom" value="<?php echo $row['NOM']; ?>"></td>
            </tr>
            <tr>
                <td>Prenom</td>
                <td><input type="text" name="prenom" value="<?php echo $row['PRENOM']; ?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $row['EMAIL']; ?>"></td>
            </tr>
            <tr>
                <td>Date de naissance</td>
                <td><input type="date" name="Date" value="<?php echo $row['DATE_DE_NAISSANCE']; ?>"></td>
            </tr>
            <tr>
                <td>Diplome</td>
                <td><input type="text" name="diplome" value="<?php echo$row['DIPLOME'];?>"></td>
            </tr>
            <tr>
                <td>Niveau</td>
                <td><input type="text" name="niveau" value="<?php echo$row['NIVEAU'];?>"></td>
            </tr>
            <tr>
                <td>Etablissement</td>
                <td><input type="text" name="etab" value="<?php echo$row['ETABLISSEMENT_ORIGINE'];?>"></td>
            </tr>
            <tr>
                <td>Photo</td>
                <td><input type="text" name="photo" value="<?php echo $row['PHOTOPATH']; ?>"></td>
            </tr>
            <tr>
                <td>CV</td>
                <td><input type="text" name="cv" value="<?php echo $row['CV']; ?>"></td>
            </tr>
            <tr>
                <td>Mot de passe</td>
                <td><input type="text" name="mdp" value="<?php echo $row['MDP']; ?>"></td>
            </tr>
    
        </table>
        <input type="submit" name="submit" value="Enregistrer les modifications">
        <input type="submit" name="supprimer" value="Supprimer">
        <button type="submit" name="generer" formaction="convo.php" >Générer le reçu PDF</button>
       
    </form>


</body>
</html>

