
<?php
function genCatCard($data){
	$id = $data['ID'];
	$name = $data['Кличка'];
	$path = $data['ПутьДоКартинки'];
	$example = "<li><a href=\"/tomasina/pages/aboutCat?id=$id\"><img src=\"/tomasina/pic/cats/$path\"><div style=\"height: 50px!important\"> ♡ ".mb_strtoupper($name)." ♡ </div></a></li>;";
	// $example = "<div class=\"col\"><div class=\"p-3 border bg-light card card-catalog\"><img src=\"/tomasina/pic/cats/$path\" class=\"card-img-top\" height=\"300px\" alt=\"...\"><div class=\"card-body text-center\"><a class=\"btn btn-info btn-lg\" href=\"/tomasina/pages/aboutCat?id=$id\">$name</a></div></div></div>";
	echo $example; 
}
require_once "./includes/bd.php";
$sql = "SELECT * FROM `cats` WHERE `Взят` = 0";
if((isset($_GET['sex']) && $_GET['sex'] != "") || isset($_GET['cheeped']) || isset($_GET['steril']) || isset($_GET['vacian']) || (isset($_GET['breed'])&& ($_GET['breed'] != "no")) || (isset($_GET['color'])&& ($_GET['color'] != "no")))
{
	$sql = $sql . " and ";
}
if(isset($_GET['sex']) && $_GET['sex'] != ""){
	$sql = $sql . "`Пол` = " . "'". $_GET['sex'] ."'";
	if(isset($_GET['cheeped']) || isset($_GET['steril']) || isset($_GET['vacian'])){
		$sql = $sql . " and ";
	}
}
if(isset($_GET['cheeped'])){
	$sql = $sql . " `Чипирование` = 1 ";
	if(isset($_GET['steril']) || isset($_GET['vacian'])){
		$sql = $sql . " and ";
	}
}
if(isset($_GET['steril'])){
	$sql = $sql . " `Стерилизация` = 1 ";
	if(isset($_GET['vacian'])){
		$sql = $sql . " and ";
	}
}
if(isset($_GET['vacian'])){
	$sql = $sql . " `Вакцинация` = 1 ";
	if(isset($_GET['breed']) && ($_GET['breed'] != "no")){
		$sql = $sql . " and ";
	}
}
if(isset($_GET['breed']) && ($_GET['breed'] != "no")){
	$sql = $sql . " `IDПорода` =".$_GET['breed'];
	if(isset($_GET['color']) && ($_GET['color'] != "no")){
		$sql = $sql . " and ";
	}
}
if(isset($_GET['color']) && ($_GET['color'] != "no")){
	$sql = $sql . " `IDОкрас` =".$_GET['color'];
}

mysqli_set_charset($connect, "utf8mb4");
$select = mysqli_query($connect, $sql);
?>
<!DOCTYPE html>
<html lang="ru">
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
<?php include "moduls/nav_menu.php"?>

