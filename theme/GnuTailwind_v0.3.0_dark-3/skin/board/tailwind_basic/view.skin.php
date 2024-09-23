<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH . '/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $board_skin_url . '/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->
<article class="pt-4 pb-6">
  <header class="mb-4">
    <h2 class="font-medium text-lg truncate p-3 border-t border-b border-gray-200">
      <?php echo $view['wr_subject']; ?>
    </h2>
  </header>

  <section id="bo_v_info">
    <h2 class="absolute top-0 left-0 fs-0 lh-0 overflow-hidden">
      페이지 정보
    </h2>
    <div class="flex-none md:flex items-center space-x-2">
      <div class="flex items-center w-full">
        <div class="profile_info">
          <span class="pf_img"><?php echo get_member_profile_img($view['mb_id']) ?></span>
        </div>
        <div class="text-sm text-gray-500 space-x-2">
          <span class="sr-only">작성자</span>
          <span>
            <?php echo $view['name'] ?>
            <?php if ($is_ip_view) echo "&nbsp;($ip)"; ?>
          </span><br>
          <?php if ($category_name) { ?>
            <span class="pl-2 pr-1 bg-indigo-100 text-indigo-500 uppercase rounded-lg">
              <?php echo $view['ca_name']; ?>
            </span>
          <?php } ?>
          <span class="sr-only">댓글</span>
          <span>
            <a href="#bo_vc"> <i class="fa fa-commenting-o" aria-hidden="true"></i> <?php echo number_format($view['wr_comment']) ?>건</a>
          </span>
          <span class="sr-only">조회</span>
          <span>
            <i class="fa fa-eye" aria-hidden="true"></i>
            <?php echo number_format($view['wr_hit']) ?>회
          </span>
          <span>
            <span class="sr-only">작성일</span>
            <i class="fa fa-clock-o" aria-hidden="true"></i>
            <?php echo date("y-m-d H:i", strtotime($view['wr_datetime'])) ?>
          </span>
        </div>
      </div>

      <!-- 게시물 상단 버튼 시작 { -->
      <div id="bo_v_top" class="w-full text-right">
        <?php ob_start(); ?>

        <ul class="btn_bo_user bo_v_com m-0 p-0 text-sm text-gray-400">
          <li class="relative inline w-10 text-center ml-2 bg-white">
            <a href="<?php echo $list_href ?>" class="btn_b01 btn inline-block underline-none align-middle leading-10 py-0 px-3 text-center border-0 text-lg  transition duration-300 transition-color ease-out" title="목록"><i class="fa fa-list" aria-hidden="true"></i><span class="sr-only">목록</span>
            </a>
          </li>
          <?php if ($reply_href) { ?>
            <li class="relative inline w-10 text-center ml-2 bg-white"><a href="<?php echo $reply_href ?>" class="btn_b01 btn inline-block underline-none align-middle leading-10 py-0 px-3 text-center border-0 transition duration-300 transition-color ease-out" title="답변"><i class="fa fa-reply" aria-hidden="true"></i><span class="sr-only">답변</span></a></li>
          <?php } ?>
          <?php if ($write_href) { ?>
            <li class="relative inline w-10 text-center ml-2 bg-white"><a href="<?php echo $write_href ?>" class="btn_b01 btn inline-block underline-none align-middle leading-10 py-0 px-3 text-center border-0 transition duration-300 transition-color ease-out" title="글쓰기"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sr-only">글쓰기</span></a></li>
          <?php } ?>
          <?php if ($update_href || $delete_href || $copy_href || $move_href || $search_href) { ?>
            <li class="relative inline w-10 text-center ml-2 bg-white">
              <button type="button" class="btn_more_opt is_view_btn btn_b01 btn inline-block underline-none align-middle border-0 bg-transparent leading-10 py-0 px-3 text-center border-0 text-lg transition duration-300 transition-color ease-out m-0 p-0"><i class="fa fa-ellipsis-v" aria-hidden="true"></i><span class="sr-only">게시판 리스트 옵션</span></button>
              <ul class="more_opt is_view_btn hidden block absolute top-11 right-0 bg-white border z-999">
                <?php if ($update_href) { ?>
                  <li class="border-b p-3 float-inherit w-24 text-center m-0 text-gray-700 text-left bg-white">
                    <a href="<?php echo $update_href ?>">수정<i class="fa fa-pencil-square-o ml-2" aria-hidden="true"></i>
                    </a>
                  </li>
                <?php } ?>
                <?php if ($delete_href) { ?>
                  <li class="border-b p-3 float-inherit w-24 text-center m-0 text-gray-700 text-left bg-white">
                    <a href="<?php echo $delete_href ?>" onclick="del(this.href); return false;">삭제<i class="fa fa-trash-o ml-2" aria-hidden="true"></i>
                    </a>
                  </li>
                <?php } ?>
                <?php if ($copy_href) { ?>
                  <li class="border-b p-3 float-inherit w-24 text-center m-0 text-gray-700 text-left bg-white">
                    <a href="<?php echo $copy_href ?>" onclick="board_move(this.href); return false;">복사<i class="fa fa-files-o ml-2" aria-hidden="true"></i>
                    </a>
                  </li>
                <?php } ?>
                <?php if ($move_href) { ?>
                  <li class="border-b p-3 float-inherit w-24 text-center m-0 text-gray-700 text-left bg-white">
                    <a href="<?php echo $move_href ?>" onclick="board_move(this.href); return false;">이동<i class="fa fa-arrows ml-2" aria-hidden="true"></i>
                    </a>
                  </li>
                <?php } ?>
                <?php if ($search_href) { ?>
                  <li class="border-b p-3 float-inherit w-24 text-center m-0 text-gray-700 text-left bg-white">
                    <a href="<?php echo $search_href ?>">검색<i class="fa fa-search ml-2" aria-hidden="true"></i>
                    </a>
                  </li>
                <?php } ?>
              </ul>
            </li>
          <?php } ?>
        </ul>

        <script>
          jQuery(function($) {
            // 게시판 보기 버튼 옵션
            $(".btn_more_opt.is_view_btn").on("click", function(e) {
              e.stopPropagation();
              $(".more_opt.is_view_btn").toggle();
            });
            $(document).on("click", function(e) {
              if (!$(e.target).closest('.is_view_btn').length) {
                $(".more_opt.is_view_btn").hide();
              }
            });
          });
        </script>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
        ?>
      </div>
      <!-- } 게시물 상단 버튼 끝 -->
    </div>
  </section>

  <section class="container mx-auto">
    <h2 class="absolute top-0 left-0 fs-0 lh-0 overflow-hidden">본문</h2>
    <div class="relative pt-4 px-0 pb-2 my-2 flex-col md:flex-row items-center">
      <div>
        <?php include_once(G5_SNS_PATH . "/view.sns.skin.php"); ?>
      </div>
      <div>
        <?php if ($scrap_href) { ?>
          <a href="<?php echo $scrap_href;  ?>" target="_blank" class="btn btn_b03 py-1 px-4 text-gray-700 font-normal text-base md:w-full leading-7 h-7 border rounded" onclick="win_scrap(this.href); return false;">
            <i class="fa fa-bookmark" aria-hidden="true"></i> 스크랩
          </a>
        <?php } ?>
      </div>
    </div>

    <div class="pt-4 pb-6">
      <?php
      // 파일 출력
      $v_img_count = count($view['file']);
      if ($v_img_count) {
        echo "<div id=\"bo_v_img\">\n";

        foreach ($view['file'] as $view_file) {
          echo get_file_thumbnail($view_file);
        }

        echo "</div>\n";
      }
      ?>
    </div>

    <!-- 본문 내용 시작 { -->
    <div id="bo_v_con" class="mt-2 mx-0 mb-7 w-full leading-7 min-h-48 break-all overflow-hidden text-gray-500">
      <?php echo get_view_thumbnail($view['content']); ?>
    </div>
    <?php //echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 
    ?>
    <!-- } 본문 내용 끝 -->

    <?php if ($is_signature) { ?><p><?php echo $signature ?></p><?php } ?>


    <!--  추천 비추천 시작 { -->
    <?php if ($good_href || $nogood_href) { ?>
      <div id="bo_v_act" class="mb-8 text-center">
        <?php if ($good_href) { ?>
          <span class="bo_v_act_gng relative">
            <a href="<?php echo $good_href . '&amp;' . $qstr ?>" id="good_button" class="bo_v_good mr-2 align-middle text-gray-700 hover:bg-white hover:text-red-400 hover:border-red-400 inline-block border w-16 leading-10 rounded-3xl"><i class="fa fa-thumbs-o-up text-lg mr-2" aria-hidden="true"></i><span class="sr-only">추천</span><strong><?php echo number_format($view['wr_good']) ?></strong></a>
            <b id="bo_v_act_good" class=" hidden absolute top-7 left-0 z-9999 py-3 px-0 w-40 bg-red-40 text-white text-center"></b>
          </span>
        <?php } ?>
        <?php if ($nogood_href) { ?>
          <span class="bo_v_act_gng relative">
            <a href="<?php echo $nogood_href . '&amp;' . $qstr ?>" id="nogood_button" class="bo_v_nogood mr-2 align-middle text-gray-700 hover:bg-white hover:text-red-400 hover:border-red-400 inline-block border w-16 leading-10 rounded-3xl"><i class="fa fa-thumbs-o-down text-lg mr-2" aria-hidden="true"></i><span class="sr-only">비추천</span><strong><?php echo number_format($view['wr_nogood']) ?></strong></a>
            <b id="bo_v_act_nogood" class=" hidden absolute top-7 left-0 z-9999 py-3 px-0 w-40 bg-red-400 text-white text-center"></b>
          </span>
        <?php } ?>
      </div>
      <?php } else {
      if ($board['bo_use_good'] || $board['bo_use_nogood']) {
      ?>
        <div id="bo_v_act" class="mb-7 text-center">
          <?php if ($board['bo_use_good']) { ?><span class="bo_v_good inline-block border w-16 leading-10 rounded-3xl"><i class="fa fa-thumbs-o-up text-lg mr-2" aria-hidden="true"></i><span class="sr-only">추천</span><strong><?php echo number_format($view['wr_good']) ?></strong></span><?php } ?>
          <?php if ($board['bo_use_nogood']) { ?><span class="bo_v_nogood inline-block border w-16 leading-10 rounded-3xl"><i class="fa fa-thumbs-o-down text-lg mr-2" aria-hidden="true"></i><span class="sr-only">비추천</span><strong><?php echo number_format($view['wr_nogood']) ?></strong></span><?php } ?>
        </div>
    <?php
      }
    }
    ?>
    <!-- }  추천 비추천 끝 -->
  </section>

  <?php
  $cnt = 0;
  if ($view['file']['count']) {
    for ($i = 0; $i < count($view['file']); $i++) {
      if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
        $cnt++;
    }
  }
  ?>

  <?php if ($cnt) { ?>
    <!-- 첨부파일 시작 { -->
    <section id="bo_v_file" class="mb-2">
      <h2 class="sr-only">첨부파일</h2>
      <ul class="border p-2">
        <?php
        // 가변 파일
        for ($i = 0; $i < count($view['file']); $i++) {
          if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
        ?>
            <li class="text-sm">
              <i class="fa fa-folder-open" aria-hidden="true"></i>
              <a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
                <span><?php echo $view['file'][$i]['source'] ?></span> <?php echo $view['file'][$i]['content'] ?> (<?php echo $view['file'][$i]['size'] ?>)
              </a>
              <span class="bo_v_file_cnt pl-4"><?php echo $view['file'][$i]['download'] ?>회 다운로드 | DATE : <?php echo $view['file'][$i]['datetime'] ?></span>
            </li>
        <?php
          }
        }
        ?>
      </ul>
    </section>
    <!-- } 첨부파일 끝 -->
  <?php } ?>

  <?php if (isset($view['link']) && array_filter($view['link'])) { ?>
    <!-- 관련링크 시작 { -->
    <section id="bo_v_link">
      <h2 class="sr-only">관련링크</h2>
      <ul class="border p-2">
        <?php
        // 링크
        $cnt = 0;
        for ($i = 1; $i <= count($view['link']); $i++) {
          if ($view['link'][$i]) {
            $cnt++;
            $link = cut_str($view['link'][$i], 70);
        ?>
            <li class="text-sm">
              <i class="fa fa-link" aria-hidden="true"></i>
              <a href="<?php echo $view['link_href'][$i] ?>" target="_blank">
                <span><?php echo $link ?></span>
              </a>
              <span class="bo_v_link_cnt pl-4"><?php echo $view['link_hit'][$i] ?>회 연결</span>
            </li>
        <?php
          }
        }
        ?>
      </ul>
    </section>
    <!-- } 관련링크 끝 -->
  <?php } ?>

  <?php if ($prev_href || $next_href) { ?>
    <ul class="bo_v_nb">
      <?php if ($prev_href) { ?><li class="btn_prv"><span class="nb_tit"><i class="fa fa-chevron-up" aria-hidden="true"></i> 이전글</span><a href="<?php echo $prev_href ?>"><?php echo $prev_wr_subject; ?></a> <span class="nb_date"><?php echo str_replace('-', '.', substr($prev_wr_date, '2', '8')); ?></span></li><?php } ?>
      <?php if ($next_href) { ?><li class="btn_next"><span class="nb_tit"><i class="fa fa-chevron-down" aria-hidden="true"></i> 다음글</span><a href="<?php echo $next_href ?>"><?php echo $next_wr_subject; ?></a> <span class="nb_date"><?php echo str_replace('-', '.', substr($next_wr_date, '2', '8')); ?></span></li><?php } ?>
    </ul>
  <?php } ?>

  <?php
  // 코멘트 입출력
  include_once(G5_BBS_PATH . '/view_comment.php');
  ?>
