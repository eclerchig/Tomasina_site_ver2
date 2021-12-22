
<?php
require_once "./includes/bd.php";
$id = $_GET['id']; //через метод get получем id кота через ссылку 
if (!empty($_SESSION['auth'])) {
    $ID_user = $_SESSION['id'];
}
$sql = "SELECT * FROM `cats` WHERE `ID` = $id";
mysqli_set_charset($connect, "utf8mb4");
$select = mysqli_query($connect, $sql);
$cat = mysqli_fetch_assoc($select);
$breed = mysqli_fetch_assoc(mysqli_query($connect,"SELECT Name FROM breeds join cats ON breeds.ID = cats.IDПорода WHERE cats.ID = $id"));
$color = mysqli_fetch_assoc(mysqli_query($connect,"SELECT Name FROM coatcolor join cats ON coatcolor.ID = cats.IDОкрас WHERE cats.ID = $id"));

//считаем уникальные посещения страницы
$visitor_ip = $_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d");
$res = mysqli_query($connect, "SELECT `ID_ip` FROM `ips` WHERE `date_visit`='$date' AND ID_cat='$id'");
if (mysqli_num_rows($res) == 0)
{
    // Очищаем таблицу ips
    mysqli_query($connect, "DELETE FROM `ips` WHERE ID_cat='$id'");
}
$current_ip = mysqli_query($connect, "SELECT `ID_ip` FROM `ips` WHERE `ip_address`='$visitor_ip' AND ID_cat='$id' ");
if (mysqli_num_rows($current_ip) == 0)
{
     // Заносим в базу IP-адрес этого посетителя
    mysqli_query($connect, "INSERT INTO `ips` SET `ip_address`='$visitor_ip', `date_visit`='$date',`ID_cat`='$id'");

        // Добавляем в базу +1 уникального посетителя (хост) и +1 просмотр (хит)
    mysqli_query($connect, "UPDATE `cats` SET `visits`=`visits`+1 WHERE `ID`='$id'");
}
?>

