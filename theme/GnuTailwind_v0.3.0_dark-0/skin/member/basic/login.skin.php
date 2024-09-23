<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 로그인 시작 { -->
<div id="sign_in" class="bg-no-repeat bg-cover bg-center relative" style="background-image: url(<?php echo G5_THEME_URL ?>/skin/member/basic/img/bg_login.jpg);">
	<div class="absolute bg-gradient-to-b from-indigo-500 to-indigo-400 opacity-75 inset-0 z-0"></div>
	<div class="min-h-screen sm:flex sm:flex-row mx-0 justify-center">
		<div class="flex justify-center self-center  z-10">
			<div class="p-12 bg-white mx-auto rounded-2xl w-100 relative">
				<h1><?php echo $g5['title'] ?></h1>
				<div class="text-center">
					<h2><span class="sr-only">회원</span>로그인</h2>
				</div>

				<div class="space-y-5">
					<form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
						<input type="hidden" name="url" value="<?php echo $login_url ?>">

						<div class="mt-4 space-y-2">
							<legend class="sr-only">회원로그인</legend>
							<label class="text-sm font-medium text-gray-700 tracking-wide">
								회원아이디<strong class="sr-only"> 필수</strong></label>
							<input class=" w-full text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-indigo-400" type="text" name="mb_id" id="login_id" required maxLength="20" placeholder="아이디">
						</div>

						<div class="mt-4 space-y-2">
							<label class="mb-5 text-sm font-medium text-gray-700 tracking-wide">
								비밀번호<strong class="sr-only"> 필수</strong>
							</label>
							<input class="w-full content-center text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-indigo-400" type="password" name="mb_password" id="login_pw" required maxLength="20" placeholder="비밀번호">
						</div>
						<div class="mt-4 flex items-center">
							<div class="flex items-center">
								<input name="auto_login" id="login_auto_login" type="checkbox" class="h-4 w-4 bg-blue-500 focus:ring-blue-400 border-gray-300 rounded">
								<label for="remember_me" class="ml-2 block text-sm text-gray-800">
									자동로그인
								</label>
							</div>
						</div>
						<div class="mt-8">
							<button type="submit" class="w-full flex justify-center bg-indigo-400  hover:bg-indigo-500 text-gray-100 p-3  rounded-full tracking-wide font-semibold  shadow-lg cursor-pointer transition ease-in duration-500">
								로그인
							</button>
						</div>
						<div class="mt-8 flex items-center justify-between">
							<div class="flex items-center">
								<a href="<?php echo G5_BBS_URL ?>/register.php" class="text-indigo-400 hover:text-indigo-500">회원가입</a>
							</div>
							<div class="text-sm">
								<a href="<?php echo G5_BBS_URL ?>/password_lost.php" target="_blank" class="text-indigo-400 hover:text-indigo-500">
									정보찾기
								</a>
							</div>
						</div>
					</form>
				</div>
				<?php @include_once(get_social_skin_path().'/social_login.skin.php'); // 소셜로그인 사용시 소셜로그인 버튼 ?>
				<div class="pt-5 text-center text-gray-400 text-xs">
					<span>
						Copyright © 2024
						<a href="<?php echo G5_URL ?>/" rel="" target="_top" title="Ajimon" class="text-green hover:text-indigo-500 ">산업마켓(주)</a>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
jQuery(function($){
    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        }
    });
});

function flogin_submit(f)
{
    if( $( document.body ).triggerHandler( 'login_sumit', [f, 'flogin'] ) !== false ){
        return true;
    }
    return false;
}
</script>
<!-- } 로그인 끝 -->
