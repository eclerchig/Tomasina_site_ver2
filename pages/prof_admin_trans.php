<?php 
include "includes/bd.php";
$id = $_SESSION['id'];
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
	<link rel="stylesheet" href="../style.css">
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
		<div class="col-12"></div>
		</div>	
		<div class="col-md-7 offset-md-1 col-12 content mb-5">
			<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  				<ol class="breadcrumb">
    				<li class="breadcrumb-item" aria-current="page"><a href="/tomasina/pages/prof">Личный кабинет админа</a></li>
    				<li class="breadcrumb-item active" aria-current="page">Передачи кошек</li>
  				</ol>
			</nav>
			<h2>Заявки на получение котика</h2>
			<?php 
          		$rows = mysqli_query($connect, "SELECT * FROM `transmission` WHERE `accepted` = '0' ORDER BY `ID`");
          		$count = mysqli_num_rows($rows);
          		if  ($count < 1)
          		{
            	?>
              		<label>Нет необработанных заявок</label>
          		<?php
          		}
          		else
          		{?>
            		<table class="table table-success table-hover mt-3 interviews">
              		<thead>
                		<tr class="t_title">
                  			<th scope="col">Пользователь</th>
                  			<th scope="col">Котик</th>
                		</tr>
              		</thead>
              		<tbody>
                <?php
                while ($row = mysqli_fetch_assoc($rows)) { ?>
                 	<tr> 
                  	<?php
                   		$ID_user = $row['ID_user'];
                   		$user = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `users` WHERE `ID` = '$ID_user'"));
                   		$ID_cat = $row['ID_cat'];
                   		$cat = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `cats` WHERE `ID` = '$ID_cat'"));
                   	?>
                  <td><a href="/tomasina/pages/prof/getUserData?id=<?php echo $ID_user?>&mode=1"><?php echo $user['surname'].' '.$user['name'].' '.$user['fathername']?></a></td>
                  <td><a href="/tomasina/pages/aboutCat?id=<?php echo $ID_cat?>"><?php echo $cat['Кличка']?></a></td>  
                </tr>
                <?php } 
                ?>
              </tbody>
            </table>
          <?php }?>
          	<h2>Подтвердить передачу котика</h2>
          	<?php 
          		$rows = mysqli_query($connect, "SELECT * FROM `transmission` WHERE `accepted` = '1' AND `success` = '0' ORDER BY `ID`");
          		$count = mysqli_num_rows($rows);
          		if  ($count < 1)
          		{
            	?>
              		<label>Нет неподтвержденных передач</label>
          		<?php
          		}
          		else
          		{?>
            		<table class="table table-success table-hover mt-3 interviews">
              		<thead>
                		<tr class="t_title">
                			<th scope="col">Дата</th>
                  			<th scope="col">Пользователь</th>
                  			<th scope="col">Котик</th>
                		</tr>
              		</thead>
              		<tbody>
                <?php
                while ($row = mysqli_fetch_assoc($rows)) { ?>
                 	<tr> 
                  	<?php
                   		$ID_user = $row['ID_user'];
                   		$user = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `users` WHERE `ID` = '$ID_user'"));
                   		$ID_cat = $row['ID_cat'];
                   		$cat = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `cats` WHERE `ID` = '$ID_cat'"));
                   	?>
                  <td><?php echo $row['date'] ?></td>
                  <td><a href="/tomasina/pages/prof/getUserDataResult?id=<?php echo $ID_user?>&mode=1"><?php echo $user['surname'].' '.$user['name'].' '.$user['fathername']?></a></td>
                  <td><a href="/tomasina/pages/aboutCat?id=<?php echo $ID_cat?>"><?php echo $cat['Кличка']?></a></td>  
                </tr>
                <?php } 
                ?>
              </tbody>
            </table>
          <?php }?>
			<h2>Успешные передачи котиков</h2>
			<?php 
          		$rows = mysqli_query($connect, "SELECT * FROM `transmission` WHERE `accepted` = '1' AND `success` = '1' ORDER BY `date`");
          		$count = mysqli_num_rows($rows);
          		if  ($count < 1)
          		{
            	?>
              		<label>Нет выполненных передач</label>
          		<?php
          		}
          		else
          		{?>
            		<table class="table table-success table-hover mt-3 interviews">
              		<thead>
                		<tr class="t_title">
                			<th scope="col">Дата</th>
                  			<th scope="col">Пользователь</th>
                  			<th scope="col">Котик</th>
                  			<th scope="col">Работник</th>
                		</tr>
              		</thead>
              		<tbody>
                <?php
                while ($row = mysqli_fetch_assoc($rows)) { ?>
                 	<tr> 
                  	<?php
                   		$ID_user = $row['ID_user'];
                   		$user = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `users` WHERE `ID` = '$ID_user'"));
                   		$ID_cat = $row['ID_cat'];
                   		$cat = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `cats` WHERE `ID` = '$ID_cat'"));
                   		$ID_worker = $row['ID_worker'];
                   		$worker = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `workers` WHERE `ID` = '$ID_worker'"));
                   	?>
                  <td><?php echo $row['date'] ?></td>
                  <td><?php echo $user['surname'].' '.$user['name'].' '.$user['fathername']?></td>
                  <td><a href="/tomasina/pages/aboutCat?id=<?php echo $ID_cat?>"><?php echo $cat['Кличка']?></a></td>
                  <td><?php echo $worker['ФИО']?></td>   
                </tr>
                <?php } 
                ?>
              </tbody>
            </table>
          <?php }?>

      <h2>Отчёты</h2>

      <h4 class="mt-4">Отчёт о переданных кошках за определенный период</h4>
      <form action="/tomasina/pages/prof/report" method="POST">
        <h5>Период</h5>
        <div class="row g-3">
          <div class="col">
            c   <input type="date" class="form-control" name="datebefore" required>
          </div>
          <div class="col">
            по  <input type="date" class="form-control" name="dateafter" required>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-4"></div>
          <div class="col-4">
          <button type="submit" name="do_report1" class="btn btn-primary" style="width: 100%">Сформировать отчёт</button>
          </div>
          <div class="col-4"></div>
        </div>
      </form>

      <h4 class="mt-4">Отчёт о переданных кошках за определенный период</h4>
      <form action="/tomasina/pages/prof/report" method="POST">
        <h5>Период</h5>
        <div class="row g-3">
          <div class="col">
            c   <input type="date" class="form-control" id="date" name="datebefore" placeholder="" required>
          </div>
          <div class="col">
            по  <input type="date" class="form-control" id="date" name="dateafter" placeholder="" required>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-4"></div>
          <div class="col-4">
          <button type="submit" name="do_report2" class="btn btn-primary" style="width: 100%">Сформировать отчёт</button>
          </div>
          <div class="col-4"></div>
        </div>
      </form>
		</div>
		</div>
	    <div class="col-1">	</div>
</div>

<?php include "moduls/footer.php" ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<script src="../jquery-3.6.0.min.js"></script>
	<script src="../jq.js"></script>
</body>
</html>