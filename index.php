<?php
require_once('calendar.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>カレンダー</title>
  <link rel="stylesheet" type="text/css" href="reset.css">
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
              <?php if ($month == $today->format('Y-m') && $day == $today->format('j')): ?> 
                <td class="today"><?php echo $day ?></td>
              <?php else: ?>
                <td><?php echo $day ?></td>
              <?php endif ?>
            <?php endforeach ?>
          </tr>
        <?php endforeach ?>
      </table>
    </div>
  </div>
</body>
</html>