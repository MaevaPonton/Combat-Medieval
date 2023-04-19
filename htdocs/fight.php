<?php

session_start();
require("./Config/db.php");
require("./Class/Hero.php");
require("./Class/Archer.php");
require("./Class/Guerrier.php");
require("./Class/Mage.php");
require_once('./Class/FightsManager.php');
require_once('./Class/Monster.php');
require_once('./Class/HeroesManager.php'); 


function pretyDump($data){
  highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
}

  // Utilisation de la fonction find()
  $heroes_manager = new HeroesManager($db); // instance de HeroesManager
  $hero_id = $_GET['hero_id']; // on récupère l'id du héros présent dans le formulaire index.php
  $hero = $heroes_manager->find($hero_id); // on utilise la méthode find() présente dans la classe HeroesManager




  // Utilisation de la fonction fight()

$fightManager = new FightsManager($db);
$monster = $fightManager->createMonster();// Création du monstre
$fightResults = $fightManager->fight($hero, $monster);// Exécution du combat, Exécuter la fonction fight() et stocker le résultat dans $fightResults
$heroes_manager->update($hero);// Mise à jour du héros

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Css/fight.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Jeu de Combat Médiéval</title>
</head>

<body>

<a href="./index.php" class="btn btn-light">Retour à l'accueil</a>



 <div class='row'>
    <div class='col-md-4'>
        <div class='card'>
            <div class='card-body3 text-bg-dark'>
                <h5 class='card-title'><?php echo $hero->getName() ?></h5>
                <p class='card-text'>Points de vie restants : <?php echo $hero->getHealthPoint() ?></p> 
                <p class='card-text'>Grade : <?php echo $hero->getPersonnage() ?></p> 
                <p class='card-text'>Energie :</p> 
                <progress value="<?php echo $hero->getEnergy(); ?>" max="100"></progress>
                <?php foreach ($fightResults as $result) {
                  echo '<p class = "result" >' . $result . '<p>';
                  }?>
                   <button class="btn btn-light" onclick="window.location.reload();">Refaire le combat</button>
            </div>
        </div>
    </div>
</div>