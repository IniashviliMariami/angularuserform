<?php                
// $servername = "localhost";
// $username = "root";
// $password = "";

// // Create connection
// $conn = mysqli_connect($servername, $username, $password);

// // Check connection
// if (!$conn) {
//   die("Connection failed: " . mysqli_connect_error());
// }
// echo "Connected successfully";



$connection = mysqli_connect('localhost','root','','angularwork');
mysqli_set_charset($connection,'utf8');
if(isset($_GET['userView'])&& $_GET['userView']==1){
    $query = 'SELECT * FROM  ';
    $result = mysqli_query($connection,$query);
    if($result->num_rows>0){
        $array = [];
        while($row=mysqli_fetch_assoc($result)){
            $array[]=$row;
        }
    }
    echo json_encode($array);
}
// for adding user
$data=json_decode(file_get_contents('php://input'),true);
if(isset($data['insert']) && $data['insert']==1){    
              $query="INSERT INTO users (NAME,PASSWORD)
                      VALUES ('".$data['NAME']."','".$data['PASSWORD']."')              
              ";
         $result=mysqli_query($connection,$query);
              if($result){
                      echo 'ჩანაწერი წარმატებით დაემატა';
              }else {
                      echo 'Something Went Wrong';
              }
}





if(isset($data['delete']) &&  $data['delete']==1){
    foreach($data['forDelete'] as $key=>$value){
            $sql="DELETE FROM users where ID=".$value."";
           $result= mysqli_query($connection,$sql);
    }
    if($result){
        echo 'deleted';
    }
}

if(isset($data['editID'])){
    $query = 'SELECT * FROM  users WHERE ID='.$data['editID'].'';
    $result = mysqli_query($connection,$query);
    
    
    
    if($result->num_rows>0){
        $array = [];
        while($row=mysqli_fetch_assoc($result)){
            $array[]=$row;
        }
    }
    echo json_encode($array);
}
    if(isset($data['idForUpdate'])){
        $sql="UPDATE users SET NAME='".$data['NAME']."', PASSWORD='".$data['PASSWORD']."' WHERE ID=".$data['idForUpdate']."";
        $result= mysqli_query($connection,$sql);
        if($result){
            echo 'edited';
        }
    }





?>

