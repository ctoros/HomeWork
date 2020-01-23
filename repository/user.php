<?php
include("conexion.php");
class usuario {
    public $id = "";
    public $email = "";
    public $password = "";
    public $nombre = "";
    
    function setId($id) {
        $this->id = $id;
    }
    function setEmail($email) {
        $this->email = $email;
    }
    function setPassword($password) {
        $this->password = $password;
    }
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function save() {
        $db = new DataBase();
        $conn = $db->connect();
        
        if ($conn) {
            $sql = "INSERT INTO usuario (id, email, password, nombre) VALUES (NULL, '" . $this->email . "', PASSWORD('" . $this->password . "'), '" . $this->nombre . "')";
            if ($conn->query($sql) === TRUE) {
                return array(TRUE, $this->toArray());
            } else {
                return array(FALSE, $conn->error);
            }
        }
    }
    function listUsers() {
        $users = [];
        $db = new DataBase();
        $conn = $db->connect();
        if ($conn) {
            $sql = "SELECT * FROM user";
            if ($conn->query($sql)) {
                $resp = $conn->query($sql);
                while ($fila = mysqli_fetch_assoc($resp)) {
                    $usr = new User();
                    $usr->setId($fila['id']);
                    $usr->setEmail($fila['email']);
                    $usr->setPassword($fila['password']);
                    array_push($users, $usr);
                }
                return $users;
            }
            echo "entra y no trae";
        }
        echo "no entra";
    }
    function getUserById($idUser) {
        $users = [];
        $db = new DataBase();
        $conn = $db->connect();
        if ($conn) {
            $sql = "SELECT id,email,passoword FROM user where id ='".$idUser."' ";
            echo $idUser;
            if ($conn->query($sql)) {
                $resp = $conn->query($sql);
                while ($fila = mysqli_fetch_assoc($resp)) {
                    $usr = new User();
                    $usr->setId($fila['id']);
                    $usr->setNombre($fila['email']);
                    $usr->setValor($fila['password']);
                    array_push($users, $usr);
                }
                return $users;
            }
        }
    }

        function getUserByEmail($email) {
        $users = [];
        $db = new DataBase();
        $conn = $db->connect();
        if ($conn) {
            $sql = "SELECT id,email,passoword FROM user where email ='".$email."' ";
            echo $idUser;
            if ($conn->query($sql)) {
                $resp = $conn->query($sql);
                while ($fila = mysqli_fetch_assoc($resp)) {
                    $usr = new User();
                    $usr->setId($fila['id']);
                    $usr->setNombre($fila['email']);
                    $usr->setValor($fila['password']);
                    array_push($users, $usr);
                }
                return $users;
            }
        }
    }
        public function deleteById($nId){
        $db= new Database();
        $conn = $db->connect();
        if ($conn) {
            $query = "Delete user where id=$this->$nId";
            echo $query;
            if ($conn->query($query)===true) {
                return array(TRUE, $this->toArray());
            }else{
                return array(FALSE, $conn->error);
                }
            }
        }
          public function updateByID(){
        $db= new Database();
        $conn = $db->connect();
        if ($conn) {
            $query="UPDATE user SET email='".$this->email."',"
                    ."SET codigo= PASSWORD('".$this->password."'), SET nombre = '".$this->nombre."',"
                    . "WHERE id=$this->id";
            echo $query;
            if ($conn->query($query)===true) {
                return array(TRUE, $this->toArray());
            }else{
                return array(FALSE, $conn->error);
            }
        }    
    }
    function toArray() {
        $arr = array(
            'id' => $this->id,
            'email' => $this->email,
            'password' => $this->password,
        );
        return json_encode($arr);
    }
}
?>