<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Список студентов</title>
    <link rel="stylesheet" href="/html/css/style.css">
</head>
<body>
<a class="reg_link" href="/registration.php">Регистрация</a>
<h1>Список абитуриентов</h1>
<form action="/search.php" method="post" enctype="multipart/form-data" class="search_panel">
    <img src="/html/img/loop.png" alt="">
    <input class="search" type="text" name="text" placeholder="Поиск по сайту" value="" maxlength="300" />
    <button type="submit">Поиск</button>
</form>
<div class="student_list">
    <table>
        <tr>
            <td><a href="/?sorter=first_name">Имя</a></td>
            <td><a href="/?sorter=last_name">Фамилия</a></td>
            <td><a href="/?sorter=groupe">Номер группы</a></td>
            <td><a href="/?sorter=exam">Баллов</a></td>
        </tr>
        <?php foreach ($students as $student) : ?>
            <tr>
                <td><?php echo $student->first_name ?></td>
                <td><?php echo $student->last_name ?></td>
                <td><?php echo $student->groupe ?></td>
                <td><?php echo $student->exam ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php if ($pager): ?>
    <div class="center">
        <div class="pagination">
            <?php for ($i = 1; $i <= $pager; $i++): ?>
                <?php if ($i == 1): ?>
                    <a href="/<?php if (!empty($sorter)) echo '?sorter=' . $sorter?>" <?php if ($i == $page || empty($page)) echo 'class="active"'?>>1</a>
                <?php else: ?>
                    <a href="/?page=<?php echo $i;  if (!empty($sorter)) echo '&sorter=' . $sorter ?>" <?php if ($i == $page) echo 'class="active"'?>><?php echo $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    </div>
<?php endif; ?>
</body>
</html>