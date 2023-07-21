<?php
    $value = $argv[1];

    if($value % 3 === 0 && $value % 5 === 0){
        echo "FizzBuzz\n";
    }elseif ($value % 3 === 0){
        echo "Fizz\n";
    }
    elseif ($value % 5 === 0){
        echo "Buzz\n";
    }else{
        echo $value;
    }
?>
