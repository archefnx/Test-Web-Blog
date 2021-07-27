<?php
$answers = [];

for ($i = 1; $i < 5; $i++)
{
    $question = 'q' . $i;
    if ($_POST[$question] == 'yes')
        $answers[] = 'yes';
}

if (count($answers) >= 2) {
    echo 'Похоже что вы добрый человек. <br>';
    echo '<a href="/">Вернутся на главную</a>';
} else
    echo 'Похоже вы не самый добрый человек. <br>';
    echo '<a href="/">Вернутся на главную</a>';
?>