<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $latest_skin_url . '/style.css">', 0);
$list_count = (is_array($list) && $list) ? count($list) : 0;
?>

<div class="lat relative mb-4">
  <h2 class="lat_title border-t py-2 bg-gray-100"><a href="<?php echo get_pretty_url($bo_table); ?>" class="text-lg font-semibold px-2"><?php echo $bo_subject ?></a></h2>
  <ul class="border-t">
    <?php for ($i = 0; $i < $list_count; $i++) {  ?>
      <li class="basic_li text-base font-normal py-2 mb-2 border-b">
        <span class="px-2">
          <?php
          if ($list[$i]['icon_secret']) echo "<i class=\"fa fa-lock\" aria-hidden=\"true\"></i><span class=\"sound_only\">비밀글</span> ";

          echo "<a href=\"" . get_pretty_url($bo_table, $list[$i]['wr_id']) . "\"> ";
          echo $list[$i]['icon_reply'] . " ";
          if ($list[$i]['is_notice'])
            echo '<span class="text-base font-normal">' . $list[$i]['subject'] . '</span>';
          else
            echo '<span class="text-base font-normal">' . $list[$i]['subject'] . '</span>';

          echo "</a>";

          if ($list[$i]['icon_hot']) echo "<span class=\"hot_icon\"><i class=\"fa fa-heart\" aria-hidden=\"true\"></i><span class=\"sound_only\">인기글</span></span>";
          if ($list[$i]['icon_new']) echo "<span class=\"new_icon\">N<span class=\"sound_only\">새글</span></span>";
          // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
          // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

          if (isset($list[$i]['icon_file']) && $list[$i]['icon_file']) echo " <i class=\"fa fa-download\" aria-hidden=\"true\"></i>";
          if ($list[$i]['icon_link']) echo " <i class=\"fa fa-link\" aria-hidden=\"true\"></i>";

          if ($list[$i]['comment_cnt'])  echo "
		        <span class=\"lt_cmt\"><span class=\"sound_only\">댓글</span>" . $list[$i]['comment_cnt'] . "</span>";
          ?>
        </span>
        <div class="lt_info flex align-center flex justify-between pt-1 px-2">
          <span class="lt_nick text-sm text-gray-500 font-semibold"><?php echo $list[$i]['name'] ?></span>
          <span class="lt_date text-sm text-gray-500"><?php echo $list[$i]['datetime2'] ?></span>
        </div>
      </li>
    <?php }  ?>
    <?php if ($list_count == 0) { //게시물이 없을 때  
    ?>
      <li class="empty_li text-base text-center font-normal  py-6 mb-2 border-b">게시물이 없습니다.</li>
    <?php }  ?>
  </ul>
  <a href="<?php echo get_pretty_url($bo_table); ?>" class="lt_more absolute top-0 right-0 text-indigo-400 pr-2 py-3"><span class="sound_only"><?php echo $bo_subject ?></span><i class="fa fa-plus"></i></a>
</div>