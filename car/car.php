<?php
include "database.php";

class Car extends Database
{
    public $tblname = "Car";
    public function createTable()
    {
     

        $table = "CREATE TABLE IF NOT EXISTS $this->tblname(
            id int primary key auto_increment,
            classification varchar(50) not null,
            types varchar(50) not null,
            wheels varchar(50) not null,
            fuel_source varchar(50) not null,
            manual_or_auto varchar(50) not null,
            abs varchar(50) not null)";

        //inititalize to create car table
            $this->db();
            $this->conn->query($table);

    }

    public function search($params)
    {
        if($_SERVER['REQUEST_METHOD'] != 'GET'){
            return json_encode([
           'code'=> 'GET METHOD IS REQUIRED',
            ]);
    }

    $classification = $params['classification']?? '';
    $sql = "SELECT * FROM car where classification like '%$classification%'";

    $car = $this->conn->query($sql);

    if(empty($this->getError())){
        return json_encode($car->fetch_all(MYSQLI_ASSOC));

    }else {
        return json_encode([
            'code' => 500,
            'message' => $this->getError(), 
        ]);
    }
    if($_SERVER['REQUEST_METHOD'] != 'GET'){
        return json_encode([
       'code'=> 'GET METHOD IS REQUIRED',
        ]);

    }
    $classification = $params['classification']?? '';
    $sql = "SELECT * FROM car where classification like '%$classification%'";
    
    $classification = $this->conn->query($sql);

    if(empty($this->getError())){
        return json_encode($car->fetch_all(MYSQLI_ASSOC));

       }else {
           return json_encode([
               'code' => 500,
               'message' => $this->getError(), 
           ]);
       }
       
    }

    public function getRecord($params)
    {
        if($_SERVER['REQUEST_METHOD'] != 'GET'){
            echo json_encode([
                "code" => 201,
                "message" => $_SERVER['REQUEST_METHOD']. " Method is not allowed, Only GET Method is allowed",
            ]);
        
            exit();
        }

        if(!isset($params['id']) || empty($params['id'])) {
            $response = [
                "code" => 422,
                "message" => "ID Field is required"
            ];

            return json_encode($response);
        }

        $id = $params['id'];

        $data = $this->conn->query("SELECT * FROM $this->tblname WHERE id = $id");

        if($data->num_rows == 0){
            $response = [
                "code" => 404,
                "message" => "no Racer record found"
            ];

            return json_encode($response);
        }
        
        return json_encode($data->fetch_assoc());
       
    }

    public function getAll()
    {
        $car = $this->conn->query("SELECT * FROM car");

        return json_encode($car->fetch_all(MYSQLI_ASSOC));
    }

    public function create1($params)
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
             return json_encode([
            'code'=> 'POST METHOD IS REQUIRED',
        ]);

    }

    if(!isset($params['classification']) || empty($params['classification'])){
        return json_encode([
            'code'=> 'Classification is required',
        ]);
    }

    if(!isset($params['types']) || empty($params['types'])){
        return json_encode([
            'code'=> 'Types is required',
        ]);
    }

    if(!isset($params['wheels']) || empty($params['wheels'])){
        return json_encode([
            'code'=> 'Wheels is required',
        ]);
    }

    if(!isset($params['fuel_source']) || empty($params['fuel_source'])){
        return json_encode([
            'code'=> 'Fuel Source is required',
        ]);
    }

    if(!isset($params['manual_or_auto']) || empty($params['manual_or_auto'])){
        return json_encode([
            'code'=> 'Manual/Auto is required',
        ]);
    }

    if(!isset($params['abs']) || empty($params['abs'])){
        return json_encode([
            'code'=> 'Abs is required',
        ]);
    }

    $classification = $params['classification'];
    $types = $params['types'];
    $wheels = $params['wheels'];
    $fuel_source = $params['fuel_source'];
    $manual_or_auto = $params['manual_or_auto'];
    $abs = $params['abs'];

    $sql = "INSERT INTO $this->tblname(id, classification, types, wheels, fuel_source, manual_or_auto, abs) VALUES(NULL,'$classification','$types','$wheels','$fuel_source','$manual_or_auto','$abs')";

    $added = $this->conn->query($sql);

    if($added){
        echo json_encode([
            'code' => 200,
            'message' => 'The car successfully added' 
        ]);

        exit();
    }else {
        echo json_encode([
            'code' => 500,
            'message' => 'error',
        ]);

        exit();
    }
}

public function update($params)
{
    if(!isset($params['classification']) || empty($params['classification'])){
        return json_encode([
            'code'=> 'Classification is required',
        ]);
    }

    if(!isset($params['types']) || empty($params['types'])){
        return json_encode([
            'code'=> 'Types is required',
        ]);
    }

    if(!isset($params['wheels']) || empty($params['wheels'])){
        return json_encode([
            'code'=> 'Wheels is required',
        ]);
    }

    if(!isset($params['fuel_source']) || empty($params['fuel_source'])){
        return json_encode([
            'code'=> 'Fuel Source is required',
        ]);
    }

    if(!isset($params['manual_or_auto']) || empty($params['manual_or_auto'])){
        return json_encode([
            'code'=> 'Manual/Auto is required',
        ]);
    }

    if(!isset($params['abs']) || empty($params['abs'])){
        return json_encode([
            'code'=> 'Abs is required',
        ]);
    }

    if(!isset($params['id']) || empty($params['id'])){
        return json_encode([
            'code'=> 'ID is required',
        ]);
    }

        $id = $params['id'];
        $classification = $params['classification'];
        $types = $params['types'];
        $wheels = $params['wheels'];
        $fuel_source = $params['fuel_source'];
        $manual_or_auto = $params['manual_or_auto'];
        $abs = $params['abs'];

        $sql = "UPDATE car SET classification = '$classification', types = '$types', wheels = '$wheels', fuel_source = '$fuel_source', manual_or_auto = '$manual_or_auto', abs = '$abs'
        where id = '$id'";

$updated = $this->conn->query($sql);

if($updated){
    return json_encode([
        'code' => 200,
        'message' => 'The car successfully updated', 
    ]);
}else {
    return json_encode([
        'code' => 500,
        'message' => $this->getError(), 
    ]);
}

}

public function delete($params)
{
    if($_SERVER['REQUEST_METHOD'] != 'GET'){
        return json_encode([
       'code'=> 'GET METHOD IS REQUIRED',
        ]);

   }
   if(!isset($params['id']) || empty($params['id'])){
    return json_encode([
        'code'=> 'ID is required',
    ]);
}

$id = $params['id'];

$sql = "DELETE FROM car where id = '$id'";

$deleted = $this->conn->query($sql);

if($deleted){
    return json_encode([
        'code' => 200,
        'message' => 'The car successfully deleted', 
    ]);
}else {
    return json_encode([
        'code' => 500,
        'message' => $this->getError(), 
    ]);
}

}
}
$call = new Car();
$call->createTable();

?>