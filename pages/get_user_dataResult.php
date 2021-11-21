<?php 
include "includes/bd.php";
$id = $_SESSION['id'];
?>

<?php
  if ($_SERVER['REQUEST_METHOD'] == 'GET' and isset($_GET["mode"]))
  {
    $mode = $_GET["mode"];
  }

  if ($_SERVER['REQUEST_METHOD'] == 'GET' and isset($_GET["id"]))
  {
    $ID_user = $_GET["id"];
    $query = "SELECT * FROM `users` WHERE `ID` = $ID_user";
    $row = mysqli_fetch_assoc(mysqli_query($connect, $query));
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST["do_rate"]))
  {
    if (empty($_POST['mode']))
    {
        $int = $_POST["id_int"];
        $result = (string)((int)$_POST['home'] + (int)$_POST['trans'] + (int)$_POST['food'])/3;
        $count = strlen($result);
        if ($count > 4)
        {
          $result = mb_substr($result, 0, 3);
        }
        echo "$result ";
        echo $int;
        $home = $_POST['home'];
        $trans = $_POST['trans'];
        $food = $_POST['food'];
        $query = "UPDATE `interviews` SET `rate_home` = '$home', `rate_trans` = '$trans', `rate_care` = '$food', `result` = '$result' WHERE `interviews`.`ID` = '$int'";
        echo $query;
        mysqli_query($connect, $query);
    
    $url = '/tomasina/pages/prof/interviews';
    }
    else
    {
      $transmission = $_POST['id_trans'];
      $ID_worker = $_POST['ID_worker'];
      $query = "UPDATE `transmission` SET `success` = '1', `ID_worker` = '$ID_worker' WHERE `transmission`.`ID` = '$transmission'";
      mysqli_query($connect, $query);
      $trans = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM `transmission` WHERE `ID`='$transmission'"));
      $ID_cat = $trans['ID_cat'];
      $query = "UPDATE `cats` SET `Взят` = '1' WHERE `ID` = '$ID_cat'";
      mysqli_query($connect, $query);
      $url = '/tomasina/pages/prof';
    }
     header('Location: '.$url);
  }
