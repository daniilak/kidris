<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 0);
error_reporting(-1);
$access_token = $GLOBALS['token'] ;
/**
 * Kidris Engine v. 3.0
 * Панель управления
 */
require_once('lib/TemplateEngine.php');
require_once('lib/Main.php');
require_once('lib/DataBase.php');
$main = new Main();
$db = new Database();
$template = new TemplateEngine('page/ask.tpl');
$controller = explode('/', $_GET['route']);
$stmt = $db->dbStream->prepare("SELECT * FROM `groups` WHERE `screen_name` = ?");
$stmt->bindValue(1,  $controller[0], PDO::PARAM_STR);
try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
if ($stmt->rowCount() == 0) {
  require_once('models/404.php');
  }
$token = password_hash($_SERVER["REMOTE_ADDR"], PASSWORD_DEFAULT);
if (!isset($_SESSION) || empty($_SESSION['key'])) {
  $_SESSION['key'] = $token;
}
if (!isset($_COOKIE['key']))
  setrawcookie("key",$token,0x6FFFFFFF);

$groupBase = $stmt->fetchAll(PDO::FETCH_ASSOC);
$status = $groupBase[0]['status'];
$stmt = $db->dbStream->prepare("SELECT COUNT(*) FROM `msgs` WHERE (`ip`= ? OR `cookies` = ?) AND `datetime` > ?");
$stmt->bindValue(1,  $_SERVER["REMOTE_ADDR"], PDO::PARAM_STR);
$stmt->bindValue(2,  $token, PDO::PARAM_STR);
$stmt->bindValue(3,  date("Y-m-d H:i:s", time()-(24*60*60)), PDO::PARAM_STR);
try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
$temp = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($temp[0]['COUNT(*)'] > 5) {
	$template->templateSetVar('google', '<div class="g-recaptcha" data-sitekey="6LfiVyITAAAAAJqYq0h00SCTHs0i7QLhpY2rLHqW"></div>');
	$needCaptcha = 1;
} else {
	$template->templateSetVar('google', '');
	$needCaptcha = 0;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['video'])) {
	
	$video = urlencode(trim(strip_tags($_POST['video'])));
	$polls = $main->requestVkApi("video.search","q={$video}&sort=2&adult=0&offset=0&count=20&access_token={$access_token}");
	
	$res = array();
	foreach($polls["items"] as $key => $poll) {
		$res []= ["id"=> "video".$poll['owner_id']."_".$poll['id'], "photo"=>$poll['photo_130'], "text"=>$poll['title'] ];
	}

	
	$answer = [
	'code' => 0,
	'count' => count($res),
	'items' => $res,
	];
	echo(json_encode($answer));
	die();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['audio'])) {
	$audio = trim(strip_tags($_POST['audio']));
	$res = array();
	$res[0] = ["id"=> 5, "photo"=>"https://s3.amazonaws.com/uifaces/faces/twitter/_everaldo/128.jpg", "text"=>$audio ];
	$res[1] = ["id"=> 6, "photo"=>"https://s3.amazonaws.com/uifaces/faces/twitter/_everaldo/128.jpg", "text"=>$audio ];
	$res[2] = ["id"=> 7, "photo"=>"https://s3.amazonaws.com/uifaces/faces/twitter/_everaldo/128.jpg", "text"=>$audio ];
	$answer = [
	'code' => 0,
	'count' => 3,
	'items' => $res,
	];
	echo(json_encode($answer));
	die();
	# code...
}
//рекомендую сделать кроссдоменные запросы 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['poll'])  && isset($_POST['question'])  && isset($_POST['is_anonymous'])  && isset($_POST['token'])) {
	$owner_id = "-".$groupBase[0]['id_group'];
	$is_anonymous = intval($_POST['is_anonymous']);
	$add_answers = urlencode(trim(strip_tags($_POST['question'])));
	$question = urlencode(trim(strip_tags($_POST['poll'])));
	$poll = $main->requestVkApi("polls.create","question={$question}&is_anonymous={$is_anonymous}&owner_id={$owner_id}&add_answers={$add_answers}&access_token={$access_token}");
	$answer = [
	'code' => 0,
	'items' => "poll".$poll['owner_id']."_".$poll['id'],
	];
	echo(json_encode($answer));
	die();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_FILES['file']) && is_uploaded_file($_FILES['file']['tmp_name'])) {

$dirpath = dirname(getcwd());
	//var_dump($dirpath);
	$allowFiles = ['jpg', 'png', 'gif', 'bmp', 'jpeg'];
	$account['token'] = 'c97e6995284c1b1c56e24695981b0b2d6d31e0d67b59eabad327aed7799c553f2e59f6610bcf70ec94dd3';
	$account['album'] = 246838700;
	
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
				
				$answer = ['code'=> 38,'photo_min'=> $photo_id,'photo_vk'=> $photo_vk];
				echo(json_encode($answer));
				die();

			}
		}
	}
}
//рекомендую сделать кроссдоменные запросы 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token'])  && isset($_POST['msg'])  && isset($_POST['attachments']) || isset($_POST['v'])) {
	
	if ($status == 0) {
		$answer = [
		'code' => 4,
		'items' => "У вас нет премиум аккаунта",
		];
		echo(json_encode($answer));
		die();
	}
	if (!isset($_POST['v']) && $needCaptcha == 1) {
		$answer = [
		'code' => 4,
		'items' => "Введите капчу",
		];
		echo(json_encode($answer));
		die();
	}
	$dateTime = date("Y-m-d H:i:s"); 
	if (!password_verify($_SERVER["REMOTE_ADDR"], $token)) {
		//токен не совпадает с айпишником юзера
		$answer = [
		'code' => 1,
		];
		echo(json_encode($answer));
		die();
	}
	if (!isset($_COOKIE) || empty($_COOKIE['key'])) {
		if (!password_verify($_COOKIE['key'], $token)) {
			//токен не совпадает с куки
			$answer = [
			'code' => 2,
			];
			echo(json_encode($answer));
			die();
		}
	  //токен не совпадает с печеньками
		$answer = [
		'code' => 3,
		];
		echo(json_encode($answer));
		die();
	}
	if (isset($_POST['v']) ) {
    	$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=COD&response=".$_POST['v']);
		$response = json_decode($response, true);
			if($response["success"] === true) {
				
			}else {
			$answer = [
		'code' => 4,
		'items' => "Введите капчу",
		];
		echo(json_encode($answer));
		die();
		}
  	}
	
	
	$msg = trim(strip_tags($_POST['msg']));
	$msg = preg_replace('/\.(?!\.)/iu', '. ', $msg);
	$stop_list = ["порно","проститу","синий кит","накрот","спайс","тихийдом","хуец","бляди","легальные","порошки","vzlomvkontakte","взлом"];
	foreach($stop_list as $word) {
		$msg = str_ireplace("{$word}", '****', $msg);
	}
	$attachments = trim(strip_tags($_POST['attachments']));
	$token = trim(strip_tags($_POST['token']));
	
	$owner_id = "-".$groupBase[0]['id_group'];
	   
	//БЕЗ ЗАЩИТЫ!
	$stmt = $db->dbStream->prepare("INSERT INTO  `msgs` (`id_group`,`datetime`,`text`,`attachments`,`ip`,`cookies`) VALUES (?,?,?,?,?,?)");
	$stmt->bindValue(1,  $groupBase[0]['id_group'], PDO::PARAM_INT);
	$stmt->bindValue(2,  $dateTime, PDO::PARAM_STR);
	$stmt->bindValue(3,  $msg, PDO::PARAM_STR);
	$stmt->bindValue(4,  $attachments, PDO::PARAM_STR);
	$stmt->bindValue(5,  $_SERVER["REMOTE_ADDR"], PDO::PARAM_STR);
	$stmt->bindValue(6,  $token, PDO::PARAM_STR);
	try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
	if ($groupBase[0]['auto_add'] == 1) {
		$msg = ($groupBase[0]['auto_add'] == 0) ? $groupBase[0]['auto_add_text'].PHP_EOL.$msg : $msg.PHP_EOL.$groupBase[0]['auto_add_text'] ;
	}
	
	if (!(stristr($attachments, 'photo')) && strlen($groupBase[0]['auto_add_photo']) > 0) {
		$attachments = (strlen($attachments)>0) ? $attachments.",".$groupBase[0]['auto_add_photo'] : $groupBase[0]['auto_add_photo'];
	}
	
	$msg = urlencode($msg);
	$request = $main->requestVkApi("wall.post","owner_id={$owner_id}&from_group=1&message={$msg}&attachments={$attachments}&access_token={$access_token}");

	if (isset($request['error'])) {
		$answer = [
		'code' => 4,
		'items' => $request['error']["error_msg"],
		];
		echo(json_encode($answer));
		die();
	}
	$groupBase[0]['total_msg'] = intval($groupBase[0]['total_msg']) + 1;
	$stmt = $db->dbStream->prepare("UPDATE `groups` SET `total_msg` = ? WHERE  `id_group` = ?");
	$stmt->bindValue(1, $groupBase[0]['total_msg'], PDO::PARAM_INT);
	$stmt->bindValue(2, $groupBase[0]['id_group'], PDO::PARAM_INT);
	try{$stmt->execute();}catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
	$answer = [
	'code' => 0,
	'items' => "POST",
	];
	echo(json_encode($answer));
	die();
}



$template->templateSetVar('name', $groupBase[0]['cache_name']);
$template->templateSetVar('photo', $groupBase[0]['cache_photo']);
$template->templateSetVar('screen_name', $groupBase[0]['screen_name']);

$template->templateSetVar('description', $groupBase[0]['description']);
$template->templateSetVar('total_msg', $groupBase[0]['total_msg']);
$template->templateSetVar('token', $token);
$template->templateCompile();
$template->templateDisplay();