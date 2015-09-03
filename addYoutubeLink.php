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
	

    function getYouTubeIdFromURL($url)
    {
      $url_string = parse_url($url, PHP_URL_QUERY);
      parse_str($url_string, $args);
      return isset($args['v']) ? $args['v'] : false;
      $call = embedYoutubeId();
    }
    

    function embedYoutubeId()
    {
      $ytLink = $_GET['vidlink'];
      $youtube_id = getYouTubeIdFromURL($ytLink);
      $youtubeCompleteLink = "http://www.youtube.com/embed/".$youtube_id."?modestbranding=1&autohide=1&showinfo=0&controls=0";
      return $youtubeCompleteLink;
    }

    

    

?>

<?php
$host = "localhost";
$username = "root";
$password = "";
$db_name="playtube"; // Database name 
$tbl_name="youtubelinks";

mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

$ytLink=$_GET['vidlink'];

function yt_exists($videoID) {
    $theURL = "http://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=$videoID&format=json";
    $headers = get_headers($theURL);

    $content = file_get_contents("http://youtube.com/get_video_info?video_id=".$videoID);
    parse_str($content, $ytarr);
    $linkTitle = $ytarr['title'];

    if (substr($headers[0], 9, 3) !== "404") {
    	$tbl_name="youtubelinks";
    	$youtubeCompleteLinkReady = embedYoutubeId();
        $sql="INSERT INTO $tbl_name(link, title)VALUES('$youtubeCompleteLinkReady', '$linkTitle')";
		$result=mysql_query($sql);
		if($result){
			echo "<h1></h1>";
      echo '<meta http-equiv="refresh" content="0; url=index.php" />';
			};
    } else {
        echo "Wrong Link!";
        echo '<meta http-equiv="refresh" content="2; url=index.php" />';
    }
	}

$checkLink = yt_exists(getYouTubeIdFromURL($ytLink));

?>

