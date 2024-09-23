<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH . '/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $board_skin_url . '/style.css">', 0);
?>

<!-- 게시판 목록 시작 { -->
<!-- <div id="bo_gall" style="width:<?php echo $width; ?>"> -->
<div id="bo_gall" class="pt-4 pt-6">

  <?php if ($is_category) { ?>
    <nav id="bo_cate">
      <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
      <ul id="bo_cate_ul">
        <?php echo $category_option ?>
      </ul>
    </nav>
  <?php } ?>

  <form name="fboardlist" id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div id="bo_btn_top" class="mt-3 mx-0">
      <div id="bo_list_total" class="float-left leading-10 text-gray-700">
        <span>Total <?php echo number_format($total_count) ?>건</span>
        <?php echo $page ?> 페이지
      </div>

      <ul class="btn_bo_user float-right m-0 p-0">
        <?php if ($admin_href) { ?><li class="relative float-left w-10 text-center ml-2 bg-white"><a href="<?php echo $admin_href ?>" class="btn_admin btn inline-block text-indigo-500 underline-none align-middle leading-10 py-0 px-3 text-center font-semibold border-0 text-lg  transition duration-300 transition-color ease-out" title="관리자"><i class="fa fa-cog fa-spin fa-fw"></i><span class="sound_only">관리자</span></a></li><?php } ?>
        <?php if ($rss_href) { ?><li class="relative float-left w-10 text-center ml-2 bg-white"><a href="<?php echo $rss_href ?>" class="btn_b01 btn inline-block text-gray-400 align-middle border-0 bg-transparent leading-10 py-0 px-3 text-center font-semibold border-0 text-lg transition duration-300 transition-color ease-out" title="RSS"><i class="fa fa-rss" aria-hidden="true"></i><span class="sound_only">RSS</span></a></li><?php } ?>
        <li class="relative float-left w-10 text-center ml-2 bg-white">
          <button type="button" class="btn_bo_sch btn_b01 btn inline-block text-gray-400 align-middle border-0 bg-transparent leading-10 py-0 px-3 text-center font-semibold border-0 text-lg transition duration-300 transition-color ease-out" title="게시판 검색"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">게시판 검색</span></button>
        </li>
        <?php if ($write_href) { ?><li class="relative float-left w-10 text-center ml-2 bg-white"><a href="<?php echo $write_href ?>" class="btn_b01 btn inline-block text-gray-400 underline-none align-middle border-0 bg-transparent leading-10 py-0 px-3 text-center font-semibold border-0 text-lg transition duration-300 transition-color ease-out" title="글쓰기"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sound_only">글쓰기</span></a></li><?php } ?>
        <?php if ($is_admin == 'super' || $is_auth) {  ?>
          <li class="relative float-left w-10 text-center ml-2 bg-white">
            <button type="button" class="btn_more_opt is_list_btn btn_b01 btn inline-block text-gray-400 underline-none align-middle border-0 bg-transparent leading-10 py-0 px-3 text-center font-semibold border-0 text-lg transition duration-300 transition-color ease-out m-0 p-0" title="게시판 리스트 옵션"><i class="fa fa-ellipsis-v" aria-hidden="true"></i><span class="sound_only">게시판 리스트 옵션</span></button>
            <?php if ($is_checkbox) { ?>
              <ul class="more_opt is_list_btn hidden block absolute top-11 right-0 bg-white border z-999 text-base">
                <li class="border-b pt-3 px-2 float-inherit w-40 m-0 text-gray-700 text-center text-sm bg-white"><button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value" class="w-full border-0 bg-white"><i class="fa fa-trash-o" aria-hidden="true"></i> 선택삭제</button></li>
                <li class="border-b pt-3 px-2 float-inherit w-40 m-0 text-gray-700 text-center text-sm bg-white"><button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"><i class="fa fa-files-o" aria-hidden="true"></i> 선택복사</button></li>
                <li class="border-b pt-3 px-2 float-inherit w-40 m-0 text-gray-700 text-center text-sm bg-white"><button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"><i class="fa fa-arrows" aria-hidden="true"></i> 선택이동</button></li>
              </ul>
            <?php } ?>
          </li>
        <?php }  ?>
      </ul>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->

    <div class="clear-both"></div>

    <?php if ($is_checkbox) { ?>
      <div class="clear-both flex items-center my-1">
        <div class="bg-white border rounded border-gray-400 w-4 h-4 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-indigo-500">
          <input type="checkbox" class="opacity-0 absolute  checked:bg-indigo-500" onclick="if (this.checked) all_checked(true); else all_checked(false);">
          <svg class="fill-current hidden w-4 h-4 text-indigo-500 pointer-events-none" viewBox="0 0 20 20">
            <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
          </svg>
        </div>
        <div class="select-none"><b class="sound_only">현재 페이지 게시물</b> 전체선택</div>
      </div>
    <?php } ?>

    <div class="container mx-auto">
      <?php for ($i = 0; $i < count($list); $i++) { ?>
        <div class="gall_box relative rounded-lg flex flex-col md:flex-row items-center md:shadow-xl md:h-52 mb-10">
          <div class="gall_chk chk_box absolute top-2.5 right-2 z-20">
            <?php if ($is_checkbox) { ?>
              <div class="flex items-center">
                <div class="bg-white border rounded border-gray-400 w-4 h-4 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-indigo-500">
                  <input type="checkbox" class="opacity-0 absolute" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
                  <svg class="fill-current hidden w-3 h-3 text-indigo-500 pointer-events-none" viewBox="0 0 20 20">
                    <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                  </svg>
                </div>
              </div>
            <?php } ?>
            <span class="sound_only">
              <?php
              if ($wr_id == $list[$i]['wr_id'])
                echo "<span class=\"bo_current\">열람중</span>";
              else
                echo $list[$i]['num'];
              ?>
            </span>
          </div>

          <div class="z-0 relative order-1 md:order-2 w-full md:w-2/5 h-60 md:h-full overflow-hidden rounded-lg md:rounded-none md:rounded-r-lg shadow-xl">
            <?php
            $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height'], false, true);

            if ($thumb['src']) {
              $img_content = '<img class="absolute inset-0 h-full w-full object-cover" src="' . $thumb['src'] . '" alt="' . $thumb['alt'] . '" >';
            } else {
              $img_content = '<img class="absolute inset-0 h-full w-full object-cover" src="' . $board_skin_url . '/img/no_img.png">';
            }

            echo run_replace('thumb_image_tag', $img_content, $thumb);
            ?>
          </div>
          <div class="text-box z-10 order-2 md:order-1 w-full h-full md:w-3/5 -mt-6 md:mt-0 shadow-none flex items-center">
            <div class="p-2 md:p-4 mx-2 md:mx-0 h-full bg-white rounded-lg md:rounded-none md:rounded-l-lg shadow-xl md:shadow-none w-full">
              <?php if ($is_category && $list[$i]['ca_name']) { ?>
                <a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link bg-indigo-100 text-indigo-500 font-normal py-0.5 px-1.5 rounded text-sm hover:underline ml-2"><?php echo $list[$i]['ca_name'] ?></a>
              <?php } ?>
              <a href="<?php echo $list[$i]['href'] ?>" class="bo_tit">

                <?php // echo $list[$i]['icon_reply']; 
                ?>
                <!-- 갤러리 댓글기능 사용시 주석을 제거하세요. -->

                <span class="inline-block pl-2 py-3 leading-none bg-orange-200 text-orange-800 rounded-full font-semibold uppercase tracking-wide text-base"><?php echo cut_str(get_text($list[$i]['wr_subject']), 15); ?></span>
                <?php
                // if ($list[$i]['file']['count']) { echo '<'.$list[$i]['file']['count'].'>'; }
                if ($list[$i]['icon_new']) echo "<span class=\"new_icon\">N<span class=\"sound_only\">새글</span></span>";
                if (isset($list[$i]['icon_hot'])) echo rtrim($list[$i]['icon_hot']);
                //if (isset($list[$i]['icon_file'])) echo rtrim($list[$i]['icon_file']);
                //if (isset($list[$i]['icon_link'])) echo rtrim($list[$i]['icon_link']);
                if (isset($list[$i]['icon_secret'])) echo rtrim($list[$i]['icon_secret']);
                ?>

                <?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><span class="cnt_cmt bg-indigo-100 text-indigo-500 text-sm h-4 leading-4 py-0 px-1 rounded align-middle"><?php echo $list[$i]['wr_comment']; ?></span><span class="sound_only">개</span><?php } ?>
              </a>

              <p class="cont p-2 h-24 text-base text-gray-500"><?php echo utf8_strcut(strip_tags($list[$i]['wr_content']), 100, '..'); ?></p>
              <div class="info-line p-2 border-t text-sm text-gray-700">
                <div class="pt-1.5 text-sm text-gray-700 flex justify-between">
                  <span class="pr-2 flex-start font-semibold"><span class="sound_only">작성자 </span><?php echo $list[$i]['name'] ?></span>
                  <div>
                    <span class="pr-2"><span class="sound_only">작성일 </span><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $list[$i]['datetime2'] ?></span>
                    <span class="pr-2"><span class="sound_only">조회 </span><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $list[$i]['wr_hit'] ?></span>
                    <?php if ($is_good) { ?><span class="sound_only">추천</span><span class="pr-2"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <?php echo $list[$i]['wr_good'] ?></span><?php } ?>
                    <?php if ($is_nogood) { ?><span class="sound_only">비추천</span><span><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> <?php echo $list[$i]['wr_nogood'] ?></span><?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <?php if ($list[$i]['is_notice']) { ?>
            <div class="gall_option absolute top-2.5 left-8">
              <span class="sound_only">공지</span><strong class="bg-white border border-gray-200 py-1 px-2.5 rounded-3xl">공지</strong>
            </div>
          <?php } ?>

          <div class="gall_option absolute top-2.5 right-2.5">
            <?php if ($is_good) { ?><span class="sound_only">추천</span><strong class="bg-white border border-gray-200 py-1 px-2.5 rounded-3xl"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <?php echo $list[$i]['wr_good'] ?></strong><?php } ?>
            <?php if ($is_nogood) { ?><span class="sound_only">비추천</span><strong class="bg-white border border-gray-200 py-1 px-2.5 rounded-3xl"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> <?php echo $list[$i]['wr_nogood'] ?></strong><?php } ?>
          </div>
        </div>
      <?php } ?>
      <?php if (count($list) == 0) {
        echo "<li class=\"empty_list\">게시물이 없습니다.</li>";
      } ?>
    </div>
</div>

<!-- 페이지 -->
<div class="mt-4 flex justify-center">
  <?php echo $write_pages; ?>
</div>
<!-- 페이지 -->

<?php if ($list_href || $is_checkbox || $write_href) { ?>
  <div class="bo_fx mb-2 float-right">
    <?php if ($list_href || $write_href) { ?>
      <ul class="btn_bo_user m-0 p-0 float-left">
        <?php if ($admin_href) { ?><li class="relative float-left w-10 text-center ml-2 bg-white"><a href="<?php echo $admin_href ?>" class="btn_admin btn inline-block text-indigo-400 align-middle leading-10 py-0 px-3 text-center font-semibold border-0 text-lg transition duration-300 transition-color ease-out" title="관리자"><i class="fa fa-cog fa-spin fa-fw"></i><span class="sound_only">관리자</span></a></li><?php } ?>
        <?php if ($rss_href) { ?><li class="relative float-left w-10 text-center ml-2 bg-white"><a href="<?php echo $rss_href ?>" class="btn_b01 btn inline-block text-gray-400 underline-none align-middle border-0 bg-transparent leading-10 py-0 px-3 text-center font-semibold border-0 text-lg transition duration-300 transition-color ease-out" title="RSS"><i class="fa fa-rss" aria-hidden="true"></i><span class="sound_only">RSS</span></a></li><?php } ?>
        <?php if ($write_href) { ?><li class="relative float-left w-10 text-center ml-2 bg-white"><a href="<?php echo $write_href ?>" class="btn_b01 btn inline-block text-gray-400 underline-none align-middle border-0 bg-transparent leading-10 py-0 px-3 text-center font-semibold border-0 text-lg transition duration-300 transition-color ease-out" title="글쓰기"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sound_only">글쓰기</span></a></li><?php } ?>
      </ul>
    <?php } ?>
  </div>
<?php } ?>
</form>

<!-- 게시판 검색 시작 { -->
<div class="bo_sch_wrap hidden w-full h-full fixed top-0 left-0 z-999">
  <fieldset class="bo_sch absolute top-1/2 left-1/2 bg-white text-left w-80 max-h-72 -m-32 -mt-44 overflow-y-auto rounded border border-indigo-200 bg-white">
    <h3 class="p-4 border-b font-semibold">검색</h3>
    <form name="fsearch" method="get" class="p-4 block">
      <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
      <input type="hidden" name="sca" value="<?php echo $sca ?>">
      <input type="hidden" name="sop" value="and">
      <label for="sfl" class="sound_only">검색대상</label>
      <select name="sfl" id="sfl" class="py-2 border w-full">
        <?php echo get_board_sfl_select_options($sfl); ?>
      </select>
      <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
      <div class="sch_bar flex justify -between mt-4 mb-2 border">
        <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="sch_input w-60 h-10 border-0 p-0 bg-transparent" size="25" maxlength="20" placeholder=" 검색어를 입력해주세요">
        <button type="submit" value="검색" class="sch_btn h-10 text-gray-700 bg-none border-0 w-10 text-base"><i class="fa fa-search text" aria-hidden="true"></i><span class="sound_only">검색</span></button>
      </div>
      <button type="button" class="bo_sch_cls absolute right-0 top-0 text-gray-400 border-0 py-3 px-4 text-base bg-white" title="닫기"><i class="fa fa-times" aria-hidden="true"></i><span class="sound_only">닫기</span></button>
    </form>
  </fieldset>
  <div class="bo_sch_bg bg-black bg-opacity-30 w-full h-full"></div>
</div>
<script>
  // 게시판 검색
  $(".btn_bo_sch").on("click", function() {
    $(".bo_sch_wrap").toggle();
  })
  $('.bo_sch_bg, .bo_sch_cls').click(function() {
    $('.bo_sch_wrap').hide();
  });
</script>
<!-- } 게시판 검색 끝 -->
</div>

<div class="clear-both"></div>

<?php if ($is_checkbox) { ?>
  <noscript>
    <p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
  </noscript>
<?php } ?>

<?php if ($is_checkbox) { ?>
  <script>
    function all_checked(sw) {
      var f = document.fboardlist;

      for (var i = 0; i < f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
          f.elements[i].checked = sw;
      }
    }

    function fboardlist_submit(f) {
      var chk_count = 0;

      for (var i = 0; i < f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
          chk_count++;
      }

      if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
      }

      if (document.pressed == "선택복사") {
        select_copy("copy");
        return;
      }

      if (document.pressed == "선택이동") {
        select_copy("move");
        return;
      }

      if (document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
          return false;

        f.removeAttribute("target");
        f.action = g5_bbs_url + "/board_list_update.php";
      }

      return true;
    }

    // 선택한 게시물 복사 및 이동
    function select_copy(sw) {
      var f = document.fboardlist;

      if (sw == 'copy')
        str = "복사";
      else
        str = "이동";

      var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

      f.sw.value = sw;
      f.target = "move";
      f.action = g5_bbs_url + "/move.php";
      f.submit();
    }

    // 게시판 리스트 관리자 옵션
    jQuery(function($) {
      $(".btn_more_opt.is_list_btn").on("click", function(e) {
        e.stopPropagation();
        $(".more_opt.is_list_btn").toggle();
      });
      $(document).on("click", function(e) {
        if (!$(e.target).closest('.is_list_btn').length) {
          $(".more_opt.is_list_btn").hide();
        }
      });
    });
  </script>
<?php } ?>
<!-- } 게시판 목록 끝 -->