<?php 
include "includes/bd.php";
echo $_SESSION['id'];
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
		<div class="col-12 prof-content py-5 mb-5" id="col-left">
			<ul class="nav flex-column nav-left">
  				<li class="nav-item">
  					<div class="row nav-left-row">	
  						<div class="col-lg-2 col-12"><p id="center-i"><img src="/tomasina/pic/sandglass.png" alt="" class="item-m"></p></div>
  						<div class="col-lg-10 col-12"><a class="nav-link" href="/tomasina/pages/prof/sandglass">Факты передачи кошек</a></div>
  					</div> 				
  				</li>
  				<li class="nav-item">
  					<div class="row nav-left-row ">	
  						<div class="col-lg-2 col-12"><p id="center-i"><img src="/tomasina/pic/interview.png" alt="" class="item-m"></p></div>
  						<div class="col-lg-10 col-12"><a class="nav-link" href="/tomasina/pages/prof/interviews">Заявки на собеседования</a></div>
  					</div>
  				</li>
			</ul>
		</div>
		<div class="col-12"></div>
		</div>	
		<div class="col-7 offset-1 prof-content pt-3 mb-5">
			<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  				<ol class="breadcrumb">
    				<li class="breadcrumb-item" aria-current="page"><a href="/tomasina/pages/prof/edit">Личный кабинет</a></li>
  				</ol>
			</nav>
			<h1>ЛИЧНЫЕ ДАННЫЕ</h1>
			<div class="mb-3 mt-4">
			<label for="exampleFormControlInput1" class="form-label">Фамилия</label>
			<input class="form-control" type="text" placeholder="<?php echo $user['surname']?>" aria-label="readonly input example" readonly>
			</div>
			<div class="mb-3">
			<label for="exampleFormControlInput1" class="form-label">Имя</label>
			<input class="form-control" type="text" placeholder="<?php echo $user['name']?>" aria-label="readonly input example" readonly>
			</div>
			<div class="mb-3">
			<label for="exampleFormControlInput1" class="form-label">Отчество</label>
			<input class="form-control" type="text" placeholder="<?php echo $user['fathername']?>" aria-label="readonly input example" readonly>
			</div>
			<div class="mb-3">
			<label for="exampleFormControlInput1" class="form-label">Пол</label>
			<input class="form-control" type="text" placeholder="<?php echo $user['sex']?>" aria-label="readonly input example" readonly>
			</div>
			<div class="mb-3">
			<label for="exampleFormControlInput1" class="form-label">Возраст</label>
			<input class="form-control" type="text" placeholder="<?php echo $user['age']?>" aria-label="readonly input example" readonly>
			</div>
			<div class="mb-3">
			<label for="exampleFormControlInput1" class="form-label">Место работы</label>
			<input class="form-control" type="text" placeholder="<?php echo $user['work']?>" aria-label="readonly input example" readonly>
			</div>
			<div class="mb-3">
			<label for="exampleFormControlInput1" class="form-label">Номер телефона</label>
			<input class="form-control" type="text" placeholder="<?php echo $user['num_telephone']?>" aria-label="readonly input example" readonly>
			</div>
			<div class="mb-3">
			<label for="exampleFormControlInput1" class="form-label">Адрес проживания</label>
			<input class="form-control" type="text" placeholder="<?php echo $user['address']?>" aria-label="readonly input example" readonly>
			</div>
			<div class="mb-3">
			<label for="exampleFormControlInput1" class="form-label">Электронная почта</label>
			<input class="form-control" type="text" placeholder="<?php echo $user['email']?>" aria-label="readonly input example" readonly>
			</div>
			<div class="row justify-content-center">
				<div class="col-4">	</div>
				<div class="col-4">		
	    			<button type="button" class="btn btn-info" style="width: 100%">Изменить пароль</button>
	    		</div>
	    		<div class="col-4">	</div>		
	    	</div>
		</div>
		</div>
	    <div class="col-1">	</div>
</div>

<?php include "moduls/footer.php" ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<script src="../../jquery-3.6.0.min.js"></script>
	<script src="../../jq.js"></script>
</body>
</html>