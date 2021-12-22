<?php 
include "includes/bd.php";
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
    <div class="col-1"> </div>	
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
		<div class="col-lg-7 col-12 offset-0 offset-lg-1  prof-content mb-5">
			<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  				<ol class="breadcrumb">
    				<li class="breadcrumb-item" aria-current="page"><a href="/tomasina/pages/prof">Личный кабинет</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Котики под опекой</li>
  				</ol>
			</nav>
			<h2>КОТИКИ, НАХОДЯЩИЕСЯ ПОД ВАШИМ УХОДОМ</h2>
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
          <table class="table table-success table-hover align-middle">
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
                $id_breed = $cat['IDПорода'];
                $id_worker = $row['ID_worker'];
                $worker = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `workers` WHERE `ID` = '$id_worker'"))
                ?>
                  <tr>
                    <th scope="row" class="t_title"><?php echo $row['date']?></th>
                    <td><a href="/tomasina/pages/aboutCat?id=<?php echo $id_cat;?>"><?php echo $cat['Кличка']?></a></td>
                    <td style="text-align: center"><?php echo $cat['Пол']?></td>
                    <td>
                    <?php 
                    $breed = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `breeds` WHERE `ID` = '$id_breed'")); 
                    echo $breed['Name']?>
                    </td>
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
      <?php 
        $rows = mysqli_query($connect, "SELECT * FROM `interviews` WHERE `ID_user`= $id AND `datetime` BETWEEN CAST(SUBDATE(NOW(), INTERVAL 4 MONTH) AS DATE) AND CAST(NOW() AS DATE) AND `accepted` = 1 AND `result` >= 7 ORDER BY `datetime`;");
        $nonaccepted = mysqli_query($connect, "SELECT * FROM `transmission` WHERE `ID_user`= $id AND `accepted` = 0 AND `success` = 0;");
        $accepted = mysqli_query($connect, "SELECT * FROM `transmission` WHERE `ID_user`= $id AND `accepted` = 1 AND `success` = 0;");
        $count = mysqli_num_rows($rows);
        $count2 = mysqli_num_rows($nonaccepted);
        $count3 = mysqli_num_rows($accepted);
        if ($count3 >= 1)
        {
            while ($row = mysqli_fetch_assoc($accepted))
            {
                $date = $row['date'];
                $id_cat = $row['ID_cat'];
                $cat = mysqli_fetch_assoc(mysqli_query($connect, "SELECT Кличка FROM `cats` WHERE `ID`= $id_cat"));
                $name = $cat['Кличка'];
                echo "<label>Дата и время получения котика <a href=\"/tomasina/pages/aboutCat?id=$id_cat\" style=\"color: #b722b9; font-weight: 500;\">$name</a>: $date</label>" ; 
            }
        }
        if  ($count < 1)
        {
          ?>
        <div class="alert alert-primary" role="alert">
          Пройденных актуальных собеседований нет. Для получения кошки запишитесь на <a href="/tomasina/pages/prof/interviews" style="color: #b722b9; font-weight: 500;">СОБЕСЕДОВАНИЕ</a>.       
        </div>
        <?php
        }
        elseif ($count2 < 1)
        {
         ?>
        <div class="row justify-content-center mt-5">
          <div class="col-2"> </div>
          <div class="col-6">     
            <a class="btn btn-info col-12" href="/tomasina/pages/cats/cats">Приобрести котика</a>
          </div>
          <div class="col-2"> </div>
		    </div>
      <?php }
      else
      { 
          $trans = mysqli_fetch_assoc($nonaccepted);
          $id_cat = $trans['ID_cat'];
          $cat = mysqli_fetch_assoc(mysqli_query($connect, "SELECT Кличка FROM `cats` WHERE `ID` = '$id_cat'"));
          $name = $cat['Кличка'];
        ?>
      <div class="alert alert-primary" role="alert">
      Ваше заявление на приобретение котика 
      <a style="color: #b722b9; font-weight: 500;" href="/tomasina/pages/aboutCat?id=<?php echo $id_cat?>"><?php echo mb_strtoupper($name)?></a> еще рассматривается. Вы не можете оформить новое заявление, не дождавшись обработки старого. 
      </div>   
      <?php
      } ?>
		  </div>
	    <div class="col-1">	</div>
</div>
<div class="col-1"> </div>
<?php include "moduls/footer.php" ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<script src="../../jquery-3.6.0.min.js"></script>
	<script src="../../jq.js"></script>
</body>
</html>