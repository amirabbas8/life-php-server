<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // Get tag
    $tag = $_POST['tag'];

    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();
    // response Array

    // check for tag type
    if ($tag == 'delete') {
        $id = $_POST['id'];
        $postId = $_POST['postid'];
        $userId = $_POST['userid'];
        $code = $_POST['code'];
        $result = mysql_query("SELECT * FROM users WHERE id LIKE '$id' AND life_code LIKE '$code'") or die(mysql_error());

        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {

            $result1 = mysql_query("SELECT * FROM posts WHERE id LIKE '$postId' AND userid LIKE '$id'") or die(mysql_error());
            $no_of_rows1 = mysql_num_rows($result1);

            if ($no_of_rows1 > 0) {
                $row = mysql_fetch_array($result1);
                $c = $row['image'];
                $d = $row['video'];
                $f = $row['videoThumbName'];
                if (file_exists('../postsimages/' . $c))
                    unlink('../postsimages/' . $c);

                if (file_exists('../video/' . $d))
                    unlink('../video/' . $d);

                if (file_exists('../videoThumb/' . $f))
                    unlink('../videoThumb/' . $f);
                $result2 = mysql_query("DELETE FROM posts WHERE id = '$postId'  ") or die(mysql_error());
                $result2 = mysql_query("DELETE FROM notification WHERE postId = '$postId'  ") or die(mysql_error());
                $result2 = mysql_query("SELECT * FROM posts  WHERE userid LIKE '$id'") or die(mysql_error());
                $nPosts = mysql_num_rows($result2);
                $result3 = mysql_query("UPDATE users SET nPosts = '$nPosts'  WHERE id LIKE '$id' ") or die(mysql_error());

                $results['post'] = array();
                //$b = $row['id'] ;
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
