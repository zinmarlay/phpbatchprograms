<?php
    $fp = fopen(__DIR__ . "/input.csv", "r");
    $linecount = 0;
    $mancount = 0;
    $womancount = 0;
    while ($data = fgetcsv($fp)){
        $linecount++;
        if($linecount === 1){
            continue;
        }
        var_dump($data);
        if($data[4] === "男性"){
            $mancount++;
        }else {
            $womancount++;
        }
    };
    fclose($fp);

    //debug
    echo "${mancount}, ${womancount}";

    $fpout = fopen(__DIR__ . "/output.csv", "w");
    $header = ["男性","女性"];
    fputcsv($fpout,$header);
?>