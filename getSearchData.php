<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {
    $tag = $_POST['tag'];
    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();
    // check for tag type
    if ($tag == 'search') {
        $id = $_POST['id'];
        $search = $_POST['searchText'];
        if ($search == '') {
            $result = mysql_query("SELECT * FROM posts   ORDER BY id  DESC LIMIT 10 ") or die(mysql_error());
        } else {
            $result = mysql_query("SELECT * FROM posts  WHERE  status REGEXP '$search' OR location REGEXP '$search'   ORDER BY id DESC limit 10 ") or die(mysql_error());
        }
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
                'location' => $row['location'],
                'image' => $row['image'],'video' => $row['video'],'videoThumbName' => $row['videoThumbName'],
                'profilePic' => $row['profilePic'],
                'status' => $row['status'],
                'timeStamp' => $row['timestamp'],
                'nLike' => $row['nlike'],
                'myLike' => $myLike,
            );

        }
        print json_encode($results);


    } elseif ($tag == 'searchLoadMore') {
        $id = $_POST['id'];
        $pid = $_POST['pid'];
        $search = $_POST['searchText'];
        if ($search == '') {
            $result = mysql_query("SELECT * FROM posts  ORDER BY RAND() DESC limit 10 ") or die(mysql_error());
        } else {
            $result = mysql_query("SELECT * FROM posts  WHERE id < '$pid' AND ( status REGEXP '$search' OR location REGEXP '$search' )   ORDER BY id   DESC limit 10 ") or die(mysql_error());
        }
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
                'image' => $row['image'],'video' => $row['video'],'videoThumbName' => $row['videoThumbName'],
                'profilePic' => $row['profilePic'],
                'status' => $row['status'],
                'location' => $row['location'],
                'timeStamp' => $row['timestamp'],
                'nLike' => $row['nlike'],
                'myLike' => $myLike,
            );
        }
        print json_encode($results);

    }
}

?>
