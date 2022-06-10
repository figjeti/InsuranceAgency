<?php

    ini_set('auto_detect_line_endings', true);

    $arr= [
    ];

    $flag = true;
    if (($handle = fopen("../DataSets/FL_insurance_sample.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, NULL, ",")) !== FALSE) {

            if( $flag ) {
                $flag = false;
                continue;
            }

            $county = $data[2];
            $tiv_2012 = $data[8];
            $line = $data[15];

            if(isset($arr['county'][$county])) {
                $arr['county'][$county]["tiv_2012"] +=  $tiv_2012;
            } else {
                $arr['county'][$county]["tiv_2012"] =  $tiv_2012;
            }
            $arr['county'][$county]["tiv_2012"] = round($arr['county'][$county]["tiv_2012"], 2);

            if( isset($arr['line'][$line]) ) {
                $arr['line'][$line]["tiv_2012"] += $tiv_2012;
            } else {
                $arr['line'][$line]["tiv_2012"] =  $tiv_2012;
            }
            $arr['line'][$line]["tiv_2012"] = round($arr['line'][$line]["tiv_2012"],2);
        }
        fclose($handle);
    }

    file_put_contents('../AggregatedJSON/output.json', json_encode($arr));
