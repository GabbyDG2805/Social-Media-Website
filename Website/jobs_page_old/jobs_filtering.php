<?php
    include_once 'db_connect.php';
    include_once 'job_objects.php';
    
    $valid_array = array();
    $fieldVar = $_POST['field'];
    $typeVar = $_POST['type'];
    $salaryVar = $_POST['salary'];
    $locationVar = $_POST['location'];
    $orderVar = $_POST['orderBy'];
    
    if($salaryVar == "£0 - £10k"){
        $upper = 10000;
        $lower = 0;
    }
    elseif($salaryVar == "£10k - £20k"){
        $upper = 20000;
        $lower = 10000;
    }
    elseif($salaryVar == "£20k - £30k"){
        $upper = 20000;
        $lower = 30000;
    }
    elseif($salaryVar == "£30k +"){
        $lower = 30000;
        $upper = 10000000;
    }
    else{$lower = 20000000; $upper = 20000001;}

    foreach($jobs_array as $job){
        if($job->getSalary() > $lower && $job->getSalary() < $upper){
            if($job->getLocation() == $locationVar){
                if($job->getType() == $typeVar){
                    if($job->getField() == $fieldVar){
                        array_push($valid_array, $job);
                    }
                }             
            }
        }
    }

    if($orderVar == "By Title"){
        function cmp($a, $b){
            return strcmp($a->getTitle(), $b->getTitle());
        }
        usort($valid_array, "cmp");
    }

    elseif($orderVar == "By Company Name"){
        function cmp($a, $b){
            return strcmp($a->getCompany(), $b->getCompany());
        }
        usort($valid_array, "cmp");
    }

    echo json_encode($valid_array);
?>
