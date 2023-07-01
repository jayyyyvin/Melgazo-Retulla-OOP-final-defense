<?php
include "database.php";

class User extends Database
{
    public $tblname = "User";
    public function createTable()
    {
     

        $table = "CREATE TABLE IF NOT EXISTS $this->tblname(
            id int primary key auto_increment,
            username varchar(50) not null,
            password varchar(50) not null,
            gender varchar(50) not null,
            age int not null,
            location varchar(50) not null,
            status varchar(50) not null)";

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

    $username = $params['username']?? '';
    $sql = "SELECT * FROM user where username like '%$username%'";

    $user = $this->conn->query($sql);

    if(empty($this->getError())){
        return json_encode($user->fetch_all(MYSQLI_ASSOC));

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

    $username = $params['username']?? '';
    $sql = "SELECT * FROM user where username like '%$username%'";

    $username = $this->conn->query($sql);

    if(empty($this->getError())){
        return json_encode($user->fetch_all(MYSQLI_ASSOC));

       }else {
           return json_encode([
               'code' => 500,
               'message' => $this->getError(), 
           ]);
       }
       
    }

    public function getAll()
    {
        $user = $this->conn->query("SELECT * FROM user");

        return json_encode($user->fetch_all(MYSQLI_ASSOC));
    }

    public function create1($params)
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
             return json_encode([
            'code'=> 'POST METHOD IS REQUIRED',
        ]);
    }
    if(!isset($params['username']) || empty($params['username'])){
        return json_encode([
            'code'=> 'username is required',
        ]);
    }

    if(!isset($params['password']) || empty($params['password'])){
        return json_encode([
            'code'=> 'password  is required',
        ]);
    }

    if(!isset($params['gender']) || empty($params['gender'])){
        return json_encode([
            'code'=> 'gender is required',
        ]);
    }

    if(!isset($params['age']) || empty($params['age'])){
        return json_encode([
            'code'=> 'age is required',
        ]);
    }

    if(!isset($params['location']) || empty($params['location'])){
        return json_encode([
            'code'=> 'location is required',
        ]);
    }

    if(!isset($params['status']) || empty($params['status'])){
        return json_encode([
            'code'=> 'status is required',
        ]);
    }  
    
    $username = $params['username'];
    $password  = $params['password'];
    $gender = $params['gender'];
    $age = $params['age'];
    $location = $params['location'];
    $status = $params['status'];

    $sql = "INSERT INTO $this->tblname(id, username, password, gender, age, location, status) VALUES(NULL,'$username','$password','$gender','$age','$location','$status')";

    $added = $this->conn->query($sql);

    if($added){
        echo json_encode([
            'code' => 200,
            'message' => 'The user successfully added' 
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
    if(!isset($params['username']) || empty($params['username'])){
    return json_encode([
        'code'=> 'username is required',
    ]);
}

if(!isset($params['password ']) || empty($params['password '])){
    return json_encode([
        'code'=> 'password is required',
    ]);
}

if(!isset($params['gender']) || empty($params['gender'])){
    return json_encode([
        'code'=> 'gender is required',
    ]);
}

if(!isset($params['age']) || empty($params['age'])){
    return json_encode([
        'code'=> 'age is required',
    ]);
}

if(!isset($params['location']) || empty($params['location'])){
    return json_encode([
        'code'=> 'location is required',
    ]);
}

if(!isset($params['status']) || empty($params['status'])){
    return json_encode([
        'code'=> 'status is required',
    ]);
}

if(!isset($params['id']) || empty($params['id'])){
    return json_encode([
        'code'=> 'ID is required',
    ]);
}

$id = $params['id'];
$username = $params['username'];
$password  = $params['password '];
$gender = $params['gender'];
$age = $params['age'];
$location = $params['location'];
$status = $params['status'];

$sql = "UPDATE racer SET username = '$username', password = '$password', gender = '$gender', age = '$age', location = '$location', status = '$status'
    where id = '$id'";

$updated = $this->conn->query($sql);

if($updated){
    return json_encode([
        'code' => 200,
        'message' => 'The user successfully updated', 
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

$sql = "DELETE FROM user where id = '$id'";

$deleted = $this->conn->query($sql);

if($deleted){
    return json_encode([
        'code' => 200,
        'message' => 'The user successfully deleted', 
    ]);
}else {
    return json_encode([
        'code' => 500,
        'message' => $this->getError(), 
            ]);
        }
    }
    
    public function authentication()
    {
        if (!isset($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_PW'])) {
        echo json_encode([
            'code' => 401,
            'message' => 'Authentication is required!'
        ]);
        } else {
            $username = $_SERVER['PHP_AUTH_USER'];
            $password = $_SERVER['PHP_AUTH_PW'];

            $sql = $this->conn->query("SELECT * FROM $this->tblname");
        // Here, you can perform validation or check against a database of users
            
        // Example: Check if the username and password are correct
        if ($username === 'defense' && $password === 'melgazoretulla') {
            echo json_encode([
                'code' => 200,
                'message' => 'authentication successful!'
                ]);
            // Continue with the protected content or redirect to another page
            return json_encode($sql->fetch_all(MYSQLI_ASSOC));
        } else {
            echo json_encode([
                'code' => 401,
                'message' => 'Invalid Authentication!'
                ]);
            }
        }
    }

}


?>