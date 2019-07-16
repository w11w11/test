<?php
session_start();
        if(isset($_SESSION["login"])){
	    header("Location: index.php");
	}
	require_once("bd.php");
if(isset($_POST['login']) && isset($_POST['password']))
    {
        	$query ="SELECT * FROM user WHERE login='".$_POST['login']."'";
            $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        	$numrows=mysqli_num_rows($result);
        	if($numrows!=0)
        	{
        	$query ="SELECT * FROM user WHERE login='".$_POST['login']."'";
            $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
            $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if($result['password']==md5($_POST['password']))
            {
                $_SESSION["login"]=$_POST['login'];
                header("Location: index.php");
            }
            else
            {
                $_SESSION["error"]='Неверный пароль';
            }
        	}
         else
            {
                $_SESSION["error"]='Пользователь не найден';
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
      <div class="col-sm-6">  
            <form class="form-signin" method="post">
              <h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>
              <?
              if($_SESSION["error"]!="") 
              echo $_SESSION["error"];
              ?>
              <input type="text" name="login" class="form-control" placeholder="Логин" required autofocus></br>
              <input type="password" name="password" class="form-control" placeholder="Пароль" required></br>
              <button class="btn btn-lg btn-primary btn-block" type="submit">Вход</button>
            </form>
            </div>
  </body>
</html>
