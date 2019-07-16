<?php 
	require 'bd.php';
	session_start();
	if(isset($_POST['surname']))
	        {
	            $sql = mysqli_query($link, "UPDATE user SET surname='".$_POST['surname']."' WHERE login='".$_SESSION['login']."'");
	            unset($_POST['surname']);
	        }
	if(isset($_POST['name']))
	        {
	            $sql = mysqli_query($link, "UPDATE user SET name='".$_POST['name']."' WHERE login='".$_SESSION['login']."'");
	            unset($_POST['name']);
	        }
	if(isset($_POST['patronymic']))
	        {
	            $sql = mysqli_query($link, "UPDATE user SET patronymic='".$_POST['patronymic']."' WHERE login='".$_SESSION['login']."'");
	            unset($_POST['patronymic']);
	        }
	if (isset($_POST['password1']) and isset($_POST['password2']))
	{
	    if($_POST['password1']==$_POST['password2'])
	    {
	        unset($_POST['password1']);
	        unset($_POST['password2']);
	        $_SESSION['error'] = 'Такой пароль уже используется';
	    }
	    else 
	    {
    	    $query ="SELECT * FROM user WHERE login='".$_SESSION["login"]."'";
            $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
            $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
	        if($result['password']==md5($_POST['password1']))
	        {
	            $sql = mysqli_query($link, "UPDATE user SET password='".md5($_POST['password2'])."' WHERE login='".$_SESSION['login']."'");
	            $_SESSION['error'] = 'Пароль изменен!';
	            unset($_POST['password1']);
	            unset($_POST['password2']);
	        }
	        else 
	        {
	            $_SESSION['error'] = 'Пароль не верный!';
	            unset($_POST['password1']);
	            unset($_POST['password2']);
	        }
	    }
	}
	
?>


<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Страница входа</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body class="text-center">
      <div class="container">
         <div class="row justify-content-center">
            <div class="col-sm-12">  
          <?php if ( isset ($_SESSION['login']) ) : ?>
    	Авторизован! <br/>
    	Привет, 
    	<?php
    	 $query ="SELECT * FROM user WHERE login='".$_SESSION["login"]."'";
         $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
         $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
         echo $result['surname'].' '.$result['name'].' '.$result['patronymic'];
    	
    	?>!<br/><a href="logout.php">Выйти</a></div><br/>
            <div class="col-sm-6">  
            <form class="form-signin" method="post">
              <h1 class="h3 mb-3 font-weight-normal">Изменить пароль</h1>
              <?
              if($_SESSION["error"]!="") 
              echo $_SESSION["error"];
              unset($_SESSION['error']);
              ?>
              <input type="password" name="password1" class="form-control" placeholder="Пароль" required></br>
              <input type="password" name="password2" class="form-control" placeholder="Новый пароль" required></br>
              <button class="btn btn-lg btn-primary btn-block" type="submit">Изменить</button>
            </form>
            </div>
            </div><br>
            <div class="row justify-content-center">
             <br><div class="col-sm-3">  
            <form class="form-signin" method="post">
              <h1 class="h3 mb-3 font-weight-normal">Изменить Имя</h1>
              <input type="text" name="name" class="form-control" placeholder="Имя" required></br>
              <button class="btn btn-lg btn-primary btn-block" type="submit">Изменить</button>
            </form>
            </div><br>
            <div class="col-sm-3">  
            <form class="form-signin" method="post">
              <h1 class="h3 mb-3 font-weight-normal">Изменить Фамилию</h1>
              <input type="text" name="surname" class="form-control" placeholder="Фамилия" required></br>
              <button class="btn btn-lg btn-primary btn-block" type="submit">Изменить</button>
            </form>
            </div><br>
            <div class="col-sm-3">  
            <form class="form-signin" method="post">
              <h1 class="h3 mb-3 font-weight-normal">Изменить Отчество</h1>
              <input type="text" name="patronymic" class="form-control" placeholder="Отчество" required></br>
              <button class="btn btn-lg btn-primary btn-block" type="submit">Изменить</button>
            </form>
            </div><br>
    	
    
            <?php else : ?><div class="col-sm-6">  
            Вы не авторизованы<br/>
            <a href="auth.php">Авторизация</a>
            <a href="reg.php">Регистрация</a></div>
            <?php endif; ?>
            
</div></div>
  </body>
</html>
