<?php
    include_once 'db_connect.php';
    $sql = "SELECT * FROM jobs_new";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    class Job{
        var $title;
        var $company;
        var $location;
        var $salary;
        var $description;
        var $field;
        var $type;
        
        function setField($Field){
            $this->field = $Field;
        }
        
        function setType($Type){
            $this->type = $Type;
        }
        
        function setTitle($Title){
            $this->title = $Title;
        }
        
        function setCompany($Company){
            $this->company = $Company;
        }
        
        function setSalary($Salary){
            $this->salary = $Salary;
        }
        
        function setLocation($Location){
            $this->location = $Location;
        }
        
        function setDescription($Description){
            $this->description = $Description;
        }
        
        function getField(){
            return $this->field;
        }
        
        function getType(){
            return $this->type;
        }
        
        function getTitle(){
            return $this->title;
        }
        
        function getCompany(){
            return $this->company;
        }
        
        function getSalary(){
            return $this->salary;
        }
        
        function getLocation(){
            return $this->location;
        }
        
        function getDescription(){
            return $this->description;
        }
        
    }

    $jobs_array = array();

    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $next_job = new Job();
            $next_job->setTitle($row['job_title']);
            $next_job->setCompany($row['job_company']);
            $next_job->setSalary($row['job_salary']);
            $next_job->setLocation($row['job_location']);
            $next_job->setDescription($row['job_desctription']);
            $next_job->setField($row['job_field']);
            $next_job->setType($row['job_type']);
            
            array_push($jobs_array, $next_job);
        }
    }
