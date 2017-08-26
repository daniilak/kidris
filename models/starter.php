<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 0);
error_reporting(-1);

/**
 * Kidris Engine v. 3.0
 * Панель управления
 */
require_once('lib/TemplateEngine.php');
require_once('lib/Main.php');
$main = new Main();
$template = new TemplateEngine('page/template.tpl');
$userID = $data[0]["ID"];
$vkID = $data[0]["id_vk"];
$token = $data[0]["token"];
$vkID = $data[0]["id_vk"];
$photo = $data[0]["photo"];
$fName = $data[0]["first_name"];
$lName = $data[0]["last_name"];
//закешировать
$stmt = $db->dbStream->prepare("SELECT COUNT(*) FROM `users`");
try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
$temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
$template->templateSetVar('count_admin', $temp[0]['COUNT(*)']);
//закешировать
$stmt = $db->dbStream->prepare("SELECT COUNT(*) FROM `groups`");
try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
$temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
$template->templateSetVar('count_groups', $temp[0]['COUNT(*)']);
//конец закешировать

$request = $main->requestVkApi("groups.get","extended=1&filter=editor&fields=description&access_token={$token}");
//если групп нет
if (isset($request["error"])) {
	if ($request["error"]['error_code'] == 5){
		setcookie("token", "", time()-3600);
		setcookie("id", "", time()-3600);  
		header( 'Location: /starter', true, 307 );
		die();
	}
}
$links = "";
foreach ($request['items'] as $key => $group) 
	$links .= '<li> <a href="/dash/'.$group['screen_name'].'">'.$group['name'].'</a> </li>';
$template->connectMenu($links);
$template->templateLoadSub('page/starter.tpl', "content");

$template->templateSetVar('photo_user', $photo);
$template->templateSetVar('fName', $fName);
$template->templateSetVar('lName', $lName);
$template->templateSetVar('groups', $links);
$template->templateCompile();
$template->templateDisplay();