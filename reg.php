<?php
	require_once 'bd.php';
	session_start();
        if(isset($_SESSION["login"]))
		{
	    header("Location: index.php");
		}
	if($_POST["login"])
	{
	   
	$login=$_POST["login"];
	$mail=$_POST["mail"];
	$password=$_POST["password"];
	$name=$_POST["name"];
	$surname=$_POST["surname"];
	$patronymic=$_POST["patronymic"];
	
if(!isset($login) or !isset($mail) or !isset($password) or !isset($name) or !isset($surname) or !isset($patronymic))
			{
				$_SESSION["error"]="Введенны не все данные!";
			}
		else
		{
			$query ="SELECT * FROM user WHERE login='".$login."'";
            $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
            $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if(!isset($result))
                {
					$password=md5($password);
                    $query ="INSERT INTO `user` (`login`, `mail`, `password`, `name`, `surname`, `patronymic`)
                             VALUES ('".$login."','".$mail."','".$password."','".$name."','".$surname."','".$patronymic."')";
                    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
					$_SESSION["login"]=$login;
					
                }
            else 
			{
				$_SESSION["error"]="Такой логин уже зарегестрирован!";
			}
        }
	
	}

	
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Страница входа">
    <title>Cтраница регистрации</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="text-center">
<div class="col-sm-6">  
	<form class="form-signin" method="POST">
      <h1 class="h3 mb-3 font-weight-normal">Регистрация</h1>
	  <? 
		if(isset($_SESSION["error"]))
		{
			echo '<b>'.$_SESSION["error"].'</b>';
		}
	  ?>
      <input type="text" name="login" class="form-control" placeholder="Логин" required/></br>
	  <input type="mail" name="mail" class="form-control" placeholder="Почта" required/></br>
	  <input type="password" name="password" class="form-control" placeholder="Пароль" required/></br>
	  <input type="text" name="name" class="form-control" placeholder="Имя" required/></br>
	  <input type="text" name="surname" class="form-control" placeholder="Фамилия" required/></br>
	  <input type="text" name="patronymic" class="form-control" placeholder="Отчество" required/></br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Продолжить</button>
   </form>
 </div>
  </body>
</html>
