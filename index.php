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
			
		}


			function remove_numbers($condition = "") {
				$result = "";
				if (preg_match_all ('/\d+/', $condition, $matches, PREG_OFFSET_CAPTURE)) {
					foreach ($matches[0] as $match) {
       					$result = $result.$match[0]." ";
					}	
				} 
				return $result;
			}


			#function write_fail($write) {
				#$my_file = fopen("file.txt", "a");
				#fwrite($my_file, $write."\n");
				#fclose($my_file);
				#}	
			
			function connection_to_db() {
				$options = [
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_STRINGIFY_FETCHES => false,
					PDO::ATTR_EMULATE_PREPARES => false
				];
				global $input_numbers;
				$user = 'admin';
				$password = 'admin';
				$dsn = "pgsql:host=db;port=5432;dbname=firstdb";
				try {
					$pdo = new PDO($dsn, $user, $password, $options);
					#echo "<br> Успешное подключение <br>";
					$pdo->exec("CREATE TABLE IF NOT EXISTS data_numbers (
						id SERIAL PRIMARY KEY, 
						message TEXT);");
					$stmt = $pdo->prepare("
						INSERT INTO data_numbers (message) VALUES (:msg)");
					$stmt->execute(['msg' => $input_numbers]);
					$rows = $pdo->query("
						SELECT * FROM data_numbers ORDER BY id
					")->fetchAll(PDO::FETCH_ASSOC);
					#echo "<pre>";
					#print_r($rows);
					#echo "<pre>";
				} catch (PDOException $e) {
					echo '<br>Ошибка подключения<br>'.	$e->$input_numbers;
				}
			}

			if (empty($text) == "True") {
			} else {
				echo "Найденные числа:<br><br>";
				$input_numbers = remove_numbers($text);
				echo remove_numbers($text);
				#write_fail(remove_numbers($text));
				echo "<br><br>Обработанный текст:<br><br>";
				echo $text;
			}
		
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$pdo = connection_to_db();
			}
		?>  
    </main>
</body>

</html>