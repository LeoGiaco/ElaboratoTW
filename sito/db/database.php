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

        public function addPost($utente, $testo, $tipo, $titolo, $media=""){
            $query = "INSERT INTO Post (Utente, Tipologia, Media, Testo, Data, Titolo) VALUES (?,?,?,?,?,?)"; 
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ssssss', $utente, $tipo, $media, $testo, today(), $titolo);
            return $stmt->execute();          
        }

        public function getInterests(){
            $query = "SELECT Nome FROM Interesse";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function addInterests($user, $interest){
            $query = "INSERT INTO Preferenza (InterNome, Username) VALUES (?,?) "; 
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ss', $interest, $user);
            return $stmt->execute();      
        }

        public function getPosts($nPost, $limit){
            $query = 'SELECT p.*, u.Immagine FROM Post p JOIN Utente u ON p.Utente=u.Username ORDER BY Data DESC LIMIT ?, ?';
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ss', $nPost, $limit);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function getUserPosts($nPost, $limit, $id){
            $query = 'SELECT p.*, u.Immagine FROM Post p JOIN Utente u ON p.Utente=u.Username WHERE Utente=? ORDER BY Data DESC LIMIT ?, ?';
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sss', $id, $nPost, $limit);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function getUserInfo($username){
            $query = 'SELECT * FROM Utente u JOIN Preferenza p ON u.Username = p.Username WHERE u.Username=?';
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s', $username);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function addComment($utente, $post, $testo){
            $query = "INSERT INTO Commento (Testo, Data, Post, Utente) VALUES (?, ?, ?, ?)"; 
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ssss', $testo, today(), $post, $utente);
            return $stmt->execute();          
        }

        public function getComments($idPost){
            $query = 'SELECT c.*, u.Immagine FROM Commento c JOIN Utente u ON c.Utente=u.Username  WHERE Post=? ORDER BY Data';
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $idPost);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function getReactions($id){
            $query = "SELECT PostID, SUM(CASE WHEN `Like` = 1 THEN 1 ELSE 0 END) AS NumLike, SUM(CASE WHEN Dislike = 1 THEN 1 ELSE 0 END) AS NumDislike FROM Reazione WHERE PostId = ? GROUP BY PostId";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function checkReactions($user, $id){
            $query = "SELECT * FROM `Reazione` WHERE `PostID`=? AND `Username`=?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ss", $id, $user);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function addReaction($user, $id, $like, $dislike){
            $query = "INSERT INTO `Reazione`(`PostID`, `Username`, `Dislike`, `Like`) VALUES (?, ?, ?, ?)"; 
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ssss', $id, $user, $dislike, $like);
            return $stmt->execute();     
        }

        public function deleteReaction($user, $id){
            $query = "DELETE FROM `Reazione` WHERE PostId=? AND Username=?"; 
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ss', $id, $user);
            return $stmt->execute();     
        }

        public function switchReaction($user, $post, $like, $dislike){
            $query = "UPDATE `Reazione` SET `Dislike`=?,`Like`=? WHERE PostId=? AND Username=?"; 
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ssss', $dislike, $like, $post, $user);
            return $stmt->execute();    
        }

        public function getFollower($user){
            $query = "SELECT Seguace AS Amico, Immagine FROM Follower f JOIN Utente u ON f.Seguace=u.Username WHERE Seguito=?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $user);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function getFollow($user){
            $query = "SELECT Seguito AS Amico, Immagine FROM Follower f JOIN Utente u ON f.Seguito=u.Username WHERE Seguace=?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $user);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }
    }
?>