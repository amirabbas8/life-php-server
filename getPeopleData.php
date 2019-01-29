<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {
    $tag = $_POST['tag'];
    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();
    // check for tag type
    if ($tag == 'people') {
        $id = $_POST['id'];
        $search = $_POST['search'];
        if ($search == '') {
            $result = mysql_query("SELECT * FROM friend  WHERE user1 LIKE '$id'  ORDER BY idnum DESC limit 10 ") or die(mysql_error());
        } else {
            $result = mysql_query("SELECT * FROM users where   realname REGEXP '$search'  OR username REGEXP '$search'  ORDER BY id DESC limit 10 ") or die(mysql_error());
        }
        $results['user'] = array();
        while ($row = mysql_fetch_array($result)) {
            $b = $row['id'];
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
                'MyFollowStatus' => $MyFollowStatus
            );


        }
        print json_encode($results);


    } elseif ($tag == 'peopleLoadMore') {
        $id = $_POST['id'];
        $pid = $_POST['pid'];
        $search = $_POST['search'];
        if ($search == '') {
            $result0 = mysql_query("SELECT * FROM friend  WHERE  id LIKE '$pid'  ") or die(mysql_error());
            $row0 = mysql_fetch_array($result0);
            $a= $row0['idnum'];
            $result = mysql_query("SELECT * FROM friend  WHERE idnum<'$a' AND user1 LIKE '$id'  ORDER BY idnum DESC limit 10 ") or die(mysql_error());
        } else {
            $result = mysql_query("SELECT * FROM users where  id<'$pid' AND  (realname REGEXP '$search'  OR username REGEXP '$search')  ORDER BY id DESC limit 10 ") or die(mysql_error());
        }
        $results['user'] = array();
        while ($row = mysql_fetch_array($result)) {
            $b = $row['id'];
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
                'MyFollowStatus' => $MyFollowStatus
            );


        }
        print json_encode($results);

    }
}

?>
