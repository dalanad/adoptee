<?php
class EmployeeController
{

    function view()
    {
        $model = new EmployeeModel();
        $data = [
            'employees' => $model->getEmployees()
        ];

        View::render("employees", $data);
    }

    function viewById()
    {
        $model = new EmployeeModel();
        $data = [
            'employee' => $model->getEmployeeById($_GET["id"])[0]
        ];
        View::render("single_employee", $data);
    }
}
