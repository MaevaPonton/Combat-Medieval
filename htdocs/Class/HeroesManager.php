<link rel="stylesheet" href="./Css/index.css">

<?php


class HeroesManager { 

    // Création d'une propriété privée $db qui est une instance de PDO
    private $db;


    // on passe la connection PDO à la base de données
    public function __construct(PDO $db)
    {
        $this->setDb ($db);
    }

    public function setDb ($db)
    {
        $this -> db = $db;
    }



    public function add(Hero $hero) // Fonction pour ajouter les nouveaux héros dans la base de données :
    {
        $name = $hero->getName();
        $personnage = $hero->getPersonnage();
     

        // Vérifier si le héros existe déjà dans la base de données, avec le grade sélectionné : 
        $query = $this->db->prepare("SELECT COUNT(*) AS count FROM heroes WHERE name = :name AND personnage = :personnage");
        $query->bindParam(':name', $name);
        $query->bindParam(':personnage', $personnage);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
    
        if ($data['count'] > 0) {
            echo "<div class = 'UserExist'>Héros déjà crée, sélectionne-le en dessous !</div>";
            return;
        } 
        
        // Si le héros n'existe pas, on le crée : 
        $requete = $this->db->prepare("INSERT INTO heroes (name, personnage ) VALUES (:name, :personnage)");
        $requete->bindParam(':name', $name);
        $requete->bindParam(':personnage', $personnage);
        $requete->execute();

        $hero->setId($this->db->lastInsertId());
    }




    public function findAllAlive()
    {
        // Préparation et exécution de la requête SELECT
        $query = $this->db->query("SELECT * FROM heroes WHERE health_point > 0 AND energy > 0  ORDER BY id DESC");

        // Stockage des résultats dans un tableau d'instances de la classe Hero
        $heroes = array();
        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $data) {
            $hero = new Hero($data);
            $hero->setId($data['id']);
            $heroes[] = $hero;
        }
        
        return $heroes;
    }



    public function find($hero_id) 
    {
        $request = $this->db->prepare('SELECT * FROM heroes WHERE id = :id');
        $request->bindValue(':id', $hero_id, PDO::PARAM_INT);
        $request->execute();
        $resultat = $request->fetch(PDO::FETCH_ASSOC);

        if (!$resultat) {
            return null; // Héros non trouvé
        }

        $hero = new Hero([
            'id' => $resultat['id'],
            'name' => $resultat['name'],
            'health_point' => $resultat['health_point'],
            'personnage' => $resultat ['personnage'],
            'energy' => $resultat ['energy'],
        ]);
        return $hero;

        
    }


    // fonction de mise à jour du héros dans la base de données, au niveau des points de vie et de l'énergie :
    public function update(Hero $hero) {
        $request = $this->db->prepare('UPDATE heroes SET health_point = :health_point, energy = :energy WHERE id = :id ');
        $request->bindValue(':id', $hero->getId());
        $request->bindValue(':health_point', $hero->getHealthPoint());
        $request->bindValue(':energy', $hero->getEnergy());
        $request->execute();
      }

    



      public function pretyDump($data){
        highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
    }

}

  


?>



