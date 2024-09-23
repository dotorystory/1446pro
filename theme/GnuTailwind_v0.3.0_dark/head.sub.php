<?php
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$g5_debug['php']['begin_time'] = $begin_time = get_microtime();

if (!isset($g5['title'])) {
  $g5['title'] = $config['cf_title'];
  $g5_head_title = $g5['title'];
} else {
  // 상태바에 표시될 제목
  $g5_head_title = implode(' | ', array_filter(array($g5['title'], $config['cf_title'])));
}

$g5['title'] = strip_tags($g5['title']);
$g5_head_title = strip_tags($g5_head_title);

// 현재 접속자
// 게시판 제목에 ' 포함되면 오류 발생
$g5['lo_location'] = addslashes($g5['title']);
if (!$g5['lo_location'])
  $g5['lo_location'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
$g5['lo_url'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
if (strstr($g5['lo_url'], '/' . G5_ADMIN_DIR . '/') || $is_admin == 'super') $g5['lo_url'] = '';

/*
// 만료된 페이지로 사용하시는 경우
header("Cache-Control: no-cache"); // HTTP/1.1
header("Expires: 0"); // rfc2616 - Section 14.21
header("Pragma: no-cache"); // HTTP/1.0
*/
?>

<!doctype html>
<html lang="ko" class="light">

<head>
  <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-WTDM063JWN"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-WTDM063JWN');
</script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="color-scheme" content="light dark" />
  <?php
  if ($config['cf_add_meta'])
    echo $config['cf_add_meta'] . PHP_EOL;
  ?>
  <title><?php echo $g5_head_title; ?></title>

  <!-- 파비콘 설정 -->
  <link rel="shortcut icon" href="<?php echo G5_THEME_IMG_URL; ?>/fav/favicon.ico" type="image/x-icon">
  <link rel="icon" href="<?php echo G5_THEME_IMG_URL; ?>/fav/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo G5_THEME_IMG_URL; ?>/fav/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo G5_THEME_IMG_URL; ?>/fav/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo G5_THEME_IMG_URL; ?>/fav/favicon-16x16.png">
  <link rel="manifest" href="<?php echo G5_THEME_URL; ?>/manifest.json">

  <link rel="stylesheet" href="<?php echo run_replace('head_css_url', G5_THEME_CSS_URL . '/' . (G5_IS_MOBILE ? 'mobile' : 'default') . '.css?ver=' . G5_CSS_VER, G5_THEME_URL); ?>">

  <!-- Tailwind CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.7/tailwind.min.css" integrity="sha512-y6ZMKFUQrn+UUEVoqYe8ApScqbjuhjqzTuwUMEGMDuhS2niI8KA3vhH2LenreqJXQS+iIXVTRL2iaNfJbDNA1Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Bootstrap icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <!-- AOS(Animation on scroll) -->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <!-- Swiper -->
  <link href="<?php echo G5_THEME_URL ?>/assets/swiper/swiper-bundle.min.css" rel="stylesheet">
  <!-- Slick -->
  <link href="<?php echo G5_THEME_URL ?>/assets/slick/slick_theme.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

  <link href="<?php echo G5_THEME_URL ?>/assets/theme.css" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/xeicon@2.3.3/xeicon.min.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Assistant:wght@400;700&display=swap">

  <!--[if lte IE 8]>
<script src="<?php echo G5_JS_URL ?>/html5.js"></script>
<![endif]-->
  <script>
    // 자바스크립트에서 사용하는 전역변수 선언
    var g5_url = "<?php echo G5_URL ?>";
    var g5_bbs_url = "<?php echo G5_BBS_URL ?>";
    var g5_is_member = "<?php echo isset($is_member) ? $is_member : ''; ?>";
    var g5_is_admin = "<?php echo isset($is_admin) ? $is_admin : ''; ?>";
    var g5_is_mobile = "<?php echo G5_IS_MOBILE ?>";
    var g5_bo_table = "<?php echo isset($bo_table) ? $bo_table : ''; ?>";
    var g5_sca = "<?php echo isset($sca) ? $sca : ''; ?>";
    var g5_editor = "<?php echo ($config['cf_editor'] && $board['bo_use_dhtml_editor']) ? $config['cf_editor'] : ''; ?>";
    var g5_cookie_domain = "<?php echo G5_COOKIE_DOMAIN ?>";
  </script>
  <?php
  add_javascript('<script src="' . G5_JS_URL . '/jquery-1.12.4.min.js"></script>', 0);
  add_javascript('<script src="' . G5_JS_URL . '/jquery-migrate-1.4.1.min.js"></script>', 0);
  add_javascript('<script src="' . G5_JS_URL . '/jquery.menu.js?ver=' . G5_JS_VER . '"></script>', 0);
  add_javascript('<script src="' . G5_JS_URL . '/common.js?ver=' . G5_JS_VER . '"></script>', 0);
  add_javascript('<script src="' . G5_JS_URL . '/wrest.js?ver=' . G5_JS_VER . '"></script>', 0);
  add_javascript('<script src="' . G5_JS_URL . '/placeholders.min.js"></script>', 0);
  add_stylesheet('<link rel="stylesheet" href="' . G5_JS_URL . '/font-awesome/css/font-awesome.min.css">', 0);

  if (!defined('G5_IS_ADMIN'))
    echo $config['cf_add_script'];
  ?>
  
</head>

<body class="light" <?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?>>
  <script>
    const theme = localStorage.getItem('theme' || 'light')
    document.body.className = theme
  </script>

  <?php
  if ($is_member) { // 회원이라면 로그인 중이라는 메세지를 출력해준다.
    $sr_admin_msg = '';
    if ($is_admin == 'super') $sr_admin_msg = "최고관리자 ";
    else if ($is_admin == 'group') $sr_admin_msg = "그룹관리자 ";
    else if ($is_admin == 'board') $sr_admin_msg = "게시판관리자 ";

    echo '<div id="hd_login_msg" class="sr-only">' . $sr_admin_msg . get_text($member['mb_nick']) . '님 로그인 중 ';
    echo '<a href="' . G5_BBS_URL . '/logout.php">로그아웃</a></div>';
  }
