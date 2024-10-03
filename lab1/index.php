<?php
//Task 1
echo "Hello, world!";

//Task 2

//Make 4 different valuables
$str = "Hello!";
$int = 19;
$doble = 19.2;
$bool = true;

//print all valuables
echo "$str + $int + $doble + $bool"."<br>";

//print types of our valuables
var_dump($str, $int, $doble, $bool);

//Task 3
$str1 = "Hello, ";
$str2 = "World!";
echo "<br>" . $str1 . $str2;

//Task 4
$num = 4;
if($num%2 == 0){
    echo "<br>"."Num is even";
} else echo "<br>"."Num is odd";

//Task 5
for($i = 1; $i < 11; $i++){
    echo "<br>".$i;
}
echo "<br>";
$num1 = 10; 
while($num1 > 0){
    echo "<br>".$num1;
    $num1 = $num1-1;
}

//Task 6
echo "<br>";
$student = array ('name' => 'Yelisei',
					'surname' => 'Savushkin',
					'age' => 19,
                    'specs' => 'Computer Science');
print_r($student);
$student['grade'] = 88;
echo "<br>";
print_r($student);
?>
<?php
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    if (empty($first_name) || empty($last_name)) {
        echo "<p>Будь ласка, заповніть всі поля!</p>";
    } else {
        echo "<h1>Привіт, " . htmlspecialchars($first_name) . " " . htmlspecialchars($last_name) . "!</h1>";
    }
} else {
    echo "<p>Дані не були відправлені!</p>";
}

