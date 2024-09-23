<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 6;

if ($is_checkbox) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$qa_skin_url.'/style.css">', 0);
?>

<div id="bo_list">
	<?php if ($category_option) { ?>
    <!-- 카테고리 시작 { -->
    <nav id="bo_cate">
        <h2><?php echo $qaconfig['qa_title'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <!-- } 카테고리 끝 -->
    <?php } ?>

	<!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div id="bo_btn_top" class="mt-3 mx-0 text-sm">
        <div id="bo_list_total" class="float-left leading-10 text-gray-700">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div>

		 <?php if ($admin_href || $write_href) { ?>
        <ul class="btn_bo_user float-right m-0 p-0">
        	<?php if ($admin_href) { ?>
        	<li class="relative float-left w-10 text-center ml-2 bg-white"><a href="<?php echo $admin_href ?>" class="btn_admin btn inline-block text-indigo-400 underline-none align-middle leading-10 py-0 px-3 text-center font-semibold border-0 text-lg  transition duration-300 transition-color ease-out" title="관리자"><i class="fa fa-cog fa-spin fa-fw"></i><span class="sr-only inline-block absolute top-0 left-0 w-0 h-0 m-0 p-0 fs-0 lh-0 border-0 overflow-hidden">관리자</span></a>
        	</li>
        	<?php } ?>
        	<li class="relative float-left w-10 text-center ml-2 bg-white">
        		<button type="button" class="btn_bo_sch btn_b01 btn inline-block text-gray-400 align-middle border-0 bg-transparent leading-10 py-0 px-3 text-center font-semibold border-0 text-lg transition duration-300 transition-color ease-out" title="게시판 검색"><i class="fa fa-search" aria-hidden="true"></i><span class="sr-only inline-block absolute top-0 left-0 w-0 h-0 m-0 p-0 fs-0 lh-0 border-0 overflow-hidden">게시판 검색</span>
        		</button>
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
			    <script>
					// 게시판 검색
					$(".btn_bo_sch").on("click", function() {
					    $(".bo_sch_wrap").toggle();
					})
					$('.bo_sch_bg, .bo_sch_cls').click(function(){
					    $('.bo_sch_wrap').hide();
					});
				</script>
			    <!-- } 게시판 검색 끝 -->
             <?php if ($write_href) { ?><li class="relative float-left w-10 text-center ml-2 bg-white"><a href="<?php echo $write_href ?>" class="btn_b01 btn inline-block text-gray-400 align-middle border-0 bg-transparent leading-10 py-0 px-3 text-center font-semibold border-0 text-lg transition duration-300 transition-color ease-out" title="문의등록"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sr-only inline-block absolute top-0 left-0 w-0 h-0 m-0 p-0 fs-0 lh-0 border-0 overflow-hidden">문의등록</span></a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->

    <form name="fqalist" id="fqalist" action="./qadelete.php" onsubmit="return fqalist_submit(this);" method="post">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="<?php echo get_text($token); ?>">

    <div class="tbl_head01 tbl_wrap">
        <table class="table-auto w-full">
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <thead>
        <tr class="border-t border-b">
            <?php if ($is_checkbox) { ?>
            <th scope="col" class="all_chk chk_box">
                <div class="flex items-center justify-center">
					<div class="bg-white border rounded border-gray-400 w-4 h-4 flex flex-shrink-0 justify-center items-center focus-within:border-indigo-500">
						<input type="checkbox" id="chkall" class="opacity-0 absolute  checked:bg-indigo-500" onclick="if (this.checked) all_checked(true); else all_checked(false);">
						<svg class="fill-current hidden w-4 h-4 text-indigo-500 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
					</div>
					<div class="select-none"><b class="sr-only">현재 페이지 게시물  전체선택</b></div>
				</div>
            </th>
            <?php } ?>
            <th scope="col" class="show-cell py-3 text-center">번호</th>
            <th scope="col" class="py-3 text-center">제목</th>
            <th scope="col" class="show-cell py-3 text-center">글쓴이</th>
            <th scope="col" class="show-cell py-3 text-center">등록일</th>
            <th scope="col" class="show-cell py-3 text-center">상태</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $i<count($list); $i++) {
        	if ($i%2==0) $lt_class = "even";
        	else $lt_class = "";
        ?>
        <tr class="<?php echo $lt_class ?> border-b">
            <?php if ($is_checkbox) { ?>
            <td class="td_chk chk_box py-3 px-3">
	            <label class="flex justify-center items-center">
					<div class="bg-white border rounded border-gray-400 w-4 h-4 flex flex-shrink-0 justify-center items-center focus-within:border-indigo-500">
						<input type="checkbox" class="opacity-0 absolute" name="chk_qa_id[]" value="<?php echo $list[$i]['qa_id'] ?>" id="chk_qa_id_<?php echo $i ?>" class="select_chk">
						<svg class="fill-current hidden w-3 h-3 text-indigo-500 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
					</div>
					<b class="sr-only"><?php echo $list[$i]['subject'] ?></b>
				</label>
            </td>
            <?php } ?>
            <td class="td_num show-cell py-3 text-center"><?php echo $list[$i]['num']; ?></td>
            <td class="td_subject py-3">
                <span class="bo_cate_link float-left inline-block mr-3 bg-indigo-100 text-indigo-500 font-normal py-0.5 px-1.5 rounded text-base ml-2"><?php echo $list[$i]['category']; ?></span>
                <a href="<?php echo $list[$i]['view_href']; ?>" class="bo_tit font-normal">
                    <?php echo $list[$i]['subject']; ?>
                    <?php if ($list[$i]['icon_file']) echo " <i class=\"fa fa-download\" aria-hidden=\"true\"></i>" ; ?>
                </a>
                <div class="show-row-one flex justify-between font-normal mt-3">
                    <div class="text-sm">
	                    <?php echo $list[$i]['date']; ?>
		            		<span class="pl-2"><?php echo $list[$i]['name'] ?></span>
                    </div>
                    <div>
						<span class="text-sm py-1 px-2 rounded <?php echo ($list[$i]['qa_status'] ? 'bg-indigo-200' : 'bg-gray-200'); ?>"><?php echo ($list[$i]['qa_status'] ? '답변완료' : '답변대기'); ?></span>
                    </div>
		        </div>
            </td>
            <td class="td_name show-cell py-3 text-center"><?php echo $list[$i]['name']; ?></td>
            <td class="td_date show-cell py-3 text-center"><?php echo $list[$i]['date']; ?></td>
            <td class="td_stat show-cell py-3 text-center"><span class="py-1 px-2 rounded <?php echo ($list[$i]['qa_status'] ? 'bg-indigo-200' : 'bg-gray-200'); ?>"><?php echo ($list[$i]['qa_status'] ? '답변완료' : '답변대기'); ?></span></td>
        </tr>
        <?php
        }
        ?>

        <?php if ($i == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </div>
	<!-- 페이지 -->
	<?php echo $list_pages; ?>
	<!-- 페이지 -->

     <div class="bo_fx mb-2 float-right">
        <ul class="btn_bo_user m-0 p-0">
        	<?php if ($is_checkbox) { ?>
            <li class="relative float-left w-10 text-center ml-2 bg-white"><button type="submit" name="btn_submit" value="선택삭제" title="선택삭제" onclick="document.pressed=this.value" class="btn btn_b01 btn_admin inline-block text-red-400 align-middle leading-10 py-0 px-3 text-center font-semibold border-0 text-lg transition duration-300 transition-color ease-out"><i class="fa fa-trash-o" aria-hidden="true"></i><span class="sound_only">선택삭제</span></button></li>
            <?php } ?>
            <?php if ($list_href) { ?><li class="relative float-left w-10 text-center ml-2 bg-white"><a href="<?php echo $list_href ?>" class="btn_b01 btn inline-block text-gray-400 align-middle leading-10 py-0 px-3 text-center font-semibold border-0 text-lg transition duration-300 transition-color ease-out" title="목록"><i class="fa fa-list" aria-hidden="true"></i><span class="sound_only">목록</span></a></li><?php } ?>
            <?php if ($write_href) { ?><li class="relative float-left w-10 text-center ml-2 bg-white"><a href="<?php echo $write_href ?>" class="btn_b01 btn inline-block text-gray-400 align-middle leading-10 py-0 px-3 text-center font-semibold border-0 text-lg transition duration-300 transition-color ease-out" title="문의등록"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sound_only">문의등록</span></a></li><?php } ?>
        </ul>
    </div>
    </form>
</div>

<div class="clear-both"></div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fqalist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_qa_id[]")
            f.elements[i].checked = sw;
    }
}

function fqalist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_qa_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다"))
            return false;
    }

    return true;
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->