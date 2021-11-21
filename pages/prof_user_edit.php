<?php 
include "includes/bd.php";
echo $_SESSION['id'];
$id = $_SESSION['id'];
?>

<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST["do_edit"]))
  {
    // Пишем логин и пароль из формы в переменные для удобства работы:
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $fathername = $_POST['fathername'];
    $sex = ($_POST['sex'] == 1) ? 'м' : 'ж';
    $age = $_POST['age'];
    $work = $_POST['work'];
    $num = $_POST['num'];
    $address = $_POST['address'];
    $query = "UPDATE `users` SET `surname` = '$surname', `name` = '$name', `fathername` = '$fathername', `sex` = '$sex', `age` = '$age', `work` = '$work', `num_telephone` = '$num', `address` = '$address' WHERE `users`.`ID` = $id";
   }
  $query = "SELECT * FROM users WHERE ID='$id'";
$user = mysqli_fetch_array(mysqli_query($connect, $query));

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<title>Главная страница "Томасина"</title>
	<link rel="stylesheet" href="../../style.css">
</head>
<body>
	
<?php include "moduls/mod_reg.php" ?>
<?php include "moduls/mod_log.php" ?>
<?php include "moduls/nav_menu.php" ?>

<div class="container-fluid background pt-5">
	<div class="row justify-content-center">	
		<div class=" col-1">	</div>
		
		<div class="row col-10">
		<div class="col-4">
		<div class="col-12 content py-5 mb-5" id="col-left">
			<ul class="nav flex-column nav-left">
  				<li class="nav-item">
  					<div class="row nav-left-row">	
  						<div class="col-lg-2 col-12"><p id="center-i"><img src="/tomasina/pic/settings.png" alt="" class="item-m"></p></div>
  						<div class="col-lg-10 col-12"><a class="nav-link" href="/tomasina/pages/prof/edit">Редактировать профиль</a></div>
  					</div>
  					
    				
  				</li>
  				<li class="nav-item">
  					<div class="row nav-left-row ">	
  						<div class="col-lg-2 col-12"><p id="center-i"><img src="/tomasina/pic/interview.png" alt="" class="item-m"></p></div>
  						<div class="col-lg-10 col-12"><a class="nav-link" href="/tomasina/pages/prof/interviews">Собеседования</a></div>
  					</div>
  				</li>
  				<li class="nav-item">
  					<div class="row nav-left-row">	
  						<div class="col-lg-2 col-12"><p id="center-i"><img src="/tomasina/pic/cat.png" alt="" class="item-m"></div>
  						<div class="col-lg-10 col-12"><a class="nav-link" href="/tomasina/pages/prof/cats">Приобрести котика</a></div>
  					</div>
  				</li>
			</ul>
		</div>
		<div class="col-12">	</div>
		</div>	
		<div class="col-7 offset-1 content pt-3 mb-5">
			<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  				<ol class="breadcrumb">
    				<li class="breadcrumb-item" aria-current="page"><a href="/tomasina/pages/prof">Личный кабинет</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Редактирование данных</li>
  				</ol>
			</nav>
			<h1>ИЗМЕНЕНИЕ ЛИЧНЫХ ДАННЫХ</h1>
          <form method="POST" class="needs-validation" novalidate>
			       <div class="form-floating mb-3 mt-4">
                <input type="text" name="surname" class="form-control" id="floatingInput" value="<?php echo $user['surname']?>">
                <label for="floatingInput">Фамилия</label>
            </div>
            <div class="form-floating  mb-3">
                <input type="text" name="name" class="form-control" id="floatingPassword" value="<?php echo $user['name']?>">
                <label for="floatingPassword">Имя</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="fathername" class="form-control" id="floatingInput" value="<?php echo $user['fathername']?>">
                <label for="floatingInput">Отчество</label>
            </div>
            <div class="form-floating mb-3">
                <select name="sex" class="form-select" aria-label="Default select example" id="sex" required>
                  <option <?php echo(($user['sex']=='м')?'selected':'')?> value="1">м</option>
                  <option <?php echo(($user['sex']=='ж')?'selected':'')?> value="2">ж</option>
                </select>
                <label for="floatingInput">Пол</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="age" class="form-control" id="floatingPassword" value="<?php echo $user['age']?>">
                <label for="floatingPassword">Возраст</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="work" class="form-control" id="floatingPassword" value="<?php echo $user['work']?>">
                <label for="floatingPassword">Место работы</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="num" class="form-control" id="floatingInput" value="<?php echo $user['num_telephone']?>">
                <label for="floatingInput">Номер телефона</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="address" class="form-control" id="floatingPassword" value="<?php echo $user['address']?>">
                <label for="floatingPassword">Адрес проживания</label>
            </div>
            <div class="row justify-content-center">
                <div class="col-4"> </div>
                <div class="col-4">     
                    <button type="submit" name="do_edit" class="btn btn-info" style="width: 100%">Подтвердить изменения</button>
                </div>
                <div class="col-4"> </div>      
            </div>
          </form>
		</div>
		</div>
	    <div class="col-1">	</div>
</div>
<?php include "moduls/footer.php" ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<script src="jquery-3.6.0.min.js"></script>
	<script src="jq.js"></script>
</body>
</html>