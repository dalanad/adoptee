<?php

class EmployeeModel extends BaseModel
{
    function getEmployees()
    {
        return $this -> select("SELECT * FROM `employee`");
    }
    function getEmployeeById($id)
    {
        return $this -> select("SELECT * FROM `employee` where emp_id = $id");
    }
}
