<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {
    $tag = $_POST['tag'];
    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();
    // check for tag type
    if ($tag == 'notification') {
        $id = $_POST['id'];
        $code = $_POST['code'];
        $result = mysql_query("SELECT * FROM notification  WHERE receiver LIKE '$id'  ORDER BY id DESC limit 30 ") or die(mysql_error());

        $results['user'] = array();
        while ($row = mysql_fetch_array($result)) {
            $b = $row['sender'];
            $result11 = mysql_query("SELECT * FROM friend  WHERE user1 LIKE '$id' AND id LIKE '$b'  ") or die(mysql_error());

            $no_of_rows = mysql_num_rows($result11);
            if ($no_of_rows > 0) {
                $MyFollowStatus = true;
            } else {
                $MyFollowStatus = false;
            }
            $result1 = mysql_query("SELECT * FROM users where  id LIKE '$b'   ORDER BY id DESC limit 1 ") or die(mysql_error());
            $row1 = mysql_fetch_array($result1);
            $results['user'][] = array(
                'name' => $row1['realname'],
                'userId' => $row1['id'],
                'profilePic' => $row1['profileImage'],
                'id' => $row['id'],
                'postId' => $row['postId'],
                'MyFollowStatus' => $MyFollowStatus,
            );


        }
        print json_encode($results);


    }
}

?>
