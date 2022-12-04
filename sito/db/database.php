<?php
    class DatabaseHelper{
        private $db;

        public function __construct($servername, $username, $password, $dbname, $port){
            $this->db = new mysqli($servername, $username, $password, $dbname, $port);
            if ($this->db->connect_error) {
                die("Connection failed: " . $this->db->connect_error);
            }        
        }

        #Aggiungere funzone che cripta la password
        public function addUser($username, $nome, $cognome, $sesso, $dataNascita, $mail, $password, $online="0"){
            $query = "INSERT INTO Utente (Username, Nome, Cognome, Sesso, DataNascita, Online) VALUES (?,?,?,?,?,?)"; 
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ssssss', $username, $nome, $cognome, $sesso, $dataNascita, $online);
            $stmt->execute();
        }

    }
?>