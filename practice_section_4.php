<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Practice Section 4</title>
</head>
<body>

<?php
    /*
     * Step 1: Define a function and make it return a calculation of 2 number.
     * Step 2: Make a function that passes parameters and call it using parameter values.
     * */
    function calculate_two_digits($first_digit, $second_digit, $operation) {
        $result = '';
        switch ($operation) {
            case 'addition':
                $result = $first_digit + $second_digit;
                break;
            case 'subtraction':
                $result = $first_digit - $second_digit;
                break;
            case 'multiplication':
                $result = $first_digit * $second_digit;
                break;
            case 'division':
                $second_digit !=0 ? $result = $first_digit / $second_digit : $result = 'Error, division by 0 is impossible.';
        }
        return $result;
    }
    $v = [];
    $v['first_digit'] = $_POST['firstDigit'] ?? '';
    $v['second_digit'] = $_POST['secondDigit'] ?? '';
    $v['operation'] = $_POST['operation'] ?? '';
    $v['submit'] = $_POST['submit'];

    if ($v['submit'] && !empty($v['first_digit']) && !empty($v['second_digit']) ) {
        $result = '';
        $result = calculate_two_digits($v['first_digit'],$v['second_digit'],$v['operation']);
    } else {
        $result = 'No calculation elements given!';
    }
?>

<h1>Simple calculator</h1>
<form action="<?=$_SERVER['PHP_SELF'];?>" method="POST">
    <label for="firstDigit">First digit:</label>
    <input type="number" id="firstDigit" name="firstDigit" value=<?echo $v['first_digit'];?>><br><br>
    <label for="operation">Operation:</label>
    <select name="operation" id="operation" value=<?echo $v['operation'];?>>
        <option value="addition">Addition</option>
        <option value="subtraction">Subtraction</option>
        <option value="multiplication">Multiplication</option>
        <option value="division">Division</option>
    </select><br><br>
    <label for="secondDigit">Second digit:</label>
    <input type="number" id="secondDigit" name="secondDigit" value=<?echo $v['second_digit'];?>><br><br>
    <input type="submit" name="submit" value="Submit"><br><br>
<label for="result">Result:</label>
<output name="result" for="result"><?echo $result;?></output>

</body>
</html>