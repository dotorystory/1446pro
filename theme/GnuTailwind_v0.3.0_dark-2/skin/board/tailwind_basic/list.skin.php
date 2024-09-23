<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $board_skin_url . '/style.css">', 0);
?>

<!-- 게시판 목록 시작 { -->
<div id="bo_list" class="pt-4 pb-6">

  <!-- 게시판 카테고리 시작 { -->
  <?php if ($is_category) { ?>
    <nav id="bo_cate">
      <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
      <ul id="bo_cate_ul">
        <?php echo $category_option ?>
      </ul>
    </nav>
  <?php } ?>
  <!-- } 게시판 카테고리 끝 -->

  <form name="fboardlist" id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">

    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div id="bo_btn_top" class="mt-3 mx-0">
      <div id="bo_list_total" class="float-left leading-10 text-gray-700">
        <span class="text-base">Total <?php echo number_format($total_count) ?>건</span>
        <span class="text-base"><?php echo $page ?> 페이지</span>
      </div>

      <ul class="btn_bo_user float-right m-0 p-0">
        <?php if ($admin_href) { ?><li class="relative float-left w-10 text-center ml-2 bg-white"><a href="<?php echo $admin_href ?>" class="btn_admin btn inline-block text-indigo-500 underline-none align-middle leading-10 py-0 px-3 text-center font-semibold border-0 text-lg  transition duration-300 transition-color ease-out" title="관리자"><i class="fa fa-cog fa-spin fa-fw"></i><span class="sr-only inline-block absolute top-0 left-0 w-0 h-0 m-0 p-0 fs-0 lh-0 border-0 overflow-hidden">관리자</span></a></li><?php } ?>
        <?php if ($rss_href) { ?><li class="relative float-left w-10 text-center ml-2 bg-white"><a href="<?php echo $rss_href ?>" class="btn_b01 btn inline-block text-gray-400 align-middle border-0 bg-transparent leading-10 py-0 px-3 text-center font-semibold border-0 text-lg transition duration-300 transition-color ease-out" title="RSS"><i class="fa fa-rss" aria-hidden="true"></i><span class="sr-only inline-block absolute top-0 left-0 w-0 h-0 m-0 p-0 fs-0 lh-0 border-0 overflow-hidden">RSS</span></a></li><?php } ?>
        <li class="relative float-left w-10 text-center ml-2 bg-white">
          <button type="button" class="btn_bo_sch btn_b01 btn inline-block text-gray-400 align-middle border-0 bg-transparent leading-10 py-0 px-3 text-center font-semibold border-0 text-lg transition duration-300 transition-color ease-out" title="게시판 검색"><i class="fa fa-search" aria-hidden="true"></i><span class="sr-only inline-block absolute top-0 left-0 w-0 h-0 m-0 p-0 fs-0 lh-0 border-0 overflow-hidden">게시판 검색</span></button>
        </li>
        <?php if ($write_href) { ?><li class="relative float-left w-10 text-center ml-2 bg-white"><a href="<?php echo $write_href ?>" class="btn_b01 btn inline-block text-gray-400 underline-none align-middle border-0 bg-transparent leading-10 py-0 px-3 text-center font-semibold border-0 text-lg transition duration-300 transition-color ease-out" title="글쓰기"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sr-only inline-block absolute top-0 left-0 w-0 h-0 m-0 p-0 fs-0 lh-0 border-0 overflow-hidden">글쓰기</span></a></li><?php } ?>
        <?php if ($is_admin == 'super' || $is_auth) {  ?>
          <li class="relative float-left w-10 text-center ml-2 bg-white">
            <button type="button" class="btn_more_opt is_list_btn btn_b01 btn inline-block text-gray-400 underline-none align-middle border-0 bg-transparent leading-10 py-0 px-3 text-center font-semibold border-0 text-lg transition duration-300 transition-color ease-out m-0 p-0" title="게시판 리스트 옵션"><i class="fa fa-ellipsis-v" aria-hidden="true"></i><span class="sr-only inline-block absolute top-0 left-0 w-0 h-0 m-0 p-0 fs-0 lh-0 border-0 overflow-hidden">게시판 리스트 옵션</span></button>
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

    <div class="tbl_wrap">
      <table class="table-auto w-full">
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <thead>
          <tr class="border-t border-b font-semibold text-gray-500">
            <?php if ($is_checkbox) { ?>
              <th scope="col" class="all_chk chk_box">
                <div class="flex items-center justify-center">
                  <div class="bg-white border rounded border-gray-400 w-4 h-4 flex flex-shrink-0 justify-center items-center focus-within:border-indigo-500">
                    <input type="checkbox" id="chkall" class="select_chk opacity-0 absolute  checked:bg-indigo-500" onclick="if (this.checked) all_checked(true); else all_checked(false);">
                    <svg class="fill-current hidden w-4 h-4 text-indigo-500 pointer-events-none" viewBox="0 0 20 20">
                      <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                    </svg>
                  </div>
                  <div class="select-none"><b class="sr-only">현재 페이지 게시물 전체선택</b></div>
                </div>
              </th>
            <?php } ?>
            <th scope="col" class="show-cell py-3 text-center whitespace-nowrap px-3">번호</th>
            <th scope="col" class="py-3 text-center whitespace-nowrap px-3">제목</th>
            <th scope="col" class="show-cell py-3 text-center whitespace-nowrap px-3">글쓴이</th>
            <th scope="col" class="cell-hit show-cell py-3 text-center whitespace-nowrap px-3"><?php echo subject_sort_link('wr_hit', $qstr2, 1) ?>조회 </a></th>
            <?php if ($is_good) { ?><th scope="col" class="cell-good show-cell py-3 text-center whitespace-nowrap px-3"><?php echo subject_sort_link('wr_good', $qstr2, 1) ?>추천 </a></th><?php } ?>
            <?php if ($is_nogood) { ?><th scope="col" class="cell-bad show-cell py-3 text-center whitespace-nowrap px-3"><?php echo subject_sort_link('wr_nogood', $qstr2, 1) ?>비추천 </a></th><?php } ?>
            <th scope="col" class="show-cell py-3 text-center whitespace-nowrap px-3"><?php echo subject_sort_link('wr_datetime', $qstr2, 1) ?>날짜 </a></th>
          </tr>
        </thead>
        <tbody>
          <?php
          for ($i = 0; $i < count($list); $i++) {
            if ($i % 2 == 0) $lt_class = "even";
            else $lt_class = "";
          ?>
            <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?> <?php echo $lt_class ?> border-b">
              <?php if ($is_checkbox) { ?>
                <td class="py-3 px-3">
                  <label class="flex justify-center items-center">
                    <div class="bg-white border rounded border-gray-400 w-4 h-4 flex flex-shrink-0 justify-center items-center focus-within:border-indigo-500">
                      <input type="checkbox" class="opacity-0 absolute" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
                      <svg class="fill-current hidden w-3 h-3 text-indigo-500 pointer-events-none" viewBox="0 0 20 20">
                        <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                      </svg>
                    </div>
                    <b class="sr-only"><?php echo $list[$i]['subject'] ?></b>
                  </label>
                </td>
              <?php } ?>
              <td class="show-cell py-3 px-3 text-center">
                <?php
                if ($list[$i]['is_notice']) // 공지사항
                  echo '<span class="inline-block leading-6 rounded-1 font-normal text-pink-500 whitespace-nowrap">공지</span>';
                else if ($wr_id == $list[$i]['wr_id'])
                  echo "<span class=\"bo_current\">열람중</span>";
                else
                  echo $list[$i]['num'];
                ?>
              </td>

              <td class="td_subject py-3 px-3" style="padding-left:<?php echo $list[$i]['reply'] ? (strlen($list[$i]['wr_reply']) * 10) : '0'; ?>px">
                <?php
                if ($is_category && $list[$i]['ca_name']) {
                ?>
                  <a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link float-left inline-block mr-1 bg-indigo-100 text-indigo-500 font-normal mt-0.5 px-1.5 rounded text-sm ml-2 show-cell">
                    <?php echo $list[$i]['ca_name'] ?>
                  </a>
                <?php } ?>
                <div>
                  <a href="<?php echo $list[$i]['href'] ?>">
                    <?php echo $list[$i]['icon_reply'] ?>
                    <?php
                    if (isset($list[$i]['icon_secret'])) echo rtrim($list[$i]['icon_secret']);
                    ?>
                    <span class="font-normal"><?php echo $list[$i]['subject'] ?></span>
                  </a>
                  <?php
                  if ($list[$i]['icon_new']) echo "<span class=\"new_icon\">N<span class=\"sound_only\">새글</span></span>";
                  // if ($list[$i]['file']['count']) { echo '<'.$list[$i]['file']['count'].'>'; }
                  if (isset($list[$i]['icon_hot'])) echo rtrim($list[$i]['icon_hot']);
                  if (isset($list[$i]['icon_file'])) echo rtrim($list[$i]['icon_file']);
                  if (isset($list[$i]['icon_link'])) echo rtrim($list[$i]['icon_link']);
                  ?>
                  <?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><span class="cnt_cmt"><?php echo $list[$i]['wr_comment']; ?></span><span class="sound_only">개</span><?php } ?>
                  <div class="show-row-one flex justify-between font-normal mt-3">
                    <div class="">
                      <span class="pr-2 text-sm font-semibold"><?php echo $list[$i]['name'] ?></span>
                      <i class="fa fa-eye" aria-hidden="true"></i><span class="text-sm"> <?php echo $list[$i]['wr_hit'] ?></span>
                    </div>
                    <div class="text-sm">
                      <?php echo $list[$i]['datetime2'] ?>
                    </div>
                  </div>
                </div>
              </td>
              <td class="td_name sv_use show-cell px-3 text-center whitespace-nowrap"><?php echo $list[$i]['name'] ?></td>
              <td class="td_num show-cell px-3 text-center whitespace-nowrap"><?php echo $list[$i]['wr_hit'] ?></td>
              <?php if ($is_good) { ?><td class="td_num show-cell px-3 text-center align-middle whitespace-nowrap"><?php echo $list[$i]['wr_good'] ?></td><?php } ?>
              <?php if ($is_nogood) { ?><td class="td_num show-cell px-3 text-center align-middle whitespace-nowrap"><?php echo $list[$i]['wr_nogood'] ?></td><?php } ?>
              <td class="td_datetime show-cell px-3 text-center align-middle whitespace-nowrap"><?php echo $list[$i]['datetime2'] ?></td>

            </tr>
          <?php } ?>
          <?php if (count($list) == 0) {
            echo '<tr><td colspan="' . $colspan . '" class="empty_table text-center pt-8">게시물이 없습니다.</td></tr>';
          } ?>
        </tbody>
      </table>
    </div>

    <!-- 페이지 -->
    <div class="mt-6 flex justify-center">
      <?php echo $write_pages; ?>
    </div>
    <!-- 페이지 -->

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
      <div class="bo_fx mb-2 float-right">
        <?php if ($list_href || $write_href) { ?>
          <ul class="btn_bo_user m-0 p-0">
            <?php if ($admin_href) { ?><li class="relative float-left w-10 text-center ml-2 bg-white"><a href="<?php echo $admin_href ?>" class="btn_admin btn inline-block text-indigo-400 align-middle leading-10 py-0 px-3 text-center font-semibold border-0 text-lg transition duration-300 transition-color ease-out" title="관리자"><i class="fa fa-cog fa-spin fa-fw"></i><span class="sr-only inline-block absolute top-0 left-0 w-0 h-0 m-0 p-0 fs-0 lh-0 border-0 overflow-hidden">관리자</span></a></li><?php } ?>
            <?php if ($rss_href) { ?><li class="relative float-left w-10 text-center ml-2 bg-white"><a href="<?php echo $rss_href ?>" class="btn_b01 btn inline-block text-gray-400 underline-none align-middle border-0 bg-transparent leading-10 py-0 px-3 text-center font-semibold border-0 text-lg transition duration-300 transition-color ease-out" title="RSS"><i class="fa fa-rss" aria-hidden="true"></i><span class="sr-only inline-block absolute top-0 left-0 w-0 h-0 m-0 p-0 fs-0 lh-0 border-0 overflow-hidden">RSS</span></a></li><?php } ?>
            <?php if ($write_href) { ?><li class="relative float-left w-10 text-center ml-2 bg-white"><a href="<?php echo $write_href ?>" class="btn_b01 btn inline-block text-gray-400 underline-none align-middle border-0 bg-transparent leading-10 py-0 px-3 text-center font-semibold border-0 text-lg transition duration-300 transition-color ease-out" title="글쓰기"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sr-only inline-block absolute top-0 left-0 w-0 h-0 m-0 p-0 fs-0 lh-0 border-0 overflow-hidden">글쓰기</span></a></li><?php } ?>
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
        <label for="sfl" class="sr-only inline-block absolute top-0 left-0 w-0 h-0 m-0 p-0 fs-0 lh-0 border-0 overflow-hidden">검색대상</label>
        <select name="sfl" id="sfl" class="py-2 border w-full">
          <?php echo get_board_sfl_select_options($sfl); ?>
        </select>
        <label for="stx" class="sr-only">검색어<strong class="sr-only"> 필수</strong></label>
        <div class="sch_bar flex justify -between mt-4 mb-2 border">
          <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="sch_input w-60 h-10 border-0 p-0 bg-transparent" size="25" maxlength="20" placeholder=" 검색어를 입력해주세요">
          <button type="submit" value="검색" class="sch_btn h-10 text-gray-700 bg-none border-0 w-10 text-base"><i class="fa fa-search text" aria-hidden="true"></i><span class="sr-only">검색</span></button>
        </div>
        <button type="button" class="bo_sch_cls absolute right-0 top-0 text-gray-400 border-0 py-3 px-4 text-base bg-white" title="닫기"><i class="fa fa-times" aria-hidden="true"></i><span class="sr-only inline-block absolute top-0 left-0 w-0 h-0 m-0 p-0 fs-0 lh-0 border-0 overflow-hidden">닫기</span></button>
      </form>
    </fieldset>
    <div class="bo_sch_bg bg-black bg-opacity-30 w-full h-full"></div>
  </div>

  <div class="clear-both"></div>

  <script>
    jQuery(function($) {
      // 게시판 검색
      $(".btn_bo_sch").on("click", function() {
        $(".bo_sch_wrap").toggle();
      })
      $('.bo_sch_bg, .bo_sch_cls').click(function() {
        $('.bo_sch_wrap').hide();
      });
    });
  </script>
  <!-- } 게시판 검색 끝 -->
</div>

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

      if (sw == "copy")
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