<?php
class Controller {
    private $reservedControllers = [ 'main', 'starter', 'dash', 'ideas','accounts','payment', 404];
    public function __construct($params) {

        if (empty($params['route'])) {
            $this->loadModel('main');
        } else {


            if (isset($_GET['logout'])) {
                setcookie("token", "", time()-3600);
                setcookie("id", "", time()-3600); 
                header('Location: /'); 
                die();
            }
            $controller = explode('/', $params['route']);
            if (in_array($controller[0], $this->reservedControllers)) 
                $this->loadModel($controller[0]);
            else
                $this->loadModel('ask');    
        }    
    }
    private function loadModel($controller)
    {
        if ($controller == 'ask' ||
            $controller == 'main' || 
            $controller == 'rules' || 
            $controller == 'privacy' ||
            $controller == 'agreement' ) {
            require_once("models/{$controller}.php");
        } else {
                if (empty($_COOKIE["token"]) || empty($_COOKIE["id"])){
                    header('Location: /');
                    die();
                }
                
                require_once('lib/DataBase.php');
                $db       = new DataBase();
                $userID    = $_COOKIE["id"];
                $token     = $_COOKIE["token"];
                $stmt = $db->dbStream->prepare("SELECT *  FROM `users` WHERE `ID` =  ? LIMIT 1");
                $stmt->bindValue(1, $userID, PDO::PARAM_INT);
                try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
                if ($stmt->rowCount() == 0) {
                    setcookie("token", "", time()-3600);
                    setcookie("id", "", time()-3600); 
                    header('Location: /');
                    die();
                }
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $ex = explode("_",$token);
                if (md5(join('_', array($data[0]['GUID'],  $ex[0]))) != $ex[1]) 
                {
                    setcookie("token", "", time()-3600);
                    setcookie("id", "", time()-3600);            
                    header('Location: /auth');
                    die();
                }
                $GLOBALS['models'] = $controller; 
                require_once("models/{$controller}.php");
        } 
    } 
}