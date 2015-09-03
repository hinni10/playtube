<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Playtube</title><!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<?php
$host = "localhost";
$username = "root";
$password = "";
$db_name="playtube"; // Database name 
$tbl_name="youtubelinks";

mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

$sql="SELECT * FROM $tbl_name";
$result=mysql_query($sql);
?>
<body>
  <div style="margin-top:30px;" class="container">
        <div class="well well-lg">
          <div style="margin-top:-5px;" class="text-bold text-center h1"><strong>Playtube</strong></div>
          <form action="addYoutubeLink.php">
            <div style="width:95%; margin-top:40px;" class="input-group ">
                <span class="input-group-addon" id="basic-addon1">
                  <span class="glyphicon glyphicon-play"></span>
                </span> 
                <input name="vidlink" class="form-control" id="youtubeLink" placeholder="Youtube link" type="text">

            </div>
            <button style="margin-top:-34px;" type="submit" class="pull-right btn btn-default"><strong>Add</strong></button>
          </form>
<?php 

while($rows=mysql_fetch_array($result)){
?>
<div class="panel panel-default">
  <div class="panel-body">
    <iframe style="float:left; margin-top:0px;" height="141" width="250" src="<?php echo $rows['link']; ?>" width="420"></iframe>
    <h2 style="float:left; margin-left:20px;" class="col-md-offset-1 "><?php echo $rows['title']; ?> </h2>
  </div>
</div>

<?php
// Exit looping and close connection 
}
mysql_close();
?>


    
            
        </div>
    </div><!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src=
    "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed -->
     <script src="js/bootstrap.min.js"></script>
</body>
</html>