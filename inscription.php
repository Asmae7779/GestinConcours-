<!DOCTYPE html>
<html>
<head>
    <title>Formulaire</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #000; /* Noir */
        }
        h1 {
            color: #800080; /* Purple */
            text-align: center;
        }
        form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }
        input[type="text"],
        input[type="date"],
        input[type="submit"],
        select,
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #ff69b4; /* Pink */
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #d46a9f; /* Darker Pink */
        }
    </style>
</head>
<body>
    <h1>Formulaire d'inscription</h1>
    <form method="POST" action="inscription.php" enctype="multipart/form-data" >
    
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required><br>

        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="niveau">Niveau:</label>
        <select id="niveau" name="niveau" required>
            <option value="3eme annee">3eme annee</option>
            <option value="4eme annee">4eme annee</option>
        </select>

        <label for="diplome">Diplôme:</label>
        <select id="diplome" name="diplome" required>
            <option value="b2">Bac+2</option>
            <option value="b3">Bac+3</option>
        </select>
        
        <label for="etab">Etablissement d'origine:</label>
        <input type="text" id="etab" name="etab" required><br>

        <label for="date">Date DE Naissance:</label>
        <input type="date" id="date" name="date" required><br>
        <label for="mdp">Mot De Passe:</label>
        <input type="text" id="mdp" name="mdp" required><br>

        <label for="photo">Sélectionnez une photo (JPG, JPEG, PNG):</label>
        <input type="file" id="photo" name="photo" required><br>

        <label for="cv">Inserer Votre CV Format PDF:</label>
        <input type="file" id="cv" name="cv" accept=".pdf" required><br>

        <input id='inserer' type="submit" value="Insérer" name='inserer'>
    </form>
</body>
</html>

<?php
require_once('BD.php');
//integrer la librairie PHPMailer
require 'PHPMailer/vendor/autoload.php'; // Inclure l'autoloader de Composer pour PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['inserer'])){
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $niveau=$_POST['niveau'];
    $etab=$_POST['etab'];
    $diplome=$_POST['diplome'];
    $email=$_POST['email'];
    $mdp=$_POST['mdp'];
   
    $dt=$_POST['date'];
    $token=uniqid();
    
    if (isset($_FILES['photo']) && isset($_FILES['cv'])){
        $CV=$_FILES['cv'];
        $photo=$_FILES['photo'];}
    $photopath ='uploads/'.$photo['name'];
    $cvpath='uploads/'.$CV['name'];
    move_uploaded_file($photo['tmp_name'],$photopath);
    move_uploaded_file($CV['tmp_name'],$cvpath);

    try{
        if($niveau=="3eme annee"){
            $sql1 = "INSERT INTO etud3a (NOM, PRENOM, EMAIL, DATE_DE_NAISSANCE, DIPLOME, NIVEAU, ETABLISSEMENT_ORIGINE, PHOTOPATH, CV, MDP,token) VALUES ('$nom',' $prenom','$email',' $dt',' $diplome','$niveau','$etab','$photopath','$cvpath','$mdp','$token')";
            $bd->query($sql1);
            echo'INfo enregistre avec succes dans 3a !  '; 
        }
        if($niveau=="4eme annee"){
            $sql2 = "INSERT INTO etud4a (NOM, PRENOM, EMAIL, DATE_DE_NAISSANCE, DIPLOME, NIVEAU, ETABLISSEMENT_ORIGINE, PHOTOPATH, CV, MDP,token) VALUES ('$nom',' $prenom','$email',' $dt',' $diplome','$niveau','$etab','$photopath','$cvpath','$mdp','$token')";
            $bd->query($sql2);
            echo'INfo enregistre avec succes dans 4a !  '; 
        }
       

    }
    catch(PDOException $e){
        echo'ERRor '.$e.'<br>';
    }




require "./phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php";
require "./phpmailer/vendor/phpmailer/phpmailer/src/Exception.php";
require "./phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php";
require './phpmailer/vendor/autoload.php';

$mail = new PHPMailer;
// $mail->SMTPDebug = 4;                               // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = "elamiryhajar801@gmail.com";                 // SMTP username
$mail->Password = "ssnitwsnhjemxmjq";                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, ssl also accepted
$mail->Port = 587;                                    // TCP port to connect to
$mail->setFrom("EMAIL", 'Dsmart Tutorials');
$mail->addAddress($_POST['email']);     // Add a recipient
$mail->addReplyTo("EMAIL");
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = "Confirmation d'inscription";
$mail->Body    = '<div style="border:1px solid gray;">Bonjour ' . $prenom . ',<br><br>Votre inscription au concours des passerelles de génie informatique a bien été confirmée.<br><br>Veuillez utiliser le token suivant lors du processus de candidature : <strong>' . $token . '</strong><br><br>Cordialement,<br>Club Genie Informatique</div>';
if($mail->send()){
    echo"EMAIL ENVOYE";
}else{
    echo"ERREUR!";
}

}


?>

