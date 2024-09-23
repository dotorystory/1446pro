<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $board_skin_url . '/style.css">', 0);
?>

<section id="bo_w" class="pt-4 pb-6">
  <h2 class="sr-only"><?php echo $g5['title'] ?></h2>

  <!-- 게시물 작성/수정 시작 { -->
  <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
      $option = '';
      if ($is_notice) {
        $option .= PHP_EOL . '<li class="chk_box inline-flex items-center pr-2"><div class=" bg-white border rounded border-gray-400 w-4 h-4 flex flex-shrink-0 justify-center items-center focus-within:border-indigo-500"><input type="checkbox" id="notice" name="notice"  class="select_chk opacity-0 absolute  checked:bg-indigo-500" value="1" ' . $notice_checked . '><svg class="fill-current hidden w-4 h-4 text-indigo-500 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg></div>' . PHP_EOL . '<div class="pl-1">공지</div></li>';
      }
      if ($is_html) {
        if ($is_dhtml_editor) {
          $option_hidden .= '<input type="hidden" value="html1" name="html">';
        } else {
          $option .= PHP_EOL . '<li class="chk_box inline-flex items-center pr-2"><div class=" bg-white border rounded border-gray-400 w-4 h-4 flex flex-shrink-0 justify-center items-center focus-within:border-indigo-500"><input type="checkbox" id="html" name="html"   onclick="html_auto_br(this);" class="select_chk opacity-0 absolute  checked:bg-indigo-500" value="' . $html_value . '" ' . $html_checked . '><svg class="fill-current hidden w-4 h-4 text-indigo-500 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg></div>' . PHP_EOL . '<div class="pl-1">html</div></li>';
        }
      }
      if ($is_secret) {
        if ($is_admin || $is_secret == 1) {
          $option .= PHP_EOL . '<li class="chk_box inline-flex items-center pr-2"><div class=" bg-white border rounded border-gray-400 w-4 h-4 flex flex-shrink-0 justify-center items-center focus-within:border-indigo-500"><input type="checkbox" id="secret" name="secret"  class="select_chk opacity-0 absolute  checked:bg-indigo-500" value="secret" ' . $secret_checked . '><svg class="fill-current hidden w-4 h-4 text-indigo-500 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg></div>' . PHP_EOL . '<div class="pl-1">비밀글</div></li>';
        } else {
          $option_hidden .= '<input type="hidden" name="secret" value="secret">';
        }
      }
      if ($is_mail) {
        $option .= PHP_EOL . '<li class="chk_box inline-flex items-center pr-2"><div class=" bg-white border rounded border-gray-400 w-4 h-4 flex flex-shrink-0 justify-center items-center focus-within:border-indigo-500"><input type="checkbox" id="mail" name="mail"  class="select_chk opacity-0 absolute  checked:bg-indigo-500" value="mail" ' . $recv_email_checked . '><svg class="fill-current hidden w-4 h-4 text-indigo-500 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg></div>' . PHP_EOL . '<div class="pl-1">답변메일받기</div></li>';
      }
    }
    echo $option_hidden;
    ?>

    <?php if ($is_category) { ?>
      <div class="bo_w_select write_div mt-2 mb-4 mx-0 relative">
        <label for="ca_name" class="sr-only">분류<strong>필수</strong></label>
        <select name="ca_name" id="ca_name" class="w-full py-2 mb-2 sm:mb-0 px-1 border" required>
          <option value="">분류를 선택하세요</option>
          <?php echo $category_option ?>
        </select>
      </div>
    <?php } ?>

    <div class="bo_w_info write_div my-2 mx-0 relative block sm:grid grid-cols-2 gap-4">
      <?php if ($is_name) { ?>
        <label for="wr_name" class="sr-only">이름<strong>필수</strong></label>
        <input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input half_input required w-full mb-2 sm:mb-0 border p-1.5 outline-none" placeholder="이름">
      <?php } ?>

      <?php if ($is_password) { ?>
        <label for="wr_password" class="sr-only">비밀번호<strong>필수</strong></label>
        <input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input half_input <?php echo $password_required ?> w-full mb-2 sm:mb-0 border p-1.5 outline-none" placeholder="비밀번호">
      <?php } ?>

      <?php if ($is_email) { ?>
        <label for="wr_email" class="sr-only">이메일</label>
        <input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input half_input email w-full mb-2 sm:mb-0 border p-1.5 outline-none" placeholder="이메일">
      <?php } ?>


      <?php if ($is_homepage) { ?>
        <label for="wr_homepage" class="sr-only">홈페이지</label>
        <input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input half_input w-full mb-2 sm:mb-0 border p-1.5 outline-none" size="50" placeholder="홈페이지">
      <?php } ?>
    </div>

    <?php if ($option) { ?>
      <?php if ($is_name || $is_password || $is_email || $is_homepage) { ?>
        <div class="write_div my-2 mx-0">
        <?php } else { ?>
          <div class="write_div -mt-4 mb-2 mx-0">
          <?php } ?>
          <span class="sr-only">옵션</span>
          <ul class="bo_v_option">
            <?php echo $option ?>
          </ul>
          </div>
        <?php } ?>

        <div class="bo_w_tit write_div relative my-2 mx-0">
          <label for="wr_subject" class="sr-only">제목<strong>필수</strong></label>

          <div id="autosave_wrapper" class="write_div my-2 mx-0 border p-1.5">
            <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input full_input required outline-none w-full" maxlength="255" placeholder="제목">
            <?php if ($is_member) { // 임시 저장된 글 기능
            ?>
              <script src="<?php echo G5_JS_URL; ?>/autosave.js"></script>
              <?php if ($editor_content_js) echo $editor_content_js; ?>
              <button type="button" id="btn_autosave" class="btn_frmline absolute top-1 right-1 leading-7 h-7 text-xs inline-block w-28 py-0 px-1 border-0 bg-gray-600 rounded text-white">임시 저장된 글 (<span id="autosave_count"><?php echo $autosave_count; ?></span>)</button>
              <div id="autosave_pop" class="hidden z-10 block absolute top-8 right-0 w-80 h-auto border border-gray-800 bg-white">
                <strong class="absolute fs-0 lh-0 overflow-hidden">임시 저장된 글 목록</strong>
                <ul class="p-4 overflow-y-scroll h-32 border-b list-none"></ul>
                <div class="text-center m-0"><button type="button" class="autosave_close m-0 p-0 border-0 w-full bg-none text-gray-700 font-semibold text-sm">닫기</button></div>
              </div>
            <?php } ?>
          </div>

        </div>

        <div class="write_div my-2 mx-0">
          <label for="wr_content" class="sr-only">내용<strong>필수</strong></label>
          <div class="wr_content <?php echo $is_dhtml_editor ? $config['cf_editor'] : ''; ?>">
            <?php if ($write_min || $write_max) { ?>
              <!-- 최소/최대 글자 수 사용 시 -->
              <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
            <?php } ?>
            <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출
            ?>
            <?php if ($write_min || $write_max) { ?>
              <!-- 최소/최대 글자 수 사용 시 -->
              <div id="char_count_wrap"><span id="char_count"></span>글자</div>
            <?php } ?>
          </div>
        </div>

        <?php for ($i = 1; $is_link && $i <= G5_LINK_COUNT; $i++) { ?>
          <div class="bo_w_link write_div my-2 mx-0 relative border">
            <label for="wr_link<?php echo $i ?>" class="absolute top-px left-px h-10 leading-10 w-11 text-lg text-center text-gray-300"><i class="fa fa-link" aria-hidden="true"></i><span class="sr-only"> 링크 #<?php echo $i ?></span></label>
            <input type="text" name="wr_link<?php echo $i ?>" value="<?php if ($w == "u") {
                                                                        echo $write['wr_link' . $i];
                                                                      } ?>" id="wr_link<?php echo $i ?>" class="frm_input full_input pl-12 p-1.5 outline-none w-full" size="50">
          </div>
        <?php } ?>

        <?php for ($i = 0; $is_file && $i < $file_count; $i++) { ?>
          <div class="bo_w_flie write_div my-2 mx-0 relative">
            <div class="file_wr write_div relative border bg-white align-middle rounded-sm p-1.5 h-10 m-0">
              <label for="bf_file_<?php echo $i + 1 ?>" class="lb_icon absolute top-0 left-0 h-10 leading-10 w-11 text-lg text-center text-gray-300"><i class="fa fa-folder-open" aria-hidden="true"></i><span class="sr-only"> 파일 #<?php echo $i + 1 ?></span></label>
              <input type="file" name="bf_file[]" id="bf_file_<?php echo $i + 1 ?>" title="파일첨부 <?php echo $i + 1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file pl-12 w-full">
            </div>
            <?php if ($is_file_content) { ?>
              <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="full_input frm_input border border-t-0 p-1.5 outline-none w-full" placeholder="파일 설명을 입력해주세요.">
            <?php } ?>

            <?php if ($w == 'u' && $file[$i]['file']) { ?>
              <span class="file_del">
                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'] . '(' . $file[$i]['size'] . ')';  ?> 파일 삭제</label>
              </span>
            <?php } ?>

          </div>
        <?php } ?>


        <?php if ($is_use_captcha) { //자동등록방지
        ?>
          <div class="write_div text-center my-4">
            <?php echo $captcha_html ?>
          </div>
        <?php } ?>

        <div class="btn_confirm write_div flex justify-center mt-4">
          <a href="<?php echo get_pretty_url($bo_table); ?>" class="leading-8 h-8 px-3 inline-block text-center font-normal border-0 text-base transition transition-colors duration-300 ease-out text-white bg-gray-500 hover:bg-gray-600 rounded mr-1">취소</a>
          <button type="submit" id="btn_submit" accesskey="s" class="leading-8 h-8 px-3 text-center font-normal border-0 text-base transition transition-colors duration-300 ease-out text-white bg-indigo-500 hover:bg-indigo-600 rounded">작성완료</button>
        </div>
  </form>

  <script>
    <?php if ($write_min || $write_max) { ?>
      // 글자수 제한
      var char_min = parseInt(<?php echo $write_min; ?>); // 최소
      var char_max = parseInt(<?php echo $write_max; ?>); // 최대
      check_byte("wr_content", "char_count");

      $(function() {
        $("#wr_content").on("keyup", function() {
          check_byte("wr_content", "char_count");
        });
      });

    <?php } ?>

    function html_auto_br(obj) {
      if (obj.checked) {
        result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
        if (result)
          obj.value = "html2";
        else
          obj.value = "html1";
      } else
        obj.value = "";
    }

    function fwrite_submit(f) {
      <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함
      ?>

      var subject = "";
      var content = "";
      $.ajax({
        url: g5_bbs_url + "/ajax.filter.php",
        type: "POST",
        data: {
          "subject": f.wr_subject.value,
          "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
          subject = data.subject;
          content = data.content;
        }
      });

      if (subject) {
        alert("제목에 금지단어('" + subject + "')가 포함되어있습니다");
        f.wr_subject.focus();
        return false;
      }

      if (content) {
        alert("내용에 금지단어('" + content + "')가 포함되어있습니다");
        if (typeof(ed_wr_content) != "undefined")
          ed_wr_content.returnFalse();
        else
          f.wr_content.focus();
        return false;
      }

      if (document.getElementById("char_count")) {
        if (char_min > 0 || char_max > 0) {
          var cnt = parseInt(check_byte("wr_content", "char_count"));
          if (char_min > 0 && char_min > cnt) {
            alert("내용은 " + char_min + "글자 이상 쓰셔야 합니다.");
            return false;
          } else if (char_max > 0 && char_max < cnt) {
            alert("내용은 " + char_max + "글자 이하로 쓰셔야 합니다.");
            return false;
          }
        }
      }

      <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함
      ?>

      document.getElementById("btn_submit").disabled = "disabled";

      return true;
    }
  </script>
</section>
<!-- } 게시물 작성/수정 끝 -->