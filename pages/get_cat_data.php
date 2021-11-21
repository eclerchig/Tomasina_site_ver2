<?php 
include "includes/bd.php";
echo $_SESSION['id'];
$id = $_SESSION['id'];
$mode_search = 0;
?>

<?php
 if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if (isset($_POST['do_edit']))
    {

      if (!isset($_POST['confirm_edit']))
      {
        $ID_cat = $_POST['ID_cat'];
        $cat = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `cats` WHERE `ID` = $ID_cat"));
        $mode = 1;
      }
      else
      {
        echo $_POST['st'];
        echo "STEP 2 EDIT";
        $ID_cat = $_POST['ID_cat'];
        $name = $_POST['Кличка'];
        $age = $_POST['Возраст'];
        $date = $_POST['Дата_рождения'];
        $poroda = $_POST['Порода'];
        $pol = $_POST['Пол'];
        $okras = $_POST['Окрас'];
        $prim = $_POST['Особые_приметы'];
        $vet = $_POST['Адрес_ВетКлиники'];
        if ($_POST['chip'] == '1')
        {
          echo "CHIP";
          $chip = 1;
        }
        else
        {
          $chip = 0;
        }
        if ($_POST['vak'] == '1')
        {
          echo "VAK";
          $vak = 1;
        }
        else
        {
          $vak = 0;
        }
        if ($_POST['ster'] == '1')
        {
          echo "STER";
          $ster = 1;
        }
        else
        {
          $ster = 0;
        }
        if ($_POST['st'] == '1')
        {
          echo "ST";
          $st = 1;
        }
        else
        {
          $st = 0;
        }

        $query = "UPDATE `cats` SET `Кличка` = '$name', `Возраст` = '$age', `Дата рождения` = '$date', `Порода` = '$poroda', `Пол` = '$pol', `Окрас` = '$okras', `Особые приметы` = '$prim', `Чипирование` = '$chip', `Стерилизация` = '$ster', `Вакцинация` = '$vak', `Адрес_ВетКлиники` = '$vet', `Взят` = '$st' WHERE `cats`.`ID` = '$ID_cat'";
        mysqli_query($connect, $query);
        echo $query;
        $url = "/tomasina/pages/prof/cats";
        header('Location: '.$url);
      }
    }
    elseif (isset($_POST['do_create']))
    {
      if (!isset($_POST['confirm_create']))
      {
          $mode = 2;
      }
      else
      { 
        $name = $_POST['Кличка'];
        $age = $_POST['Возраст'];
        $date = $_POST['Дата_рождения'];
        $poroda = $_POST['Порода'];
        $pol = $_POST['Пол'];
        $okras = $_POST['Окрас'];
        $prim = $_POST['Особые_приметы'];
        $vet = $_POST['Адрес_ВетКлиники'];

        if (isset($_POST['chip']))
        {
          echo "CHIP";
          $chip = 1;
        }
        else
        {
          $chip = 0;
        }
        if (isset($_POST['vak']))
        {
          echo "VAK";
          $vak = 1;
        }
        else
        {
          $vak = 0;
        }
        if (isset($_POST['ster']))
        {
          echo "STER";
          $ster = 1;
        }
        else
        {
          $ster = 0;
        }
        if (isset($_POST['st']))
        {
          echo "ST";
          $st = 1;
        }
        else
        {
          $st = 0;
        }
        $query = "INSERT INTO `cats` (`Кличка`, `Возраст`, `Дата рождения`, `Порода`, `Пол`, `Окрас`, `Особые приметы`, `Чипирование`, `Стерилизация`, `Вакцинация`, `Адрес_ВетКлиники`, `Взят`) VALUES ('$name', '$age', '$date', '$poroda', '$pol', '$okras', '$prim', '$chip', '$ster', '$vak', '$vet', '$st')";
        mysqli_query($connect, $query);
        echo $query;
        $url = "/tomasina/pages/prof/cats";
        header('Location: '.$url);
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<title>Главная страница "Томасина"</title>
	<link rel="stylesheet" href="../style.css">
</head>
<body>
	
<?php include "moduls/mod_reg.php" ?>
<?php include "moduls/mod_log.php" ?>
<?php include "moduls/nav_menu.php" ?>

<div class="container-fluid background pt-5">
	<div class="row justify-content-center">
    <div class="col-lg-1 col-0"> </div>	
		<div class="row col-lg-10 col-12">
		<div class="col-md-4 col-12">
		<div class="col-12 content py-5 mb-5" id="col-left">
			<ul class="nav flex-column nav-left">
          <li class="nav-item">
            <div class="row nav-left-row">  
              <div class="col-lg-2 col-12"><p id="center-i"><img src="/tomasina/pic/sandglass.png" alt="" class="item-m"></p></div>
              <div class="col-lg-10 col-12"><a class="nav-link" href="/tomasina/pages/prof">Факты передачи кошек</a></div>
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
		<div class="col-md-7 offset-md-1 col-12 content mb-5">
			<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  				<ol class="breadcrumb">
    				<li class="breadcrumb-item" aria-current="page"><a href="#">Личный кабинет</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Котики под опекой</li>
  				</ol>
			</nav>
      <?php
      if ($mode == 1)
      {
      ?>
			<h2>Редактирование данных о котике</h2>
      <form action="" method="POST">
        <div class="row">
          <div class="mb-3 mt-4">
            <label for="exampleFormControlInput1" class="form-label">Кличка</label>
            <input name="Кличка" class="form-control" type="text" value="<?php echo $cat['Кличка']?>" aria-label="readonly input example" required>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Возраст (Полных лет)</label>
            <input name="Возраст" class="form-control" type="text" value="<?php echo $cat['Возраст']?>" aria-label="readonly input example" required>
          </div>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Дата рождения</label>
          <input name="Дата_рождения" class="form-control" type="text" value="<?php echo $cat['Дата рождения']?>" aria-label="readonly input example" required>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Порода</label>
          <input name="Порода" class="form-control" type="text" value="<?php echo $cat['Порода']?>" aria-label="readonly input example" required>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Пол</label>
          <input name="Пол" class="form-control" type="text" value="<?php echo $cat['Пол']?>" aria-label="readonly input example" required>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Окрас</label>
          <input name="Окрас" class="form-control" type="text" value="<?php echo $cat['Окрас']?>" aria-label="readonly input example" required>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Особые приметы</label>
          <input name="Особые_приметы" class="form-control" type="text" value="<?php echo $cat['Особые приметы']?>" aria-label="readonly input example" required>
        </div>
        <div class="mb-3">
          <input name="ster" class="form-check-input" type="checkbox" id="check-ster">
          <label class="form-check-label" for="flexCheckDefault">
            Стерилизован(-на)
          </label>
        </div>
        <div class="mb-3">
          <input name="chip" class="form-check-input" type="checkbox"  id="check-chip">
          <label class="form-check-label" for="flexCheckDefault">
            Чипирован(-на)
          </label>
        </div>
        <div class="mb-3">
          <input  name="vak" class="form-check-input" type="checkbox" id="check-vak">
          <label class="form-check-label" for="flexCheckDefault">
            Вакцинирован(-на)
          </label>
        </div>
        <div class="mb-3">
          <input  name="st" class="form-check-input" type="checkbox"  id="check-st">
          <label class="form-check-label" for="flexCheckDefault">
            Забрали
          </label>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Адрес ветиринарной клиники</label>
          <input name="Адрес_ВетКлиники" class="form-control" type="text" value="<?php echo $cat['Адрес_ВетКлиники']?>" aria-label="readonly input example" required>
        </div>
        <div class="row">
          <div class="mb-3 col-4 offset-4">
              <input type="hidden" name="ID_cat" value="<?php echo $ID_cat ?>">
              <input type="hidden" name="confirm_edit">
              <button type="submit" name="do_edit" class="btn btn-info mt-2" style="width: 100%">Подтвердить</button>
          </div> 
        </div>
      </form>
      <?php
      }
      elseif ($mode == 2)
      {
      ?>
      <h2>Создание записи о котике</h2>
      <form action="" method="POST">
        <div class="row">
          <div class="mb-3 mt-4">
            <label for="exampleFormControlInput1" class="form-label">Кличка</label>
            <input name="Кличка" class="form-control" type="text" aria-label="readonly input example" required>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Возраст (Полных лет)</label>
            <input name="Возраст" class="form-control" type="text" aria-label="readonly input example" required>
          </div>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Дата рождения</label>
          <input type="date" name="Дата_рождения" class="form-control" type="text" aria-label="readonly input example" required>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Порода</label>
          <input name="Порода" class="form-control" type="text" aria-label="readonly input example" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Пол</label>
          <select name="Пол" class="form-select" aria-label="Default select example" required>
            <option selected disabled>Выберите</option>
            <option value="м">м</option>
            <option value="ж">ж</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Окрас</label>
          <input name="Окрас" class="form-control" type="text" aria-label="readonly input example" required>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Особые приметы</label>
          <input name="Особые_приметы" class="form-control" type="text" aria-label="readonly input example" required>
        </div>
        <div class="mb-3">
          <input name="ster" class="form-check-input" type="checkbox" value="1">
          <label class="form-check-label" for="flexCheckDefault">
            Стерилизован(-на)
          </label>
        </div>
        <div class="mb-3">
          <input name="chip" class="form-check-input" type="checkbox" value="1">
          <label class="form-check-label" for="flexCheckDefault">
            Чипирован(-на)
          </label>
        </div>
        <div class="mb-3">
          <input  name="vak" class="form-check-input" type="checkbox" value="1">
          <label class="form-check-label" for="flexCheckDefault">
            Вакцинирован(-на)
          </label>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Адрес ветиринарной клиники</label>
          <input name="Адрес_ВетКлиники" class="form-control" type="text" aria-label="readonly input example" required>
        </div>
        <div class="mb-3">
          <input  name="st" class="form-check-input" type="checkbox" value="1">
          <label class="form-check-label" for="flexCheckDefault">
            Забрали
          </label>
        </div>
        <div class="row">
          <div class="mb-3 col-4 offset-4">
              <input type="hidden" name="confirm_create">
              <button type="submit" name="do_create" class="btn btn-info mt-2" style="width: 100%">Подтвердить</button>
          </div> 
        </div>
      </form>

      <?php
      }
      ?>
		</div>
	    <div class="col-1">	</div>
</div>
<div class="col-lg-1 col-0"> </div>
<?php include "moduls/footer.php" ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<script src="../jquery-3.6.0.min.js"></script>
	<script src="jq.js"></script>
  <script>
    <?php
    if ($cat['Чипирование'] == '1')
    {?>
      $('#check-chip').prop('checked', true);
    <?php
    }
    if ($cat['Стерилизация'] == '1')
    {?>
      $('#check-ster').prop('checked', true);
    <?php
    }
    if ($cat['Вакцинация'] == '1')
    {?>
      $('#check-vak').prop('checked', true);
    <?php
    }
    if ($cat['Взят'] == '1')
    {
    ?>
      $('#check-st').prop('checked', true);
    <?php
    }
    ?>
  </script>
</body>
</html>