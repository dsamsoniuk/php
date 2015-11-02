<?php

/* -------------------------------------------------------------------- */
/* -- Nazwa pliku  -- */
$file_name = "data/comment_file.txt";


/* -- Class -- */
include('scrypt/comment.class.php');
/* -------------------------------------------------------------------- */





echo '
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="style/comment_style.css">
	</head>
<body>
';


echo '<div id="container">';
echo '<h2><center>Skrypt komentarz</center></h2>';


$file = new comment($file_name);
/* --- Zwraca tablice komentarz --------------------------------------- */
$comment_table = $file->contents();





/* --- Sprawdz czy dane formularzu sa puste ----------------------------- */
if(empty($_POST['nick_name']) || empty($_POST['comment']))
	echo ''; 
else 
{
	$file->save_comment($_POST['nick_name'], $_POST['comment']);
}
	

	

/* --- Formularz komentarza -------------------------------------------- */

echo '
<table>
<form action="index.php" method="post">
	<tr>
		<td>Nick</td> 
		<td><input type="text" name="nick_name"></td>
	</tr>
	<tr>
		<td>Treść</td>
		<td><textarea name="comment" style="width:500px;"></textarea></td>
	<tr>
		<td colspan="2"><input type="submit" value="Wyślij"></td>
	</tr>
</form>
</table>
';





/* -- Wyswietl komentarze ----------------------------------------------- */

echo '
<div id="window-comment">
<table>';

	for ($i=0; $i < count($comment_table); $i++)
	{	
		echo '
			<tr>
				<td class="name-content">'.$comment_table[$i][0].'</td>
				<td class="text-content">'.$comment_table[$i][1].'</td>
			</tr>';
	}
	
echo '
</table>
</div>';


/* -- end-container -- */
echo '</div>';



echo '</body>
</html>';
	

?>