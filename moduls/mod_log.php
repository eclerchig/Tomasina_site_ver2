<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST["do_log"]))
    {
    include "includes/bd.php";
 
    // Пишем логин и пароль из формы в переменные для удобства работы:
    $login = $_POST['login'];
    $password = $_POST['password'];
    
    // Формируем и отсылаем SQL запрос:
    $query = "SELECT * FROM users WHERE email='$login'";
    
    $result = mysqli_query($connect, $query);
    
    // Преобразуем ответ из БД в нормальный массив PHP:
    $user = mysqli_fetch_assoc($result);

    if (!empty($user)) {
      $hash = $user['hash_password']; // соленый пароль из БД
    
      // Проверяем соответствие хеша из базы введенному паролю
      if (password_verify($_POST['password'], $hash)) {

        $_SESSION['auth'] = true;
        $_SESSION['id'] = $user['ID'];
        $_SESSION['status'] = $user['status'];
      } 
      else 
      {
      }
    }
    else
    {
    }
}
?>

<div class="modal fade" id="form_log" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Авторизация</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST"  id="auth" class="needs-validation" novalidate>
  			<div class="mb-3">
    			<label for="exampleInputEmail1" class="form-label">Электронная почта</label>
    			<input type="email" name="login" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
  			</div>
  			<div class="mb-3">
    			<label for="exampleInputPassword1" class="form-label">Пароль</label>
    			<input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
  			</div>
  			<label for=""><a href="" data-bs-toggle="modal" data-bs-target="#form_reg" data-bs-dismiss="modal">Еще не зарегистрировались?</a></label>
        <div class="row">
  			 <div class="mt-3 form-check" style="text-align: center; padding-left: 0px">
  				  <input type="submit" name="do_log" class="btn btn-primary" style="" value="Войти">
  			 </div>
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