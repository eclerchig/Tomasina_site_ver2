<?php 
include "includes/bd.php";
echo $_SESSION['id'];
$id = $_SESSION['id'];
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
		<div class="col-md-7 offset-md-1 col-12 content mb-5">
			<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  				<ol class="breadcrumb">
    				<li class="breadcrumb-item" aria-current="page"><a href="/tomasina/pages/prof">Личный кабинет</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Котики под опекой</li>
  				</ol>
			</nav>
			<h1>КОТИКИ, НАХОДЯЩИЕСЯ ПОД ВАШИМ УХОДОМ</h1>
      <?php 
          $rows = mysqli_query($connect, "SELECT * FROM `transmission` WHERE `ID_user` = '$id' AND `success` = '1' ORDER BY `date`");
          if  (empty($rows))
          {
            ?>
              <label>Вы не забрали ни одного котика :(</label>
          <?php
          }
          else
          {?>
          <table class="table table-success table-hover">
            <thead>
              <tr  class="t_title">
                <th scope="col">Дата</th>
                <th scope="col">Котик</th>
                <th scope="col">Пол</th>
                <th scope="col">Порода</th>
                <th scope="col">Работник</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($row = mysqli_fetch_assoc($rows)) {
                $id_cat = $row['ID_cat'];
                $cat = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `cats` WHERE `ID` = '$id_cat'")); 
                $id_worker = $row['ID_worker'];
                $worker = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `workers` WHERE `ID` = '$id_worker'"))
                ?>
                  <tr>
                    <th scope="row" class="t_title"><?php echo $row['date']?></th>
                    <td><a href="/tomasina/pages/aboutCat?id=<?php echo $id_cat;?>"><?php echo $cat['Кличка']?></a></td>
                    <td><?php echo $cat['Пол']?></td>
                    <td><?php echo $cat['Порода']?></td>
                    <td><?php echo $worker['ФИО']?></td>
                  </tr>
                <?php
              }
      ?>  
            </tbody>
          </table>
          <?php
              }
      ?>
      <div class="row justify-content-center mt-5">
                <div class="col-2"> </div>
                <div class="col-6">     
                   <a class="btn btn-info col-12" href="/tomasina/pages/cats/cats">Приобрести котика</a>
                </div>
                <div class="col-2"> </div>
		</div>
		</div>
	    <div class="col-1">	</div>
</div>
<div class="col-lg-1 col-0"> </div>
<?php include "moduls/footer.php" ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<script src="jquery-3.6.0.min.js"></script>
	<script src="jq.js"></script>
</body>
</html>