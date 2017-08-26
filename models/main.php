<?php
require_once('lib/TemplateEngine.php');
require_once('lib/DataBase.php');

$db = new DataBase();
$template = new TemplateEngine("main_page.tpl");
$template->templateSetVar('msg', 'Инструмент Kidris помогает администраторам групп ВКонтакте привлечь дополнительную аудиторию и повысить удобство для подписчиков.');
 function GUID() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}
function getSalt() {
    return sprintf('%04u%04u%04u%04u%04u%04u%04u%04u', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}
if (isset($_GET['code']))  {
    require_once('lib/Main.php');
    $main = new Main();
    $json = json_decode($main->requestURL("https://oauth.vk.com/access_token?client_id={$GLOBALS['vk_app_id']}&client_secret={$GLOBALS['vk_app_secret']}&code={$_GET['code']}&redirect_uri=". urlencode('http://'.$_SERVER['SERVER_NAME'].'/')), true);
    if (isset($json['error'])) 
        $template->templateSetVar('msg', 'Произошла ошибка при авторизации <br> Попробуйте еще раз.');
    else  {
        $user_id = intval($json['user_id']);
        $access_token = $json['access_token'];
        $stmt = $db->dbStream->prepare("SELECT *  FROM `users` WHERE `id_vk` = ? LIMIT 1");
        $stmt->bindValue(1,  $user_id, PDO::PARAM_INT);
        try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
        if ($stmt->rowCount() == 0) {
            $userData = $main->requestVkApi("users.get","user_ids={$user_id}&fields=photo_100&access_token={$access_token}");
            //получаем фото и имя юзверя
            if (isset($userData['error']))
            	var_dump($userData);
            if (isset($userData)) {
                $photo = $userData[0]['photo_100'];
                $fName = $userData[0]['first_name'];
                $lName = $userData[0]['last_name'];
            } else {
                $photo = "https://vk.com/images/deactivated_100.png";
                $fName = "Deleted";
                $lName = "Error";
            }
            //получаем фото и имя юзверя
            $secret =  GUID();
            $stmt = $db->dbStream->prepare("INSERT INTO `users` (`id_vk`,`token`,`photo`,`first_name`,`last_name`,`GUID`)  VALUES (?,?,?,?,?,?)");
            $stmt->bindValue(1,  $user_id, PDO::PARAM_INT);
            $stmt->bindValue(2,  $access_token, PDO::PARAM_STR);
            $stmt->bindValue(3,  $photo, PDO::PARAM_STR);
            $stmt->bindValue(4,  $fName, PDO::PARAM_STR);
            $stmt->bindValue(5,  $lName, PDO::PARAM_STR);
            $stmt->bindValue(6,  $secret, PDO::PARAM_STR);
            try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
            $stmt = $db->dbStream->prepare("SELECT `ID`,`GUID`  FROM `users` WHERE `id_vk` = ? LIMIT 1");
            $stmt->bindValue(1,  $user_id, PDO::PARAM_INT);
            try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
            $salt = getSalt();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $token = $salt . '_' . md5(join('_', array($data[0]['GUID'],  $salt)));
            setcookie("token",$token,0x6FFFFFFF);
            setcookie("id",$data[0]['ID'],0x6FFFFFFF);
            header( 'Location: /starter', true, 307 );
            die();
        } else {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (strlen($data[0]['GUID']) > 0) {
                if (isset($_COOKIE["token"])) {
                    $ex = explode("_",$_COOKIE["token"]);
                    if (md5(join('_', array($data[0]['GUID'],  $ex[0]))) == $ex[1]) {
                        $stmt = $db->dbStream->prepare("UPDATE `users` SET `token` = ? WHERE `id`= ? ");
                        $stmt->bindValue(1,  $access_token, PDO::PARAM_STR);
                        $stmt->bindValue(2,  $data[0]['ID'], PDO::PARAM_INT);
                        try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
                        header( 'Location: /starter', true, 307 );
                        die();
                    } else {
                        $template->templateSetVar('msg', 'Произошла ошибка при авторизации <br> Попробуйте еще раз.');
                        setcookie("token", "", time()-3600);
                        setcookie("id", "", time()-3600);  
                    }
                } else {
                    $salt = getSalt();
                    $token = $salt . '_' . md5(join('_', array($data[0]['GUID'],  $salt)));
                    setcookie("token",$token,0x6FFFFFFF);
                    setcookie("id",$data[0]['ID'],0x6FFFFFFF);
                    $stmt = $db->dbStream->prepare("UPDATE `users` SET `token` = ? WHERE `id`= ? ");
                    $stmt->bindValue(1,  $access_token, PDO::PARAM_STR);
                    $stmt->bindValue(2,  $data[0]['ID'], PDO::PARAM_INT);
                    try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
                    header( 'Location: /starter', true, 307 );
                    die();
                }
            } else {
                $secret =  GUID();
                $stmt = $db->dbStream->prepare("UPDATE `users` SET `GUID` = ?, `token` = ? WHERE `ID` = ? ");
                $stmt->bindValue(1,  $secret, PDO::PARAM_STR);
                $stmt->bindValue(2,  $access_token, PDO::PARAM_STR);
                $stmt->bindValue(3,  $data[0]['ID'], PDO::PARAM_INT);
                try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
                $salt = getSalt();
                $token = $salt . '_' . md5(join('_', array($secret,  $salt)));
                setcookie("token",$token,0x6FFFFFFF);
                setcookie("id",$data[0]['ID'],0x6FFFFFFF);
                header( 'Location: /starter', true, 307 );
                die();
            }
        }
    }
}

$template->templateSetVar('auth_url', "https://oauth.vk.com/authorize?client_id={$GLOBALS['vk_app_id']}&redirect_uri=http://{$_SERVER['SERVER_NAME']}/&response_type=code&scope=groups&lang=ru&v=5.37");

$template->templateCompile();
$template->templateDisplay();





