
<?php
$users = [
    [
        'name' => 'Soso',
        'age' => 25
    ],
    [
        'name' => 'Lolo',
        'age' => 25
    ],
    [
        'name' => 'Toto',
        'age' => 25
    ],
];


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>


<style>
    body{
        background-color: #112;
        color: #eee;
        padding: 20px;
    }
    </style>

<script>
alert('Welcome');
</script>
</head>
<body>
<h1>Home Page</h1>

<div>
    <?php
    foreach($users as $user){
        echo '<div>';
        echo '<h2>'.$user['name'].'</h2>';
        echo '<h5>'.$user['age'].'</h5>';
        echo '</div>';
    }
    ?>
</div>
</body>
</html>
