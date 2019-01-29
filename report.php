<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // Get tag
    $tag = $_POST['tag'];

    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();
    // response Array

    // check for tag type
    if ($tag == 'report') {
        $id = $_POST['id']; 
        $postid = $_POST['postid'];
        $kind = $_POST['kind'];
        $code = $_POST['code'];
        $comment = $_POST['comment'];
        $result = mysql_query("SELECT * FROM users WHERE id LIKE '$id' AND life_code LIKE '$code'") or die(mysql_error());

        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            $result = mysql_query("SELECT * FROM user_reports WHERE userid LIKE '$id' AND reported_id LIKE '$postid'") or die(mysql_error());
            $no_of_rows = mysql_num_rows($result);
            if ($no_of_rows == 0)
                $result2 = mysql_query("INSERT INTO user_reports(userid,reported_kind,reported_id,usercomment) VALUES('$id' , '$kind' ,'$postid','$comment' )");


            $results['user'] = array();
            $results['user'][0] = array('success' => "1");
            print json_encode($results);

        } else {
            $results['user'] = array();
            $results['user'][0] = array('success' => "2");

            print json_encode($results);
        }


    }
}
?>