<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST["do_order_cat"])) //заявление на получение кошки
  {
    $query = "SELECT * FROM `transmission` WHERE ID_user='$ID_user' AND accepted='0';";
    echo $query;
    $rows = mysqli_query($connect,$query);
    $count = mysqli_num_rows($rows);
    if ($count < 1)
    {
       $query = "INSERT INTO `transmission` (`ID_user`, `ID_cat`) VALUES ('$ID_user','$id');";
        mysqli_query($connect, $query);
   }
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>О котике <?php
    
    ?></title>
	<link rel="stylesheet" href="../style.css">
    <script type="text/javascript" id="www-widgetapi-script" src="https://www.youtube.com/s/player/4c89207b/www-widgetapi.vflset/www-widgetapi.js" async=""></script>
    <script src="../moduls/carouselengine/froogaloop2.min.js"></script>
    <script src="../moduls/carouselengine/jquery.js"></script>
    <script src="../moduls/carouselengine/amazingcarousel.js"></script>
    <link rel="stylesheet" type="text/css" href="../moduls/carouselengine/initcarousel-1.css">
    <script src="../moduls/carouselengine/initcarousel-1.js"></script>
</head>
<body>

<?php include "moduls/mod_reg.php" ?>
<?php include "moduls/mod_log.php" ?>
<?php include "moduls/nav_menu.php"?>

<div class="container-fluid background pt-5">
	<div class="row justify-content-center">	
		<div class="col-11 content p-5 mb-5 container" id="pageCat" >
            <div class="row mb-3">
                <div class="col-1"></div>
                <div class="col" id="divNameCat">
                    <h1 id="nameCat"><?php
                    if($cat['Пол'] == "м"){
                    echo "Кот " . $cat['Кличка'];
                    }else{
                    echo "Кошка " . $cat['Кличка'];
                    }
                ?></h1>
                </div>
                <div class="col-1"></div>
            </div>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-4">
                    <img id="avatar_cat" class="col-3" src="/tomasina/pic/cats/<?php
                    echo $cat['ПутьДоКартинки'];
                ?>" width="256">
                </div>
                <div class="col">
                <ul class="list-group list-group-flush ">
                    <li class="list-group-item"><span>Кличка:</span> <?php
                    echo  $cat['Кличка'];
                ?></li>
                    <li class="list-group-item"><span>Возраст:</span> <?php
                    $age = $cat['Возраст'];
                    if($age == 1 || ($age % 10) == 1){
                        echo  $cat['Возраст'] . " год";
                    }elseif($age < 5 || ($age % 10) > 1 && ($age % 10) < 5){
                        echo  $cat['Возраст'] . " годa";
                    }else{
                        echo  $cat['Возраст'] . " лет";
                    }
                ?></li>
                    <li class="list-group-item"><span>Дата рождения:</span> <?php
                    echo  $cat['Дата рождения'];
                ?></li>
                    <li class="list-group-item"><span>Порода:</span> <?php
                    echo  $breed['Name'];
                ?></li>
                    <li class="list-group-item"><span>Пол:</span> <?php
                    if($cat['Пол'] == "м"){
                        echo "Кот";
                    }else{
                        echo "Кошка";
                    }
                ?></li>
                    <li class="list-group-item"><span>Окрас:</span> <?php
                    echo  $color['Name'];
                ?></li>
                    <li class="list-group-item"><span>Чипирование:</span> <?php
                    if($cat['Чипирование'] == 1){
                        echo "Есть";
                    }else{
                        echo "Нету";
                    }
                ?></li>
                    <li class="list-group-item"><span>Стерилизация:</span> <?php
                    if($cat['Стерилизация'] == 1){
                        echo "Есть";
                    }else{
                        echo "Нету";
                    }
                ?></li>
                    <li class="list-group-item"><span>Вакцинация:</span> <?php
                    if($cat['Вакцинация'] == 1){
                        echo "Есть";
                    }else{
                        echo "Нету";
                    }
                ?></li>
                    <li class="list-group-item"><span>Адрес вет-клиники:</span> <?php
                    echo  $cat['Адрес_ВетКлиники'];
                ?></li>
                    <li class="list-group-item"><span>Особые приметы:</span> <?php
                    echo  $cat['Особые приметы'];
                ?></li>
                </ul>
                </div>
                <div class="col-1"></div>
            </div>
            
            <?php include "moduls/carusel.php"?>

            <?php
            if (isset($_SESSION['status']))
            {
              if ($_SESSION['status'] == '2') {
            ?>

            <?php 
                $rows = mysqli_query($connect, "SELECT * FROM `interviews` WHERE `ID_user`= $ID_user AND `datetime` BETWEEN CAST(SUBDATE(NOW(), INTERVAL 4 MONTH) AS DATE) AND CAST(NOW() AS DATE) AND `accepted` = 1 AND `result` >= 7 ORDER BY `datetime`;");
                $count = mysqli_num_rows($rows);
                $query = "SELECT * FROM `transmission` WHERE `ID_user`= $ID_user AND `accepted` = 0 AND `success` = 0";
                $catsrow = mysqli_query($connect, $query);
                $count2 = mysqli_num_rows($catsrow);
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
            <div class="d-flex mt-3 justify-content-center">
                <a data-bs-toggle="modal" data-bs-target="#order_cat" href="#" class="btn btn-primary btn-lg" tabindex="-1" role="button" aria-disabled="true">Взять котика!</a>
            </div>
      <?php } ?>
            <?php
            }
            }
            ?>
	    </div>	
	 </div>	
</div>

<div class="modal fade" id="order_cat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        С вами в течение дня свяжется оператор.
      </div>
      <div class="modal-footer">
        <form action="" method="POST">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>
          <button type="submit" name="do_order_cat" class="btn btn-primary">Хорошо</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include "moduls/footer.php" ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<script src="../jq.js"></script> 
</body>
</html>