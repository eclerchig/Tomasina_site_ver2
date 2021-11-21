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
    $row = mysqli_fetch_assoc(mysqli_query($connect, $query)); //данные о пользователе

    $query = "SELECT * FROM `interviews` WHERE `ID_user`= $ID_user AND `datetime` BETWEEN CAST(SUBDATE(NOW(), INTERVAL 4 MONTH) AS DATE) AND CAST(NOW() AS DATE) ORDER BY `datetime`;"; //свежие собеседования от пользователя
    $rows = mysqli_query($connect, $query);
    $count = mysqli_num_rows($rows);

    if (empty($_GET["mode"]))
    {
        $query = "SELECT ID FROM `interviews` WHERE `ID_user`= $ID_user AND `accepted` = '0';"; //непринятые заявки от пользователя
        $currents = mysqli_query($connect, $query);
        if (!empty ($currents)) //если есть непринятые заявки
        {
            $current = mysqli_fetch_assoc($currents);
            $id_int = $current['ID']; //id текущего интервью
        } 
    }
    else
    {
        $query = "SELECT ID FROM `transmission` WHERE `ID_user`= $ID_user AND `accepted` = '0';"; //непринятые заявки от пользователя
        $currents = mysqli_query($connect, $query);
        if (!empty ($currents))
        {
            $current = mysqli_fetch_assoc($currents);
            $id_trans = $current['ID']; //id передачи
        } 
    }
   }

  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if (empty($_POST['mode']))
    {
      echo "Пустое";
      $int = $_POST['id_int'];
      if (isset($_POST["do_accept"]))
      {
        $date = $_POST['date'];
        $time = $_POST['time'];
        echo $date;
        echo $time;
        echo $int;
        $query = "UPDATE `interviews` SET `accepted` = '1', `datetime` = '$date {$time}:00'  WHERE `interviews`.`ID` = '$int'";
        mysqli_query($connect, $query);
      }
      elseif (isset($_POST["do_cancel"]))
      {
        echo $int;
        $query = "DELETE FROM `interviews` WHERE `ID` = $int";
        mysqli_query($connect, $query);
        echo "Удаление";
      }
    $url = '/tomasina/pages/prof/interviews';
    }
    else
    {
      echo "КОТИК";
      $transmission = $_POST['id_trans'];
      if (isset($_POST["do_accept"]))
      {
        $date = $_POST['date'];
        $time = $_POST['time'];
        echo $date;
        echo $time;
        echo $transmission;
        $query = "UPDATE `transmission` SET `accepted` = '1', `date` = '$date {$time}:00'  WHERE `transmission`.`ID` = '$transmission'";
        echo "<br>{$query}";
        mysqli_query($connect, $query);
      }
      elseif (isset($_POST["do_cancel"]))
      {
        echo $transmission;
        $query = "DELETE FROM `transmission` WHERE `ID` = $transmission";
        mysqli_query($connect, $query);
        echo "Удаление";
      }
    $url = '/tomasina/pages/prof';
    }
   header('Location: '.$url);
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
		<div class=" col-1">	</div>
		
		<div class="row col-10">
		<div class="col-4">
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
		<div class="col-7 offset-1 content pt-3 mb-5">
			<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  				<ol class="breadcrumb">
    				<li class="breadcrumb-item" aria-current="page"><a href="/tomasina/pages/prof">Личный кабинет</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Редактирование данных</li>
  				</ol>
			</nav>
			<h3>Информация о пользователе</h3><h3><?php echo ($row['surname'] ." ".$row['name']." ". $row['fathername'])?></h3>
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
          <h3>Результат последнего собеседования</h3>
          <?php
          if ($count < 1)
          {
              ?>
              <label style="color: red">Нет актуальных собеседований</label>
              <div class="row justify-content-center mt-4">
                      <?php
                      if (empty($mode)) {
                      ?>
                      <div class="col-2"> </div>
                          <div class="col-3">  
                                 <button type="button" data-bs-toggle="modal" data-bs-target="#do_accept" class="btn btn-info"style="width: 100%">Принять</button>   
                          </div>
                          <div class="col-3 offset-2"> 
                          <form method="POST" action="">  
                              <input name="id_int" value="<?php echo $id_int ?>" type="hidden">   
                              <button type="submit" name="do_cancel" class="btn btn-info" style="width: 100%">Отклонить</button>
                          </form>
                          </div>
                      <div class="col-2"> </div>
                      <?php 
                      }
                      else
                      {
                      ?>
                      <div class="col-3"> </div>
                      <div class="col-3"> 
                          <form method="POST" action="">  
                              <input name="id_trans" value="<?php echo $id_trans ?>" type="hidden">   
                              <button type="submit" name="do_cancel" class="btn btn-info" style="width: 100%">Отклонить</button>
                          </form>
                      </div>
                      <div class="col-3"> </div>
                      <?php 
                      }
                      ?>
              </div>
              <?php
          }
          else
          {
            $interview = mysqli_fetch_assoc($rows);
               ?>
                  <p>Дата собеседования: <?php echo  $interview['datetime']?></p>
                  <p>Итоговая оценка: <?php
                  if ($interview['result'] > 6)
                  { 
                    echo $interview['result']; 
                    if (empty($mode)) {
                    ?>
                    <div class="row justify-content-center mt-4">
                      <div class="col-3"> </div>
                          <div class="col-3">
                              <form method="POST" action=""> 
                                  <input name="id_int" value="<?php echo $id_int ?>" type="hidden">    
                                  <button type="submit" name="do_cancel" class="btn btn-info" style="width: 100%">Отклонить</button>
                              </form>
                          </div>
                      <div class="col-3"> </div>
                    </div>  
                    <?php
                    }
                    else
                    { ?>
                    <div class="row justify-content-center mt-4">
                    <div class="col-2"> </div>
                        <div class="col-3">  
                            <button type="button" data-bs-toggle="modal" data-bs-target="#do_accept" class="btn btn-info"style="width: 100%">Принять</button>   
                        </div>
                        <div class="col-3 offset-2"> 
                          <form method="POST" action="">
                            <input name="mode" value="1" type="hidden">  
                            <input name="id_int" value="<?php echo $id_int ?>" type="hidden">   
                            <button type="submit" name="do_cancel" class="btn btn-info" style="width: 100%">Отклонить</button>
                          </form>
                        </div>
                    <div class="col-2"> </div>
                    </div> 
                    <?php
                    }
                  }
                  else
                  {
                    echo ("Не пройдено"); 
                    if (empty($mode))
                    {
                    ?>
                    <div class="row justify-content-center mt-4">
                      <div class="col-2"> </div>
                          <div class="col-3">  
                                 <button type="button" data-bs-toggle="modal" data-bs-target="#do_accept" class="btn btn-info"style="width: 100%">Принять</button>   
                          </div>
                          <div class="col-3 offset-2"> 
                          <form method="POST" action="">   
                              <input name="id_int" value="<?php echo $id_int ?>" type="hidden">  
                              <button type="submit" name="do_cancel" class="btn btn-info" style="width: 100%">Отклонить</button>
                          </form>
                          </div>
                      <div class="col-2"> </div>      
                  </div>
                  <?php
                  }
                  else
                  {?>
                   <div class="row justify-content-center mt-4">
                      <div class="col-3"> </div>
                          <div class="col-3">
                              <form method="POST" action=""> 
                                  <input name="mode" value="1" type="hidden">
                                  <input name="id_trans" value="<?php echo $id_trans ?>" type="hidden">    
                                  <button type="submit" name="do_cancel" class="btn btn-info" style="width: 100%">Отклонить</button>
                              </form>
                          </div>
                      <div class="col-3"> </div>
                    </div>    
                  <?php
                  }
                  }    
                  ?></p><br>
              <?php
          }
          ?> 
    </div>
		</div>
	    <div class="col-1">	</div>
