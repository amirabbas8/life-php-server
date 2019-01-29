<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // Get tag
    $tag = $_POST['tag'];

    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();
    // response Array

    // check for tag type
    if ($tag == 'editprofileimage') {
        $id = $_POST['id'];
        $profileImage = $_POST['profileImage'];
        $code = $_POST['code'];
        $result = mysql_query("SELECT * FROM users WHERE id LIKE '$id' AND life_code LIKE '$code'") or die(mysql_error());

        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {

            $row1 = mysql_fetch_array($result);
            $c = $row1['profileImage'];
            $result2 = mysql_query("UPDATE users SET profileImage = '$profileImage' WHERE id LIKE '$id'") or die(mysql_error());
            $result2 = mysql_query("UPDATE posts SET profilePic = '$profileImage' WHERE userid LIKE '$id'") or die(mysql_error());
            $result2 = mysql_query("UPDATE wave_posts SET profilePic = '$profileImage' WHERE userid LIKE '$id'") or die(mysql_error());
            $result2 = mysql_query("SELECT * FROM users WHERE id LIKE '$id'") or die(mysql_error());
            $results['user'] = array();
            while ($row = mysql_fetch_array($result2)) {

                unlink('../profileimages/' . $c);
                //$b = $row['id'] ;

                $results['user'][] = array(
                    'success' => 1,
                    'realname' => $row['realname'],
                    'id' => $row['id'],
                    'code' => $row['life_code'],
                    'profileImage' => $row['profileImage']
                );
            }

            print json_encode($results);

        } else {
            $results['user'] = array();

            $results['user'][0] = array('success' => 2);

            print json_encode($results);
        }


    }
}
?>