</article>
<!-- } 게시판 읽기 끝 -->

<script>
  <?php if ($board['bo_download_point'] < 0) { ?>
    $(function() {
      $("a.view_file_download").click(function() {
        if (!g5_is_member) {
          alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
          return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if (confirm(msg)) {
          var href = $(this).attr("href") + "&js=on";
          $(this).attr("href", href);

          return true;
        } else {
          return false;
        }
      });
    });
  <?php } ?>

  function board_move(href) {
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
  }
</script>

<script>
  $(function() {
    $("a.view_image").click(function() {
      window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
      return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
      var $tx;
      if (this.id == "good_button")
        $tx = $("#bo_v_act_good");
      else
        $tx = $("#bo_v_act_nogood");

      excute_good(this.href, $(this), $tx);
      return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
  });

  function excute_good(href, $el, $tx) {
    $.post(
      href, {
        js: "on"
      },
      function(data) {
        if (data.error) {
          alert(data.error);
          return false;
        }

        if (data.count) {
          $el.find("strong").text(number_format(String(data.count)));
          if ($tx.attr("id").search("nogood") > -1) {
            $tx.text("이 글을 비추천하셨습니다.");
            $tx.fadeIn(200).delay(2500).fadeOut(200);
          } else {
            $tx.text("이 글을 추천하셨습니다.");
            $tx.fadeIn(200).delay(2500).fadeOut(200);
          }
        }
      }, "json"
    );
  }
</script>
<!-- } 게시글 읽기 끝 -->