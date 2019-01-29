<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // Get tag
    $tag = $_POST['tag'];

    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();
    // response Array

    // check for tag type
    if ($tag == 'getPostData') {
        // Request type is check Login
        $id = $_POST['idNo'];
        $postId = $_POST['postId'];

        $result = mysql_query("SELECT * FROM posts  WHERE id   LIKE '$postId'  ORDER BY id DESC limit 10 ") or die(mysql_error());
        $results['post'] = array();
        while ($row = mysql_fetch_array($result)) {
            $result0 = mysql_query("SELECT * FROM likes WHERE userid LIKE '$id' AND postid LIKE '$postId' ") or die(mysql_error());
            $no_of_rows0 = mysql_num_rows($result0);

            $results['post'][] = array(
                'id' => $row['id'],
                'userId' => $row['userid'],
                'name' => $row['name'],
                'image' => $row['image'],
                'video' => $row['video'],
                'videoThumbName' => $row['videoThumbName'],
                'profilePic' => $row['profilePic'],
                'status' => $row['status'],
                'timeStamp' => $row['timestamp'],
                'nLike' => $row['nlike'],
                'myLike' => ($no_of_rows0 > 0),
            );

        }
        print json_encode($results);


    }
}

?>
