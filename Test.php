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
      error_reporting(0);
            
      $pieces = explode("item=", $_SERVER['REQUEST_URI']);
      If (isset($pieces[1])) {
          $test_path = __DIR__  .  DIRECTORY_SEPARATOR  . Tests .  DIRECTORY_SEPARATOR  . $pieces[1];
          $tmp_path = file_get_contents($test_path);
          $test_json = json_decode($tmp_path, true);
                  ?>
          <section class="testblock">
          <form class="list" action="test.php" method="GET">
            <?php
              $Test_index = count($test_json)-2;
              $Test_number;
              $item;
              $break='vs';
              $Correct_answer;
              $index;
              $Ansers_checked;
              echo'<h1 >Ответьте на вопросы теста:</h1>';
              for ($Test_number = 0; $Test_number <= $Test_index; $Test_number++) {
                echo'<div class="test-part">';
                $Correct_answer[$Test_number]=$test_json[$Test_number]['correct_answer'];
                echo'<h1 class="test-header">'. $test_json[$Test_number]['question'].'</h1>';
                  foreach ($test_json[$Test_number]['answers'] as $index => $item) {
                    echo '<input class="item" type="radio" name='.$Ansers_checked[$Test_number].' value='.$item.$break.$test_json[$Test_number]['correct_answer'].'>'.$item;}
                echo'</div>' ;   
              }    
            ?>
            <p><input class="testchoice" type="submit" value="Ответить"></p>
          </form>
        
      <?php
      }
      else {
        if (count($_GET) == 0 ) {
          echo'<p class="final">Вы не выбрали ни один вариант, начните заново с выбора теста (вкладка "выбор тестов")</p>';
          exit;
        }
        $Ansers_checked=$_GET;
        $Result;
        $Result_count;
        $Final_result;

        foreach ($Ansers_checked as $answer => $bool) {
          $Test_Check = explode("=", $answer);
          $Chek=explode('vs', $Test_Check[1]);
          If ($Chek[0]==$Chek[1]) {$Result[$answer]=1;} else{$Result[$answer]=0;}
          $Result_count=$Result_count+$Result[$answer];
        }

        $Test_count=count($Result);
        if ($Result_count>0) { 
          $Final_result= 'Вы ответили правильно на '.$Result_count.' из '.$Test_count.' вопросов!';
        } 
          else { 
            $Final_result='Вы не ответили правильно ни на один вопрос!';
          }
        echo'<p class="final">'.$Final_result.'</p>';
    }
    ?>
    </section>
  </body>
</html>
