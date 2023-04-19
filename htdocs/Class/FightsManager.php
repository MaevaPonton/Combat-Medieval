<?php

class FightsManager { 

 // Création d'une propriété privée $db qui est une instance de PDO
 private $db;


 // on passe la connection PDO à la base de données
 public function __construct(PDO $db)
 {
     $this->db = $db;
 }


public function fight(Hero $hero, Monster $monster)
 {
      $fightResults = [];
      $heroEnergy = $hero->getEnergy();
      
    do // fait
      { 

        $damage = $monster -> hit($hero);
        array_push($fightResults, " le monstre inflige " . $damage . " dégâts au héros");
        

        // Diminuer l'énergie du héros après avoir été touché
            $heroEnergy -= 10;
            $hero->setEnergy($heroEnergy);
            array_push($fightResults, " le héros perd " . $heroEnergy . " mana");
            
        if ($hero -> getHealthPoint() <= 0) {
          array_push($fightResults, " le héros est mort");
          break;
        } 

        $damage = $hero -> hit($monster);
        array_push($fightResults, " le héros inflige " . $damage . " dégâts au monstre");

        // Augmente l'énergie du héros après avoir touché le monstre
        $heroEnergy += 5;
        $hero->setEnergy($heroEnergy);
        array_push($fightResults, " le héros gagne " . $heroEnergy . " mana");

        if ($monster -> getHealthPoint() <= 0) {
          array_push($fightResults, " le monstre est mort");
        }

      } 

  while ($monster ->getHealthPoint() > 0); // tant que

  return $fightResults;
 }



 
 public function createMonster()
 {
     $name = "LE MONSTRE";
     $healthPoint = 50;
     $data = [
         'name' => $name,
         'health_point' => $healthPoint
     ];

     return new Monster($data);
 } 

 public function pretyDump($data){
  highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
}

}

?>