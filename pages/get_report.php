<?php
require_once "./includes/bd.php";
$ID_user = $_SESSION['id'];
if (!isset($_POST['do_report3'])){
$data1 = $_POST['date1'];
$data2 = $_POST['date2'];}

$rowcats = array();
$rowvisits = array();
$dates = array();
$kol = array();
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
		<div class="col-11 prof-content p-5 mb-5 container">
            <?php
            if (isset($_POST["do_report1"]))
            {?>
                <h4 class="mt-4">Отчёт о переданных кошках за период с <?php echo $data1 ?> по <?php echo $data2 ?> (краткий)</h4>

                <?php
                    $query = "SELECT `date` FROM `transmission` WHERE `date` BETWEEN '$data1' AND '$data2' AND `success` = '1' ORDER BY `date`";
                   // echo $query;
                    $rows = mysqli_query($connect, $query);
                    $count = mysqli_num_rows($rows);
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
                              <th scope="col" style="text-align: center">Дата</th>
                              <th scope="col" style="text-align: center">Количество кошек</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($dates as $i => $date) {
                            ?>
                            <tr>
                                <td style="width: 40%; text-align: center"><?php echo $date ?></td>
                                <td style="width: 60%; text-align: right"><?php echo $kol[$i] ?></td>
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
            <h4 class="mt-3">Статистика передач кошек</h4>
            <canvas id="popChart1" width="auto" height="200"></canvas>
            <?php


            }?>

            <?php
            if (isset($_POST["do_report2"]))
            {?>
                <h4 class="mt-4">Отчёт о передачах кошек за период с <?php echo $data1 ?> по <?php echo $data2 ?> (подробный)</h4>

                <?php
                    $query = "SELECT * FROM `transmission` WHERE `date` BETWEEN '$data1' AND '$data2' AND `success` = '1' ORDER BY `date`";
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
                                      <th scope="col" style="text-align: center">Дата и время</th>
                                      <th scope="col" style="text-align: center">Кошка (кличка, возраст)</th>
                                      <th scope="col" style="text-align: center">ФИО пользователя</th>
                                      <th scope="col" style="text-align: center">ФИО работника</th>
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
                                            <td style="text-align: center"><?php echo $row['date'] ?></td>
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
            <?php
            if (isset($_POST["do_report3"]))
            {?>
                <h3 class="mt-2 mb-4">Отчёт о посещаемости страниц</h3>
                <table class="table table-bordered" style="width: 60%">
                    <thead>
                        <tr>
                            <th scope="col">Страница кошки</th>
                            <th scope="col">Количество визитов</th>
                            <th scope="col">Статус</th>
                        </tr>
                    </thead>
                <tbody>
                <?php
                    $query = "SELECT * FROM cats";
                    $rows = mysqli_query($connect, $query);
                    $cats = array();
                    $visits = array();
                    while ($row = mysqli_fetch_assoc($rows))
                    {  
                        $IDcat = $row['ID']; 
                        $cat = $row['Кличка'];
                        $visits = $row['visits'];
                        $status = $row['Взят'];
                    ?>
                    <tr>
                        <td style="width: 35%">
                        <a href="/tomasina/pages/aboutCat?id=<?php echo $IDcat?>"><?php echo $cat ?></a>
                        </td>
                        <td style="text-align: right; width: 40%"><?php echo $visits ?></td>
                        <td style="width: 25%"><?php if ($status == '1')
                        {
                            echo "Забрали";
                        }
                        else
                        {
                            echo "В приюте";
                        }

                         ?>
                             
                         </td>
                    </tr>
                <?php } ?>
                    </tbody>
                    </table>
                <?php 
                $query = "SELECT * FROM `cats` ORDER BY `visits` DESC  LIMIT 10";
                $rows = mysqli_query($connect, $query);
                while ($row = mysqli_fetch_assoc($rows))
                {
                    $rowcats[] = $row['Кличка'];
                    $rowvisits[] = $row['visits'];
                }    
                ?>    
                <h4 class="mt-3">ТОП-10 посещяемых страниц</h4>
                <canvas id="popChart" width="auto" height="200">
                    
                </canvas> <?php
                } ?>
	    </div>	
	 </div>	
</div>

<?php include "moduls/footer.php" ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.2/chart.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<script src="../../jquery-3.6.0.min.js"></script>
	<script src="../../jq.js"></script>
    <script>
    if ($('#popChart').length > 0) {
        var popCanvas = $("#popChart");
        var barChart = new Chart(popCanvas, {
            type: 'bar',
            data: {
            labels: <?=json_encode($rowcats);?>,
            datasets: [{
                label: 'Количество уникальных посещений, ед.',
                data: <?=json_encode(array_values($rowvisits));?>,
                options: {
                    legend: {
                        display: false,
                        position: 'bottom'
                    }
                },
                backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)'
            ]
    }]
  }
});     
    } 

    if ($('#popChart1').length > 0) {
        var popCanvas = $("#popChart1");
        var barChart = new Chart(popCanvas, {
            type: "line",
            data: {
            labels: <?=json_encode($dates);?>,
            datasets: [{
                label: 'Количество передач, ед.',
                backgroundColor: "rgba(0,0,0,1.0)",
                borderColor: "rgba(0,0,0,0.1)",
                data: <?=json_encode(array_values($kol));?>
            }]
        }
});
    }
    </script>
</body>
</html>