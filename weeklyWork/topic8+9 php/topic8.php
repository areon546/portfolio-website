<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 7 8 9</title>
    <script src="topic8.js"></script> 

</head>
<body>
    <?php 


$forecast = ["a" => 3];

foreach ($forecast as $value) { // lets you loop through the values
	print($value."<br>");
}

foreach ($forecast as $key => $value) {
	print($key." => ".$value."<br>");
}
    ?>
</body>
</html>