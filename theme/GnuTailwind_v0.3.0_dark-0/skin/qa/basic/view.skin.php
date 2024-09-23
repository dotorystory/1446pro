<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$qa_skin_url.'/style_tailwind.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->
<article id="bo_v" class="pt-4 pb-8">
    <header class="border border-b-0 pt-4 px-4">
        <h2 id="bo_v_title">
	        <span class="py-1 px-2 m-0 bg-indigo-100 text-center text-indigo-500 inline-block uppercase rounded-lg mb-1 mr-2">
	            <?php
	            echo '<span class="bo_v_cate">'.$view['category'].'</span> '; // 분류 출력 끝
	            ?>
	        </span>
	        <span class="bo_v_tit inline font-semibold inline-block text-lg my-4">
	            <?php
	            echo $view['subject']; // 글제목 출력
	            ?>
	        </span>
        </h2>
    </header>

    <section id="bo_v_info" class="relative pb-2 border border-t-0 px-4">
        <h2 class="absolute top-0 left-0 fs-0 lh-0 overflow-hidden">페이지 정보</h2>
        <div class="flex justify-between">
	        <div class="flex items-center space-x-4 text-gray-500 text-sm">
		        <span class="sr-only">작성자</span><?php echo $view['name'] ?>
		        <span class="sr-only">작성일</span><span class="bo_date"><i class="fa fa-clock-o pr-1" aria-hidden="true"></i><?php echo $view['datetime']; ?></span>
		        <?php if($view['email'] || $view['hp']) { ?>
		            <?php if($view['email']) { ?>
		            <span class="sr-only">이메일</span>
		            <i class="fa fa-envelope-o pr-1" aria-hidden="true"></i> <?php echo $view['email']; ?></span>
		            <?php } ?>
		            <?php if($view['hp']) { ?>
		            <span class="sr-only">휴대폰</span>
		            <i class="fa fa-phone pr-q" aria-hidden="true"></i> <?php echo $view['hp']; ?>
		            <?php } ?>
		        <?php } ?>
	        </div>

	        <!-- 게시물 상단 버튼 시작 { -->
		    <div id="bo_v_top">
		        <?php
		        ob_start();
				?>

		        <ul class="bo_v_com float-right m-0 p-0">
					<li class="relative float-left w-10 text-center ml-2 bg-white"><a href="<?php echo $list_href ?>" class="btn_b01 btn inline-block text-gray-400 underline-none align-middle leading-10 py-0 px-3 text-center font-semibold border-0 text-lg  transition duration-300 transition-color ease-out" title="목록"><i class="fa fa-list" aria-hidden="true"></i><span class="sr-only">목록</span></a></li>
		            <?php if ($write_href) { ?><li class="relative float-left w-10 text-center ml-2 bg-white"><a href="<?php echo $write_href ?>" class="btn_b01 btn inline-block text-gray-400 underline-none align-middle leading-10 py-0 px-3 text-center font-semibold border-0 text-lg  transition duration-300 transition-color ease-out" title="글쓰기"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sr-only">글쓰기</span></a></li><?php } ?>
	                <?php if ($update_href || $delete_href) { ?>
		        	<li class="relative float-left w-10 text-center ml-2 bg-white">
		        		<button type="button" class="btn_more_opt btn_b01 btn inline-block text-gray-400 underline-none align-middle border-0 bg-transparent leading-10 py-0 px-3 text-center font-semibold border-0 text-lg transition duration-300 transition-color ease-out m-0 p-0" title="게시판 읽기 옵션"><i class="fa fa-ellipsis-v" aria-hidden="true"></i><span class="sr-only">게시판 읽기 옵션</span></button>
		        		<ul class="more_opt hidden block absolute top-11 right-0 bg-white border z-999">
		        			<?php if ($update_href) { ?><li class="border-b p-3 float-inherit w-24 text-center m-0 text-gray-700 text-left bg-white"><a href="<?php echo $update_href ?>" class="btn_b01 btn" title="수정">수정<i class="fa fa-pencil-square-o ml-2" aria-hidden="true"></i></a></li><?php } ?>
		            		<?php if ($delete_href) { ?><li class="border-b p-3 float-inherit w-24 text-center m-0 text-gray-700 text-left bg-white"><a href="<?php echo $delete_href ?>" class="btn_b01 btn" onclick="del(this.href); return false;" title="삭제">삭제<i class="fa fa-trash-o ml-2" aria-hidden="true"></i></a></li><?php } ?>
		        		</ul>
		        	</li>
	                <?php } ?>
		        </ul>
		        <script>
					// 게시판 리스트 옵션
					$(".btn_more_opt").on("click", function() {
					    $(".more_opt").toggle();
					})
				</script>
		        <?php
		        $link_buttons = ob_get_contents();
		        ob_end_flush();
				?>
		    </div>
		    <!-- } 게시물 상단 버튼 끝 -->
        </div>
	</section>

    <section id="bo_v_atc" class="border border-t-0 p-4">
        <h2 id="bo_v_atc_title" class="sr-only">본문</h2>

        <?php
        // 파일 출력
        if($view['img_count']) {
            echo "<div id=\"bo_v_img\">\n";

            for ($i=0; $i<$view['img_count']; $i++) {
                //echo $view['img_file'][$i];
                echo get_view_thumbnail($view['img_file'][$i], $qaconfig['qa_image_width']);
            }

            echo "</div>\n";
        }
         ?>

        <!-- 본문 내용 시작 { -->
        <div id="bo_v_con" class="mt-2 mx-0 mb-7 w-full leading-7 min-h-48 break-all overflow-hidden"><?php echo get_view_thumbnail($view['content'], $qaconfig['qa_image_width']); ?></div>
        <!-- } 본문 내용 끝 -->

        <?php if($view['qa_type']) { ?>
        <div id="bo_v_addq"><a href="<?php echo $rewrite_href; ?>" class="btn_b01">추가질문</a></div>
        <?php } ?>

        <?php if($view['download_count']) { ?>

        <!-- 첨부파일 시작 { -->
        <section id="bo_v_file">
            <h2>첨부파일</h2>
            <ul>
            <?php
            // 가변 파일
            for ($i=0; $i<$view['download_count']; $i++) {
             ?>
                <li>
                    <i class="fa fa-download" aria-hidden="true"></i>
                    <a href="<?php echo $view['download_href'][$i];  ?>" class="view_file_download" download>
                        <strong><?php echo $view['download_source'][$i] ?></strong>
                    </a>
                </li>
            <?php
            }
             ?>
            </ul>
        </section>
        <!-- } 첨부파일 끝 -->
        <?php } ?>
    </section>

    <?php if ($prev_href || $next_href) { ?>
    <ul class="bo_v_nb">
        <?php if ($prev_href) { ?><li><a href="<?php echo $prev_href ?>" class="btn_b01 btn"><i class="fa fa-chevron-left" aria-hidden="true"></i> 이전글</a></li><?php } ?>
        <?php if ($next_href) { ?><li><a href="<?php echo $next_href ?>" class="btn_b01 btn">다음글 <i class="fa fa-chevron-right" aria-hidden="true"></i></i></a></li><?php } ?>
    </ul>
    <?php } ?>

    <?php
    // 질문글에서 답변이 있으면 답변 출력, 답변이 없고 관리자이면 답변등록폼 출력
    if(!$view['qa_type']) {
        if($view['qa_status'] && $answer['qa_id'])
            include_once($qa_skin_path.'/view.answer.skin.php');
        else
            include_once($qa_skin_path.'/view.answerform.skin.php');
    }
    ?>

    <?php if($view['rel_count']) { ?>
    <section id="bo_v_rel">
        <h2>연관질문</h2>

        <div class="tbl_head01 tbl_wrap">
            <table>
            <thead>
            <tr>
                <th scope="col">제목</th>
                <th scope="col">등록일</th>
                <th scope="col">상태</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for($i=0; $i<$view['rel_count']; $i++) {
            ?>
            <tr>
                <td>
                    <span class="bo_cate_link"><?php echo get_text($rel_list[$i]['category']); ?></span>

                    <a href="<?php echo $rel_list[$i]['view_href']; ?>" class="bo_tit">
                        <?php echo $rel_list[$i]['subject']; ?>
                    </a>
                </td>
                <td class="td_date"><?php echo $rel_list[$i]['date']; ?></td>
                <td class="td_stat"><span class="<?php echo ($rel_list[$i]['qa_status'] ? 'txt_done' : 'txt_rdy'); ?>"><?php echo ($rel_list[$i]['qa_status'] ? '<i class="fa fa-check-circle" aria-hidden="true"></i> 답변완료' : '<i class="fa fa-times-circle" aria-hidden="true"></i> 답변대기'); ?></span></td>
            </tr>
            <?php
            }
            ?>
            </tbody>
            </table>
        </div>
    </section>
    <?php } ?>
</article>
<!-- } 게시판 읽기 끝 -->

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});
</script>