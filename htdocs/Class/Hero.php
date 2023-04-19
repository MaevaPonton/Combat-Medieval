<?php

class Hero {

private $name; // propriété qui va stocker son nom unique.
private $healthPoint;// propriété qui stocke les points de vie.
private $id; // id généré automatiquement du héros
private $personnage; // propriété qui stocke le personnage choisi
private $energy; // propriété qui stocke l'énergie



// constructeur qui reprend les colonnes de la base de données sous forme d'un tableau data :
public function __construct(array $data) 
{

    if (isset($data['name'])){
        $this->setName($data['name']);
    }
    if (isset($data['health_point'])){
        $this->setHealthPoint($data['health_point']);
    }
    if (isset($data['id'])){
        $this->setId($data['id']);
    }
    if (isset($data['personnage'])){
        $this->setPersonnage($data['personnage']);
    }
    if (isset($data['energy'])){
        $this->setEnergy($data['energy']);
    }
}




// GETER et SETER id 
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    


// GETER et SETER name
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }





 // GETER et SETER healthPoint
    public function setHealthPoint($healthPoint) 
    {
        $this->healthPoint = $healthPoint;
    }

    public function getHealthPoint() 
    {
        return $this->healthPoint;
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




// GETER et SETER energy
public function setEnergy($energy)
{
    $this->energy = $energy;
}

public function getEnergy()
{
    return $this->energy;
}



// Fonction hit() :
   public function hit(Monster $monster) : int 
   {

    //On vérifie si le héros a suffisamment d'énergie pour donner un coup
    if ($this->energy <= 0) {
        return 0; // le coup n'a pas été porté
    }

       $damage = rand (25,50) ;
       $monsterHealtPoint = $monster -> getHealthPoint();
       $monster -> setHealthPoint($monsterHealtPoint - $damage);
       // $monster -> setHealthPoint($monster -> getHealthPoint() - rand (0,5));

    // Diminuer l'énergie du héros après avoir porté un coup
    $this->energy -= 1;

    return $damage;
   }

   public static function afficherImage($personnage)
   {
       switch ($personnage) {
           case 'Archer':
               return './images/archer.png';
           case 'Guerrier':
            return './images/guerrier.png';
           case 'Mage':
            return './images/mage.png';
           default:
               return './images/hero.png';
       }
   }
   

}


?>