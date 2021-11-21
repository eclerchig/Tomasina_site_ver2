<?php
require_once "./includes/bd.php";
$ID_user = $_SESSION['id'];
?>

<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {  
    $data1 = $_POST['datebefore'];
    $data2 = $_POST['dateafter'];
    if (isset($_POST["do_report1"]))
    {
        
    }
    if (isset($_POST["do_report2"]))
    {
        
    }
  }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<title>О котике</title>
	<link rel="stylesheet" href="../../style.css">
</head>
<body>

<?php include "moduls/mod_reg.php" ?>
<?php include "moduls/mod_log.php" ?>
<?php include "moduls/nav_menu.php"?>

<div class="container-fluid background pt-5">
	<div class="row justify-content-center">	
		<div class="col-11 content p-5 mb-5 container">
            <?php
            if (isset($_POST["do_report1"]))
            {?>
                <h4 class="mt-4">Отчёт о переданных кошках за период с <?php echo $data1 ?> по <?php echo $data2 ?></h4>

                <?php
                    $query = "SELECT `date` FROM `transmission` WHERE `date` BETWEEN '$data1' AND '$data2' ORDER BY `date`";
                   // echo $query;
                    $rows = mysqli_query($connect, $query);
                    $count = mysqli_num_rows($rows);
                    $dates = array();
                    $kol = array();
                    if ($count < 1)
                    { ?>

                        <label> За данный период не было осуществлено передач кошек</label>

                    <?php    
                    }
                    else
                    {  
                        $sum = 0;
                        while ($row = mysqli_fetch_assoc($rows))
                        {
                
                        $check = 0;
                        foreach ($dates as $i => $date) {
                            $date1 = substr($date,0,10);
                            $date2 = substr($row['date'],0,10);
                            if ($date == $date2)
                            {
                                $kol[$i]++;
                                $check = 1;
                                $sum++;
                            }
                        }
                        if ($check == 0)
                        {
                            $dates[] = substr($row['date'],0,10);
                            $kol[] = 1;
                            $sum++;
                        }
                    }
                    ?>
                    <table class="table table-bordered" style="width: 40%">
                        <thead>
                            <tr>
                              <th scope="col">Дата</th>
                              <th scope="col">Количество кошек</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($dates as $i => $date) {
                            ?>
                            <tr>
                                <td style="width: 50%"><?php echo $date ?></td>
                                <td style="width: 50%"><?php echo $kol[$i] ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <label>Итого отданных кошек: <?php echo $sum ?></label>
                    <?php
                    }
                    ?>
            <?php
            }?>

            <?php
            if (isset($_POST["do_report2"]))
            {?>
                <h4 class="mt-4">Отчёт о фактах передачи кошек за период с <?php echo $data1 ?> по <?php echo $data2 ?></h4>

                <?php
                    $query = "SELECT * FROM `transmission` WHERE `date` BETWEEN '$data1' AND '$data2' ORDER BY `date`";
                    $rows = mysqli_query($connect, $query);
                    $count = mysqli_num_rows($rows);
                    if ($count < 1)
                    { ?>
                        <label> За данный период не было зафиксировано фактов передачи кошек</label>
                    <?php    
                    }
                    else
                    {  
                        ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                      <th scope="col">Дата и время</th>
                                      <th scope="col">Кошка (кличка, возраст)</th>
                                      <th scope="col">ФИО пользователя</th>
                                      <th scope="col">ФИО работника</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($rows))
                                    {
                                        $ID_user = $row['ID_user'];
                                        $query = "SELECT * FROM `users` WHERE `ID`='$ID_user'";
                                        $user = mysqli_fetch_assoc(mysqli_query($connect, $query));
                                        $ID_cat = $row['ID_cat'];
                                        $query = "SELECT * FROM `cats` WHERE `ID`='$ID_cat'";
                                        $cat = mysqli_fetch_assoc(mysqli_query($connect, $query));
                                        $ID_worker = $row['ID_worker'];
                                        $query = "SELECT `ФИО` FROM `workers` WHERE `ID`='$ID_worker'";
                                        $worker = mysqli_fetch_assoc(mysqli_query($connect, $query));
                                    ?>
                                        <tr>
                                            <td><?php echo $row['date'] ?></td>
                                            <td><?php echo "{$cat['Кличка']} {$cat['Возраст']} лет" ?></td>
                                            <td><?php echo "{$user['surname']} {$user['name']} {$user['fathername']}" ?></td>
                                            <td><?php echo $worker['ФИО'] ?></td>
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
            }?>
            
	    </div>	
	 </div>	
</div>

<?php include "moduls/footer.php" ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<script src="../jquery-3.6.0.min.js"></script>
	<script src="../jq.js"></script>
</body>
</html>