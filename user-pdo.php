<?php
session_start();


// $servername = "localhost";
// $username = "";
// $password = "";
// $dbName = "classes";

// try {

// 	// Creating the connection
// 	$bdd = new PDO("mysql:host=localhost;dbname=classes",
// 					'root', "");
	
// 	// Setting the PDO error mode to exception
// 	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 	echo "Connection avec success";
	
// 	// To close the connection
// 	$bdd= null;
// }

// // If connection fails
// catch(PDOException $e) {

// 	// Throws the error message
// 	echo "Connection failed: " . $e->getMessage();
// }



 class User{
    // pro^rietes;
    private $id;
    public  $login;
    public  $email;
    public  $firstname;
    public  $lastname;
    public  $password;
    protected $bdd;
    

    public function __construct($id, $login, $password, $email, $firstname, $lastname) {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->bdd = new PDO('mysql:host=localhost;dbname=classes', 'root', '');
    

    

  }
  public function register() {
    $requete = "INSERT INTO `utilisateurs` (`login`, `email`, `password`, `firstname`, `lastname`) VALUES ('$this->login', '$this->email', '$this->password', '$this->firstname', '$this->lastname')";
    $reponse = $this->bdd->prepare($requete);
    $reponse -> execute();
    $requete1 = "SELECT*FROM utilisateurs WHERE login = '$this->login'";
    $reponse2 = $this->bdd->prepare($requete1);
    $reponse2-> execute();
    $result2 = $reponse2->fetchAll(PDO::FETCH_ASSOC);
    var_dump($result2);
    
 }
 // connecte l'utilisateur, et donne aux attributs de la classe les valeurs correspondantes à celle de l'utilisateur connecté.: parametre login et password
 public function connect($login,$password){
  $requete1 = "SELECT * FROM  utilisateurs WHERE login = '$login' && password = '$password'";
  $reponse1 = $this->bdd->prepare($requete1);
  $reponse1-> execute();
  $result = $reponse1->fetchAll(PDO::FETCH_ASSOC);
  $_SESSION['user'] = $result;
  $this->id = $_SESSION['user'][0]['id'];
  $this->login =$_SESSION['user'][0]['login'];
  $this->password = $_SESSION['user'][0]['password'];
  $this->email = $_SESSION['user'][0]['email'];
  $this->firstname = $_SESSION['user'][0]['firstname'];
  $this->lastname = $_SESSION['user'][0]['lastname'];
    var_dump($_SESSION);
 }
 // Déconnécté l’utilisateur
 public function disconnect(){
    session_destroy();
    echo "déconecté <br/>";
  }
  // Supprime et déconnecte un user  
  public function delete(){
    $this->id= $_SESSION['login'];
    $id=$this->id;
    $requete = "DELETE FROM utilisateurs WHERE`login` = '$this->login'";
    $reponse = $this->bdd->prepare($requete);
    $reponse -> execute();
    // $result = $reponse->fetchAll(PDO::FETCH_ASSOC);
    session_destroy();
    var_dump($_SESSION['login']);

  }
  // Met à jour les atributs de l'objet, et modifie les information en bdd
  public function update($login, $password, $email, $firstname, $lastname){
    // requete mettre a jour les attributs de l'objet
    $requete1 = "UPDATE `utilisateurs` SET  `login` = '$login', `password`='$password',`email`='$email', `firstname`='$firstname', `lastname`='$lastname'";
    $req = $this->bdd->prepare($requete1);
    $req -> execute();
    var_dump($requete1);
  }
  public function isConnected(){
    
    if(isset( $_SESSION['user'])){
      echo 'login Connecté';
  }else{echo 'non connecté';}
    
   }
public function getAllInfos(){
    echo $this->id .'<br/>';
    echo $this->login .'<br/>';
    echo $this->email  .'<br/';
    echo $this->firstname .'<br/';
    echo $this->firstname .'<br/';
    
    
  }
  
    
  public function getLogin(){
    echo $this->login .'<br/>';
}

public function getEmail(){
  echo $this->email  .'<br/';
}

public function getFirstName(){
  echo $this->firstname .'<br/';
}

public function getLastName(){
  echo $this->firstname .'<br/';
}


}



 $newuser= new User("","lili","lolo","lali","lali","lolo");
//  $newuser->register("","lili","lolo","lali","lali","lolo");
 $newuser->connect("lili","lolo");
//  $newuser->disconnect("","lili","lolo","lali","lali","lolo");
//  $newuser->delete("","lili","lolo","lali","lali","lolo");
//  $newuser->update("","loulou","lolo","lali","lali","lolo");
//  $newuser->isConnected("","loulou","lolo","lali","lali","lolo");
 $newuser->getAllInfos();
 $newuser->getLogin("","lili","lolo","lali","lali","lolo");
 $newuser->getEmail("","lili","lolo","lali","lali","lolo");
 $newuser->getFirstName("","lili","lolo","lali","lali","lolo");
 $newuser->getLastName("","lili","lolo","lali","lali","lolo");


?>