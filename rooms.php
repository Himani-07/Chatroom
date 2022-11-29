<?php
include'conn.php';
$roomname=$_GET['roomname'];

$sql="SELECT * FROM rooms WHERE roomname='$roomname'";
$result=mysqli_query($conn,$sql);

if($result)
{
    if(mysqli_num_rows($result)==0)
    {
        // $message="This room doesnot exists.Try creating new one.";
        // echo '<script language="javascript">';
        // echo 'alert("'.$message.'");';
        // echo 'window.location="http://localhost/chatroom/";';
        // echo '</script>';
    }
}
else
{
    echo "Error" . mysqli_error($conn);
}
?>

<!--     -------------------------HTML--------------------------           -->

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">    
<link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/product/">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<!-- Custom styles for this template -->
<link href="css/product.css" rel="stylesheet">

<style>

  body {
    margin: 0 auto;
    max-width: 800px;
    padding: 0 20px;
  }

  .container {
    border: 2px solid #dedede;
    background-color: #f1f1f1;
    border-radius: 5px;
    padding:5px;
    margin: 10px 0;
  }

  .darker {
    border-color: #ccc;
    background-color: #ddd;
  }

  .container::after {
    content: "";
    clear: both;
    display: table;
  }

  .container img {
    float: left;
    max-width: 60px;
    width: 100%;
    margin-right: 20px;
    border-radius: 50%;
  }

  .container img.right {
    float: right;
    margin-left: 20px;
    margin-right:0;
  }

  .time-right {
    float: right;
    color: #aaa;
  }

  .time-left {
    float: left;
    color: #999;
  }
  .anyClass{
    height:350px;
    overflow-y:scroll;
  }
</style>
</head>

<body>
<header>
<!-- <nav class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow"> -->
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom box-shadow">
  <div class="container-fluid">
     <a class="navbar-brand" href="#">SecretChatRoom.com</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="d-flex" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>        
        </ul>
      </div>
  </div>
</nav>
</header>
<br>
<h2>Chat Messages-<?php echo $roomname; ?></h2>


<div class="container">
  <div class="anyClass">
    
  </div>
</div>

<input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="Add message"><br>
<button class="btn btn-default" name="submitmsg" id="submitmsg">SEND</button>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
  //Check for new messages every 1 sec
  setInterval(runFunction, 1000);
  function runFunction(){
    $.post("htcont.php",{room:'<?php echo $roomname?>'},
    function(data,status)
    {
      document.getElementsByClassName('anyClass')[0].innerHTML = data;
    })
  }

  // Get the input field
var input = document.getElementById("usermsg");
// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if(event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("submitmsg").click();
  }
});

  //if user submits the form
  $("#submitmsg").click(function(){
    var clientmsg = $("#usermsg").val();
    $.post("postmsg.php", {text:clientmsg, room:'<?php echo $roomname?>' ,ip: '<?php echo $_SERVER['REMOTE_ADDR'] ?>'},
  function(data,status){
    document.getElementsByClassName('anyClass')[0].innerHTML = data;});
    $("#usermsg").val("");
    return false;
});
</script>
</body>
</html>