</div>

<!-- Модальное окно -->
<div class="modal fade" id="do_accept" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <?php
        if (empty($mode))
        {?>
            <h5 class="modal-title" id="exampleModalLabel"> Выбор даты и времени собеседования</h5>
        <?php
        }
        else
        {
        ?>
            <h5 class="modal-title" id="exampleModalLabel"> Выбор даты и времени получения котика</h5>
        <?php
        }
        ?>
      </div>
      <div class="modal-body">
      <form action="" method="POST">
          <label for="exampleDataList" class="form-label mt-1">Выберите дату</label>
          <input type="date" class="form-control" id="date" name="date" placeholder="Дата" required>
          <label for="exampleDataList" class="form-label mt-1 ">Выберите время</label>
          <select name="time" class="form-select" aria-label="Пример выбора по умолчанию" required>
              <option value="10:00">10:00</option>
              <option value="11:00">11:00</option>
              <option value="12:00">12:00</option>
              <option value="13:00">13:00</option>
              <option value="14:00">14:00</option>
              <option value="15:00">15:00</option>
              <option value="16:00">16:00</option>
              <option value="17:00">17:00</option>
              <option value="18:00">18:00</option>
              <option value="19:00">19:00</option>
              <option value="20:00">20:00</option>
          </select>
          <?php
          if (empty($mode))
          {
          ?>
          <input type="hidden" class="form-control"  name="id_int" value="<?php echo $id_int ?>" required>
          <?php
          }
          else
          {?>
          <input type="hidden" class="form-control"  name="id_trans" value="<?php echo $id_trans ?>" required>
          <input type="hidden" class="form-control"  name="mode" value="<?php echo $mode ?>" required>
          <?php
          }
          ?>
      </div>
      <div class="modal-footer">
        <button type="submit" name="do_accept" class="btn btn-primary">Подтвердить</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php include "moduls/footer.php" ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<script src="../../jquery-3.6.0.min.js"></script>
	<script src="../../jq.js"></script>
</body>
</html>