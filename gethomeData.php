<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // Get tag
    $tag = $_POST['tag'];

    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();
    // response Array

    // check for tag type
    if ($tag == 'home') {
        // Request type is check Login
        $id = $_POST['id'];
        $code = $_POST['code'];
        $result = mysql_query("SELECT * FROM users WHERE id LIKE '$id' AND life_code LIKE '$code'") or die(mysql_error());
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
        }
        $date = date("Y/m/d h:i:sa");
        $result2 = mysql_query("UPDATE users SET lastHomeGet = '$date'  WHERE id LIKE '$id' ") or die(mysql_error());

        $myfriend = mysql_query("select group_concat(id separator '\',\'') from friend where user1 = '$id'") or die(mysql_error());
        $row1 = mysql_fetch_assoc($myfriend);
        $a = $row1["group_concat(id separator '\',\'')"];
        $result = mysql_query("SELECT * FROM posts  WHERE userid IN ('$a','$id')  ORDER BY id DESC limit 10 ") or die(mysql_error());
        $results['post'] = array();
        while ($row = mysql_fetch_array($result)) {
            $b = $row['id'];
            $c = (string)$b;
            $result0 = mysql_query("SELECT * FROM likes WHERE userid LIKE '$id' AND postid LIKE '$c' ") or die(mysql_error());
            $no_of_rows0 = mysql_num_rows($result0);
            $myLike = False;
            if ($no_of_rows0 > 0) {
                $myLike = True;
            }
            $results['post'][] = array(
                'id' => $row['id'],
                'userId' => $row['userid'],
                'name' => $row['name'],
                'image' => $row['image'], 'video' => $row['video'],'videoThumbName' => $row['videoThumbName'],
                'location' => $row['location'],
                'profilePic' => $row['profilePic'],
                'status' => $row['status'],
                'timeStamp' => $row['timestamp'],
                'nLike' => $row['nlike'],
                'myLike' => $myLike
            );

        }
        print json_encode($results);


    } elseif ($tag == 'homeLoadMore') {
        // Request type is check Login
        $id = $_POST['id'];
        $pid = $_POST['pid'];
        $date = date("Y/m/d h:i:sa");
        $result2 = mysql_query("UPDATE users SET lastHomeGet = '$date'  WHERE id LIKE '$id' ") or die(mysql_error());
        $myfriend = mysql_query("select group_concat(id separator '\',\'') from friend where user1 = '$id'") or die(mysql_error());
        $row1 = mysql_fetch_assoc($myfriend);
        $a = $row1["group_concat(id separator '\',\'')"];
        $result = mysql_query("SELECT * FROM posts  WHERE userid IN ('$a','$id') AND id < '$pid'  ORDER BY id DESC limit 10 ") or die(mysql_error());
        $results['post'] = array();
        while ($row = mysql_fetch_array($result)) {
            $b = $row['id'];
            $c = (string)$b;
            $result0 = mysql_query("SELECT * FROM likes WHERE userid LIKE '$id' AND postid LIKE '$c' ") or die(mysql_error());
            $no_of_rows0 = mysql_num_rows($result0);
            $myLike = False;
            if ($no_of_rows0 > 0) {
                $myLike = True;
            }
            $results['post'][] = array(
                'id' => $row['id'],
                'userId' => $row['userid'],
                'name' => $row['name'],
                'image' => $row['image'],
                'video' => $row['video'],'videoThumbName' => $row['videoThumbName'],
                'profilePic' => $row['profilePic'],
                'status' => $row['status'],
                'timeStamp' => $row['timestamp'],
                'nLike' => $row['nlike'],
                'location' => $row['location'],
                'myLike' => $myLike
            );

        }
        print json_encode($results);


    }
}

?>
