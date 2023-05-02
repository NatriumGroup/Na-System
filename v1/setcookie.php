<?php
if(isset($_GET['user'])&&isset($_GET['password'])){if($_GET['password']=="114514"&&$_GET['user']=="114514"){setcookie("123","1", time()+10);}else{echo("WRONG");}}else{echo("Miss");}?>