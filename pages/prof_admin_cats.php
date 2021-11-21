<?php 
include "includes/bd.php";
$id = $_SESSION['id'];
$mode_search = 0;
?>

<?php
 if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if (!empty($_POST['ID_cat']))
    {
      $mode_search = 1;
      $ID_cat = $_POST['ID_cat'];
      $cat = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `cats` WHERE `ID` = $ID_cat"));
    }
    if (isset($_POST['do_delete']))
    {
      $ID_cat = $_POST['ID_cat'];
      $query = "DELETE FROM `cats` WHERE `ID` = '$ID_cat'";
      mysqli_query($connect, $query);
      $url = "/tomasina/pages/prof/cats";
      header('Location: '.$url);
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
	<link rel="stylesheet" href="../../style.css">
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
    				<li class="breadcrumb-item" aria-current="page"><a href="/tomasina/pages/prof">Личный кабинет админа</a></li>
            <li class="breadcrumb-item active" aria-current="page">Котики в приюте</li>
  				</ol>
			</nav>
			<h1>Котики в приюте</h1>
      <h3 class="mt-3">Поиск кота</h3>
      <?php
      $rows = mysqli_query($connect, "SELECT * FROM `cats`");
      ?>
      <form action="" method="POST">
      <select name="ID_cat" class="form-select form-select-sm" aria-label=".form-select-sm">
        <option selected disabled>Выберите котика</option>
          <?php
          while ($row = mysqli_fetch_assoc($rows))
          { ?>
            <option value="<?php echo $row['ID'] ?>"><?php echo "{$row['Кличка']} Возраст: {$row['Возраст']} лет Окрас: {$row['Окрас']}" ?></option>
          
          <?php
          }
          ?>
      </select>
      <button type="submit" name="do_search" class="btn btn-info mt-2">Поиск</button>
      </form>
      <?php
      if ($mode_search == 1)
      { 
        ?>
        <h3 class="mt-3">Информация о котике</h3>
        
        <div class="row">
          <div class="mb-3 mt-4">
            <label for="exampleFormControlInput1" class="form-label">Кличка</label>
            <input class="form-control" type="text" placeholder="<?php echo $cat['Кличка']?>" aria-label="readonly input example" readonly>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Возраст</label>
            <input class="form-control" type="text" placeholder="<?php echo $cat['Возраст']?>" aria-label="readonly input example" readonly>
          </div>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Дата рождения</label>
          <input class="form-control" type="text" placeholder="<?php echo $cat['Дата рождения']?>" aria-label="readonly input example" readonly>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Порода</label>
          <input class="form-control" type="text" placeholder="<?php echo $cat['Порода']?>" aria-label="readonly input example" readonly>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Пол</label>
          <input class="form-control" type="text" placeholder="<?php echo $cat['Пол']?>" aria-label="readonly input example" readonly>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Окрас</label>
          <input class="form-control" type="text" placeholder="<?php echo $cat['Окрас']?>" aria-label="readonly input example" readonly>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Особые приметы</label>
          <input class="form-control" type="text" placeholder="<?php echo $cat['Особые приметы']?>" aria-label="readonly input example" readonly>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Чипирование</label>
          <input class="form-control" type="text" placeholder="<?php
          if ($cat['Чипирование'] == 1)
          {
           echo "Есть";
          }
          else
          {
           echo "Нет";
          } ?>
          "aria-label="readonly input example" readonly>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Стерилизация</label>
          <input class="form-control" type="text" placeholder="<?php if ($cat['Стерилизация'] == 1)
          {
           echo "Есть";
          }
          else
          {
           echo "Нет";
          } ?>
          "aria-label="readonly input example" readonly>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Вакцинация</label>
          <input class="form-control" type="text" placeholder="<?php if ($cat['Вакцинация'] == 1)
          {
           echo "Есть";
          }
          else
          {
           echo "Нет";
          } ?>
          "aria-label="readonly input example" readonly>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Адрес ветиринарной клиники</label>
          <input class="form-control" type="text" placeholder="<?php echo $cat['Адрес_ВетКлиники']?>" aria-label="readonly input example" readonly>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Статус</label>
          <input class="form-control" type="text" placeholder="<?php if ($cat['Взят'] == 1)
          {
           echo "Забрали";
          }
          else
          {
           echo "Находится в приюте";
          } ?>
          "aria-label="readonly input example" readonly>
        </div>
        <div class="row">
          <div class="mb-3 col-4 offset-2">
            <form action="" method="POST">
              <input type="hidden" name="ID_cat" value="<?php echo $cat['ID'] ?>">
              <button type="submit" name="do_delete" class="btn btn-info mt-2" style="width: 100%">Удалить</button>
            </form>
          </div>
          <div class="mb-3 col-4 offsets ">
            <form action="/tomasina/pages/get_cat_data" method="POST">
              <input type="hidden" name="ID_cat" value="<?php echo $cat['ID'] ?>">
              <button type="submit" name="do_edit" class="btn btn-info mt-2" style="width: 100%">Редактировать</button>
            </form>
          </div>
        </div>  
      <?php
      }
      ?>
      <div class="row">
        <div class="mb-3 col-4 offset-4">
            <form action="/tomasina/pages/get_cat_data" method="POST">
              <input type="hidden" name="do_create">
              <button type="submit" name="do_create" class="btn btn-info mt-2" style="width: 100%">Создать запись</button>
            </form>
        </div> 
      </div>
		</div>
	    <div class="col-1">	</div>
</div>
<div class="col-lg-1 col-0"> </div>
<?php include "moduls/footer.php" ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<script src="../../jquery-3.6.0.min.js"></script>
	<script src="../../jq.js"></script>
</body>
</html>