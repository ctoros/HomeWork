<?php
include("conexion.php");
class tarea {
    public $id = "";
    public $titulo = "";
    public $descripcion = "";
    public $idUsuario = "";
    
    function setId($id) {
        $this->id = $id;
    }
    function setTitulo($titulo){
        $this->titulo =$titulo;
    }
    function setDescripcion($descripcion){
        $this->descripcion =$descripcion;
    }
    function setIdUsuario($idUsuario){
        $this->idUsuario =$idUsuario;
    }


    function save() {
        $db = new DataBase();
        $conn = $db->connect();
        
        if ($conn) {
            $sql = "INSERT INTO tareas ( titulo, descripcion) VALUES (  '" . $this->titulo . "', '" . $this->descripcion . "')";
            if ($conn->query($sql) === TRUE) {
                return array(TRUE, $this->toArray());
            } else {
                return array(FALSE, $conn->error);
            }
        }
    }
    function listTareas() {
        $works = [];
        $db = new DataBase();
        $conn = $db->connect();
        if ($conn) {
            $sql = "SELECT * FROM tareas";
            if ($conn->query($sql)) {
                $resp = $conn->query($sql);
                while ($fila = mysqli_fetch_assoc($resp)) {
                    $work = new Tarea();
                    $work->setId($fila['id']);
                    $work->setTitulo($fila['titulo']);
                    $work->setDescripcion($fila['descripcion']);
                    $work->setIdUsuario($fila['idUsuario']);
                    array_push($works, $work);
                }
                return $works;
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
        public function deleteById(){
        $db= new Database();
        $conn = $db->connect();
        if ($conn) {
            $query = "Delete user where id=$this->titulo";
            echo $query;
            if ($conn->query($query)===true) {
                return array(TRUE, $this->toArray());
            }else{
                return array(FALSE, $conn->error);
                }
            }
        }

        public function deleteByTitle(){
        $db= new Database();
        $conn = $db->connect();
        if ($conn) {
            $query = "Delete from tareas where id=".$this->id;

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
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'idUasuario' => $this->idUsuario,
        );
        return json_encode($arr);
    }
}
?>