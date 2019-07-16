<?php
    
    $link = mysqli_connect('localhost', 'u0722890_test', '8D1j3L6l', 'u0722890_test') // подключаемся к серверу
    or die("Ошибка " . mysqli_error($link));
    $r=$link->set_charset("utf8");
    
?>