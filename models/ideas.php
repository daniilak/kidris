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

$request = $main->requestVkApi("groups.get","extended=1&filter=editor&fields=description&access_token={$token}");
//если групп нет
$links = "";
foreach ($request['items'] as $key => $group) 
	$links .= '<li> <a href="/dash/'.$group['screen_name'].'">'.$group['name'].'</a> </li>';
$template->connectMenu($links);
$template->templateLoadSub('page/ideas.tpl', "content");
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['like_id']) && isset($_POST['is_liked']) ) {
	$likeID = intval($_POST['like_id']);
	$isLiked = intval($_POST['is_liked']);
	if ($isLiked == 0)  {
		$stmt = $db->dbStream->prepare("INSERT INTO `count_ideas` (`id_idea`,`id_user`) VALUES (?,?)");
		$stmt->bindValue(1,  $likeID, PDO::PARAM_INT);
		$stmt->bindValue(2,  $userID, PDO::PARAM_INT);
		try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
	}
	else {
		$stmt = $db->dbStream->prepare("DELETE FROM `count_ideas` WHERE `id_idea` = ? AND `id_user` = ?");
		$stmt->bindValue(1,  $likeID, PDO::PARAM_INT);
		$stmt->bindValue(2,  $userID, PDO::PARAM_INT);
		try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
	}
	$answer = [
	  'code' => '0',
	];
	echo(json_encode($answer));
	die();

}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']) && isset($_POST['description']) ) {
	$name = trim(strip_tags($_POST['name']));
	$description = trim(strip_tags($_POST['description']));
	$stmt = $db->dbStream->prepare("INSERT INTO `ideas` ( `id_user`, `name`, `description`) VALUES (?,?,?);");
	$stmt->bindValue(1,  $userID, PDO::PARAM_INT);
	$stmt->bindValue(2,  $name, PDO::PARAM_STR);
	$stmt->bindValue(3,  $description, PDO::PARAM_STR);
	try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
	$answer = [
	  'code' => '0',
	];
	echo(json_encode($answer));
	die();
}

$stmt = $db->dbStream->prepare("SELECT * FROM `ideas` WHERE `is_posted` = 1 LIMIT 20");
try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
$temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
$blockIdeas = '';
foreach ($temp as $idea) {
	$stmt = $db->dbStream->prepare("SELECT COUNT(*) FROM `count_ideas` WHERE `id_idea` = ?  ");
	$stmt->bindValue(1,  $idea['ID'], PDO::PARAM_INT);
	try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
	$temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$idea['count'] = $temp[0]['COUNT(*)'];
	$stmt = $db->dbStream->prepare("SELECT COUNT(*) FROM `count_ideas` WHERE `id_idea` = ? AND `id_user` = ? ");
	$stmt->bindValue(1,  $idea['ID'], PDO::PARAM_INT);
	$stmt->bindValue(2,  $userID, PDO::PARAM_INT);
	try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
	$temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$idea['vote'] = ($temp[0]['COUNT(*)'] == 0 ) ? '-o"' : '" style="color:red"';
	$idea['is_like'] = ($temp[0]['COUNT(*)'] == 0 ) ? 0 : 1;

	$blockIdeas .= $template->templateLoadInString('block_idea.tpl', $idea);
}

$template->templateSetVar('block_ideas', $blockIdeas);
$template->templateSetVar('photo_user', $photo);
$template->templateSetVar('fName', $fName);
$template->templateSetVar('lName', $lName);
$template->templateSetVar('groups', $links);
$template->templateCompile();
$template->templateDisplay();