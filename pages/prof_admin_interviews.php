<?php  
include "includes/bd.php";
$id = $_SESSION['id'];
?>

<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST["do_interview"]))
  {
    $query = "SELECT * FROM `interviews` WHERE ID_user='$id' AND accepted='0';";
    $rows = mysqli_query($connect,$query);
    $count = mysqli_num_rows($rows);
    if ($count < 1)
    {
       $query = "INSERT INTO `interviews` (ID_user) VALUES ('$id');";
        mysqli_query($connect, $query);
    $connect->close();
   }
}?>

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
		<div class="col-lg-7 col-12 offset-0 offset-lg-1 prof-content mb-5">
      <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="/tomasina/pages/prof">Личный кабинет админа</a></li>
            <li class="breadcrumb-item active" aria-current="page">Заявки на собеседования</li>
          </ol>
      </nav>
			<h2>Заявки на собеседования</h2>
      <?php 
          $rows = mysqli_query($connect, "SELECT * FROM `interviews` WHERE `accepted` = '0' ORDER BY `ID`");
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
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($rows)) { ?>
                 <tr> 
                  <?php
                   $ID_user = $row['ID_user'];
                   $user = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `users` WHERE `ID` = '$ID_user'"));
                   ?>
                  <td><a href="/tomasina/pages/prof/getUserData?id=<?php echo $ID_user?>" class="info_user"><?php echo $user['surname'].' '.$user['name'].' '.$user['fathername']?></a></td>  
                </tr>
                <?php } 
                ?>
              </tbody>
            </table>
          <?php }?>
          <h2 class="mt-3">Необходимо проставить результаты</h2>
          <?php 
          $rows = mysqli_query($connect, "SELECT * FROM `interviews` WHERE `accepted` = '1' AND `result` = 0 ORDER BY `datetime`");
          $count = mysqli_num_rows($rows);
          if  ($count < 1)
          {
            ?>
              <label>Нет собеседований, которые требуют оценки</label>
          <?php
          }
          else
          {?>
            <table class="table table-success table-hover mt-3 interviews">
              <thead>
                <tr class="t_title">
                  <th scope="col">Пользователь</th>
                  <th scope="col">Дата собеседования</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($rows)) { ?>
                 <tr> 
                  <?php
                   $ID_user = $row['ID_user'];
                   $user = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `users` WHERE `ID` = '$ID_user'"));
                   ?>
                  <td><a href="/tomasina/pages/prof/getUserDataResult?id=<?php echo $ID_user?>" class="info_user">
                    <?php echo $user['surname'].' '.$user['name'].' '.$user['fathername']?></a></td>
                  <td> <?php echo $row['datetime']; ?> </td>  
                </tr>
                <?php } 
                ?>
              </tbody>
            </table>
          <?php }?>
		</div>
</div>
<div class="col-1"> </div>

<?php include "moduls/footer.php" ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<script src="../../jquery-3.6.0.min.js"></script>
  <script>
    $('a.info_user').click(function() {
      var i = $(this).attr('id');
      $.ajax({ 
      url: "/tomasina/pages/prof/getUserData", 
      method: "POST", // Что бы воспользоваться POST методом, меняем данную строку на POST   
      data: {"id": i},
      success: function(data) {
        console.log(i); // Возвращаемые данные выводим в консоль
        } 
      });
    });
</script> 

<script src="../../jq.js"></script>
</body>
</html>
