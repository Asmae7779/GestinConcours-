<?php

    @$keywords = $_GET['keywords'];
    @$valider = $_GET['valider'];
    if(isset($valider) && !empty(trim($keywords))){
        require_once('BD.php');
        $res1 = $bd->prepare("SELECT *  FROM etud3a WHERE NOM LIKE '%$keywords%'");
        $res1->setFetchMode(PDO::FETCH_ASSOC);
        $res1->execute();
        $tab1 = $res1->fetchAll();
        //table etud4a
        $res2 = $bd->prepare("SELECT *  FROM etud4a WHERE NOM LIKE '%$keywords%'");
        $res2->setFetchMode(PDO::FETCH_ASSOC);
        $res2->execute();
        $tab2 = $res2->fetchAll();

        $afficher ="oui";
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barre De Recherche - by ajax</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa; /* Couleur de fond légèrement grise */
    padding: 20px;
}

form {
    margin-bottom: 20px;
}

input[type="text"],
input[type="submit"] {
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ccc;
}

input[type="submit"] {
    background-color: #007bff; /* Couleur bleue pour le bouton de soumission */
    color: #fff;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3; /* Couleur bleu foncé au survol */
}

#resultats {
    margin-top: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 10px;
}

#nbr {
    margin-bottom: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 8px;
    border: 1px solid #ccc;
    text-align: left;
}

th {
    background-color: #007bff; /* Couleur bleue pour les en-têtes de tableau */
    color: #ffd;
}

td img {
    max-width: 100px;
    max-height: 100px;
}

    </style>
</head>
<body>

    <form action="" method="get">
        <input type="text" name="keywords" value="<?php echo $keywords; ?>" placeholder="Mots-clés">
        <input type="submit"  name="valider" value="Rechercher">
        <br><br><br>
    </form>
    <?php if(@$afficher == "oui"){ ?>
<div id="resultats">
    <div id="nbr">
        <h3><?= (count($tab1) + count($tab2)) . " " . ((count($tab1) + count($tab2)) > 1 ? "résultats trouvés" : "résultat trouvé") ?></h3>
    </div>
    <?php if ((count($tab1) + count($tab2)) != 0) { ?>
    <table border="1">
        <tr>
            <th>token</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>E-mail</th>
            <th>Date de Naissance</th>
            <th>Diplôme</th>
            <th>Niveau</th>
            <th>Établissement</th>
            <th>photo</th>
            <th>CV</th>
            <th>Login</th>
            <th>Mot De Passe</th>
        </tr>
        <?php for ($i = 0; $i < count($tab1); $i++) { ?>
            <tr>
                <td><?= $tab1[$i]['token'] ?></td>
                <td><?= $tab1[$i]['NOM'] ?></td>
                <td><?= $tab1[$i]['PRENOM'] ?></td>
                <td><?= $tab1[$i]['EMAIL'] ?></td>
                <td><?= $tab1[$i]['DATE_DE_NAISSANCE'] ?></td>
                <td><?= $tab1[$i]['DIPLOME'] ?></td>
                <td><?= $tab1[$i]['NIVEAU'] ?></td>
                <td><?= $tab1[$i]['ETABLISSEMENT_ORIGINE'] ?></td>
                <td><img src='uploads/<?= $tab1[$i]['PHOTO'] ?>' width='100' height='100'></td>
                <td><a href='<?= $tab1[$i]['CV'] ?>' target='_blank'>PDF</a></td>
                <td><?= $tab1[$i]['MDP'] ?></td>

            </tr>
        <?php } ?>
        <?php for ($i = 0; $i < count($tab2); $i++) { ?>
            <tr>
                <td><?= $tab2[$i]['token'] ?></td>
                <td><?= $tab2[$i]['NOM'] ?></td>
                <td><?= $tab2[$i]['PRENOM'] ?></td>
                <td><?= $tab2[$i]['EMAIL'] ?></td>
                <td><?= $tab2[$i]['DATE_DE_NAISSANCE'] ?></td>
                <td><?= $tab2[$i]['DIPLOME'] ?></td>
                <td><?= $tab2[$i]['NIVEAU'] ?></td>
                <td><?= $tab2[$i]['ETABLISSEMENT'] ?></td>
                <td><img src='../<?= $tab2[$i]['PHOTO'] ?>' width='100' height='100'></td>
                <td><a href='../<?= $tab2[$i]['CV'] ?>' target='_blank'>PDF</a></td>
                <td><?= $tab2[$i]['MDP'] ?></td>
            </tr>
        <?php } ?>
    </table>
    <?php } ?>
</div>
<?php } ?>
</body>
</html>