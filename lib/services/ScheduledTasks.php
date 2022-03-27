<?php
class ScheduledTasks extends BaseModel
{

    public static function run($task_name)
    {
        # code...
    }

    public static function expire_consultations()
    {
        $items = self::select("SELECT * FROM consultation WHERE consultation_date < now() AND status = 'PENDING'");

        foreach ($items as $consultation) {

            Pay::refundPayment($consultation["payment_txn_id"]);

            $query = "UPDATE `payment` SET status = 'REFUNDED' WHERE txn_id = :txn_id ";
            $params = [
                "txn_id" => $consultation["payment_txn_id"],
            ];

            self::update($query, $params);

            self::update(
                "UPDATE consultation set status = 'EXPIRED' WHERE consultation_date < now() AND status = 'PENDING' AND consultation_id = :consultation_id",
                ["consultation_id" => $consultation["consultation_id"]]
            );


            $doctor = User::findUserById($consultation["doctor_user_id"]);
            Notification::sendNotification(
                $consultation["user_id"],
                "Doctor Consultaion Expired",
                "Your Consultation for ",
                $doctor["name"] . " on " . $consultation["consultation_date"] . " @ " . $consultation["consultation_time"] . " has expired due to not accepting "
            );
        }
    }

    public static function adoption_request_auto_decline()
    {
        $items = self::select("SELECT * FROM adoption_request 
                               WHERE request_date < DATE_SUB(DATE(NOW()), INTERVAL 2 DAY) 
                               AND status = 'PENDING')");

        foreach ($items as $request) {

            $query = "UPDATE adoption_request SET status = 'REJECTED' WHERE request_id = :request_id ";
            $params = [
                "request_id" => $request['request_id']
            ];

            self::update($query, $params);

            $animal = Animal::getAnimalById($request['animal_id']);
            Notification::sendNotification(
                $request["user_id"],
                "Adoption Request Expired",
                "Your Request made on",
                $request["request_date"] . " to adopt " .$animal['name']. " has expired due to not accepting "
            );
        }
    }
}

