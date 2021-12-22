<?php
session_start();
// créer une class
 class User{
 
    //propriétés 
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;
    protected $password;
    public $bdd;
  public function __construct($login="", $password="",  $email="", $firstname="", $lastname=""){
    // Connexion à la base de données MySQL 
      $this->bdd = mysqli_connect ( 'localhost' , 'root' , '' , 'classes' );
      $this->login = $login;
      $this->email = $email;
      $this->firstname = $firstname;
      $this->lastname = $lastname;
      $this->password = $password;
   }

  public function register(){
      //  je lance ma requete
      // je n'ai pas besoin de créer une variable requete
       $requete = mysqli_query($this->bdd, "INSERT INTO utilisateurs (login, password,email,firstname,lastname) VALUES ('$this->login', '$this->password','$this->email','$this->email','$this->lastname','$this->firstname')");
       $requete1 = mysqli_query($this->bdd,"SELECT * FROM utilisateurs WHERE login ='$this->login'");
       $result = mysqli_fetch_all($requete1);
       echo "inscrit <br/>";
      //  var_dump($result);
  }
  // connecte l'utilisateur, et donne aux attributs de la classe les valeurs correspondantes à celle de l'utilisateur connecté.: parametre login et password
  public function connect(){
    $requete1 = mysqli_query($this->bdd,"SELECT * FROM  utilisateurs WHERE login = '$this->login'");
    $result1 = $requete1->fetch_array(MYSQLI_ASSOC);
    $_SESSION['user'] = $result1;
    var_dump($result1);
    echo "connecté <br/>";
  }
  // Déconnécté l’utilisateur
  public function disconnect(){
    session_destroy();
    echo "déconecté <br/>";
    
  }
  // Supprime ET déconnecte un user  
  public function delete(){
    $this->id = $_SESSION['user']['id'];
    $requete = mysqli_query($this->bdd,"DELETE FROM utilisateurs WHERE id ='$this->id'");
    session_destroy();
    var_dump($requete);

  }
  // Met à jour les atributs de l'objet, et modifie les information en bdd
  public function update($login, $password, $email, $firstname, $lastname){
    $this->id = $_SESSION['user']['id'];
    // requete mettre a jour les attributs de l'objet
    $requete1 = mysqli_query($this->bdd,"UPDATE `utilisateurs` SET login = 'pierre', password = '$this->password', email = '$this->email', lastname = '$this->lastname', firstname = '$this->firstname' WHERE id = $this->id");
    var_dump($requete1);
    return $requete1;
  }
    public function isConnected(){
      // retourne un booléen permettant de savoir si un utilisateur est connecté ou non
      $this->login = $_SESSION['user'];
      if(isset($_SESSION['user'])){
        // return true;
        echo "connecté";

      }else{
        // return false;
        echo "non connecté";
      }
      var_dump($_SESSION['user']);
      
    }
    public function getAllInfos(){
      $id=$_SESSION['user']['id'];
      $requete = mysqli_query($this->bdd,"SELECT * FROM utilisateurs WHERE id = '$id'");
      $result = mysqli_fetch_assoc($requete);
       echo $result['id'] .'<br/>';
       echo $result['login'] .'<br/>';
       echo $result['email'] .'<br/';
       echo $result['firstname'] .'<br/';
       echo $result['lastname'] .'<br/>';
      var_dump($result);
    }
    // retourne le login de l’utilisateur
    
    public function getLogin(){
      $id = $_SESSION['user']['id'];
      $requete = mysqli_query($this->bdd,"SELECT * FROM utilisateurs WHERE id = '$id'");
      $result = mysqli_fetch_assoc($requete);
        echo $result['login'];
      var_dump($result);  
    }
    public function getEmail(){
      $this->id = $_SESSION['user']['id'];
      $requete = mysqli_query($this->bdd,"SELECT email FROM utilisateurs WHERE id ='$this->id'");
      $result = mysqli_fetch_assoc($requete);
       echo $result['email'];
      var_dump($result) ;
    }
    public function getFirstname(){
      $this->id = $_SESSION['user']['id'];
      $requete = mysqli_query($this->bdd,"SELECT firstname FROM utilisateurs WHERE id = '$this->id' ");
      $result1 = mysqli_fetch_assoc($requete);
        echo $result1['firstname'];
        var_dump($result1);

    }
    public function getLastname(){
      $this->id = $_SESSION['user']['id'];
      $requete2 = mysqli_query($this->bdd,"SELECT lastname FROM utilisateurs WHERE id = '$this->id' ");
      $result =  mysqli_fetch_assoc($requete2);
      var_dump($result);
        
    }

}
 



 $newuser = new User();
 $newuser->register("pierre", "lina@lalala.fr", "123", "lina", "lina");
//  $newuser->connect("pierre", "lina@lalala.fr", "123", "lina", "lina");
//  $newuser->disconnect("pierre", "lina@lalala.fr", "123", "lina", "lina");
//  $newuser->delete("pierre", "lina@lalala.fr", "123", "lina", "lina");
// $newuser->update("pierre", "lina@lalala.fr", "123", "lina", "lina");
// $newuser->isConnected("pierre", "lina@lalala.fr", "123", "lina", "lina");
// $newuser->getAllInfos("pierre", "lina@lalala.fr", "123", "lina", "lina");
// $newuser->getLogin("pierre", "lina@lalala.fr", "123", "lina", "lina");
// $newuser->getEmail("pierre", "lina@lalala.fr", "123", "lina", "lina");
// $newuser->getFirstname("pierre", "lina@lalala.f", "123", "lina", "lina");
// $newuser->getLastname("pierre", "lina@lalala.f", "123", "lina", "lina");

?>