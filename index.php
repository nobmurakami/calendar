<?php
// 表示する月を定義
// パラメータがあればパラメータの月に、なければ今月にする
if (isset($_GET['month'])) {
  $month = $_GET['month'];
} else {
  $month = (new DateTime())->format('Y-m');
}
// 月初の日付を取得する
$first_day = new DateTime('first day of ' . $month);
// 月初の曜日を0（日曜）から6（土曜）の数値で取得
$day = $first_day->format('w');
// 曜日の数値から、第1週の空白の数を求める
$space_count = $day + 1 - 1;
// 日付の配列を作成する
$days = array();
// 配列の先頭に空白を追加する
for ($i = 1; $i <= $space_count; $i++) {
  $days[] = "";
}
// 月末の日付を取得する
$last_day = (new DateTime('last day of ' . $month))->format('d');
// 配列に1日から末日までの「日」を追加する
for ($i = 1; $i <= $last_day; $i++) {
  $days[] = $i;
}
// カレンダーの行数とセルの数を求める
$row_count = ceil(count($days) / 7);
$cell_count = $row_count * 7;
// セルの数より$daysの要素数が少なかったら、足りない分だけ空白を追加する
if (count($days) < $cell_count) {
  $add = $cell_count - count($days);
  for ($i = 1; $i <= $add; $i++) {
    $days[] = "";
  }
}
// 配列の要素を先頭から7個ずつ取り出して新たな配列weekを作成し、それを配列weeksに入れていく
$weeks = array();
$week_count = ceil(count($days) / 7);
for ($i = 1; $i <= $week_count; $i++) {
  $week = array();
  for ($j = 1; $j <= 7; $j++) {
    if (count($days) <= 0) {
      break;
    }
    $week[] = array_shift($days);
  }
  $weeks[] = $week;
}

// リンク用に前月と翌月を定義
$interval = new DateInterval('P1M');
$last_month = (new DateTime($month . '-01'))->sub($interval)->format('Y-m');
$next_month = (new DateTime($month . '-01'))->add($interval)->format('Y-m');
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>カレンダー</title>
  <link rel="stylesheet" type="text/css" href="destyle.css">
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
  <div class="content">
    <div class="header">
      <div class="title">
        <?php echo $first_day->format('Y年 n月') ?>
      </div>
      <!-- 前後の月へのリンク -->
      <div class="link">
        <a href="index.php?month=<?php echo $last_month ?>">＜</a>
        <span>　</span>
        <a href="index.php?month=<?php echo $next_month ?>">＞</a>
      </div>
    </div>
    <div class="calendar">
      <table>
        <tr>
          <th>日</th>
          <th>月</th>
          <th>火</th>
          <th>水</th>
          <th>木</th>
          <th>金</th>
          <th>土</th>
        </tr>
        <?php foreach ($weeks as $week): ?>
          <tr>
            <?php foreach ($week as $day): ?>
              <td><?php echo $day ?>
            <?php endforeach ?>
          </tr>
        <?php endforeach ?>
      </table>
    </div>

    

    

  </div>
</body>
</html>