<?php

class MerchandiseController extends Controller{

    static function cart()
    {
        $data = ["step" => $_GET['step']?? 1];

        if(isset($_POST['step']))
        {
            if($_POST['step']=="Proceed to Shipping")
            {
                $data["step"]=2;
            }
        }

        View::render('reg_user/cart', $data);
    }

    public function pay()
    {
        //process purchase details
        $payment_link = Pay::payment("Merchandise Purchase", 237500, "/Merchandise/cart?step=4", "/Merchandise/cart");
        $this->redirect($payment_link);
    }
}
