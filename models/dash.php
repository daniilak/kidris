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
$controller = explode('/', $_GET['route']);
if (!isset($controller[1]) || strlen($controller[1]) == 0) {
	header( 'Location: /starter', true, 307 );
	die();
}
$screenName = trim(strip_tags($controller[1]));
$request = $main->requestVkApi("groups.get","extended=1&filter=editor&fields=description&access_token={$token}");
//если групп нет
$links = "";
foreach ($request['items'] as $key => $group) {
	if ($screenName == $group['screen_name'] )
		$links .= '<li class="active"> <a href="/dash/'.$group['screen_name'].'">'.$group['name'].'</a> </li>';
	else 
		$links .= '<li> <a href="/dash/'.$group['screen_name'].'">'.$group['name'].'</a> </li>';
}
$template->connectMenu($links);

$request = $main->requestVkApi("groups.getById","group_id={$screenName}&fields=description&access_token={$token}");
// var_dump($request);	
$groupID = $request[0]['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
	$stmt = $db->dbStream->prepare("DELETE FROM `groups` WHERE `id_group` = ?");
	$stmt->bindValue(1,  $groupID, PDO::PARAM_INT);
	try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
	$answer = [
	'code' => '0',
	];
	echo(json_encode($answer));
	die();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['plug'])) {
	$stmt = $db->dbStream->prepare("INSERT INTO `groups` (`id_user`,`id_group`,`screen_name`,`description`,`cache_name`,`cache_photo`,`cache_time`) VALUES (?,?,?,?,?,?,?)");
	$stmt->bindValue(1,  $userID, PDO::PARAM_INT);
	$stmt->bindValue(2,  $groupID, PDO::PARAM_INT);
	$stmt->bindValue(3,  $request[0]['screen_name'], PDO::PARAM_STR);
	$stmt->bindValue(4,  $request[0]['description'], PDO::PARAM_STR);
	$stmt->bindValue(5,  $request[0]['name'], PDO::PARAM_STR);
	$stmt->bindValue(6,  $request[0]['photo_100'], PDO::PARAM_STR);
	$stmt->bindValue(7,  time(), PDO::PARAM_STR);
	try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
	$answer = [
	'code' => '0',
	];
	echo(json_encode($answer));
	die();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'  &&
	isset($_POST['update'])	&&
	isset($_POST['notifications']) &&	
	isset($_POST['auto_add']) &&	
	isset($_POST['show_desc']) &&	
	isset($_POST['show_count_msg']) &&	
	isset($_POST['description']) &&	
	isset($_POST['auto_add_text']) &&	
	isset($_POST['auto_add_photo']) &&	
	isset($_POST['auto_add_down']) &&	
	isset($_POST['auto_add_up'])) 
{

	$show_desc 		= intval($_POST['show_desc']);
	$show_count_msg = intval($_POST['show_count_msg']);
	$notifications 	= intval($_POST['notifications']);
	$auto_add 		= intval($_POST['auto_add']);
	$description 	= trim(strip_tags(($_POST['description'])));
	$auto_add_text 	= trim(strip_tags(($_POST['auto_add_text'])));
	$auto_add_photo = intval($_POST['auto_add_photo']);
	
	$auto_add_down 	= intval($_POST['auto_add_down']);
	$auto_add_up 	= intval($_POST['auto_add_up']);
	if ($auto_add_photo == 0) {
		$auto_add_photo = "";
		$auto_add_photo_url = "";
		
	}
	else {
		$stmt = $db->dbStream->prepare("SELECT `auto_add_photo`,`photo_min` FROM  `groups` WHERE `id_group` = ? ");
		$stmt->bindValue(1,  $groupID, PDO::PARAM_INT);
		try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
		$temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$auto_add_photo = $temp[0]['auto_add_photo'];
		$auto_add_photo_url =  $temp[0]['photo_min'];
		
		
	}
		
	if ($auto_add_down == 0 && $auto_add_up == 1)
		$auto_add_up_down = 0;
	else 
		$auto_add_up_down = 1;
	$stmt = $db->dbStream->prepare("UPDATE `groups`  
		SET `show_desc` = ?,
		`show_count_msg` = ?,
		`notification` = ?, 
		`auto_add` = ?,
		`description` = ?,
		`auto_add_text` = ?,
		`auto_add_photo` = ?, 
		`auto_add_up_down` = ?,`photo_min` = ? WHERE `id_group` = ? ");
	$stmt->bindValue(1,  $show_desc, PDO::PARAM_INT);
	$stmt->bindValue(2,  $show_count_msg, PDO::PARAM_INT);
	$stmt->bindValue(3,  $notifications, PDO::PARAM_INT);
	$stmt->bindValue(4,  $auto_add, PDO::PARAM_INT);
	$stmt->bindValue(5,  $description, PDO::PARAM_STR);
	$stmt->bindValue(6,  $auto_add_text, PDO::PARAM_STR);
	$stmt->bindValue(7,  $auto_add_photo, PDO::PARAM_STR);
	$stmt->bindValue(8,  $auto_add_up_down, PDO::PARAM_INT);
	$stmt->bindValue(9,  $auto_add_photo_url, PDO::PARAM_STR);
	$stmt->bindValue(10,  $groupID, PDO::PARAM_INT);
	try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
	$answer = [
	'code' => '0',
	];
	echo(json_encode($answer));
	die();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_FILES['file']) && is_uploaded_file($_FILES['file']['tmp_name'])) {

$dirpath = dirname(getcwd());
	//var_dump($dirpath);
	$allowFiles = ['jpg', 'png', 'gif', 'bmp', 'jpeg'];
	
	$account['token'] = $GLOBALS['token'];
	$account['album'] = $GLOBALS['album'];
	
	$token = rand(0,8754);
	$ext = pathinfo($_FILES['file']['name']);
	if (!isset($ext['extension'])) 
		$ext['extension'] = '';
	$ext = strtolower($ext['extension']);
	if (!in_array($ext, $allowFiles)) 
	{
		$answer = ['code'=> 30];
		echo(json_encode($answer));
		die();
	} 
	elseif (!is_uploaded_file($_FILES["file"]["tmp_name"])  ) 
	{
		move_uploaded_file($_FILES["file"]["tmp_name"], "/tmp/{$token}_".$_FILES["file"]["name"]);
		$answer = ['code'=> 31];
		echo(json_encode($answer));
		die();
	} 
	else 
	{
		//var_dump(($_FILES["file"]));
		move_uploaded_file($_FILES["file"]["tmp_name"], "/tmp/{$token}_".$_FILES["file"]["name"]);
		$members = $main -> requestVkAPI("photos.getUploadServer", "album_id={$account['album']}&group_id=151389471&access_token={$account['token']}");
			//$members = json_decode(file_get_contents("https://api.vk.com/method/photos.getUploadServer?album_id={$account['album']}&access_token={$account['token']}&v=5.62"),true);
			//	var_dump($members);
		if (isset($members['error'])) 
		{
			$answer = ['code'=> 32];
			echo(json_encode($answer));
			die();
		}
		else 
		{  
			$curl = curl_init($members['upload_url']);
			$opts = [
			CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; rv:6.0.2) Gecko/20100101 Firefox/6.0.2',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_POSTFIELDS => ['photo' => class_exists("CURLFile", false) ? new CURLFile("/tmp/{$token}_".$_FILES["file"]["name"]) : "/tmp/@{$token}_".$_FILES["file"]["name"]]
			]; 
			curl_setopt_array($curl, $opts);
			$photoRequest = json_decode(curl_exec($curl), true); 
			$request = $main -> requestVkAPI("photos.save", "server={$photoRequest['server']}&photos_list={$photoRequest['photos_list']}&group_id=151389471&album_id={$account['album']}&hash={$photoRequest['hash']}&access_token={$account['token']}");
			if (isset($request['error'])) 
			{
				$answer = ['code'=> 33];
				echo(json_encode($answer));
				die();
			}
			else 
			{
				if (isset($request[0]['photo_75'])){
					$photo_id = $request[0]['photo_75'];
					if (isset($request[0]['photo_130'])) {
						$photo_id = $request[0]['photo_130'];
						if (isset($request[0]['photo_604'])) {
							$photo_id = $request[0]['photo_604'];
						}
					}
				}
				$photo_vk = "photo".$request[0]["owner_id"]."_".$request[0]["id"];
				$stmt = $db->dbStream->prepare("UPDATE `groups` SET `auto_add_photo`= ?,`photo_min` = ? WHERE `id_group` = ?");
				$stmt->bindValue(1,  $photo_vk, PDO::PARAM_STR);
				$stmt->bindValue(2,  $photo_id, PDO::PARAM_STR);
				$stmt->bindValue(3,  $groupID, PDO::PARAM_INT);
				try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
				$answer = ['code'=> 38,'photo_min'=> $photo_id,'photo_vk'=> $photo_vk];
				echo(json_encode($answer));
				die();

			}
		}
	}
}
$stmt = $db->dbStream->prepare("SELECT * FROM  `msgs` WHERE `msgs`.`id_group` = ? LIMIT 10");
$stmt->bindValue(1,  $groupID, PDO::PARAM_INT);
try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
$posts = "";
if ($stmt->rowCount() != 0) {
	
	$postsBase = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($postsBase as $post){
		$posts .= $template->templateLoadInString("msg.tpl", $post);
	}
}
$stmt = $db->dbStream->prepare("SELECT * FROM  `groups` WHERE `groups`.`id_group` = ? LIMIT 1");
$stmt->bindValue(1,  $groupID, PDO::PARAM_INT);
try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
if ($stmt->rowCount() == 0) {
	$vars = [
	"hideOne" => 'none',
	"hideTwo" => 'block',
	"total_msg" => 0,
	"show_desc" => 'checked="checked"',
	"desc_block" => 'block',
	"show_count_msg" => 'checked="checked"',
	"auto_add" => 'checked="checked"',
	"auto_add_text" => '#kidris #кидрис',
	"auto_add_up" => 'checked="checked"',
	"auto_add_down" => '',
	"auto_add_photo" => 'checked="checked"',
	"auto_add_photo_url" => '<img src="	https://pp.userapi.com/c631525/v631525984/1bb55/Xkc6KDdUUlc.jpg" class="img" style="width: 300px" alt="">',
	"sub_block_file1" => 'none',
	"sub_block_file2" => 'block',
	"notifications" => '',
	"displayAutoAdd" => 'block',
	"displayNotifications" => 'none',
	"description_vk" => $request[0]['description'],
	"description" => $request[0]['description'],
	"name" => $request[0]['name'],
	"screen_name" => $request[0]['screen_name'],
	"photo_100" => $request[0]['photo_100'],
	"posts" => "Ещё никто не отправлял сообщения через нашу систему!",
	];
} else {
	$groupBase = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$vars = [
	"hideOne" => 'block',
	"hideTwo" => 'none',
	"total_msg" => $groupBase[0]['total_msg'],
	"show_desc" => ($groupBase[0]['show_desc'] == 1) ? 'checked="checked"' : '',
	"desc_block" => ($groupBase[0]['show_desc'] == 1) ? 'block' : 'none',
	"show_count_msg" => ($groupBase[0]['show_count_msg'] == 1) ? 'checked="checked"' : '',
	"auto_add" => ($groupBase[0]['auto_add'] == 1) ? 'checked="checked"' : '',
	"auto_add_text" => $groupBase[0]['auto_add_text'],
	"auto_add_up" => ($groupBase[0]['auto_add_up_down'] == 0) ? 'checked="checked"' : '',
	"auto_add_down" => ($groupBase[0]['auto_add_up_down'] == 0) ? '' : 'checked="checked"',
	"auto_add_photo" => (strlen($groupBase[0]['auto_add_photo']) > 0) ? 'checked="checked"' : '',
	

	"auto_add_photo_url" => (strlen($groupBase[0]['auto_add_photo']) > 0) ?  '<img 
	src="'.$groupBase[0]['photo_min'].'" class="img" style="width: 300px" alt="">': "",
	"sub_block_file1" => (strlen($groupBase[0]['auto_add_photo']) > 0) ? 'none' :'none',
	"sub_block_file2" => (strlen($groupBase[0]['auto_add_photo']) > 0) ? 'block':'none',
	
	"notifications" => ($groupBase[0]['notification'] == 0) ? '' : 'checked="checked"' ,
	"displayAutoAdd" => ($groupBase[0]['auto_add'] == 1) ? "block":"none",
	"displayNotifications" => ($groupBase[0]['notification'] == 0) ? 'none' : 'block' ,
	"description_vk" => $request[0]['description'],
	"description" => $groupBase[0]['description'],
	"name" => $request[0]['name'],
	"screen_name" => $request[0]['screen_name'],
	"photo_100" => $request[0]['photo_100'],
	"posts" => $posts,
	];

}
$template->templateSetVar('content', $template->templateLoadInString('page/dash.tpl', $vars));



$template->templateSetVar('photo_user', $photo);
$template->templateSetVar('fName', $fName);
$template->templateSetVar('lName', $lName);
$template->templateSetVar('groups', $links);
$template->templateCompile();
$template->templateDisplay();