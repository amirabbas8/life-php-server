<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // Get tag
    $tag = $_POST['tag'];

    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();
    // response Array

    // check for tag type
    if ($tag == 'share') {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $status = str_replace("'", "''", $status);
        $text = $_POST['text'];
        $code = $_POST['code'];
        $profilePic = $_POST['profilePic'];
        $name = $_POST['name'];
        $name = str_replace("'", "''", $name);
        $image = $_POST['imageName'];
        $video = $_POST['videoName'];
        $videoThumbName = $_POST['videoThumbName'];
        $location = $_POST['location'];
        $result = mysql_query("SELECT * FROM users WHERE id LIKE '$id' AND life_code LIKE '$code'") or die(mysql_error());
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {

            $result1 = mysql_query("INSERT INTO posts(userid,name,image,video,videoThumbName,profilePic,status,nlike,location) VALUES('$id' , '$name', '$image' ,'$video','$videoThumbName' ,'$profilePic','$status' ,'0','$location')");
            $result2 = mysql_query("SELECT * FROM posts  WHERE userid LIKE '$id'") or die(mysql_error());
            $nPosts = mysql_num_rows($result2);
            $result3 = mysql_query("UPDATE users SET nPosts = '$nPosts'  WHERE id LIKE '$id' ") or die(mysql_error());
            $results['user'] = array();
            $result2 = mysql_query("SELECT * FROM posts  WHERE status LIKE '$status' AND userid LIKE '$id'AND image LIKE '$image'AND video LIKE '$video'AND videoThumbName LIKE '$videoThumbName' limit 1") or die(mysql_error());
            $row = mysql_fetch_array($result2);
            $results['user'][0] = array('success' => "1", 'postId' => $row['id']);
            print json_encode($results);

        } else {
            $results['user'] = array();
            $results['user'][0] = array('success' => "2");
            print json_encode($results);
        }


    }
}
?>
