
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  		<div class="container">
    		<a class="navbar-brand" href="#">
      			<img src="/tomasina/pic/logo.png" alt="" width="80" height="80" class="d-inline-block align-text-top">
      		</a>
      		<a class="navbar-brand" id="Tomas" href="/tomasina/">
    		Кошачий приют <br>
    		&nbsp &nbsp &nbsp ТОМАСИНА
    		</a>
    		<button class="navbar-toggler" id="pop_down" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      			<span class="navbar-toggler-icon"></span>
    		</button>
        <?php 
          if (!empty($_SESSION['auth'])) { ?>
              <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link btn" href="/tomasina/pages/prof" id="t_log" >Личный кабинет</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link btn btn-outline-primary" id="t_reg" href="/tomasina/moduls/logout.php">Выход</a>
                  </li>
                </ul>
              </div>
          <?php }
        else { 
          ?>
    	<div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link btn" href="#" id="t_log" data-bs-toggle="modal" data-bs-target="#form_log">Логин</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-outline-primary" id="t_reg" href="#" data-bs-toggle="modal" data-bs-target="#form_reg">Регистрация</a>
          </li>
        </ul>
      </div>
      <?php } ?>
      </div>
</nav>

<div class="no_pad" id="info_background"> 
  <img src="/tomasina/pic/tph.png" id="cats">
  <div  class="container-fluid" id="info_banner">
    <div class="row" style="height: 100%">
      <div class="col-4" id="div_info">
        <p id="number_phone">
          8(902)451-72-02
        </p>
        <a href=""><img src="/tomasina/pic/icons/inst.png" alt=""></a>
        <a href=""><img src="/tomasina/pic/icons/vk.png" alt=""></a>
        <a href=""><img src="/tomasina/pic/icons/whatsapp.png" alt=""></a>
        <p class="info">
          ПН-СБ С 10:00 ДО 20:00 <br> ВОСКРЕСЕНИЕ - ВЫХОДНОЙ
        </p>
        <p class="info">
          Адрес: г. Иркутск, <br> ул. Байкальская д. 54
        </p>
      </div>
      <div class="col-4">
        <button  id="do_cat">
        <a href="#">ПРИЮТИТЬ КОШКУ</a>
      </button>
        </div>
      <div class="col-4"></div>
    </div>
  </div>
</div>

<div class="container-fluid nav-down no_pad">	
		<div class="row justify-content-center">
		<button type="button" class="btn col-3"><a href="#">КАК НАМ ПОМОЧЬ</a></button>
		<button type="button" class="btn col-3 bordered"><a href="#">О НАС</a></button>	
		<button type="button" class="btn col-3"><a href="#">КОНТАКТЫ</a></button>	
		</div>
</div>