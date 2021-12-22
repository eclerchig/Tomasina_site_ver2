<?php 
include "includes/bd.php";
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
    mysqli_query($connect, $query);
    $url = "/tomasina/pages/prof";
    header('Location: '.$url);
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
		<div class="col-lg-4 offset-lg-0 offset-2 col-8">
		<div class="col-12 prof-content py-5 mb-5" id="col-left">
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
		<div class="col-lg-7 col-12 offset-0 offset-lg-1 prof-content pt-3 mb-5">
			<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  				<ol class="breadcrumb">
    				<li class="breadcrumb-item" aria-current="page"><a href="/tomasina/pages/prof">Личный кабинет</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Редактирование данных</li>
  				</ol>
			</nav>
			<h2>РЕДАКТИРОВАНИЕ ПРОФИЛЯ</h2>
          <form method="POST" class="needs-validation" novalidate>
          <h4>ЛИЧНЫЕ ДАННЫЕ</h4>
          <div class="row mt-2">
			      <div class="form-floating col-6 mb-2">
                <input type="text" name="surname" class="form-control" id="floatingInput" value="<?php echo $user['surname']?>" pattern="[а-яА-Я]{1,50}">
                <label for="floatingInput">Фамилия</label>
                <div class="invalid-feedback">
                  Некорректное значение: используйте только русские буквы! От 1 до 50 символов.
                </div>
            </div>
            <div class="form-floating offset-1 col-2 mb-2">
                <select name="sex" class="form-select" aria-label="Default select example" id="sex" required pattern="[а-я]{1}">
                  <option disabled value="">Выберите</option>
                  <option <?php echo(($user['sex']=='м')?'selected':'')?> value="1">м</option>
                  <option <?php echo(($user['sex']=='ж')?'selected':'')?> value="2">ж</option>
                </select>
                <label for="floatingInput">Пол</label>
                <div class="invalid-feedback">
                Выберите значение из выпадающего списка
              </div>
            </div>
            <div class="form-floating offset-1 col-2 mb-2">
                <input type="number" name="age" class="form-control" id="floatingPassword" pattern="^[0-9]+$" min="18" max="90" value="<?php echo $user['age']?>">
                <label for="floatingPassword">Возраст</label>
                <div class="invalid-feedback">
                Введите корректный возраст
              </div>
            </div>

            <div class="form-floating col-6 mb-2">
                <input type="text" name="name" class="form-control" id="floatingPassword" value="<?php echo $user['name']?>" pattern="[а-яА-Я]{1,50}">
                <label for="floatingPassword">Имя</label>
                <div class="invalid-feedback">
                  Некорректное значение: используйте только русские буквы! От 1 до 50 символов.
                </div>
            </div>
            <div class="col-6 mb-2"></div>
            <div class="form-floating col-6 mb-4">
                <input type="text" name="fathername" class="form-control" id="floatingInput" value="<?php echo $user['fathername']?>" pattern="[а-яА-Я]{1,50}">
                <label for="floatingInput">Отчество</label>
                <div class="invalid-feedback">
                  Некорректное значение: используйте только русские буквы! От 1 до 50 символов.
                </div>
            </div>
          </div>

          <h4>ПРОЧАЯ ИНФОРМАЦИЯ</h4>
          <div class="row mt-2">
          </div>
            <div class="form-floating col-12 mb-2">
                <input type="text" name="work" class="form-control" id="floatingPassword" minlength="1" maxlength="150" value="<?php echo $user['work']?>">
                <label for="floatingPassword">Место работы</label>
                <div class="invalid-feedback">
              Некорректное значение: введите от 1 до 150 символов!
            </div>
            </div>
            <div class="form-floating col-12 mb-2">
                <input type="text" name="address" class="form-control" minlength="1" maxlength="150" id="floatingPassword" value="<?php echo $user['address']?>">
                <label for="floatingPassword">Адрес проживания</label>
                <div class="invalid-feedback">
              Некорректное значение: введите от 1 до 150 символов!
            </div>
            </div>

            <div class="form-floating col-5 mb-5">
                <input type="text" name="num" class="form-control" id="floatingInput" value="<?php echo $user['num_telephone']?>" pattern="[8]{1}[(]{1}[0-9]{3}[)]{1}[0-9]{3}-[0-9]{2}-[0-9]{2}">
                <label for="floatingInput">Номер телефона</label>
                <small id="passwordHelpBlock" class="form-text text-muted">Формат: 8(ХХХ)ХХХ-ХХ-ХХ</small>
              <div class="invalid-feedback">
                Введите номер телефона согласно формату!
              </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-3"> </div>
                <div class="col-6" style="text-align: center">     
                    <input type="submit" name="do_edit" class="btn btn-info" style="width: 100%" value="Подтвердить изменения">
                </div>
                <div class="col-3"> </div>      
            </div>
          </form>
		</div>
		</div>
	    <div class="col-1">	</div>
</div>
<?php include "moduls/footer.php" ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<script src="../../jquery-3.6.0.min.js"></script>
	<script src="../../jq.js"></script>
</body>
</html>