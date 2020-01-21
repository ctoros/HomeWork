<?php
include("connect.php");
class User {
    public $id = "";
    public $email = "";
    public $password = "";
    
    function setId($id) {
        $this->id = $id;
    }
    function setEmail($email) {
        $this->email = $email;
    }
    function setPassword($password) {
        $this->password = $password;
    }

    function save() {
        $db = new DataBase();
        $conn = $db->connect();
        if ($conn) {
            $sql = "INSERT INTO user (id, email, password) VALUES ('" . $this->id . "', '" . $this->email . "', '" . $this->password . "')";
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
          public function updateByID($id,$email,$pass){
        $db= new Database();
        $conn = $db->connect();
        if ($conn) {
            $query="UPDATE user SET email='".$email."',"
                    ."SET codigo='".$pass."',"
                    . "WHERE id=$id";
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