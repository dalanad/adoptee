<?php 
class Controller
{
    function HomePage()
    {
        $model = new BaseModel();
        $data = [
            'name'    => 'Dave',
            'colours' => ['red', 'green', 'blue'],
            // 'persons' => $model -> getPersons()
        ];
        
        View::render("home", $data);
    }

   
}