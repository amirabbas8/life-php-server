<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // Get tag
    $tag = $_POST['tag'];

    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();
    // response Array

    // check for tag type
    if ($tag == 'profile') {
        $idNo = $_POST['idNo'];
        $id = $_POST['id'];

        $result = mysql_query("SELECT * FROM posts  WHERE userid   LIKE '$id'  ORDER BY id DESC limit 10 ") or die(mysql_error());
        $results['post'] = array();
        while ($row = mysql_fetch_array($result)) {
            $b = $row['id'];
            $c = (string)$b;
            $result0 = mysql_query("SELECT * FROM likes WHERE userid LIKE '$idNo' AND postid LIKE '$c' ") or die(mysql_error());
            $no_of_rows0 = mysql_num_rows($result0);
            $results['post'][] = array(
                'id' => $row['id'],
                'userId' => $row['userid'],
                'name' => $row['name'],
                'image' => $row['image'],'video' => $row['video'],'videoThumbName' => $row['videoThumbName'],
                'profilePic' => $row['profilePic'],
                'location' => $row['location'],
                'status' => $row['status'],
                'timeStamp' => $row['timestamp'],
                'nLike' => $row['nlike'],
                'myLike' => ($no_of_rows0 > 0),
            );

        }
        print json_encode($results);


    } elseif ($tag == 'profileLoadMore') {
        // Request type is check Login
        $id = $_POST['id'];
        $pid = $_POST['pid'];
        $result = mysql_query("SELECT * FROM posts  WHERE userid  LIKE '$id' AND id < '$pid'  ORDER BY id DESC limit 10 ") or die(mysql_error());
        $results['post'] = array();
        while ($row = mysql_fetch_array($result)) {
            $b = $row['id'];
            $c = (string)$b;
            $result0 = mysql_query("SELECT * FROM likes WHERE userid LIKE '$id' AND postid LIKE '$c' ") or die(mysql_error());
            $no_of_rows0 = mysql_num_rows($result0);

            $results['post'][] = array(
                'id' => $row['id'],
                'userId' => $row['userid'],
                'name' => $row['name'],
                'image' => $row['image'],'video' => $row['video'],'videoThumbName' => $row['videoThumbName'],
                'profilePic' => $row['profilePic'],
                'location' => $row['location'],
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
