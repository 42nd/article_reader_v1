<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link href="index.php.css" rel="stylesheet" />
</head>
<body>
    <?php
    if (!$_GET["method"]) {
        header("Location: .?method=showNoticeList");
    }
    if (($_GET["method"] == "showNoticeList") && (!(int)$_GET["start"] || !(int)$_GET["end"])) {
        $e = 1;
        while (true) {
            if (file_exists("article/" . $e . ".txt")) {
                $e++;
            } else {
                $e--;
                break;
            }
        }
    /*
        if ($e < 11) {
            $s = 1;
        } else {
            $s = $e-10;
        }
    */
    // 나중에 페이지당 10개 노출되도록 수정 예정
        $s = 1;
        header("Location: .?method=showNoticeList&start=" . $s . "&end=" . $e);
    }
    if ($_GET["method"] == "showNoticeList") {
    ?>
        <h1 style="text-align: center; margin-bottom: 1px;">공지사항</h1>
        <h3 style="text-align: center; margin-top: 1px;">no.<?php echo $_GET["start"]; ?>~no.<?php echo $_GET["end"]; ?>번째 게시물</h3>
    <?php
        for ($i = $_GET["end"]; $i >= $_GET["start"]; $i--) {
            if (file_exists("article/" . $i . ".txt")) {
                $fp = fopen("article/" . $i . ".txt", "r") or die("ERROR");
                $gets = fgets($fp);
                $t = "";
                for ($j = 0; $j < strlen($gets); $j++) {
                    if ($gets[$j] == "&" || $gets[$j] == "\n") {
                        break;
                    } else {
                        $t .= $gets[$j];
                    }
                }
                echo "<a href='read_article.php?article_link=article/" . $i . ".txt" . "' style='color: black;'>" . "$i | " . $t . "</a><br />";
                @fclose($fp);
            }
            else {
                echo "$i | 게시물이 존재하지 않거나 삭제되었습니다.<br />";
            }
        }
    }
    ?>
</body>
</html>
