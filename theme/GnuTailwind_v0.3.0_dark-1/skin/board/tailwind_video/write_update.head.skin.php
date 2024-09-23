<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
include_once($board_skin_path.'/movie.lib.php');
$movie_company = get_hostis($wr_link1);
$movie_id = movie_id($wr_link1, $movie_company);

$wr_1 = $movie_company;
$wr_2 = $movie_id;
//$wr_3 = get_movie_thumb($movie_id, $movie_company);

if($movie_company == "naver"){
	$url = "https://tv.naver.com/oembed?url=https://tv.naver.com/v/".$movie_id."&format=json";
	$jsondata = curl_get_contents($url);
	$arr = json_decode($jsondata, true);
	$wr_3 = $arr['thumbnail_url'];
}
else if($movie_company == "dailymotion"){
	$url = "https://api.dailymotion.com/video/".$movie_id."?fields=thumbnail_480_url";
	$jsondata = curl_get_contents($url);
	$arr = json_decode($jsondata, true);
	$wr_3 = $arr['thumbnail_480_url'];
}
else if($movie_company == "soundcloud"){
	$url = "https://soundcloud.com/oembed?url=https://soundcloud.com/".$movie_id."&format=json";
	$jsondata = curl_get_contents($url);
	$arr = json_decode($jsondata, true);
	$wr_3 = $arr['thumbnail_url'];
}
else if($movie_company == "vimeo"){
	$url = "http://vimeo.com/api/v2/video/".$movie_id.".php";
	$jsondata = unserialize(curl_get_contents($url));
	$wr_3 = $jsondata[0]['thumbnail_large'];
}
else if($movie_company == "youtu"){
	$wr_3 = "https://img.youtube.com/vi/".$movie_id."/maxresdefault.jpg"; 
}
else if($movie_company == "kakao"){
	$wr_3 = get_movie_thumb($movie_id, $movie_company);
}
else{
	$wr_3 = "";
}
