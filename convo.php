<?php
session_start();
require_once("BD.php");
require('fpdf/fpdf.php');

if (isset($_POST['generer'])) {
    if (isset($_POST['nom']) && isset($_POST['prenom'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
       
        $pdf = new FPDF();
        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 16);

        $pdf->Cell(0, 10, "Convocation", 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, " Monsieur : $nom $prenom", 0, 1);
        $pdf->Cell(0, 10, "Nous avons le plaisir de vous convoquer au concours de ENSA de Marrakech qui se deroulera", 0, 1);
        
        $pdf->Cell(0, 10, "le 7 juillet à 9:00 à l/adresse suivante : ENSA de Marrakech", 0, 1);
        $pdf->Cell(0, 10, "Merci de vous presenter muni(e) de votre piece d/identite en",0,1);
        $pdf->Cell(0, 10, "cours de validite ainsi que de tout document requis pour le concours",0,1);

       
      
        $pdf->Output(); 
       
    } else {
        echo "erreur1 ";
    }
} else {
    echo "erreur2";
}
?>

?>