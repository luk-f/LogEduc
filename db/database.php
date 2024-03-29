<?php 
include('var.php');
function accentsPhp($text)
{
  $text = htmlentities($text, ENT_NOQUOTES, "UTF-8");
  $text = htmlspecialchars_decode($text);
  return $text;
}

function loadClass($class) {

    if (substr(realpath('.'), 0, 8) == "C:\\wamp\\") { //Windows
        require 'C:\\wamp\\www\\LogEduc\\class\\'.$class .'.class.php'; 
    } else if (substr(realpath('.'), 0, 8) == "/var/www") { //Ubuntu 
        require '/var/www/html/LogEduc/class/'.$class .'.class.php'; 
    } else { //Bthouverez.fr
      require '/homez.36/bthouver/www/LogEduc/class/'.$class .'.class.php'; 
    }

}

/* Scanne, affiche et ajoute dans un array les fichier de la racine du dossier
Champ type : permet de récupérer différents types de fichiers :
    -image : jpg, png, bmp
    -

Champ show : affiche le résultat par défaut, mettre à faux pour ne pas l'afficher */
function scanDirectoryToArray($dir, $type = null, $show = false) {
    $myDir = opendir($dir) or die('Erreur');
    $entries = array();
    if($show) echo '<ul>';
    while($entry = @readdir($myDir)) {
        if($entry != '.' && $entry != '..') {
            if(is_dir($dir.'/'.$entry) && $entry != '.' && $entry != '..') {
                if($show) echo '<li>'.$dir;
                scanDirectoryToArray($dir.'/'.$entry, $type);
                if($show) echo '</li>';
            }
            else {
                if($show) echo '<li>'.$entry.'</li>';
                if($type == 'image') {
                    $ext = strtolower(substr($entry, strlen($entry)-3, strlen($entry)));
                    if($ext == 'jpg' || $ext == 'png' || $ext == 'bmp')
                        array_push($entries, $entry);                    
                } else {
                    array_push($entries, $entry);
                }
            }
        }
    }
    if($show) echo '</ul>';
    closedir($myDir);
    return $entries;
}

function connectDB() {

        $serv = $GLOBALS['SERV'];
        $user = $GLOBALS['USER'];
        $pass = $GLOBALS['PASS'];
        $base = $GLOBALS['BASE'];

    
    $db = mysql_connect($serv, $user, $pass) or die ('Erreur SQL (connection) : '.mysql_error());
    mysql_select_db($base, $db) or die('SQL Error (selection database) : ' . mysql_error());
    return $db;
}

/* USERS */
function checkUserConnexion($login, $pass) {
    $db = connectDB();
    $sql = 'SELECT * FROM mif22_user WHERE username_user = "'.$login.'"';
    $req = mysql_query($sql) or die('Erreur SQL ! : ' . mysql_error());

    while ($data = mysql_fetch_assoc($req)) {
        if($data['password_user'] == $pass) {
            return 1; 
        } 
        else return -1;
    }

    mysql_close($db);   
    return -2;
}

function getUsers() {
    $db = connectDB();

    $sql = 'SELECT * FROM mif22_user';
    $req = mysql_query($sql) or die('Erreur SQL ! : ' . mysql_error());
    $user = new User();
    $users = array();
    while ($data = mysql_fetch_assoc($req)) {
        array_push($users, new User($data['id_user'], $data['username_user'], $data['password_user']));
        $user = new User();
    }

    mysql_close($db);
    //echo '<pre>';var_dump($users);echo '</pre>';
    return $users;
}

function getUserByName($name) {
    $db = connectDB();
    $sql = 'SELECT * FROM mif22_user WHERE username_user = "'.$name.'"';
    $req = mysql_query($sql) or die('Erreur SQL ! : ' . mysql_error());

    $user = new User();
    while ($data = mysql_fetch_assoc($req)) {
            $user->setId($data['id_user']);
            $user->setUsername($data['username_user']);
            $user->setPass($data['pass_user']);
    }

    mysql_close($db);   
    return $user;
}

function addUser($user) {
    $db = connectDB();
    //Ajout de l'user dans la table USER
    $sql = 'INSERT INTO mif22_user (username_user, password_user) VALUES ("'.$user->getUsername().'", "'.$user->getPass().'");';
    mysql_query($sql) or die('Erreur SQL ! : ' . mysql_error());
    mysql_close($db);  

    //Selection de l'id du dernier user
    $user = getUserByName($user->getUsername());

    $db = connectDB();
    //Initialisation des niveaux du joueur
    $sql = 'INSERT INTO mif22_levelUserExercice (`id_user`, `id_exercice`, `level`) VALUES ('.$user->getId().', 1, 0), ('.$user->getId().', 2, 0), ('.$user->getId().', 3, 0);';
    echo $sql;
    mysql_query($sql) or die('Erreur SQL la ! : ' . mysql_error());
    mysql_close($db);   
}


function getNews() {
    $db = connectDB();

    $sql = 'SELECT * FROM mif22_news';
    $req = mysql_query($sql) or die('Erreur SQL ! : ' . mysql_error());
    $news = array();
    while ($data = mysql_fetch_assoc($req)) {
        $news[$data['id_news']] = $data['content_news'];
    }

    mysql_close($db);
    //echo '<pre>';var_dump($news);echo '</pre>';
    return $news;
}

function getLevelByUser($user) {
    $db = connectDB();
//echo '<pre>';var_dump($user);echo '</pre>'; 

    $sql = 'SELECT * FROM mif22_levelUserExercice WHERE id_user='.$user->getId();
    //echo $sql;
    $req = mysql_query($sql) or die('Erreur SQL ! : ' . mysql_error());
    $level = array();
    while ($data = mysql_fetch_assoc($req)) {
        $level[$data['id_exercice']] = intval($data['level']);
    }

    mysql_close($db);
    //echo '<pre>';var_dump($news);echo '</pre>';
    return $level;
}