<?php

$con = mysqli_connect('localhost','root','','crudajax');

extract($_POST);

// retrieve data in tabular format
// READ DATA

if(isset($_POST['rd']))
{
    $data = "<table class='table table-bordered'>
        <tr>
        <th>ID</th>
        <th>FIRST NAME</th>
        <th>LAST NAME</th>
        <th>AGE</th>
        <th>DESIGNATION</th>
        <th>OPERATIONS</th>
        </tr>";
    
    $query="select * from employee";
    $res=mysqli_query($con,$query);
    if(mysqli_num_rows($res) > 0)
    {
        $num = 1;
        while($row = mysqli_fetch_array($res))
        {
            
            $data .= "
            <tr>
            <td>".$num."</td>
            <td>".$row['fname']."</td>
            <td>".$row['lname']."</td>
            <td>".$row['age']."</td>
            <td>".$row['desig']."</td>
            <td>
            <button class='btn btn-primary' onclick='GetUserDetails($row[id])'>Edit</button>
            
            <button class='btn btn-danger' onclick='DeleteUser($row[id])'>Delete</button>
            </td>
            </tr>";
            
            $num++;
        }
    }
    $data .= '</table>';
    echo $data;
}



// insert data
if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['age']) && isset($_POST['desig']))
{
    $query = "insert into employee (fname,lname,age,desig) values('$fname','$lname','$age','$desig')";
    
    mysqli_query($con,$query);
}


// DELETE RECORDS

//delete data code
if(isset($_POST['UserId']))
{
    $id = $_POST['UserId'];
    $query = "delete from employee where id = '$id'";
    mysqli_query($con,$query);
}

// FETCH DATA CODE

if(isset($_POST['userId']) && isset($_POST['userId']) != "")
{
    $userID = $_POST['userId'];
    $query = "select * from employee where id = '$userID'";
    
    $result = mysqli_query($con,$query);
    
    if(!$result)
    {
        exit(mysqli_error());
    }
    
    $response = array();
    
    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $response = $row;
        }
    }
    else
    {
        $response['status']=200;
        $response['message']="Data Not Found";
    }
    echo json_encode($response);
}
else
{
    $response['status']=200;
    $response['message']="Invalid Request";
}

// UPDATE DATA CODE..

// update data code
if(isset($_POST['update_hidden_id']))
{
    $update_Userid = $_POST['update_hidden_id'];
    $update_fname = $_POST['update_fname'];
    $update_lname = $_POST['update_lname'];
    $update_age = $_POST['update_age'];
    $update_desig = $_POST['update_desig'];
    
    $query = "update employee set fname = '$update_fname', lname = '$update_lname',age = '$update_age', desig = '$update_desig' where id = '$update_Userid'";
    
    mysqli_query($con,$query);
}


?>