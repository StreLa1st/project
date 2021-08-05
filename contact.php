<?php
	session_start();
	$mysqli = new mysqli("localhost", "root", "", "mysite-local");
    if(isset($_POST['dataMessage'])){
    	echo 'asd';
    	$result_setmail = $mysqli->query("SELECT `firstName`,`lastName`,`patronymic`,`address`,`tel`,`email` FROM `users` WHERE `login` = '".$_SESSION['loginn']."'");
		$tablemail = [];
	    while(($rowmail = $result_setmail->fetch_assoc()) != false){
	      $tablemail[] = $rowmail;
	    }
	    foreach($tablemail as $key => $d){
			foreach($d as $key => $l){
				$fName = $d["firstName"];
		        $lName = $d["lastName"];
		        $patr = $d["patronymic"];
		        $address = $d["address"];
		        $tel = $d["tel"];
		        $email = $d["email"];
			}
		}
		$mysqli->query("INSERT INTO `messagesUsers` (`messageUser`) VALUES ('".$_POST['dataMessage']."')");
		$headers = 'Content-type: text/html; charset=utf-8';
    	mail("therussiangui1010@gmail.com", "Vacancy", $fName.' '.$lName.' '.$patr.' c логином '.$_SESSION['loginn'].' и телефонным номером '.$tel.' отправил сообщение: <br />'.$_POST['dataMessage'], $headers);
    	exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type = "text/javascript" src = "javascript/menu4.js"></script>
	<script type = "text/javascript" src = "javascript/sendBTN.js"></script>
	<script src = "jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="css/background.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
</head>
<style type="text/css">
	body{
			font-family: "Times New Roman";
			font-size: 48px;
			user-select: none;
		}
	.content{

	}
	.contactsTextDiv{
		margin: 70px 0px 0px 430px;
	}
	.contactsParagraph{

	}
	.contactsLink{

	}
	.contacts2Paragraph{
		margin: 72px 0px 18px 0px;
	}
	.message{
		font-size: 48px;
		background-image: url("images/textArea.png");
		background-size: 100% 100%;
		width: 1035px;
		height: 265px;
		padding: 5px 0px 5px 13px;
		resize: vertical;
	}
	input{
		background-image: url("images/notActiveSendButton.png");
		background-size: 100% 100%;
		width: 302px;
		height: 68px;
		outline: none;
		border: none;
		margin: 29px 0px 87px 390px;
		font-size: 48px;
		font-family: "Times New Roman";
		color: white;
		padding-bottom: 8px;
		cursor: pointer;
	}
</style>
<body>
	<div class = "menu">
 		<a href = "index.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Общая информация</div></a>
 		<a href = "service.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Наши услуги</div></a>
 		<a href = "vacancy.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Вакансии</div></a>
 		<a href = "#" class = "menuLinks"><div class = "menuButtons activeMenuButton">Контакты</div></a>
 	</div>
 	<a href = "login.php"><div class = "profileImage"></div></a>
 	<div class = "content">
 		<div class = "contactsTextDiv">
 			<p class = "contactsParagraph">
 				Адрес: 610000 г. Екатеринбург, ул. Работников, 13.<br />
				Телефон: +7 (912) 75-15-34<br />
				E-mail: company@mail.ru<br />
				<a href = "https://www.google.com/maps/place/%D0%A7%D0%BA%D0%B0%D0%BB%D0%BE%D0%B2%D1%81%D0%BA%D0%B8%D0%B9+%D1%80-%D0%BD,+%D0%95%D0%BA%D0%B0%D1%82%D0%B5%D1%80%D0%B8%D0%BD%D0%B1%D1%83%D1%80%D0%B3,+%D0%A1%D0%B2%D0%B5%D1%80%D0%B4%D0%BB%D0%BE%D0%B2%D1%81%D0%BA%D0%B0%D1%8F+%D0%BE%D0%B1%D0%BB./@56.7392069,60.6034068,12z/data=!3m1!4b1!4m8!1m2!2m1!1z0LrQsNGA0YLQsCDQs9GD0LPQuw!3m4!1s0x43c16835f748c5f5:0xa606a4a54f05373d!8m2!3d56.7410437!4d60.6456715" class = "contactsLink" target = "_blank">Посмотреть на карте</a>
 			</p>
 			<p class = "contacts2Paragraph">Сообщение:</p>
 			<form method = "post" action = "contact.php">
 				<textarea class = "message"></textarea><br />
 				<input type="submit" name="send" value = "Отправить" class = "sendButton">
 			</form>
 		</div>
 	</div>
 	<?php
		if(isset($_SESSION['info']) == 1){
	?>
		<script type="text/javascript">
			window.onload = function(){
				var sendBtn = document.getElementsByClassName('sendButton')[0].addEventListener('click', function(){
				var c = confirm('Вы действительно хотите отправить сообщение?');
				if(c){
						var dataMessage = $('textarea').val();
						$.ajax({
						    type: "POST",
						    data: {
						      'dataMessage':dataMessage
						    },
						    success: function(data){
						      alert('Ваше сообщение успешно отправлено, в ближайшее время мы Вам ответим!');
						    }
						});
						location.reload()
				} else if(!c){
					return false;
				}
				
				});
			}
		</script>
	<?php
		} 
	?>
</body>
</html>