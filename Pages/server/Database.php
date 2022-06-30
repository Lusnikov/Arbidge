<?php
    class Database {
        public function __construct($iniFileName){
            $this->dbSettings = parse_ini_file($iniFileName);
            $this->host = $this->dbSettings['HOST'];
            $this->db = $this->dbSettings['DB'];
            $this->user = $this->dbSettings['USER'];
            $this->passwd = $this->dbSettings['PASSWD'];
            $this->charset = $this->dbSettings['CHARSET'];
        }

        public function connect(){
            return new PDO(
                "mysql:host=$this->host;
                dbname=$this->db;
                charset=$this->charset;",
                $this->user,
                $this->passwd,
               [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]
            );
        }


    }

    function fieldsIsValid($array){
        foreach ($array as $field){
            if ($field==''){
                return false;
            }
        }
        return true;
    }

    function formatDate($date){
        $res = explode('.', $date);
      
        $array = [];
        $array[0] = $res[2];
        $array[1] = $res[1];
        $array[2] = $res[0];
      
        return implode('.', $array);
    }
    function SongInLibrary($array, $songId){
        foreach ($array as $key) {
           
           if ($key == $songId){
               return true;
           }
        
        }
        return false;
    }

    function upload_image($file, $folder) 
       { 
        $name = (string)uniqid() . $file['name']; 
        var_dump($name);
        copy($file['tmp_name'], "./$folder/$name"); 
        return $name; 
    }

    function dropBalance($balance,$userId, $pdo){
        $query = $pdo->prepare("SELECT balance FROM USERS WHERE user_id=?");
        $query->execute(array($userId));
        $balanceInAccount = $query->fetch()['balance'];

        if ((int)$balanceInAccount < (int)$balance){
            return false;
        }
     
        $query = $pdo->prepare("UPDATE USERS SET balance=balance-? WHERE user_id=?");
        $query->execute(array(
            $balance,
            $userId,
        ));
        return true;
    }
    
   
    session_start();
    $userObject = null;
    $DBobj = new Database('Database.ini');
    $pdo =   $DBobj->connect();
    

    // проверка баланаса

  

    if (isset($_SESSION['user'])){
        $query = $pdo->prepare("SELECT * FROM USERS WHERE user_id=?");
        $query->execute(array($_SESSION['user']['user_id']));
        $result = $query->fetchAll(PDO::FETCH_ASSOC)[0];


       
        $_SESSION['user']= $result;
        $userObject = $_SESSION['user'];
      


        
   
    }


    


    