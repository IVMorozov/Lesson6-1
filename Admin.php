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
        <a class="navigation active" href="admin.php">Загрузка теста</a>
        <a class="navigation" href="list.php">Выбор тестов</a>
        <a class="navigation" href="test.php">Тестирование</a>
      </nav>
      
        <p class="help-block">Выберете файл с тестом для загрузки (в формате ***.json)</p>

      <form action="admin.php" method="post" enctype="multipart/form-data"> 
        <input class="btn" type="file" name="testfile" >
        <input type="submit" value="Загрузить тест">
      </form>  
    </section>
    <?php

      /*echo '<pre>';
      print_r($_FILES);
      echo PHP_EOL;*/

      // Функция проверяет расширение файла.
      function extCheck($fileName, $ext) {
        return in_array(pathinfo($fileName, PATHINFO_EXTENSION), $ext);
    }

       // Проверяем загружен ли файл
       if(is_uploaded_file($_FILES['testfile']['tmp_name'])){
          if (!extCheck($_FILES['testfile']['name'], ['json'])) {
            echo '<p class="help-block">Допускаются только файлы с расширением <strong>json</strong>.</p>';
            exit;
          }
          $tmp_path=file_get_contents($_FILES['testfile']['tmp_name']);
          $tmp_json =json_decode($tmp_path, true);

          if (is_null($tmp_json['id'])) {
             echo '<p class="help-block">Неверный формат теста</p>';
            exit;
          }
          if (is_null($tmp_json['q'])) {
            echo '<p class="help-block">Неверный формат теста</p>';
           exit;
         }
         
          
          // Если файл загружен успешно, перемещаем его из временной директории в конечную
          move_uploaded_file(
            $_FILES['testfile']['tmp_name'],
            __DIR__  .  DIRECTORY_SEPARATOR  . Tests .  DIRECTORY_SEPARATOR  . $_FILES['testfile']['name']
          );
          //echo '<p class="help-block">Файл теста загружен.</p>';
          if(file_get_contents(__DIR__  .  DIRECTORY_SEPARATOR  . Tests .  DIRECTORY_SEPARATOR  . $_FILES["testfile"]["name"])){
          echo '<p class="help-block">Файл успешно загружен</p>';}
        } 
       
 

  ?>
  </body>
</html>
