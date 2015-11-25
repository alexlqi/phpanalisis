<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<form method="post">
	<input type="text" name="search" placeholder="search pattern" /><br />
    <select name="folder">
    <?php
		#var_dump(scandir("."));
		foreach(scandir(".") as $dir){
			echo '<option value="'.$dir.'">'.$dir.'</option>';
		}
	?>
    </select><br />
    <input type="submit" value="Buscar" />
</form>
<pre>
<?php
if(@$_POST["folder"]!="" and @$_POST["search"]!=""){
	$searchRegExp="/".$_POST["search"]."/is";
	foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($_POST["folder"])) as $filename)
	{
		// filter out "." and ".."
		if ($filename->isDir()) continue;
		if(!preg_match("/\.git/",$filename)){
			#echo "$filename\n";
			$str=file_get_contents($filename);
			if(preg_match($searchRegExp,$str)){
				echo "c:\\www\\".$filename."<br />";
			}
		}
	}
}
?>
</pre>
</body>
</html>