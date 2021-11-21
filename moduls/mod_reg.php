<?php
  
  include "includes/bd.php";

  if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST["do_reg"]))
  {

    // Пишем логин и пароль из формы в переменные для удобства работы:
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $fathername = $_POST['fathername'];
    $sex = ($_POST['sex'] == 1) ? 'м' : 'ж';
    $age = $_POST['age'];
    $work = $_POST['work'];
    $num = $_POST['num'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "SELECT * FROM users WHERE email='$email'";

    $user = mysqli_fetch_assoc(mysqli_query($connect, $query));
    echo "тут";

    if (empty($result)) 
    {
      echo "nen";

      $query = "INSERT INTO `users` (surname,name,fathername,sex,age,work,num_telephone, address,email,hash_password,status) VALUES ('$surname', '$name', '$fathername','$sex','$age','$work','$num','$address','$email','$password', '2');";

      mysqli_query($connect, $query);

      $query = "SELECT * FROM users WHERE email='$email'";
      $user = mysqli_fetch_array(mysqli_query($connect, $query));

      $_SESSION['auth'] = true;
      $_SESSION['id'] = $user['ID'];
      $_SESSION['status'] = $user["status"]; 
    }
    else
    {
      // хрен знает, что тут делать =_=
    }
     $connect->close();
   }
?>

<div class="modal fade" id="form_reg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">РЕГИСТРАЦИЯ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" class="needs-validation" novalidate>
  			<div class="mb-3">
    			<label for="surname" class="form-label">Фамилия</label>
    			<input type="text" name="surname" class="form-control" id="surname"  required>
  			</div>
  			<div class="mb-3">
    			<label for="exampleInputEmail1" class="form-label">Имя</label>
    			<input type="text" name="name" class="form-control" id="name"  required>
  			</div>
  			<div class="mb-3">
    			<label for="exampleInputEmail1" class="form-label">Отчество</label>
    			<input type="text" name="fathername" type="email" class="form-control" id="fathername" required>
  			</div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Пол</label>
          <select name="sex" class="form-select" aria-label="Default select example" id="sex"  required>
            <option selected disabled>Выберите</option>
            <option value="1">м</option>
            <option value="2">ж</option>
          </select>
        </div>
  			<div class="mb-3">
    			<label for="exampleInputEmail1" class="form-label">Возраст</label>
    			<input type="text" name="age" class="form-control" id="age" required>
  			</div>
  			<div class="mb-3">
    			<label for="exampleInputEmail1" class="form-label">Место работы</label>
    			<input type="text" name="work" class="form-control" id="work"  required>
  			</div>
  			<div class="mb-3">
    			<label for="exampleInputEmail1" class="form-label">Номер телефона</label>
    			<input type="text" name="num" class="form-control" id="num"  required>
  			</div>
  			<div class="mb-3">
    			<label for="exampleInputEmail1" class="form-label">Адрес проживания</label>
    			<input type="text" name="address" class="form-control" id="address"  required>
  			</div>
  			<div class="mb-3">
    			<label for="exampleInputEmail1" class="form-label">Электронная почта</label>
    			<input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
    			<div id="emailHelp" class="form-text">Используйте электронную почту в качестве логина для входа в личный кабинет.</div>
  			</div>
  			<div class="mb-3">
    			<label for="exampleInputPassword1" class="form-label">Пароль</label>
    			<input type="password" name="password" class="form-control" id="pass1" required>
    			<div id="emailHelp" class="form-text">Никому не сообщайте пароль</div>
  			</div>
  			<div class="mb-3">
    			<label for="exampleInputPassword1" class="form-label">Повторите пароль</label>
    			<input name="confirm" type="password" class="form-control" id="pass2"  required>
  			</div>
  			<div class="form-check mt-3">
  				<input name="check" class="form-check-input" type="checkbox" value="" id="check" required>
  				<label class="form-check-label" for="flexCheckChecked">
    				Соглашаюсь на обработку персональных данных
  				</label>
			</div>
  			<label for=""><a href="" data-bs-toggle="modal" data-bs-target="#form_log" data-bs-dismiss="modal">Уже авторизовались?</a></label>
  			<div class="mt-3 form-check">
  				<button type="submit" name="do_reg" class="btn btn-primary" style="">Зарегистрироваться</button>
  			</div>
		</form>
      </div>
    </div>
  </div>
</div>

<script>

var forms = document.querySelectorAll('.needs-validation');
Array.prototype.slice.call(forms).forEach (function (f) {
f.addEventListener("submit",function(event)
  {
    if (!f.checkValidity()) 
    {
      event.preventDefault();
      event.stopPropagation();
    }

    f.classList.add("was-validated");

  }, false)
});
</script>