<?php

class Guerrier extends Hero {

    public function __construct(array $data) 
    {
        parent::__construct($data);
    }

    public function hit(Monster $monster) : int {
            if ($monster instanceof Sorcier) { // instanceof vérifie si un objet est une instance d'une certaine classe
                $damage = rand(0, 25) * 2; // inflige deux fois plus de dégâts contre un sorcier
            } else {
                $damage = rand(0, 25); // inflige des dégâts aléatoires normaux
            }
            $monsterHealthPoint = $monster->getHealthPoint(); // récupère le nombre de points de vie actuel du monstre et le stocke dans une variable
            $monster->setHealthPoint($monsterHealthPoint - $damage); // calcul qui permet d'obtenir le nombre de points de vie restants
            return $damage;
        }
    
     
}

?>