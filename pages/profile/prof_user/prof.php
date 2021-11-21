<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<title>Главная страница "Томасина"</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	
<?php include "../moduls/mod_reg.php" ?>

<div class="container-fluid background pt-5">
	<div class="row justify-content-center">	
		<div class=" col-1">	</div>
		
		<div class="row col-10">
		<div class="col-4">
		<div class="col-12 content py-5 mb-5" id="col-left">
			<ul class="nav flex-column nav-left">
  				<li class="nav-item">
  					<div class="row nav-left-row">	
  						<div class="col-lg-2 col-12"><p id="center-i"><img src="pic/settings.png" alt="" class="item-m"></p></div>
  						<div class="col-lg-10 col-12"><a class="nav-link" href="#">Редактировать профиль</a></div>
  					</div>
  					
    				
  				</li>
  				<li class="nav-item">
  					<div class="row nav-left-row ">	
  						<div class="col-lg-2 col-12"><p id="center-i"><img src="pic/interview.png" alt="" class="item-m"></p></div>
  						<div class="col-lg-10 col-12"><a class="nav-link" href="#">Собеседования</a></div>
  					</div>
  				</li>
  				<li class="nav-item">
  					<div class="row nav-left-row">	
  						<div class="col-lg-2 col-12"><p id="center-i"><img src="pic/cat.png" alt="" class="item-m"></div>
  						<div class="col-lg-10 col-12"><a class="nav-link" href="#">Приобрести котика</a></div>
  					</div>
  				</li>
			</ul>
		</div>
		<div class="col-12">	</div>
		</div>	
		<div class="col-7 offset-1 content pt-3 mb-5">
			<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  				<ol class="breadcrumb">
    				<li class="breadcrumb-item" aria-current="page"><a href="#">Личный кабинет</a></li>
  				</ol>
			</nav>
			<h1>ЛИЧНЫЕ ДАННЫЕ</h1>
			<div class="mb-3 mt-4">
			<label for="exampleFormControlInput1" class="form-label">Фамилия</label>
			<input class="form-control" type="text" placeholder="кто-то" aria-label="readonly input example" readonly>
			</div>
			<div class="mb-3">
			<label for="exampleFormControlInput1" class="form-label">Имя</label>
			<input class="form-control" type="text" placeholder="кто-то" aria-label="readonly input example" readonly>
			</div>
			<div class="mb-3">
			<label for="exampleFormControlInput1" class="form-label">Отчество</label>
			<input class="form-control" type="text" placeholder="кто-то" aria-label="readonly input example" readonly>
			</div>
			<div class="mb-3">
			<label for="exampleFormControlInput1" class="form-label">Возраст</label>
			<input class="form-control" type="text" placeholder="кто-то" aria-label="readonly input example" readonly>
			</div>
			<div class="mb-3">
			<label for="exampleFormControlInput1" class="form-label">Место работы</label>
			<input class="form-control" type="text" placeholder="кто-то" aria-label="readonly input example" readonly>
			</div>
			<div class="mb-3">
			<label for="exampleFormControlInput1" class="form-label">Номер телефона</label>
			<input class="form-control" type="text" placeholder="кто-то" aria-label="readonly input example" readonly>
			</div>
			<div class="mb-3">
			<label for="exampleFormControlInput1" class="form-label">Адрес проживания</label>
			<input class="form-control" type="text" placeholder="кто-то" aria-label="readonly input example" readonly>
			</div>
			<div class="mb-3">
			<label for="exampleFormControlInput1" class="form-label">Электронная почта</label>
			<input class="form-control" type="text" placeholder="кто-то" aria-label="readonly input example" readonly>
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
	<script src="jquery-3.6.0.min.js"></script>
	<script src="jq.js"></script>
</body>
</html>