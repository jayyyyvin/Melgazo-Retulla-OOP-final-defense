<?php
include "database.php";

class Racer extends Database
{
    public $tblname = "Racer";
    public function createTable()
    {
     

        $table = "CREATE TABLE IF NOT EXISTS $this->tblname(
            id int primary key auto_increment,
            team varchar(50) not null,
            fname varchar(50) not null,
            mname varchar(50) not null,
            lname varchar(50) not null,
            age int not null,
            country varchar(50) not null)";

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

    $team = $params['team']?? '';
    $sql = "SELECT * FROM racer where team like '%$team%'";

    $racer = $this->conn->query($sql);

    if(empty($this->getError())){
        return json_encode($racer->fetch_all(MYSQLI_ASSOC));

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
    $team = $params['team']?? '';
    $sql = "SELECT * FROM racer where team like '%$team%'";

    $team = $this->conn->query($sql);

    if(empty($this->getError())){
        return json_encode($racer->fetch_all(MYSQLI_ASSOC));

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
        $racer = $this->conn->query("SELECT * FROM racer");

        return json_encode($racer->fetch_all(MYSQLI_ASSOC));
    }

    public function create1($params)
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
             return json_encode([
            'code'=> 'POST METHOD IS REQUIRED',
        ]);

    }

    if(!isset($params['team']) || empty($params['team'])){
        return json_encode([
            'code'=> 'Team is required',
        ]);
    }

    if(!isset($params['fname']) || empty($params['fname'])){
        return json_encode([
            'code'=> 'First Name is required',
        ]);
    }

    if(!isset($params['mname']) || empty($params['mname'])){
        return json_encode([
            'code'=> 'Middle Name is required',
        ]);
    }

    if(!isset($params['lname']) || empty($params['lname'])){
        return json_encode([
            'code'=> 'Last Name is required',
        ]);
    }

    if(!isset($params['age']) || empty($params['age'])){
        return json_encode([
            'code'=> 'Age is required',
        ]);
    }

    if(!isset($params['country']) || empty($params['country'])){
        return json_encode([
            'code'=> 'Country is required',
        ]);
    }   

    $team = $params['team'];
    $fname = $params['fname'];
    $mname = $params['mname'];
    $lname = $params['lname'];
    $age = $params['age'];
    $country = $params['country'];

    $sql = "INSERT INTO $this->tblname(id, team, fname, mname, lname, age, country) VALUES(NULL,'$team','$fname','$mname','$lname','$age','$country')";

    $added = $this->conn->query($sql);

    if($added){
        echo json_encode([
            'code' => 200,
            'message' => 'The racer successfully added' 
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
    if(!isset($params['team']) || empty($params['team'])){
        return json_encode([
            'code'=> 'team is required',
        ]);
    }

    if(!isset($params['fname']) || empty($params['fname'])){
        return json_encode([
            'code'=> 'First Name is required',
        ]);
    }

    if(!isset($params['mname']) || empty($params['mname'])){
        return json_encode([
            'code'=> 'Middle Name is required',
        ]);
    }

    if(!isset($params['lname']) || empty($params['lname'])){
        return json_encode([
            'code'=> 'Last Name is required',
        ]);
    }

    if(!isset($params['age']) || empty($params['age'])){
        return json_encode([
            'code'=> 'Age is required',
        ]);
    }

    if(!isset($params['country']) || empty($params['country'])){
        return json_encode([
            'code'=> 'Country is required',
        ]);
    }

    if(!isset($params['id']) || empty($params['id'])){
        return json_encode([
            'code'=> 'ID is required',
        ]);
    }

    $id = $params['id'];
    $team = $params['team'];
    $fname = $params['fname'];
    $mname = $params['mname'];
    $lname = $params['lname'];
    $age = $params['age'];
    $country = $params['country'];

    $sql = "UPDATE racer SET team = '$team', fname = '$fname', mname = '$mname', lname = '$lname', age = '$age', country = '$country'
    where id = '$id'";

$updated = $this->conn->query($sql);

if($updated){
    return json_encode([
        'code' => 200,
        'message' => 'The racer successfully updated', 
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

$sql = "DELETE FROM racer where id = '$id'";

$deleted = $this->conn->query($sql);
    
if($deleted){
    return json_encode([
        'code' => 200,
        'message' => 'The racer successfully deleted', 
    ]);
}else {
    return json_encode([
        'code' => 500,
        'message' => $this->getError(), 
    ]);
}

}
}
$call = new Racer();
$call->createTable();

?>
    