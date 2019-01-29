<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // Get tag
    $tag = $_POST['tag'];

    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();
    // response Array

    // check for tag type
    if ($tag == 'like_dislike') {
        $id = $_POST['id'];
        $code = $_POST['code'];
        $postid = $_POST['postid'];
        $result = mysql_query("SELECT * FROM users WHERE id LIKE '$id' AND life_code LIKE '$code'") or die(mysql_error());

        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            $result1 = mysql_query("SELECT * FROM likes WHERE postid = '$postid' AND userid LIKE '$id'") or die(mysql_error());
            $no_of_rows = mysql_num_rows($result1);
            if ($no_of_rows > 0) {
                $result2 = mysql_query("DELETE FROM likes WHERE postid = '$postid' AND userid LIKE '$id'") or die(mysql_error());
                $result3 = mysql_query("SELECT * FROM likes WHERE postid LIKE '$postid'") or die(mysql_error());
                $result4 = mysql_query("DELETE FROM notification WHERE postId = '$postid' AND sender LIKE '$id'") or die(mysql_error());
                $no_of_rows = mysql_num_rows($result3);
                $result4 = mysql_query("UPDATE posts SET nlike = '$no_of_rows' WHERE id = '$postid' ");
                $results['post'] = array();
                $results['post'][0] = array('success' => "2");
                print json_encode($results);
            } else {
                $result1 = mysql_query("INSERT INTO likes(userid,postid) VALUES('$id' , '$postid')");
                $result3 = mysql_query("SELECT * FROM likes WHERE postid LIKE '$postid'") or die(mysql_error());
                $result2 = mysql_query("SELECT * FROM posts WHERE id LIKE '$postid'") or die(mysql_error());
                $row = mysql_fetch_array($result2);
                $c=$row['userid'];
                $result1 = mysql_query("INSERT INTO notification(sender,receiver,postId) VALUES('$id' ,'$c', '$postid')");
                $no_of_rows = mysql_num_rows($result3);
                $result3 = mysql_query("UPDATE posts SET nlike = '$no_of_rows' WHERE id = '$postid' ");
                $results['post'] = array();
                $results['post'][0] = array('success' => "1");
                print json_encode($results);

            }
        } else {
            $results['post'] = array();
            $results['post'][0] = array('success' => "2");
            print json_encode($results);
        }


    }
}
?>
