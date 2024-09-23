<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
  include_once(G5_THEME_MOBILE_PATH . '/tail.php');
  return;
}
?>

<!-- 	</div> -->
<?php
/*
	<div id="aside">
        <?php echo outlogin('theme/basic'); // 외부 로그인, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>
        <?php echo poll('theme/basic'); // 설문조사, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>
    </div>
    */
?>

</div>
<!-- } 콘텐츠 끝 -->

<!-- 하단 시작 { -->
<div id="footer" class="w-full bg-gray-500 text-white">
  <div class="xl:px-40 pb-12 lg:px-20 md:px-10 sm:px-5 px-10">
    <div class="w-full pt-12 flex flex-col sm:flex-row space-y-2  justify-start">
      <div class="w-full sm:w-2/5 pr-6 flex flex-col space-y-4">
        <img src="<?php echo G5_THEME_IMG_URL ?>/ft_logo.png" class="w-1/3">
        <p class="opacity-60">인천 연수구 능허대로 179번길 1(옥련동)<br>청아빌딩 2층 (우 21946)</p>
      </div>
      <div class="w-full sm:w-1/5 flex-1 sm:flex flex-col space-y-4">
        <a href="/" class="opacity-60 w-1/2 inline-flex">Home</a>
        <a href="<?php echo G5_URL ?>/#transactions" class="opacity-60 w-1/2">서비스 소개</a>
        <a href="<?php echo G5_URL ?>/#about" class="opacity-60 w-1/2 inline-flex">이용 안내</a>
        <a href="<?php echo G5_URL ?>/#new-idea" class="opacity-60 w-1/2">다운로드</a>
      </div>
      <div class="w-full sm:w-1/5 flex-1 sm:flex flex-col space-y-4">
        <a href="<?php echo G5_URL ?>/notice" class="opacity-60 w-1/2 sm:w-full inline-flex mt-2 sm:mt-0">공지사항</a>
        <a href="<?php echo G5_URL ?>/webzine" class="opacity-60 w-1/2 sm:w-full">Webzine</a>
        <a href="<?php echo G5_URL ?>/qa" class="opacity-60 w-1/2 sm:w-full inline-flex">온라인 문의</a>
        <!-- <a href="#testimonials" class="opacity-60 w-1/2 sm:w-full inline-flex">광고 안내</a> -->
        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=privacy" class="opacity-60 w-1/2 sm:w-full">개인정보보호정책</a>
        <!-- <a href="#" class="opacity-60 w-1/2 sm:w-full">개인정보보호정책</a> -->
      </div>
      <div class="w-full sm:w-1/5 pt-6 flex items-end mb-1">
        <div class="flex flex-row space-x-4">
          <i class="bi bi-facebook"></i>
          <i class="bi bi-twitter"></i>
          <i class="bi bi-instagram"></i>
          <i class="bi bi-google"></i>
        </div>
      </div>
    </div>
    <div class="opacity-60 pt-2">
      <p>© 1992 프로그룹</p>
    </div>
  </div>
</div>

<a href="#" class="back-to-top flex items-center justify-center bg-gray-700 hover:bg-gray-800 fixed invisible opacity-0 right-4 bottom-4 z-50 w-10 h-10 rounded-md transition duration-400"><i class="bi bi-arrow-up-short text-3xl text-white leading-0"></i></a>

<script>
  $(function() {
    $(".back-to-top").on("click", function() {
      $("html, body").animate({
        scrollTop: 0
      }, '500');
      return false;
    });
  });
</script>

<script>
  const btn = document.querySelector("#theme-toggle");
  const currentTheme = localStorage.getItem("theme");

  if (currentTheme == "dark") {
    document.body.classList.add("dark");
    btn.classList.remove('bi-moon')
    btn.classList.add('bi-sun')
  } else {
    btn.classList.remove('bi-sun')
    btn.classList.add('bi-moon')
  }

  btn.addEventListener("click", function() {
    document.body.classList.toggle("dark");

    let theme = "light";
    if (document.body.classList.contains("dark")) {
      theme = "dark";
      btn.classList.remove('bi-moon')
      btn.classList.add('bi-sun')
    } else {
      btn.classList.remove('bi-sun')
      btn.classList.add('bi-moon')
    }
    localStorage.setItem("theme", theme);
  });
</script>

<?php
if (G5_DEVICE_BUTTON_DISPLAY && !G5_IS_MOBILE) { ?>
<?php
}

if ($config['cf_analytics']) {
  echo $config['cf_analytics'];
}
?>

<!-- } 하단 끝 -->
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="<?php echo G5_THEME_URL ?>/assets/swiper/swiper-bundle.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script src="<?php echo G5_THEME_URL ?>/assets/theme.js"></script>

<!-- Initialize AOS -->
<script>
  AOS.init();
</script>

<!-- Initialize Slick -->
<script>
  $(".slider").slick({
    autoplay: true,
    dots: true,
    arrows: true,
    fade: true,
  });
</script>

<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".testimonials-slider", {
    speed: 600,
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false
    },
    slidesPerView: 'auto',
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    }
  });
</script>

<script>
  $(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
  });
</script>

<?php
include_once(G5_THEME_PATH . "/tail.sub.php");
