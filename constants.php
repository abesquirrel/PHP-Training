<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Constants</title>
</head>
<body>
<?php
    $number = 10;
    echo $number . "<br>";
//    define("NAME", 1000);
    const NAME = 10000;
    echo NAME . "<br>";

    /*
     * Alternatively, should use const instead of define(), moreover,
     * must consider that const can be define as a scalar expression.
     * A scalar expression are those tha contain an int, float, string
     * or bool.
     * */

//    const ANIMALS = array('dog','cat','bird');
//    echo ANIMALS[1] . "<br>";

    define('ANIMALS', array(
            'dog',
            'cat',
            'bird'
    ));

    echo ANIMALS[2];

?>
</body>
</html>