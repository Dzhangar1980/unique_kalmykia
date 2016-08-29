<?php
$path_arr = explode("/", $path);
if(count($path_arr) <= 2){
	$mypath = "../";
}elseif(count($path_arr) == 3){
	$mypath = "../../";
}
for($i = 0; $i <= 5; $i++){	$active[$i] = ""; }

if(count($path_arr) == 1){ $active[0] = " class=\"active\""; }
if(strpos($path, "categories") !== false){ $active[1] = " class=\"active\""; }
if(strpos($path, "articles") !== false){ $active[2] = " class=\"active\""; }
if(strpos($path, "article") !== false){ $active[2] = " class=\"active\""; }
if(strpos($path, "comments") !== false){ $active[3] = " class=\"active\""; }
if(strpos($path, "users") !== false){ $active[4] = " class=\"active\""; }

?>
<nav class="menu_main">
	<ul>
		<li<?php echo $active[0]; ?>><a href="{{ $mypath }}">Вернуться на фронт</a></li>
        <li<?php echo $active[1]; ?>><a href="{{ $mypath }}adminzone/categories">Категории</a></li>
        <li<?php echo $active[2]; ?>><a href="{{ $mypath }}adminzone/articles">Материалы</a></li>
        <li<?php echo $active[3]; ?>><a href="{{ $mypath }}adminzone/comments">Комментарии</a></li>
        <li<?php echo $active[4]; ?>><a href="{{ $mypath }}adminzone/users">Пользователи</a></li>
        <li<?php echo $active[5]; ?>><a href="/logout">Выход ({{ Auth::user()->name }})</a></li>
    </ul>
</nav>
