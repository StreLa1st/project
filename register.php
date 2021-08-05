<?php
function dublicatelogin(){
    global $login;
    $mysqli = new mysqli("localhost", "root", "", "mysite-local");
    $result_set = $mysqli->query('SELECT `login` FROM `users`');
    $table = [];
    while(($row = $result_set->fetch_assoc()) != false){
      $table[] = $row;
    }
    foreach($table as $d){
      foreach ($d as $l) {
        if($login == $l){
          return false;
        } 
      }
    }
    return true;
}
function dublicateemail(){
    global $email;
    $mysqli = new mysqli("localhost", "root", "", "mysite-local");
    $result_set = $mysqli->query('SELECT `email` FROM `users`');
    $table = [];
    while(($row = $result_set->fetch_assoc()) != false){
      $table[] = $row;
    }
    foreach($table as $d){
      foreach ($d as $e) {
        if($email == $e){
          return false;
        } 
      }
    }
    return true;
}
function uncorrectpass(){
    global $password;
    $passarray = str_split($password,1);
    if($password == ""){
      return true;
    }
    if(!ctype_upper($passarray[0])){
      return false;
    }
    return true;
}
function uncorrectmail(){
  global $email;
  if($email == ""){
      return true;
    }
  $match = '/(@([a-z]{1,})\.([a-z]{1,}))$/';
  if(!preg_match($match, $email)){
    return false;
  }
  return true;
}
if(isset($_POST['reg'])){
	$firstName = htmlspecialchars($_POST['firstName']);
	$lastName = htmlspecialchars($_POST['lastName']);
	$patronymic = htmlspecialchars($_POST['patronymic']);
	$address = htmlspecialchars($_POST['address']);
	$tel = htmlspecialchars($_POST['tel']);
	$email = htmlspecialchars($_POST['email']);
	$login = htmlspecialchars($_POST['login']);
	$password = htmlspecialchars($_POST['pass']);
	$bad = false;
	session_start();
	unset($_SESSION['godSite']);
	unset($_SESSION['uncemail']);
  unset($_SESSION['unclogin']);
  unset($_SESSION['uncorpass']);
	unset($_SESSION['dublogin']);
	unset($_SESSION['error_login']);
	unset($_SESSION['error_password']);
	unset($_SESSION['error_tel']);
	unset($_SESSION['reg_success']);
	unset($_SESSION['info']);
	unset($_SESSION['dub_mail']);
	if((strlen($login) < 9) || (strlen($login) > 1000)){ 
		$_SESSION['error_login'] = 1;
		$bad = true; 
	}
	if((strlen($password) < 7) || (strlen($password) > 50)){ 
		$_SESSION['error_password'] = 1;
		$bad = true; 
	}
  if(!uncorrectpass()){ 
    $_SESSION['uncorpass'] = 1;
    $bad = true; 
  }
	if(strlen($tel) != 11){ 
		$_SESSION['error_tel'] = 1;
		$bad = true; 
	}
	if(!dublicatelogin()){
		$_SESSION['dublogin'] = 1;
		$bad = true;
	}
  if(!uncorrectmail()){
    $_SESSION['uncemail'] = 1;
    $bad = true;
  }
  if(!dublicateemail()){
    $_SESSION['dub_mail'] = 1;
    $bad = true;
  }
	if(!$bad){
		$mysqli = new mysqli("localhost", "root", "", "mysite-local");
		$password = md5($password);
		$resultAccess = $mysqli->query("SELECT `id`,`title` FROM `access` WHERE `title` = 'u'");
		$dAccess = $resultAccess->fetch_assoc();
		$titleAccess = $dAccess['title'];
		$mysqli->query("INSERT INTO users (`firstName`,`lastName`,`patronymic`,`address`,`tel`,`email`,`login`,`pass`,`accessUser`) VALUES ('$firstName','$lastName','$patronymic','$address','$tel','$email','$login','$password','".$titleAccess."')");
		$mysqli->close();
		$_SESSION['reg_success'] = 1;
		header('Location: login.php');
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
  <meta name="generator" content="2018.1.0.386"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<script type = "text/javascript" src = "javascript/registerBTN.js"></script>
	<link rel="stylesheet" type="text/css" href="css/background.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
</head>
<style type="text/css">
	body{
		font-family: "Times New Roman";
		user-select: none;
	}
	.content{

	}
	.txtPoles{
		background-image: url("images/registerPole.png");
		background-size: 100% 100%;
		width: 282px;
		height: 68px;
		outline: none;
		border: none;
		margin: 29px 0px 0px 800px;
		font-size: 40px;
		padding: 0px 10px 0px 10px;
	}
	.txtPoles.pass{
		height: 63px;
		padding: 5px 10px 0px 10px;
	}
	.txtPoles:first-child{
		background-image: url("images/registerPole.png");
		background-size: 100% 100%;
		width: 302px;
		height: 68px;
		outline: none;
		border: none;
	}
	form{
		margin-top: 21px;
	}
	form > p{
		position: absolute;
		font-size: 48px;
		margin: 34px 0px 0px 580px;
		width: 200px;
		text-align: right;
	}
	.registerButton{
		background-image: url("images/registerAndLoginButtonNotActive.png");
		background-size: 100% 100%;
		width: 302px;
		height: 68px;
		outline: none;
		border: none;
		font-size: 40px;
		color: white;
		margin: 29px 0px 50px 800px;
		cursor: pointer;
		font-family: "Times New Roman";
		padding-bottom: 5px;
	}
</style>
<body>
	<div class = "menu">
 		<a href = "index.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Общая информация</div></a>
 		<a href = "service.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Наши услуги</div></a>
 		<a href = "vacancy.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Вакансии</div></a>
 		<a href = "contact.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Контакты</div></a>
 	</div>
 	<a href = "profile.php"><div class = "profileImage"></div></a>
 	<div class = "content">
 		<form action = "" method = "post">
 			<?php
		      	if($_SESSION['uncemail'] == 1 || $_SESSION['dub_mail'] == 1){ echo "<p style = 'font-size: 15px;color: red;position:absolute;top:608px;right:806px;width: 800px;'>Такой email уже существует или это не email!</p>"; }
		   		if($_SESSION['error_login'] == 1 || $_SESSION['dublogin'] == 1){ echo "<p style = 'font-size: 15px;color: red;position:absolute;top:704px;right:682px;width: 800px;'>Такой логин уже зарегистрирован, слишком короткий(длинный) или отсутствует</p>"; }
		   		if($_SESSION['error_password'] == 1 || $_SESSION['uncorpass'] == 1){ echo "<p style = 'font-size: 15px;color: red;position:absolute;top:801px;right:632px;width: 800px;'>Пароль слишком короткий(длинный), отсутствует или должен иметь хотя бы одну заглавную букву</p>"; }
		   		if($_SESSION['error_tel'] == 1){ echo "<p style = 'font-size: 15px;color: red;position:absolute;top:510px;right:830px;width: 800px;'>Неправильная длина номера телефона</p>"; }
   			?>
 			<p>Имя:</p><input type="text" name="firstName" class = "txtPoles"><br />
 			<p>Фамилия:</p><input type="text" name="lastName" class = "txtPoles"><br />
 			<p>Отчество:</p><input type="text" name="patronymic" class = "txtPoles"><br />
 			<p>Адрес:</p><input type="text" name="address" class = "txtPoles"><br />
 			<p>Телефон:</p><input type="text" name="tel" class = "txtPoles"><br />
 			<p>E-mail:</p><input type="text" name="email" class = "txtPoles"><br />
 			<p>Логин:</p><input type="text" name="login" class = "txtPoles"><br />
 			<p>Пароль:</p><input type="password" name="pass" class = "txtPoles pass"><br />
 			<button type = "submit" class = "registerButton" name = 'reg'>Регистрация</button>
 		</form>
 	</div>
</body>
</html>