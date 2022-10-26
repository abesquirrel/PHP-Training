<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Practice Section 5</title>
</head>
<body>
<?php
    /*
     * Step 1: Use a pre-built math function here and echo it
     * Step 2: Use a pre-built string function here and echo it
     * Step 3: Use a pre-built Array function here and echo it
     */

    function sanitize_string(string $text) {
        return preg_replace("/[^A-Za-z0-9 ]/", '', $text);
    }
    $v = [];
    $v['number'] = $_POST['numberInput'] ?? '';
    $v['from_base'] = $_POST['fromBase'] ?? '';
    $v['to_base'] = $_POST['toBase'] ?? '';
    $v['submit'] = $_POST['submit'] ?? '';

    $result = '';
    if ($v['submit']) {
        if (!empty($v['number']) && !empty($v['from_base']) && !empty($v['to_base'])) {
            $result = strtoupper( base_convert(
                    sanitize_string($v['number']),
                (int)$v['from_base'],
                (int)$v['to_base']) );
        }
    }
?>

    <div class="container">
        <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
            <div class="row">
                <label for="number">Number</label>
            </div>
            <div class="row">
                <input type="text" id="numberInput" name="numberInput" placeholder="Number" value=<?echo $v['number']?>>
            </div>
            <div class="row">
                <label for="from_base">From base</label>
            </div>
            <div class="row">
                <select name="fromBase" id="fromBase">
                    <option value="2">Binary</option>
                    <option value="10">Decimal</option>
                    <option value="8">Octal</option>
                    <option value="16">Hexadecimal</option>
                </select>
            </div>
            <div class="row">
                <label for="to_base">To base</label>
            </div>
            <div class="row">
                <select name="toBase" id="toBase">
                    <option value="2">Binary</option>
                    <option value="10">Decimal</option>
                    <option value="8">Octal</option>
                    <option value="16">Hexadecimal</option>
                </select>
            </div>
            <div class="row">
                <input type="submit" name="submit">
            </div>
            <div class="row">
                <label for="result">Result</label>
            </div>
            <div class="row">
                <output name="result" for="result"><?echo $result;?></output>
            </div>
        </form>
    </div>
</body>
</html>