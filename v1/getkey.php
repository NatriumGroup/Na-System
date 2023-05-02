<?php
if(isset($_COOKIE["123"])){$current_date_hour=date("Y-m-d H");$pinjie=$current_date_hour.$_GET["ign"].$_GET["add"];$generated_key=md5($pinjie);echo($generated_key);}else{echo("没带COOKIE请先鉴权");}?>