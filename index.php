<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Извлечение чисел из текста</title>
</head>
<body>
    <main>
		<h1>Извлечение чисел из текста</h1><br>
		<form action="index.php" method="post">
				<h4>Введите текст:</h4>
				<textarea name="text" rows="8" cols="80">Введите текст</textarea>   
                <button type="submit">Извлечь числа</button>
            </form>
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$text = $_POST["text"];
			function remove_numbers($condition = "null") {
			$pattern = '/\d+/';
			if (preg_match_all ($pattern, $condition, $matches, PREG_OFFSET_CAPTURE)) {
				foreach ($matches[0] as $match) {
       				echo $match[0]." ";
				}
			} 
		}
		function write_fail($condition) {
			$my_file = fopen("file.txt", "a");
			fwrite($my_file, $condition."\n");
			fclose($my_file);
		}	
		if ($text == "null") {
			die;
		} else {
		echo "Найденные числа:<br><br>";
		ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^ PHP_OUTPUT_HANDLER_REMOVABLE);
		remove_numbers($text);
		write_fail($text);	
		echo "<br><br>Обработанный текст:<br><br>";
		echo $text;
		}
	}
		?>  
    </main>
</body>

</html>