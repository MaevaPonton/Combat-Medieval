<?php

class Fantassin extends Monster {

    public function __construct(array $data) 
    {
        parent::__construct($data);
    }

   public function hit(Hero $hero) : int {
        if ($hero instanceof Mage) { // instanceof vérifie si un objet est une instance d'une certaine classe
            $damage = rand(0, 25) * 2; // inflige deux fois plus de dégâts contre un mage
        } else {
            $damage = rand(0, 25); // inflige des dégâts aléatoires normaux
        }
        $heroHealthPoint = $hero->getHealthPoint();
        $hero->setHealthPoint($heroHealthPoint - $damage);
        return $damage;
    } 

}

?>