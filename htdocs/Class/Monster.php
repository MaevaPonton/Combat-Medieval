<?php

class Monster {

    private $name; // propriété qui va stocker son nom unique.
    private $health_point;// propriété qui stocke les points de vie.
    private $personnage; // propriété qui stocke le personnage
    
    
    
    // constructeur qui reprend les colonnes de la base de données sous forme d'un tableau data :
    public function __construct(array $data) 
    {
    
        if (isset($data['name'])){
            $this->setName($data['name']);
        }
        if (isset($data['health_point'])){
            $this->setHealthPoint($data['health_point']);
        }
        if (isset($data['personnage'])){
            $this->setPersonnage($data['personnage']);
        }
    }


    // GETER et SETER name
    public function setName($name) {
        $this->name = $name;
    }
    public function getName() {
        return $this->name;
    }


    // GETER et SETER healthpoint
    public function setHealthPoint($health_point) {
        $this->health_point = $health_point;
    }
    public function getHealthPoint() {
        return $this->health_point;
    }

    // GETER et SETER personnage 
    public function setPersonnage($personnage)
    {
        $this->personnage = $personnage;
    }

    public function getPersonnage()
    {
        return $this->personnage;
    }



    
    // Fonction hit() :
   public function hit(Hero $hero) : int 
   {
       $damage = rand (25,50) ;
       $heroHealtPoint = $hero -> getHealthPoint();
       $hero -> setHealthPoint($heroHealtPoint - $damage);

       // $hero -> setHealthPoint($hero -> getHealthPoint() - rand (0,5));

       return $damage;
   }
}






?>