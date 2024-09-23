<?php
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�  

//������ �������
function get_hostis($path)
{
  preg_match("/^(https|http|ftp):\/\/(.*?)\//", "$path/", $matches);
  $parts = explode(".", $matches[2]);
  $tld = array_pop($parts);
  $host = array_pop($parts);
  if (strlen($tld) == 2 && strlen($host) <= 3) {
    $tld = "$host.$tld";
    $host = array_pop($parts);
  }

  $host =  array(
    'protocol' => $matches[1], //https
    'subdomain' => implode(".", $parts), //subdomain
    'domain' => "$host.$tld", //domain.co.kr
    'host' => $host, //domain �̸�
    'tld' => $tld //co.kr
  );

  return $host['host'];
}

//������ ���������� ��� ������/��޿�
function movie_id($path, $host)
{

  if ($host == "youtu") {

    /*�����긵ũ ������ ���̵�*/
    $youtube_link = $path;
    $youtube_url = parse_url($youtube_link);
    parse_str($youtube_url['query']);
    $youtubeid = $v;
    $movieid = $youtubeid; //$youtubeid;

    $regExp = '/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/';
    preg_match($regExp, $path, $matches);
    $youtubeid = $matches[7];
    $movieid = $youtubeid;
  } else if ($host == "vimeo" || $host == "kakao" || $host == "naver" || $host == "dailymotion") {

    /*������ ���̵�*/
    $vars = strrchr($path, "?"); // 
    $videoid = preg_replace('/' . preg_quote($vars, '/') . '$/', '', basename($path)); // 
    $movieid = $videoid; //$vimeoid;

  } else if ($host == "soundcloud") {

    /*������ ���̵�*/
    $urls =  parse_url($path, PHP_URL_PATH);
    $videoid = explode("/", $urls);
    $movieid = $videoid[1]; //$vimeoid;

  } else {
    $movieid = false;
  }

  return $movieid;
}

//������ image ��� ������/��޿�
function get_movie_thumb($movie_id, $movie_company)
{

  if ($movie_company == "youtu") {

    $movieimg = "https://img.youtube.com/vi/" . $movie_id . "/maxresdefault.jpg";
  } else if ($movie_company == "vimeo") {
    $vimeo = unserialize(file_get_contents("http://vimeo.com/api/v2/video/{$movie_id}.php"));
    //echo $small = $vimeo[0]['thumbnail_small'];
    //echo $medium = $vimeo[0]['thumbnail_medium'];
    $movieimg = $vimeo[0]['thumbnail_large'];
  } else if ($movie_company == "kakao" || $movie_company == "dailymotion") {

    if ($movie_company == "kakao") {
      $sites_html = file_get_contents('http://tv.kakao.com/v/' . $movie_id);
    } else if ($movie_company == "dailymotion") {
      $sites_html = file_get_contents('https://www.dailymotion.com/video/' . $movie_id);
    }

    $html = new DOMDocument();
    @$html->loadHTML($sites_html);
    $meta_og_img = null;
    //Get all meta tags and loop through them. 
    foreach ($html->getElementsByTagName('meta') as $meta) {
      //If the property attribute of the meta tag is og:image 
      if ($meta->getAttribute('property') == 'og:image') {
        //Assign the value from content attribute to $meta_og_img 
        $meta_og_img = $meta->getAttribute('content');
      }
    }
    $movieimg = $meta_og_img;
  } else if ($movie_company == "naver" || $movie_company == "soundcloud") {
    $movieimg = xml_movie_frame($movie_id, $movie_company, 'thumb');
  } else {
    $movieimg = "noimg"; // 
  }

  return $movieimg;
}

//xml�� ������ �ҽ� ��°�� 
function xml_movie_frame($movieid, $host, $type)
{
  if ($host == "naver") {
    $xml = simplexml_load_file("https://tv.naver.com/oembed?url=https://tv.naver.com/v/" . $movieid . "&format=xml");
    //print_r($xml);
    $movie_frame = $xml->html;
    $movie_img = $xml->thumbnail_url;
  } else if ($host == "soundcloud") {
    //$json = file_get_contents("https://soundcloud.com/oembed?url=https%3A%2F%2Fsoundcloud.com%2F".$movieid."%2Fflox-the-words&format=json");
    $json = file_get_contents("https://soundcloud.com/oembed?url=https://soundcloud.com/" . $movieid . "&format=json");
    $obj = json_decode($json);
    $movie_frame = $obj->html;
    $movie_img = $obj->thumbnail_url;
  }
  if ($type == "movie") {
    return $movie_frame;
  } else {
    return $movie_img;
  }
}

function curl_get_contents($url)
{
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5) Gecko/20041107 Firefox/1.0');

  $data = curl_exec($ch);
  curl_close($ch);

  return $data;
}
