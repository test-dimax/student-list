<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация студентов</title>
    <link rel="stylesheet" href="/html/css/style.css">
</head>
<body>
<a class="list_link" href="/">Список абитуриентов</a>
<h1>Регистрация абитуриентов</h1>
<?php //var_dump($errors); ?>
<div class="reg_form">
    <form action="<?php echo (empty($_COOKIE['user_pass'])) ? '/add.php': '/update.php' ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-25">
                <label for="first_name">Имя</label>
            </div>
            <div class="col-75">
                <input <?php if ( !empty($errors['first_name']) ) {echo 'class="error"';} ?> type="text" id="first_name" name="first_name" placeholder="Ваше имя" value="<?php echo $student->first_name ?>" required>
                <?php
                if ( !empty($errors['first_name']) ) {
                    echo '<span class="error">'.$errors['first_name'].'</span>';
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="last_name">Фамилия</label>
            </div>
            <div class="col-75">
                <input <?php if ( !empty($errors['last_name']) ) {echo 'class="error"';} ?> type="text" id="last_name" name="last_name" placeholder="Ваша фамилия" value="<?php echo $student->last_name ?>" required>
                <?php
                if ( !empty($errors['last_name']) ) {
                    echo '<span class="error">'.$errors['last_name'].'</span>';
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="gender">Пол</label>
            </div>
            <div class="col-75">
                <input type="radio" name="gender" <?php if ($student->gender == 1 ) { echo 'checked'; } ?> value="1"> Мужской<br>
                <input type="radio" name="gender" <?php if ($student->gender == 2 ) { echo 'checked'; } ?> value="2"> Женский
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="lname">Номер группы</label>
            </div>
            <div class="col-75">
                <input <?php if ( !empty($errors['groupe']) ) {echo 'class="error"';} ?> type="text" id="groupe" name="groupe" placeholder="Ваша группа" value="<?php echo $student->groupe ?>" required>
                <?php
                if ( !empty($errors['groupe']) ) {
                    echo '<span class="error">'.$errors['groupe'].'</span>';
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="email">E-mail</label>
            </div>
            <div class="col-75">
                <input <?php if ( !empty($errors['email']) ) {echo 'class="error"';} ?> type="email" id="email" name="email" placeholder="Ваш e-mail" value="<?php echo $student->email ?>" required>
                <?php
                if ( !empty($errors['email']) ) {
                    echo '<span class="error">'.$errors['email'].'</span>';
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="exam">Баллов ЕГЭ</label>
            </div>
            <div class="col-75">
                <input <?php if ( !empty($errors['exam']) ) {echo 'class="error"';} ?> type="number" id="exam" name="exam" placeholder="Ваше количество баллов ЕГЭ" value="<?php echo $student->exam ?>" required>
                <?php
                if ( !empty($errors['exam']) ) {
                    echo '<span class="error">'.$errors['exam'].'</span>';
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="date_year">Дата рождения</label>
            </div>
            <div class="col-75">
                <input type="date" id="birthday" name="birthday" value="<?php echo $student->birthday ?>" required>
                <?php
                if ( !empty($errors['birthday']) ) {
                    echo $errors['birthday'];
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="resident">Местный/иногородний</label>
            </div>
            <div class="col-75">
                <input type="radio" name="resident" <?php if ($student->resident == 1 ) { echo 'checked'; } ?> value="1"> Местный<br>
                <input type="radio" name="resident" <?php if ($student->resident == 2 ) { echo 'checked'; } ?> value="2"> Иногородний
            </div>
        </div>
        <div class="row">
            <input type="submit" value="Зарегистрироваться">
        </div>
    </form>
</div>
</body>
</html>