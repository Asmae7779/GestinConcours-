<?php

 

  $user='root';
  $base='concours';
  $mdp='';
  $srvrname='mysql:host=127.0.0.1:8080;dbname=concours';
  try{
      $bd= new PDO($srvrname,$user,$mdp);
      echo'YOU ARE CONNECTED<br>';
      
      try{
        $sql1=' CREATE TABLE IF NOT EXISTS etud3a (
          NOM VARCHAR(15) NOT NULL,
          PRENOM VARCHAR(15) NOT NULL,
          EMAIL VARCHAR(15) ,
          DATE_DE_NAISSANCE varchar(20),
          DIPLOME VARCHAR(20),
          NIVEAU VARCHAR(20),
          ETABLISSEMENT_ORIGINE VARCHAR(20),
          PHOTOPATH VARCHAR(250),
          CV varchar(255) ,
          MDP VARCHAR(20),
          token varchar(20)
          )';
        $sql2=' CREATE TABLE IF NOT EXISTS etud4a (
          
          NOM VARCHAR(15) NOT NULL,
          PRENOM VARCHAR(15) NOT NULL,
          EMAIL VARCHAR(15) ,
          DATE_DE_NAISSANCE DAte,
          DIPLOME VARCHAR(20),
          NIVEAU VARCHAR(20),
          ETABLISSEMENT_ORIGINE VARCHAR(20),
          PHOTOPATH VARCHAR(250),
          CV varchar(255) ,
          MDP VARCHAR(20),
          token varchar(20)

      )';
      $bd->query($sql1);
      echo'etud3a CREE AVRC SUCCES<br>';
      $bd->query($sql2);
      echo'etud4a CREE AVRC SUCCES';

      }
      catch(PDOException $e){
        echo'CREATION DES TABS ECHOUEE'.$e.'<br>';
      }
  }
  catch(PDOException $e){
       print'ERROR'.$e->getMessage().'<br>';
       die(); //supprime tout
  }