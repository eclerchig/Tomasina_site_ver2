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
   // echo "тут";

    if (empty($result)) 
    {
  //    echo "nen";

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
          
          <!-- Блок Фамилия -->
    			<div class="mb-3 form-group">
      			<label class="form-label">Фамилия</label>
      			<input type="text" name="surname" class="form-control" id="surname" required pattern="[а-яА-Я]{1,50}">
            <div class="invalid-feedback">
              Некорректное значение: используйте только русские буквы! От 1 до 50 символов.
            </div>
    			</div>

          <!-- Блок Имя -->
    			<div class="mb-3 form-group">
      			<label class="form-label">Имя</label>
            <input type="text" name="name" class="form-control" id="name" required pattern="[а-яА-Я]{1,50}">
            <div class="invalid-feedback">
              Некорректное значение: используйте только русские буквы! От 1 до 50 символов.
            </div>
    			</div>

          <!-- Блок Отчество -->
    			<div class="mb-3 form-group">
      			<label class="form-label">Отчество</label>
      			<input type="text" name="fathername" type="email" class="form-control" id="fathername" required pattern="[а-яА-Я]{1,50}">
            <div class="invalid-feedback">
              Некорректное значение: используйте только русские буквы! От 1 до 50 символов.
            </div>
    			</div>

          <div class="row">
            <!-- Блок Пол -->
            <div class="mb-3 col-4 form-group">
              <label class="form-label">Пол</label>
              <select name="sex" class="form-select" aria-label="Default select example" id="sex" required pattern="[а-я]{1}">
                <option selected disabled value="">Выберите</option>
                <option value="1">м</option>
                <option value="2">ж</option>
              </select>
              <div class="invalid-feedback">
                Выберите значение из выпадающего списка
              </div>
            </div>

            <!-- Блок Возраст -->
      			<div class="mb-3 offset-2 col-4 form-group">
        			<label class="form-label">Возраст</label>
        			<input type="number" name="age" class="form-control" id="age" required pattern="^[0-9]+$" min="18" max="90">
              <div class="invalid-feedback">
                Введите корректный возраст
              </div>
      			</div>
          </div>

          <div class="row">
            <!-- Блок Номер телефона -->
            <div class="mb-3 col-6 form-group">
              <label class="form-label">Номер телефона</label>
              <input type="tel" name="num" class="form-control" id="num"  pattern="[8]{1}[(]{1}[0-9]{3}[)]{1}[0-9]{3}-[0-9]{2}-[0-9]{2}" required >
              <small id="passwordHelpBlock" class="form-text text-muted">Формат: 8(ХХХ)ХХХ-ХХ-ХХ</small>
              <div class="invalid-feedback">
                Введите номер телеофна согласно формату!
              </div>
            </div>
          </div>
          <!-- Блок Место работы -->
    			<div class="mb-3 form-group">
      			<label class="form-label">Место работы</label>
      			<input type="text" name="work" class="form-control" id="work" required minlength="1" maxlength="150">
            <div class="invalid-feedback">
              Некорректное значение: введите от 1 до 150 символов!
            </div>
    			</div>

          <!-- Блок Адрес проживания -->
    			<div class="mb-3 form-group">
      			<label class="form-label">Адрес проживания</label>
      			<input type="text" name="address" class="form-control" id="address" minlength="1" maxlength="150"  required>
            <div class="invalid-feedback">
              Некорректное значение: введите от 1 до 150 символов!
            </div>
    			</div>

          <!-- Блок E-mail -->
    			<div class="mb-3 form-group">
      			<label class="form-label">Электронная почта</label>
      			<input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
      			<div id="emailHelp" class="form-text">Используйте электронную почту в качестве логина для входа в личный кабинет.</div>
            <div class="invalid-feedback">
              Некорректный формат e-mail! Используйте латинские символы, цифры. Обязатально присутствие символов '@'' и '.'  
            </div>
    			</div>

          <!-- Блок Пароль -->
    			<div class="mb-3 form-group">
      			<label for="exampleInputPassword1" class="form-label">Пароль</label>
      			<input type="password" name="password" class="form-control" id="pass1" required pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[a-zA-Z]).*">
      			<div id="emailHelp" class="form-text">Никому не сообщайте пароль</div>
            <div class="invalid-feedback">
              Некорректный пароль: не используйте русские буквы, пароль не менее 8 символов!
            </div>
    			</div>

          <!-- Блок Пароль2 -->
    			<div class="mb-3 form-group">
      			<label for="exampleInputPassword1" class="form-label">Повторите пароль</label>
      			<input name="confirm" type="password" class="form-control" id="pass2" required pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[a-zA-Z]).*">
            <div class="invalid-feedback">
              Пароли не совпадают!
            </div>
    			</div>

          <!-- Блок ОПД -->
    			<div class="form-check mt-3">
    				<input name="check" class="form-check-input" type="checkbox" value="" id="check" required>
    				<label class="form-check-label" for="flexCheckChecked">
      				Соглашаюсь на обработку персональных данных
    				</label>
  			</div>
    			<label for=""><a href="" data-bs-toggle="modal" data-bs-target="#form_log" data-bs-dismiss="modal">Ранее регистрировались?</a></label>
    			<div class="mt-3" style="text-align: center;">
    				<button id="save" type="submit" name="do_reg" class="btn btn-primary" style="">Зарегистрироваться</button>
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
    var correct = true;
    var pass = $("#confirm").val;
    var pass2 = $("#password").val;
    if (pass != pass2 && pass != NULL && pass2 != NULL)
    {
      var div = $("#confirm").parents('.form-group');
      div.addClass('is-valid').removeClass('is-invalid');
      coorect = true;
    }
    else
    {
      var div = $("#confirm").parents('.form-group');
      div.addClass('is-invalid').removeClass('is-valid');
      correct = false;
    }
    if (!f.checkValidity() && correct) 
    {
      event.preventDefault();
      event.stopPropagation();
    }

    f.classList.add("was-validated");

  }, false)
});

</script>