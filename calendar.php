<?php
// 今日
$today = new DateTime('now', new DateTimeZone('Asia/Tokyo'));

// 表示する月を定義
// パラメータがあればパラメータの月に、なければ今月にする
if (isset($_GET['month'])) {
  $month = $_GET['month'];
} else {
  $month = $today->format('Y-m');
}

// 月初の日付を取得し、カレンダー、タイトル、リンクを生成する基準日とする
$first_day = new DateTime('first day of ' . $month);

// カレンダーのセルの配列$daysを作成する
$days = array();
// 月初の曜日を取得し、カレンダー1行目の空白のセルを配列$daysに追加
$day = $first_day->format('w');
$space_count = $day + 1 - 1;
for ($i = 1; $i <= $space_count; $i++) {
  $days[] = "";
}
// 月末の日付を取得し、配列$daysに1日から末日までの「日」を追加する
$last_day = (new DateTime('last day of ' . $month))->format('d');
for ($i = 1; $i <= $last_day; $i++) {
  $days[] = $i;
}
// カレンダーに必要なセルの数を求め、セルの数より$daysの要素数が少なかったら、足りない分だけ空白を$daysに追加
$row_count = ceil(count($days) / 7);
$cell_count = $row_count * 7;
if (count($days) < $cell_count) {
  $add = $cell_count - count($days);
  for ($i = 1; $i <= $add; $i++) {
    $days[] = "";
  }
}

// 二次元配列の生成
// 配列$daysの要素を先頭から7個ずつ取り出して新たな配列を作成し、それを配列$weeksに入れていく
$weeks = array();
$week_count = ceil(count($days) / 7);
for ($i = 1; $i <= $week_count; $i++) {
  $week = array();
  for ($j = 1; $j <= 7; $j++) {
    $week[] = array_shift($days);
  }
  $weeks[] = $week;
}

// リンク用に前月と翌月を定義
$interval = new DateInterval('P1M');
$last_month = (new DateTime($month . '-01'))->sub($interval)->format('Y-m');
$next_month = (new DateTime($month . '-01'))->add($interval)->format('Y-m');
?>