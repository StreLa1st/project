<?php
	session_start();
 	$mysqli = new mysqli("localhost", "root", "", "mysite-local");

 	if (isset($_POST['searchValue'])) {
		$query = trim($_POST['searchValue']);
		$answer = '';

		if (!empty($query))
			$search = $mysqli->query("SELECT `id`,`requirements`,`payment`,`workingconditions`,`title` FROM `vacancies` WHERE `requirements` LIKE '%".$query."%' OR  `payment` LIKE '%".$query."%' OR  `workingconditions` LIKE '%".$query."%' OR `title` LIKE '%".$query."%'");
		else
			$search = $mysqli->query("SELECT `id`,`requirements`,`payment`,`workingconditions`,`title` FROM `vacancies`");

		$tableSearch = [];
		while (($rowSearch = $search->fetch_assoc()) != false)
			$tableSearch[] = $rowSearch;

		if (isset($_SESSION['godSite']) == 1) {
			$n = 1;
			foreach ($tableSearch as $key => $value) {
				$answer .=
					"<div class = 'vacancyDiv ".$n."s'>
 				<div class = 'radioDiv'><input type = 'radio' class = 'radioClass' name = 'radios'></div>
 				<div class = 'vacancyDivParagraph'>
 					<p class = 'vacancyParagraph'><span class = 'boldSpan title'>".$value['title']."</span><br />
					Обязанности:<span class = 'vacancyrequirements'>".$value['requirements']."</span><br />
					Оплата труда:<span class = 'vacancypayment payment'> ".$value['payment']."</span> руб/мес<br />
					Условия труда:<span class = 'vacancypayment conditions'>".$value['workingconditions']."<br /></span>
					</p>
				</div>
			<div class = 'deleteVacancy'>Удалить вакансию</div>
			<div class = 'editVacancy'>Изменить вакансию</div>
 			</div>";
				$n++;
			}
		} else if(isset($_SESSION['godSite']) != 1){
			$n = 1;
			foreach ($tableSearch as $key => $value) {
				$answer .=
					"<div class = 'vacancyDiv ".$n."s'>
 				<div class = 'radioDiv'><input type = 'radio' class = 'radioClass' name = 'radios'></div>
 				<div class = 'vacancyDivParagraph'>
 					<p class = 'vacancyParagraph'><span class = 'boldSpan title'>".$value['title']."</span><br />
					Обязанности:<span class = 'vacancyrequirements'>".$value['requirements']."</span><br />
					Оплата труда:<span class = 'vacancypayment payment'> ".$value['payment']."</span> руб/мес<br />
					Условия труда:<span class = 'vacancypayment conditions'>".$value['workingconditions']."<br /></span>
					</p>
				</div></div>";
				$n++;
			}
		}

		echo $answer."<div class = 'vacancyDiv'>
	 				<div class = 'radioDiv'><input type = 'radio' class = 'radioClass' name = 'radios'></div>
	 				<div class = 'vacancyDivParagraph'>
	 					<p class = 'vacancyParagraph'><span class = 'boldSpan title'></span><br />
							<span class = 'vacancyrequirements'></span><br />
							<span class = 'vacancypayment'></span><br />
							<span class = 'vacancypayment conditions'><br /></span>
						</p>
					</div>
	 		</div>
	 		<div class = 'vacancyDiv'>
	 				<div class = 'radioDiv'><input type = 'radio' class = 'radioClass' name = 'radios'></div>
	 				<div class = 'vacancyDivParagraph'>
	 					<p class = 'vacancyParagraph'><span class = 'boldSpan title'></span><br />
							<span class = 'vacancyrequirements'></span><br />
							<span class = 'vacancypayment'></span><br />
							<span class = 'vacancypayment conditions'><br /></span>
						</p>
					</div>
	 		</div>
	 		<div class = 'vacancyDiv'>
	 				<div class = 'radioDiv'><input type = 'radio' class = 'radioClass' name = 'radios'></div>
	 				<div class = 'vacancyDivParagraph'>
	 					<p class = 'vacancyParagraph'><span class = 'boldSpan title'></span><br />
							<span class = 'vacancyrequirements'></span><br />
							<span class = 'vacancypayment'></span><br />
							<span class = 'vacancypayment conditions'><br /></span>
						</p>
					</div>
	 		</div>
	 		<div class = 'vacancyDiv'>
	 				<div class = 'radioDiv'><input type = 'radio' class = 'radioClass' name = 'radios'></div>
	 				<div class = 'vacancyDivParagraph'>
	 					<p class = 'vacancyParagraph'><span class = 'boldSpan title'></span><br />
							<span class = 'vacancyrequirements'></span><br />
							<span class = 'vacancypayment'></span><br />
							<span class = 'vacancypayment conditions'><br /></span>
						</p>
					</div>
	 		</div>
	 		<div class = 'vacancyDiv'>
	 				<div class = 'radioDiv'><input type = 'radio' class = 'radioClass' name = 'radios'></div>
	 				<div class = 'vacancyDivParagraph'>
	 					<p class = 'vacancyParagraph'><span class = 'boldSpan title'></span><br />
							<span class = 'vacancyrequirements'></span><br />
							<span class = 'vacancypayment'></span><br />
							<span class = 'vacancypayment conditions'><br /></span>
						</p>
					</div>
	 		</div>
	 		<div class = 'vacancyDiv'>
	 				<div class = 'radioDiv'><input type = 'radio' class = 'radioClass' name = 'radios'></div>
	 				<div class = 'vacancyDivParagraph'>
	 					<p class = 'vacancyParagraph'><span class = 'boldSpan title'></span><br />
							<span class = 'vacancyrequirements'></span><br />
							<span class = 'vacancypayment'></span><br />
							<span class = 'vacancypayment conditions'><br /></span>
						</p>
					</div>
	 		</div>";
		exit();
	}

    $result_set = $mysqli->query('SELECT `id`,`requirements`,`payment`,`workingconditions`,`title` FROM `vacancies`');
    $table = [];
    while(($row = $result_set->fetch_assoc()) != false){
      $table[] = $row;
    }
    if(isset($_POST['vacancyTitle']) && isset($_POST['vacancyRequirements']) && isset($_POST['vacancyPayment']) && isset($_POST['vacancyWorkingconditions'])){
    	$mysqli->query("INSERT INTO `vacancies` (`requirements`,`payment`,`workingconditions`,`title`) VALUES ('".$_POST['vacancyRequirements']."','".$_POST['vacancyPayment']."','".$_POST['vacancyWorkingconditions']."','".$_POST['vacancyTitle']."')");
    	exit();
    }
    if (isset($_GET['idVacancyForDelete'])) {
    	$mysqli->query("DELETE FROM `vacancies` WHERE `id` = '".$_GET['idVacancyForDelete']."'");
    	exit();
    }
    if (isset($_POST['idVacancyForEdit'])) {
    	$req = $_POST['textVacancyRequirementsForEdit'];
    	$pay = $_POST['textVacancyPaymentForEdit'];
    	$cond = $_POST['textVacancyConditionsForEdit'];
    	$title = $_POST['textVacancyTitleForEdit'];

	    $mysqli->query("UPDATE `vacancies`
	    				SET requirements = '$req', title = '$title', payment = '$pay', workingconditions = '$cond'
	    				WHERE `id` = '".$_POST['idVacancyForEdit']."'");
    	exit();
    }
    if(isset($_POST['dataQuery'])){
    	$str = strtok($_POST['dataQuery'], "\n");
    	$str2 = strtok($str, ".");
    	$result_setvacancyUser = $mysqli->query("SELECT `id`,`title` FROM `vacancies` WHERE `title` = '".$str2."'");
		$rowVU = $result_setvacancyUser->fetch_assoc();
		$official = $rowVU['title'];

    	$result_setmail = $mysqli->query("SELECT `id`,`firstName`,`lastName`,`patronymic`,`address`,`tel`,`email` FROM `users` WHERE `login` = '".$_SESSION['loginn']."'");
		$tablemail = [];
	    while(($rowmail = $result_setmail->fetch_assoc()) != false){
	      $tablemail[] = $rowmail;
	    }
	    foreach($tablemail as $key => $d){
			foreach($d as $key => $l){
				$userIdForOfficials = $d["id"];
				$fName = $d["firstName"];
		        $lName = $d["lastName"];
		        $patr = $d["patronymic"];
		        $address = $d["address"];
		        $tel = $d["tel"];
		        $email = $d["email"];
			}
		}
		$mysqli->query("INSERT INTO `Officials` (`userid`,`lastName`,`firstName`,`patronymic`,`tel`,`official`) VALUES ('".$userIdForOfficials."','".$lName."','".$fName."','".$patr."','".$tel."','".$official."')");
		$headers = 'Content-type: text/html; charset=utf-8';
    	mail("therussiangui1010@gmail.com", "Vacancy", $fName.' '.$lName.' '.$patr.' c логином '.$_SESSION['loginn'].' и телефонным номером '.$tel.' хочет устроиться на работу!<br />'.$_POST['dataQuery'], $headers);
    	exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type = "text/javascript" src = "javascript/menu3.js"></script>
	<script type = "text/javascript" src = "javascript/queryBTN.js"></script>
	<script src = "jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="css/background.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<style type="text/css">
		body{
			font-family: "Times New Roman";
			user-select: none;
		}
		.content{
			position: absolute;
			left: 36px;
			top:178px;
			width: 1810px;
			height: 822px;
		}
		.clearfix{
			clear: both;
		}
		.vacancyesDiv{
			width: 1809px;
			/*height: 556px;*/
			height: 695px;
			margin-top: 10px;
			overflow-y: auto;
			overflow-x: hidden;
			margin-left: 1px;
		}
		.vacancyDiv{
			background-image: url("images/serviceBlock.png");
			background-size: 100% 100%;
			width: 1809px;
			height: 139px;
			position: relative;
		}
		.radioDiv{
			background-image: url("images/plusDiv.png");
			background-size: 100% 100%;
			width: 45px;
			height: 139px;
			text-align: center;
			font-size: 48px;
			font-weight: bold;
			cursor: pointer;
			float: left;
			overflow-x: hidden;
		}
		.vacancyDivParagraph{
			overflow-y: auto;
			width: 1748px;
			height: 138px;
		}
		.vacancyParagraph{
			font-size: 40px;
			margin: 0;
			padding: 0px 0px 5px 10px;
		}
		.boldSpan{
			font-weight: bold;
		}
		.radioClass{
			position: relative;
			top: 36px;
			width: 25px;
			height: 25px;
		}
		.queryDiv{
			background-image: url("images/queryButton.png");
			background-size: 100% 100%;
			width: 1809px;
			height: 72px;
			margin: 0px auto 50px auto;
			padding: 0px 0px 2px 0px;
			position: relative;
		}
		.queryButton{
			background-image: url("images/queryButtonNotActive.png");
			width: 393px;
			height: 72px;
			margin: 0px auto;
			font-size: 48px;
			text-align: center;
			color: white;
			line-height: 65px;
			cursor: pointer;
			border-bottom: 2px solid #212121;
		}
	.addVacancy{
 		background-color: black;
 		width: 270px;
 		height: 50px;
 		position: absolute;
 		top: 13px;
 		left: 19px;
 		border-radius: 10px;
 		color: white;
 		text-align: center;
 		line-height: 47px;
 		cursor: pointer;
 		font-size: 30px;
 	}
	.deleteVacancy{
 		background-color: black;
 		width: 270px;
 		height: 50px;
 		border-radius: 10px;
 		color: white;
 		text-align: center;
 		line-height: 47px;
 		cursor: pointer;
 		position: absolute;
 		right: 50px;
 		top: 14px;
 		font-size: 30px;
 	}
 	.editVacancy{
 		background-color: black;
 		width: 270px;
 		height: 50px;
 		border-radius: 10px;
 		color: white;
 		text-align: center;
 		line-height: 47px;
 		cursor: pointer;
 		position: absolute;
 		right: 50px;
 		top: 74px;
 		font-size: 30px;
 	}
 	.findBlock{
			width: 1810px;
			font-size: 40px;
		}
		.findButton{
			background-image: url("images/findButton.png");
			width: 230px;
			height: 59px;
			text-align: center;
			color: white;
			line-height: 55px;
			cursor: pointer;
			float: right;
			margin-right: 16px;
		}
		.findPole{
			background-image: url("images/findPole.png");
			background-size: 100% 100%;
			width: 342px;
			height: 59px;
			outline: none;
			border: none;
			font-size: 40px;
			padding: 0px 0px 0px 10px;
			float: right;
		}
	</style>
</head>
<body>
	<div class = "menu">
 		<a href = "index.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Общая информация</div></a>
 		<a href = "service.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Наши услуги</div></a>
 		<a href = "#" class = "menuLinks"><div class = "menuButtons activeMenuButton">Вакансии</div></a>
 		<a href = "contact.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Контакты</div></a>
 	</div>
 	<a href = "login.php"><div class = "profileImage"></div></a>
 	<div class = "content">
 		<div class = "findBlock">
 			<input class = "findPole">
 			<div class = "findButton">Поиск</div>
 			<div class = "clearfix"></div>
 		</div>
 		<div class = "vacancyesDiv">
 			<?php
				if(isset($_SESSION['godSite']) == 1){
					$n = 1;
				    foreach ($table as $key => $value) {
				    	foreach ($value as $k => $v) {
				    		if($k == 'requirements'){
				    			$requirements = $v;
				    		} else if($k == 'payment'){
				    			$payment = $v;
				    		} else if($k == 'workingconditions'){
				    			$workingconditions = $v;
				    		} else if($k == 'title'){
				    			$title = $v;
				    		}
				    	}

	echo "<div class = 'vacancyDiv ".$n."s'>
 				<div class = 'radioDiv'><input type = 'radio' class = 'radioClass' name = 'radios'></div>
 				<div class = 'vacancyDivParagraph'>
 					<p class = 'vacancyParagraph'><span class = 'boldSpan title'>".$title."</span><br />
					Обязанности:<span class = 'vacancyrequirements'>".$requirements."</span><br />
					Оплата труда:<span class = 'vacancypayment payment'> ".$payment."</span> руб/мес<br />
					Условия труда:<span class = 'vacancypayment conditions'>".$workingconditions."<br /></span>
					</p>
				</div>
			<div class = 'deleteVacancy' id='v-".$value['id']."'>Удалить вакансию</div>
			<div class = 'editVacancy' id='ve-".$value['id']."'>Изменить вакансию</div>
 			</div>";
 			$n++;
 		}
 	} else if(isset($_SESSION['godSite']) != 1){
 		$n = 1;
				    foreach ($table as $key => $value) {
				    	foreach ($value as $k => $v) {
				    		if($k == 'requirements'){
				    			$requirements = $v;
				    		} else if($k == 'payment'){
				    			$payment = $v;
				    		} else if($k == 'workingconditions'){
				    			$workingconditions = $v;
				    		} else if($k == 'title'){
				    			$title = $v;
				    		}
				    	}

	echo "<div class = 'vacancyDiv ".$n."s'>
 				<div class = 'radioDiv'><input type = 'radio' class = 'radioClass' name = 'radios'></div>
 				<div class = 'vacancyDivParagraph'>
 					<p class = 'vacancyParagraph'><span class = 'boldSpan title'>".$title."</span><br />
					Обязанности:<span class = 'vacancyrequirements'> ".$requirements."</span><br />
					Оплата труда:<span class = 'vacancypayment payment'> ".$payment."</span> руб/мес<br />
					Условия труда:<span class = 'vacancypayment conditions'> ".$workingconditions."<br /></span>
					</p>
				</div>
 			</div>";
 			$n++;
 		}
 	}
?>
			<div class = 'vacancyDiv'>
	 				<div class = 'radioDiv'><input type = 'radio' class = 'radioClass' name = 'radios'></div>
	 				<div class = 'vacancyDivParagraph'>
	 					<p class = 'vacancyParagraph'><span class = 'boldSpan title'></span><br />
							<span class = 'vacancyrequirements'></span><br />
							<span class = 'vacancypayment payment'></span><br />
							<span class = 'vacancypayment conditions'><br /></span>
						</p>
					</div>
	 		</div>
	 		<div class = 'vacancyDiv'>
	 				<div class = 'radioDiv'><input type = 'radio' class = 'radioClass' name = 'radios'></div>
	 				<div class = 'vacancyDivParagraph'>
	 					<p class = 'vacancyParagraph'><span class = 'boldSpan title'></span><br />
							<span class = 'vacancyrequirements'></span><br />
							<span class = 'vacancypayment payment'></span><br />
							<span class = 'vacancypayment conditions'><br /></span>
						</p>
					</div>
	 		</div>
	 		<div class = 'vacancyDiv'>
	 				<div class = 'radioDiv'><input type = 'radio' class = 'radioClass' name = 'radios'></div>
	 				<div class = 'vacancyDivParagraph'>
	 					<p class = 'vacancyParagraph'><span class = 'boldSpan title'></span><br />
							<span class = 'vacancyrequirements'></span><br />
							<span class = 'vacancypayment payment'></span><br />
							<span class = 'vacancypayment conditions'><br /></span>
						</p>
					</div>
	 		</div>
	 		<div class = 'vacancyDiv'>
	 				<div class = 'radioDiv'><input type = 'radio' class = 'radioClass' name = 'radios'></div>
	 				<div class = 'vacancyDivParagraph'>
	 					<p class = 'vacancyParagraph'><span class = 'boldSpan title'></span><br />
							<span class = 'vacancyrequirements'></span><br />
							<span class = 'vacancypayment payment'></span><br />
							<span class = 'vacancypayment conditions'><br /></span>
						</p>
					</div>
	 		</div>
	 		<div class = 'vacancyDiv'>
	 				<div class = 'radioDiv'><input type = 'radio' class = 'radioClass' name = 'radios'></div>
	 				<div class = 'vacancyDivParagraph'>
	 					<p class = 'vacancyParagraph'><span class = 'boldSpan title'></span><br />
							<span class = 'vacancyrequirements'></span><br />
							<span class = 'vacancypayment payment'></span><br />
							<span class = 'vacancypayment conditions'><br /></span>
						</p>
					</div>
	 		</div>
	 		<div class = 'vacancyDiv'>
	 				<div class = 'radioDiv'><input type = 'radio' class = 'radioClass' name = 'radios'></div>
	 				<div class = 'vacancyDivParagraph'>
	 					<p class = 'vacancyParagraph'><span class = 'boldSpan title'></span><br />
							<span class = 'vacancyrequirements'></span><br />
							<span class = 'vacancypayment payment'></span><br />
							<span class = 'vacancypayment conditions'><br /></span>
						</p>
					</div>
	 		</div>
 		</div>
 		<div class = "queryDiv">
 			<?php
				if(isset($_SESSION['godSite']) == 1){
		    ?>
		    <div class = "addVacancy">Добавить вакансию</div>
		    <?php
		  		}
	 		?>
 			<div class = "queryButton">Подать заявку</div>
 		</div>
 	</div>
 	<?php
		if(isset($_SESSION['godSite']) == 1){
		?>
	<script type="text/javascript">
 	window.onload = function(){
 		var vacancyesDiv = document.getElementsByClassName('addVacancy')[0];
 		vacancyesDiv.addEventListener('click',function(){
 			var vacancyTitle = prompt('Введите название вакансии');
 			var vacancyRequirements = prompt('Введите обязанности вакансии')			//+'<br />';
 			var vacancyPayment = prompt('Введите оплату вакансии');
 			var vacancyWorkingconditions = prompt('Введите требования вакансии');
 				$.ajax({
				    type: "POST",
				    data: {
				      "vacancyTitle" : vacancyTitle,
				      "vacancyRequirements" : vacancyRequirements,
				      "vacancyPayment" : vacancyPayment,
				      "vacancyWorkingconditions" : vacancyWorkingconditions
				    },
				    success: function(data){
				    }
				  });
 		});

 		var vacancyesDeleteDiv = document.getElementsByClassName('deleteVacancy');
		for (let i = 0; i < vacancyesDeleteDiv.length; i++) {
			vacancyesDeleteDiv[i].addEventListener('click',function() {
				var vId = this.id.split('-')[1];
				var par = $(this).parent('.vacancyDiv');
				$.ajax({
				    type: "GET",
				    data: {
				      "idVacancyForDelete" : vId
				    },
				    success: function(data) {
				      par.remove();
				    }
				 });
			});
		}

		var vacancyesEditDiv = document.getElementsByClassName('editVacancy');
		var vacancyesParagr1 = document.getElementsByClassName('vacancyrequirements');
		var vacancyesParagr2 = document.getElementsByClassName('vacancypayment payment');
		var vacancyesParagr3 = document.getElementsByClassName('vacancypayment conditions');
		var vacancyesParagr4 = document.getElementsByClassName('boldSpan title');
		for (let i = 0; i < vacancyesEditDiv.length; i++) {
			vacancyesEditDiv[i].addEventListener('click',function() {
				var vId = this.id.split('-')[1];
				var textVacancyTitleForEdit = prompt('Введите название вакансии для ее изменения', vacancyesParagr4[i].textContent);
				var textVacancyRequirementsForEdit = prompt('Введите обязанности вакансии для ее изменения', vacancyesParagr1[i].textContent);
				var textVacancyPaymentForEdit = prompt('Введите оплату вакансии для ее изменения', vacancyesParagr2[i].textContent);
				var textVacancyConditionsForEdit = prompt('Введите условия вакансии для ее изменения', vacancyesParagr3[i].textContent);
				$.ajax({
				    type: "POST",
				    data: {
				      "idVacancyForEdit" : vId,
				      "textVacancyRequirementsForEdit":textVacancyRequirementsForEdit,
				      "textVacancyPaymentForEdit":textVacancyPaymentForEdit,
				      "textVacancyConditionsForEdit":textVacancyConditionsForEdit,
				      "textVacancyTitleForEdit":textVacancyTitleForEdit
				    },
				    success: function(data) {
				     	$(vacancyesParagr1[i]).text(textVacancyRequirementsForEdit);
				     	$(vacancyesParagr2[i]).text(textVacancyPaymentForEdit);
				     	$(vacancyesParagr3[i]).text(textVacancyConditionsForEdit);
				     	$(vacancyesParagr4[i]).text(textVacancyTitleForEdit);
				    }
				 });
			});
		}
 	}
 	</script>
 	<?php
	  } 
	?>
	<?php
		if(isset($_SESSION['info']) == 1){
	?>
		<script type="text/javascript">
			var r = $('input:radio[name=radios]');
			var queryBtn = document.getElementsByClassName('queryButton')[0].addEventListener('click', function(){
					if(r.is(':checked') === true){
						var c = confirm('Вы действительно хотите устроиться на эту должность?');
						if(c){
							var dataQuery = $('input:radio[name=radios]:checked').parent().next().children().text();
							$.ajax({
							    type: "POST",
							    data: {
							      'dataQuery':dataQuery
							    },
							    success: function(data){
							      alert('Ваша заявка успешно отправлена нам на почту, в ближайшее время мы Вам позвоним и всё обсудим. Спасибо, что хотите сотрудничать с нами!');
							    }
							});
							location.reload()
						} else if(!c){
							return false;
						}
					} else if(r.is(':checked') !== true){
						alert('Вы не выбрали вакансию!');
						return false;
					}
				
			});
		</script>
		<script type="text/javascript">
	  		$(function(){
	  			var searchButton = document.getElementsByClassName('findButton');
	  			var searchArea = document.getElementsByTagName('input')[0];
	  			searchButton[0].addEventListener('click',function() {
	  				var divVacancy = $('.vacancyesDiv');
	  				var searchValue = searchArea.value;
	  				$.ajax({
						    type: "POST",
						    data: {
						    	"searchValue" : searchValue
						    },
						    success: function(data) {
								divVacancy.empty();
								divVacancy.append(data);
						    }
					});
	  			});
	  		});
	  	</script>
	<?php
		} 
	?>
</body>
</html>			    			