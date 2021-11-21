<?php 
$connect = mysqli_connect('127.0.0.1', 'root','', 'tomasina');

if ($connect == false)
{
	echo "Не удалось подлкючиться к БД <br>";
	echo mysqli_connect_error();
	exit();
}