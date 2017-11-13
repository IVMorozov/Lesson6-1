<!DOCTYPE html>
<html lang="ru">
  <head>
	  <meta charset="utf-8">
	  <title>title1</title>
  	<link rel="stylesheet" href="styles.css">
  </head>
  <body>

    <section class="bgrnd-main">
      <nav>
        <a class="navigation" href="admin.php">Загрузка теста</a>
        <a class="navigation" href="list.php">Выбор тестов</a>
        <a class="navigation active" href="test.php">Тестирование</a>
      </nav>
      
        
    <?php
        /*var_dump($_SERVER['REQUEST_URI']);
        echo PHP_EOL;
        var_dump($_Post);*/
        $pieces = explode("item=", $_SERVER['REQUEST_URI']);
        $test_path = __DIR__  .  DIRECTORY_SEPARATOR  . Tests .  DIRECTORY_SEPARATOR  . $pieces[1];
        $tmp_path = file_get_contents($test_path);
        $test_json = json_decode($tmp_path, true);
        /*echo PHP_EOL;
        echo '<pre>';
        print_r($test_json);*/
        ?>
      <section class="bgrnd-test">
      <div class="testblock">
        <form class="list">
          <?php
            echo'<h1>Выберите ответ на вопрос:<br>'. $test_json['q'].'</h1>';
            foreach ($test_json['answers'] as $index => $item) {
              echo '<input class="item" type="radio" name="answer" value='.$item.'>'.$item;}
          ?>
          <p><input class="testchoice" type="button" value="Ответить" action="<?php
          echo PHP_EOL;
          print_r($item);
          ?>"></p>
          <?php
          echo PHP_EOL;
          print_r($item);
          ?>
        </form>
      </div>
  </section>
  </body>
</html>
