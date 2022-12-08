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
            return $stmt->execute();          
        }

        public function getUsernameFromMail($mail){
            $query = "SELECT Utente FROM Credenziali WHERE Mail=?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $mail);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function checkUserAbsent($username){
            $query = "SELECT * FROM Utente WHERE Username=?"; 
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s', $username);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function checkMailAbsent($mail){
            $query = "SELECT * FROM Credenziali WHERE Mail=?"; 
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s', $mail);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        #Aggiungere funzone che cripta la password
        public function addCredentials($username, $mail, $password){
            $query = "INSERT INTO Credenziali (Mail, Utente, Password) VALUES (?,?,?)"; 
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sss', $mail, $username, $password);
            return $stmt->execute();          
        }

        public function login($mail, $password){
            $query = "SELECT * FROM Credenziali WHERE Mail=? AND Password=?"; 
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ss', $mail, $password);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function getPostType(){
            $query = "SELECT Nome AS cod_select, Nome AS descr_select FROM TipologiaPost ";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function addPost($utente, $testo, $tipo, $titolo, $media){
            $query = "INSERT INTO Post (Utente, Tipologia, Media, Testo, Data, Titolo) VALUES (?,?,?,?,?,?)"; 
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ssssss', $utente, $tipo, $media, $testo, today(), $titolo);
            return $stmt->execute();          
        }
    }
?>