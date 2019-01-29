<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // Get tag
    $tag = $_POST['tag'];

    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();
    // response Array

    // check for tag type
    if ($tag == 'get_feedlist_my_Life') {
        // Request type is check Login
        $id = $_POST['id'];
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

            if ($no_of_rows0 > 0) {
                $results['post'][] = array(
                    'id' => $row['id'],
                    'userid' => $row['userid'],
                    'name' => $row['name'],
                    'image' => $row['image'],
                    'profilePic' => $row['profilePic'],
                    'status' => $row['status'],
                    'timeStamp' => $row['timeStamp'],
                    'nlike' => $row['nlike'],
                    'mylike' => 'true',
                );
            } else {
                $results['post'][] = array(
                    'id' => $row['id'],
                    'userid' => $row['userid'],
                    'name' => $row['name'],
                    'image' => $row['image'],
                    'profilePic' => $row['profilePic'],
                    'status' => $row['status'],
                    'timeStamp' => $row['timeStamp'],
                    'nlike' => $row['nlike'],
                    'mylike' => 'false'
                );
            }

        }
        print json_encode($results);


    } elseif ($tag == 'get_feedlist_my_Life_loadmore') {
        // Request type is check Login
        $id = $_POST['id'];
        $pid = $_POST['pid'];
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

            if ($no_of_rows0 > 0) {

                $results['post'][] = array(
                    'id' => $row['id'],
                    'userid' => $row['userid'],
                    'name' => $row['name'],
                    'image' => $row['image'],
                    'profilePic' => $row['profilePic'],
                    'status' => $row['status'],
                    'timeStamp' => $row['timeStamp'],
                    'nlike' => $row['nlike'],
                    'mylike' => 'true'
                );
            } else {

                $results['post'][] = array(
                    'id' => $row['id'],
                    'userid' => $row['userid'],
                    'name' => $row['name'],
                    'image' => $row['image'],
                    'profilePic' => $row['profilePic'],
                    'status' => $row['status'],
                    'timeStamp' => $row['timeStamp'],
                    'nlike' => $row['nlike'],
                    'mylike' => 'false'
                );
            }

        }
        print json_encode($results);


    } elseif ($tag == 'get_feedlist_my_Life_best') {
        // Request type is check Login
        $id = $_POST['id'];
        $result = mysql_query("SELECT * FROM posts    ORDER BY RAND()  DESC LIMIT 10 ") or die(mysql_error());
        $results['post'] = array();
        while ($row = mysql_fetch_array($result)) {
            $b = $row['id'];
            $c = (string)$b;
            $result0 = mysql_query("SELECT * FROM likes WHERE userid LIKE '$id' AND postid LIKE '$c' ") or die(mysql_error());
            $no_of_rows0 = mysql_num_rows($result0);

            if ($no_of_rows0 > 0) {

                $results['post'][] = array(
                    'id' => $row['id'],
                    'userid' => $row['userid'],
                    'name' => $row['name'],
                    'image' => $row['image'],
                    'profilePic' => $row['profilePic'],
                    'status' => $row['status'],
                    'timeStamp' => $row['timeStamp'],
                    'nlike' => $row['nlike'],
                    'mylike' => 'true'
                );
            } else {
                $results['post'][] = array(
                    'id' => $row['id'],
                    'userid' => $row['userid'],
                    'name' => $row['name'],
                    'image' => $row['image'],
                    'profilePic' => $row['profilePic'],
                    'status' => $row['status'],
                    'timeStamp' => $row['timeStamp'],
                    'nlike' => $row['nlike'],
                    'mylike' => 'false'
                );
            }

        }
        print json_encode($results);


    } elseif ($tag == 'get_feedlist_my_Life_loadmore_best') {
        // Request type is check Login
        $id = $_POST['id'];
        $pid = $_POST['pid'];
        $result = mysql_query("SELECT * FROM posts  WHERE id < '$pid'  ORDER BY RAND() DESC limit 10 ") or die(mysql_error());
        $results['post'] = array();
        while ($row = mysql_fetch_array($result)) {
            $b = $row['id'];
            $c = (string)$b;
            $result0 = mysql_query("SELECT * FROM likes WHERE userid LIKE '$id' AND postid LIKE '$c' ") or die(mysql_error());
            $no_of_rows0 = mysql_num_rows($result0);

            if ($no_of_rows0 > 0) {
                $results['post'][] = array(
                    'id' => $row['id'],
                    'userid' => $row['userid'],
                    'name' => $row['name'],
                    'image' => $row['image'],
                    'profilePic' => $row['profilePic'],
                    'status' => $row['status'],
                    'timeStamp' => $row['timeStamp'],
                    'nlike' => $row['nlike'],
                    'mylike' => 'true'
                );
            } else {
                $results['post'][] = array(
                    'id' => $row['id'],
                    'userid' => $row['userid'],
                    'name' => $row['name'],
                    'image' => $row['image'],
                    'profilePic' => $row['profilePic'],
                    'status' => $row['status'],
                    'timeStamp' => $row['timeStamp'],
                    'nlike' => $row['nlike'],
                    'mylike' => 'false'
                );
            }

        }
        print json_encode($results);


    } elseif ($tag == 'get_feedlist_my_Life_search') {
        // Request type is check Login
        $id = $_POST['id'];
        $search = $_POST['search'];
        $result = mysql_query("SELECT * FROM posts WHERE status REGEXP '$search'   ORDER BY id  DESC limit 10 ") or die(mysql_error());
        $results['post'] = array();
        while ($row = mysql_fetch_array($result)) {
            $b = $row['id'];
            $c = (string)$b;
            $result0 = mysql_query("SELECT * FROM likes WHERE userid LIKE '$id' AND postid LIKE '$c' ") or die(mysql_error());
            $no_of_rows0 = mysql_num_rows($result0);

            if ($no_of_rows0 > 0) {

                $results['post'][] = array(
                    'id' => $row['id'],
                    'userid' => $row['userid'],
                    'name' => $row['name'],
                    'image' => $row['image'],
                    'profilePic' => $row['profilePic'],
                    'status' => $row['status'],
                    'timeStamp' => $row['timeStamp'],
                    'nlike' => $row['nlike'],
                    'mylike' => 'true'
                );
            } else {
                $results['post'][] = array(
                    'id' => $row['id'],
                    'userid' => $row['userid'],
                    'name' => $row['name'],
                    'image' => $row['image'],
                    'profilePic' => $row['profilePic'],
                    'status' => $row['status'],
                    'timeStamp' => $row['timeStamp'],
                    'nlike' => $row['nlike'],
                    'mylike' => 'false'
                );
            }

        }
        print json_encode($results);


    } elseif ($tag == 'get_feedlist_my_Life_loadmore_search') {
        $id = $_POST['id'];
        $pid = $_POST['pid'];
        $search = $_POST['search'];
        $result = mysql_query("SELECT * FROM posts  WHERE id < '$pid' AND status REGEXP '$search'   ORDER BY id   ORDER BY RAND() DESC limit 10 ") or die(mysql_error());
        $results['post'] = array();
        while ($row = mysql_fetch_array($result)) {
            $b = $row['id'];
            $c = (string)$b;
            $result0 = mysql_query("SELECT * FROM likes WHERE userid LIKE '$id' AND postid LIKE '$c' ") or die(mysql_error());
            $no_of_rows0 = mysql_num_rows($result0);

            if ($no_of_rows0 > 0) {

                $results['post'][] = array(
                    'id' => $row['id'],
                    'userid' => $row['userid'],
                    'name' => $row['name'],
                    'image' => $row['image'],
                    'profilePic' => $row['profilePic'],
                    'status' => $row['status'],
                    'timeStamp' => $row['timeStamp'],
                    'nlike' => $row['nlike'],
                    'mylike' => 'true'
                );
            } else {

                $results['post'][] = array(
                    'id' => $row['id'],
                    'userid' => $row['userid'],
                    'name' => $row['name'],
                    'image' => $row['image'],
                    'profilePic' => $row['profilePic'],
                    'status' => $row['status'],
                    'timeStamp' => $row['timeStamp'],
                    'nlike' => $row['nlike'],
                    'mylike' => 'false'
                );
            }

        }
        print json_encode($results);


    }
}

?>
