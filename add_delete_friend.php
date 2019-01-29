<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // Get tag
    $tag = $_POST['tag'];

    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();
    if ($tag == 'add_delete_friend') {
        $id = $_POST['id'];
        $code = $_POST['code'];
        $fid = $_POST['userId'];
        $result = mysql_query("SELECT * FROM users WHERE id LIKE '$id' AND life_code LIKE '$code'") or die(mysql_error());

        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {

            $result1 = mysql_query("SELECT * FROM friend WHERE user1 LIKE '$id' AND id LIKE '$fid'") or die(mysql_error());
            $no_of_rows1 = mysql_num_rows($result1);

            if ($no_of_rows1 > 0) {
                $result2 = mysql_query("DELETE FROM friend WHERE user1 = '$id' AND id = '$fid' ") or die(mysql_error());
                $result2 = mysql_query("DELETE FROM notification WHERE sender = '$id' AND receiver = '$fid' ") or die(mysql_error());
                $result2 = mysql_query("SELECT * FROM friend  WHERE user1 LIKE '$id'") or die(mysql_error());
                $nFollowing = mysql_num_rows($result2);
                $result3 = mysql_query("UPDATE users SET nFollowing = '$nFollowing'  WHERE id LIKE '$id' ") or die(mysql_error());

                $result2 = mysql_query("SELECT * FROM friend  WHERE id LIKE '$fid'") or die(mysql_error());
                $nFollowers = mysql_num_rows($result2);
                $result3 = mysql_query("UPDATE users SET nFollowers = '$nFollowers'  WHERE id LIKE '$fid' ") or die(mysql_error());

                $results['user'] = array();
                $results['user'][] = array('success' => "1");


                print json_encode($results);
            } else {
                $result5 = mysql_query("INSERT INTO friend( user1,id) VALUES( '$id' ,'$fid' )");
                $result5 = mysql_query("INSERT INTO notification( sender,receiver) VALUES( '$id' ,'$fid' )");

                $result2 = mysql_query("SELECT * FROM friend  WHERE user1 LIKE '$id'") or die(mysql_error());
                $nFollowing = mysql_num_rows($result2);
                $result3 = mysql_query("UPDATE users SET nFollowing = '$nFollowing'  WHERE id LIKE '$id' ") or die(mysql_error());

                $result2 = mysql_query("SELECT * FROM friend  WHERE id LIKE '$fid'") or die(mysql_error());
                $nFollowers = mysql_num_rows($result2);
                $result3 = mysql_query("UPDATE users SET nFollowers = '$nFollowers'  WHERE id LIKE '$fid' ") or die(mysql_error());

                $results['user'] = array();
                $results['user'][0] = array('success' => "2");


                print json_encode($results);
            }


        } else {
            $results['user'] = array();
            $results['user'][0] = array('success' => "3");


            print json_encode($results);
        }


    }

}
?>
