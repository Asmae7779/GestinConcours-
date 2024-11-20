<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fde7e7; /* Couleur de fond rose claire */
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
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

        tr:nth-child(even) {
            background-color: #f2f2f2; /* Couleur de fond pour les lignes paires */
        }
    </style>
</head>
<body>
    <h3>Liste 3ème année</h3>

    <table>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Date de naissance</th>
            <th>Diplôme</th>
            <th>Niveau</th>
            <th>Établissement d'origine</th>
            <th>Chemin de la photo</th>
            <th>CV</th>
            <th>Mot de passe</th>
            <th>Token</th>
        </tr>

      <?php
      require_once('BD.php');
      $query1 = "SELECT * FROM etud3a";
      $query2 = "SELECT * FROM etud4a";
      $result1= $bd->query($query1);
      $result2= $bd->query($query2);
      if($result1->rowCount()>0 || $result2->rowCount()>0 ){
        
         while($row=$result1->fetch(PDO::FETCH_ASSOC)){
         echo "<tr>";
         echo "<td>" . $row['NOM'] . "</td>";
         echo "<td>" . $row['PRENOM'] . "</td>";
         echo "<td>" . $row['EMAIL'] . "</td>";
         echo "<td>" . $row['DATE_DE_NAISSANCE'] . "</td>";
         echo "<td>" . $row['DIPLOME'] . "</td>";
         echo "<td>" . $row['NIVEAU'] . "</td>";
         echo "<td>" . $row['ETABLISSEMENT_ORIGINE'] . "</td>";
         echo "<td>" . $row['PHOTOPATH'] . "</td>";
         echo "<td>" . $row['CV'] . "</td>";
         echo "<td>" . $row['MDP'] . "</td>";
         echo "<td>" . $row['token'] . "</td>";
         echo "</tr>";
         while($row=$result2->fetch(PDO::FETCH_ASSOC)){
            echo "<tr>";
            echo "<td>" . $row['NOM'] . "</td>";
            echo "<td>" . $row['PRENOM'] . "</td>";
            echo "<td>" . $row['EMAIL'] . "</td>";
            echo "<td>" . $row['DATE_DE_NAISSANCE'] . "</td>";
            echo "<td>" . $row['DIPLOME'] . "</td>";
            echo "<td>" . $row['NIVEAU'] . "</td>";
            echo "<td>" . $row['ETABLISSEMENT_ORIGINE'] . "</td>";
            echo "<td>" . $row['PHOTOPATH'] . "</td>";
            echo "<td>" . $row['CV'] . "</td>";
            echo "<td>" . $row['MDP'] . "</td>";
            echo "<td>" . $row['token'] . "</td>";
            echo "</tr>";  


         }


      }
   }

      ?>
  </table>

</body>
</html>      