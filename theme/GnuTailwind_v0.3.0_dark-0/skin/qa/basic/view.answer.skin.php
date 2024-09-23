<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<section id="bo_v_ans" class="border mb-4">
    <h2 class=" p-4 pb-2">
	    <span class="bo_v_reply py-0.5 px-1.5 bg-indigo-100 rounded-lg text-indigo-500 mr-2">답변</span>
	    <span class="font-semibold"><?php echo get_text($answer['qa_subject']); ?>
	</h2>
    <header class="flex justify-between text-gray-500 border-b pb-4 px-4">
	    <div id="ans_datetime">
	        <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $answer['qa_datetime']; ?>
	    </div>

        <?php if ( $answer_update_href || $answer_delete_href ){ ?>
	    <div id="ans_add" class="relative">
	    	<button type="button" class="btn_more_add btn_more_opt btn_b01 btn w-full text-right" title="답변 옵션"><i class="fa fa-ellipsis-v" aria-hidden="true"></i><span class="sr-only">답변 옵션</span></button>
			<ul class="more_add hidden absolute right-0 top-8 w-20 text-right border m-0 bg-white z-9999">
				<?php if($answer_update_href) { ?>
				<li class="border-t border-b"><a href="<?php echo $answer_update_href; ?>" class="btn_b01 btn inline-block py-2 px-1 text-gray-700 w-full text-center" title="답변수정">답변수정</a></li>
				<?php } ?>
				<?php if($answer_delete_href) { ?>
				<li class="border-b"><a href="<?php echo $answer_delete_href; ?>" class="btn_b01 btn inline-block py-2 px-1 text-gray-700 w-full text-center" onclick="del(this.href); return false;" title="답변삭제">답변삭제</a></li>
				<?php } ?>
			</ul>
			<script>
				// 답변하기 옵션
				$(".btn_more_add").on("click", function() {
				    $(".more_add").toggle();
				})
			</script>
	    </div>
        <?php } ?>
	</header>

    <div id="ans_con" class="p-4">
        <?php echo get_view_thumbnail(conv_content($answer['qa_content'], $answer['qa_html']), $qaconfig['qa_image_width']); ?>
    </div>
</section>

<div class="bo_v_btn text-center">
	<a href="<?php echo $rewrite_href; ?>" class="add_qa leading-8 h-8 py-2 px-3 text-center font-normal border-0 text-base transition transition-colors duration-300 ease-out text-white bg-indigo-500 hover:bg-indigo-600 rounded" title="추가질문">추가질문</a>
</div>