<div class="container-fluid background pt-5">
	<div class="row justify-content-center">	
		<div class="col-11 prof-content pt-5 mb-5">
		<div class="row justify-content-center">
		<div class="col-3">
		<h3>Фильтры</h3>
		<form method="get" name="form">
			<label>Пол</label>
			<div class="form-check mt-1 pt-1 point-filter">
  				<input class="form-check-input" type="radio" name="sex" value="м" id="flexRadioDefault1" 
				  <?php
				  if(isset($_GET['sex']) && $_GET['sex'] == "м"){
					  echo "checked";
				  }
				  ?>>
  				<label class="form-check-label" for="flexRadioDefault1">Кот</label>
			</div>
			<div class="form-check">
  				<input class="form-check-input" type="radio" name="sex" value="ж" id="flexRadioDefault2" <?php
				  if(isset($_GET['sex']) && $_GET['sex'] == "ж"){
					  echo "checked";
				  }
				  ?>>
  				<label class="form-check-label" for="flexRadioDefault2">Кошка</label>
			</div>
			<div class="form-check">
  				<input class="form-check-input" type="radio" name="sex" value="" id="flexRadioDefault2" <?php
				  if((isset($_GET['sex']) && $_GET['sex'] == "") || !isset($_GET['sex'])){
					  echo "checked";
				  }
				  ?>>
  				<label class="form-check-label" for="flexRadioDefault2">Не важно</label >
			</div>
			<label for="exampleDataList" class="form-label mt-2">Порода</label>
			<select name="breed" class="form-select" required>
              <option 
              <?php if (isset($_GET['breed'])&&($_GET['breed'] == "")||(!isset($_GET['breed']))) echo " selected " ?>
               value="no">Выберите</option>
              <?php 
              $breeds = mysqli_query($connect, "SELECT * FROM breeds");
              for($i = 0; $i < mysqli_num_rows($breeds); $i++)
              {
                $breed = mysqli_fetch_assoc($breeds);
                if (isset ($_GET['breed'])&&($_GET['breed'] == $breed['ID']))
                {
                	echo "<option selected value=".$breed['ID'].">".$breed['Name']."</option>";
            	}
            	else
            	{
            		echo "<option value=".$breed['ID'].">".$breed['Name']."</option>";
            	}
              }; 
              ?>
            </select>
			<label for="exampleDataList" class="form-label mt-2">Окрас</label> 
				<select name="color" class="form-select" required>
	              <option 
	              <?php if (isset ($_GET['color'])&&($_GET['color'] == "")||(!isset($_GET['color']))) echo " selected " ?>
	               value="no">Выберите</option>
	              <?php 
	              $colors = mysqli_query($connect, "SELECT * FROM coatcolor");
	              for($i = 0; $i < mysqli_num_rows($colors); $i++)
	              {
	                $color = mysqli_fetch_assoc($colors);
	                if (isset ($_GET['color'])&&($_GET['color'] == $color['ID']))
                	{
                		echo "<option selected value=".$color['ID'].">".$color['Name']."</option>";
            		}
            		else
            		{
            			echo "<option value=".$color['ID'].">".$color['Name']."</option>";
            		}
	              }; 
	              ?>
	            </select>
			<label for="exampleDataList" class="form-label mt-2">Особенности</label>
			<div class="form-check pt-2 point-filter no_pad">
				<div class="form-check">
  				<input class="form-check-input" name="cheeped" type="checkbox" value="" id="flexCheckChip" <?php
				  if(isset($_GET['cheeped'])){
					  echo "checked";
				  }
				  ?>>
  				<label class="form-check-label"  for="flexCheckChip">Чипирован(-а)</label>
  				</div>

  				<div class="form-check">
  				<input class="form-check-input" name="steril" type="checkbox" value="" id="flexCheckSt" <?php
				  if(isset($_GET['steril'])){
					  echo "checked";
				  }
				  ?>>
  				<label class="form-check-label"  for="flexCheckDSt">Стерилизован(-а)</label>
  				</div>

  				<div class="form-check">
  				<input class="form-check-input" name="vacian" type="checkbox" value="" id="flexCheckV" <?php
				  if(isset($_GET['vacian'])){
					  echo "checked";
				  }
				  ?>>
  				<label class="form-check-label"  for="flexCheckV">Вакцинирован(-а)</label>
  				</div>
			</div>
			<div class="row justify-content-center mt-2">     
            	<button type="submit" class="btn btn-secondary btn-sm">Найти</button>
          	</div>
		</form>
		</div>
		<div class="col-9" style="padding-left: 20px">
			<h1 style="padding-left: 6%">КОТЫ И КОШКИ</h1>
			<div class="container overflow-hidden mt-4">
				<div class="col" id="wrap">
		        <ul id="gallery">
		        	<?php
					  if(mysqli_num_rows($select) < 1){
						  echo "<p><h2>Извините, таких котиков нет!</h2></p>";
					  }
					  for($i = 0; $i < mysqli_num_rows($select); $i++){
						$res = mysqli_fetch_assoc($select);
						genCatCard($res);
					  } 
					  ?>
		        </ul>
  				<!-- <div class="row row-cols-2 row-cols-lg-3 g-2 g-lg-3">
  				</div> -->
			</div>
		</div>
		</div>
	    </div>	
	 </div>	
</div>
<?php include "moduls/footer.php" ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<script src="../../jquery-3.6.0.min.js"></script>
	<script src="../../jq.js"></script>
</body>
</html>