?>

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
              <div class="col-lg-2 col-12"><p id="center-i"><img src="/tomasina/pic/sandglass.png" alt="" class="item-m"></p></div>
              <div class="col-lg-10 col-12"><a class="nav-link" href="/tomasina/pages/prof/trans">Факты передачи кошек</a></div>
            </div>        
          </li>
          <li class="nav-item">
            <div class="row nav-left-row "> 
              <div class="col-lg-2 col-12"><p id="center-i"><img src="/tomasina/pic/interview.png" alt="" class="item-m"></p></div>
              <div class="col-lg-10 col-12"><a class="nav-link" href="/tomasina/pages/prof/interviews">Заявки на собеседования</a></div>
            </div>
          </li>
          <li class="nav-item">
            <div class="row nav-left-row "> 
              <div class="col-lg-2 col-12"><p id="center-i"><img src="/tomasina/pic/cat.png" alt="" class="item-m"></p></div>
              <div class="col-lg-10 col-12"><a class="nav-link" href="/tomasina/pages/prof/cats">Кошки и коты</a></div>
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
			<h3>Информация и пользователе</h3><h3><?php echo ($row['surname'] ." ".$row['name']." ". $row['fathername'])?></h3>
          <form method="POST" class="needs-validation" novalidate>
              <div class="mb-3 mt-4">
                  <label for="exampleFormControlInput1" class="form-label">Фамилия</label>
                  <input class="form-control" type="text" placeholder="<?php echo $row['surname']?>" aria-label="readonly input example" readonly>
              </div>
              <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Имя</label>
                  <input class="form-control" type="text" placeholder="<?php echo $row['name']?>" aria-label="readonly input example" readonly>
              </div>
              <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Отчество</label>
                  <input class="form-control" type="text" placeholder="<?php echo $row['fathername']?>" aria-label="readonly input example" readonly>
              </div>
              <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Пол</label>
                  <input class="form-control" type="text" placeholder="<?php echo $row['sex']?>" aria-label="readonly input example" readonly>
              </div>
              <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Возраст</label>
                  <input class="form-control" type="text" placeholder="<?php echo $row['age']?>" aria-label="readonly input example" readonly>
              </div>
              <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Место работы</label>
                  <input class="form-control" type="text" placeholder="<?php echo $row['work']?>" aria-label="readonly input example" readonly>
              </div>
              <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Номер телефона</label>
                  <input class="form-control" type="text" placeholder="<?php echo $row['num_telephone']?>" aria-label="readonly input example" readonly>
              </div>
              <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Адрес проживания</label>
                  <input class="form-control" type="text" placeholder="<?php echo $row['address']?>" aria-label="readonly input example" readonly>
              </div>
              <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Электронная почта</label>
                  <input class="form-control" type="text" placeholder="<?php echo $row['email']?>" aria-label="readonly input example" readonly>
              </div>
          </form>
          <?php 
          if (empty($mode))
          {
          ?>
          <h3>Проставить результаты собеседования</h3>
          <?php
          $rows = mysqli_query($connect, "SELECT * FROM `interviews` WHERE `ID_user`=$ID_user AND `accepted` = '1'");
          $row = mysqli_fetch_assoc($rows);
          $count = mysqli_num_rows($rows);
          if ($count > 0)
          {
            $id_int = $row['ID'];
          }
          ?> 
          <form method="POST">
          <div class="row g-3">
              <div class="col-sm">
                <label class="col-sm-2 col-form-label">Оценка дома</label>
                <input type="text" class="form-control" name="home" required>
              </div>
              <div class="col-sm">
                <label class="col-sm-2 col-form-label">Оценка траснпортировки</label>
                <input type="text" class="form-control" name="trans" required>
              </div>
              <div class="col-sm">
              </div>
          </div>
          <div class="row g-3">
              <div class="col-sm">
                <label class="col-sm col-form-label">Оценка питания</label>
                <input type="text" class="form-control" name="food" required>
              </div>
              <div class="col-sm">
              </div>
              <div class="col-sm">
              </div>
          </div>
          <div class="row g-3">
          <div class="col-sm">
              </div>
          <div class="col-sm">
          <button type="submit" name="do_rate" class="btn btn-info mt-3" style="width: 100%">Подтвердить</button>
          <input name="id_int" value="<?php echo $id_int ?>" type="hidden">  
          </div>
          <div class="col-sm">
              </div>
          </form>
          <?php
          }
          else
          {  
          ?>
          <h3>Подтвердить получение котика</h3>
          <?php
          $rows = mysqli_query($connect, "SELECT * FROM `transmission` WHERE `ID_user`=$ID_user AND `accepted` = '1' AND `success` = '0';");
          $row = mysqli_fetch_assoc($rows);
          if (!empty($row))
          {
            $id_trans = $row['ID'];
          }
          ?>
          <form method="POST">
          <label for="inputState" class="form-label">Работник</label>
            <select name="ID_worker" id="inputState" class="form-select" required>
              <option selected disabled>Выберите...</option>
              <?php
              $query = "SELECT * FROM `workers`";
              $workers = mysqli_query($connect,$query);
              while ($worker = mysqli_fetch_assoc($workers))
              {
                echo "ID: {$worker['ID']}";
              ?>
                <option value="<?php echo $worker['ID'] ?>"><?php echo $worker['ФИО']?></option>
              <?php
              }
              ?>
            </select>
          <div class="row g-3">
          <div class="col-sm">
              </div>
          <div class="col-sm">
            <input name="id_trans" value="<?php echo $id_trans ?>" type="hidden">  
            <input name="mode" value="1" type="hidden">
            <button type="submit" name="do_rate" class="btn btn-info mt-3" style="width: 100%">Подтвердить</button>
          </div>
          <div class="col-sm"></div>
          </form> 
          <?php
          }
          ?>
        </div>
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