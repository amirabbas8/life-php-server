<?php
include_once 'include/DB_Connect.php';
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');
$db = new DB_Connect();

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "1077252252-zpfbtYYOFQQaoXhapTkrhazOziw3TNHo5eBLKuS",
    'oauth_access_token_secret' => "2xeb8KiqvpGUv7TTNVr1cAql4tu8zB2URVmy09pkitfw3",
    'consumer_key' => "IjzxI5QW05HUY1pu3XBCYBz9A",
    'consumer_secret' => "2NieFDjK7IIMhcV1BJGfH64Oer9Lk0rSzgQEIGxXy8Zr2d1Qqj"
);


$result = mysql_query("SELECT * FROM posts  WHERE userid   LIKE '6967'  ORDER BY id ASC limit 1 ") or die(mysql_error());
$row = mysql_fetch_array($result);
$b = $row['location'];

$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$field = '?screen_name=irna1313&since_id=' . $b . '&count=2';

$twitter = new TwitterAPIExchange($settings);
$r = $twitter->setGetfield($field)->buildOauth($url,'GET')->performRequest();
$tweets = json_decode($r, true);

foreach ($tweets as $tweet) {
    $t = $tweet['text'];
    $id = $tweet['id'];
    $result1 = mysql_query("INSERT INTO posts(userid,name,image,video,videoThumbName,profilePic,status,nlike,location) VALUES('6967' , 'IRNA', '' ,'','' ,'','$t' ,'','$id')");

}
//var_dump(json_decode($response));