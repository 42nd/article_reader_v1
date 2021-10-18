<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, inital-scale=1">
    <link href="read_article.php.css" rel="stylesheet" />
</head>
<body>
    <?php
    if (!file_exists($_GET["article_link"])) {
      echo "게시글을 찾을 수 없습니다.";
      exit;
    }
    $fp = fopen($_GET["article_link"], "r");
    $gets = fgets($fp);
    $t = "";
    for ($j = 0; $j < strlen($gets); $j++) {
      if ($gets[$j] == "&") {
        break;
      } else {
        $t .= $gets[$j];
      }
    }
    echo "<h1>" . $t . '</h1><hr style="border: 1px solid black; background-color: black;"/><br /><br />';
    while (!feof($fp)) {
        echo fgets($fp) . "<br />";
    }
    fclose($fp);
    echo "<br />";
    echo '<div style="text-align: center;">---------- 돌아가기 ----------<br />';
    echo "<a href='" . $_SERVER['HTTP_REFERER'] . "' target='_self' style='color: blue; text-decoration: none;'>여기를 클릭해 돌아가세요</a></div>";
    ?>
</body>
</html>
