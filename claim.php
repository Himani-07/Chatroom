<?php

//Getting the value of post parameter
$room = $_POST['room'];
if(strlen($room)>20 or strlen($room)<2)
{
    $message="Please choose name between 2 to 20 characters";
    echo "<script>alert('".$message."');
          window.location='http://localhost/chatroom/'</script>";
}
else if(!ctype_alnum($room))
{
    $message="Please choose an alphanumeric character";
    echo "<script>alert('".$message."');
          window.location='http://localhost/chatroom/'</script>";
}

else
{
    include'conn.php';

//Check if room already exists

$sql="SELECT * FROM rooms WHERE roomname='$room'";
$result = mysqli_query($conn,$sql);
if($result)
{
    $number =mysqli_num_rows($result);
    if(mysqli_num_rows($result)>0)
    {
        $message="Please choose different name. This room name is alredy claimed.";
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="http://localhost/chatroom/";';
        echo '</script>';
    }
    else
    { 
        $sql = "INSERT INTO rooms (`roomname`, `date`) VALUES ('$room', current_timestamp());";
        if(mysqli_query($conn,$sql))
        {
            $message="Your room is ready now and you can chat now";
            echo '<script language="javascript">';
            echo 'alert("'.$message.'");';
            echo 'window.location="http://localhost/chatroom/rooms.php?roomname=' .$room. '";';
            echo '</script>';
        }
    }
}
else{
    echo "Error: ".mysqli_error($conn);
}
}
?>