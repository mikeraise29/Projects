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
			function remove_numbers($condition) {
				if (preg_match_all ('/\d+/', $condition, $matches, PREG_OFFSET_CAPTURE)) {
					$result = "";
					foreach ($matches[0] as $match) {
       					$result = $result.$match[0]." ";
					}
					
				} 
				return $result;
			}
		function write_fail($write) {
			$my_file = fopen("file.txt", "a");
			fwrite($my_file, $write."\n");
			fclose($my_file);
		}	
		if ($text == "null") {
			die;
		} else {
		echo "Найденные числа:<br><br>";
		echo remove_numbers($text);
		write_fail(remove_numbers($text));
		echo "<br><br>Обработанный текст:<br><br>";
		echo $text;
		}
	}
		?>  
    </main>
</body>

</html>