<?php
if (!defined('_INDEX_')) define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH . '/head.php');
?>

</div>
<!-- Container End -->

<h2 class="sr-only">메인 페이지</h2>

<!-- Slick(Slider) -->
<section id="slider" class="mx-auto w-full">
  <div class="slider">
    <div><img src="<?php echo G5_THEME_URL ?>/img/slick/coffee1.jpg" title="Funky roots" class="w-full v-center"></div>
    <div><img src="<?php echo G5_THEME_URL ?>/img/slick/coffee2.jpg" title="The long and winding road" class="w-full v-center"></div>
    <div><img src="<?php echo G5_THEME_URL ?>/img/slick/coffee3.jpg" title="Happy trees" class="w-full v-center"></div>
  </div>
</section>

<!-- 이 함수가 바로 최신글을 추출하는 역할을 합니다. -->
<!-- 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수); -->
<!-- 	테마의 스킨을 사용하려면 theme/basic 과 같이 지정 -->
<section class="latest_wr mt-12">
  <div class="container mx-auto sm: px-4 text-white relative">
    <h2 class="sound_only">최신글</h2>
    <div class="latest_top_wr grid grid-cols-1 md:grid-cols-2 gap-4 text-black">
      <div>
        <?php echo latest('theme/tail_basic', 'basic', 4, 23);  ?>
      </div>
      <div>
        <?php echo latest('theme/tail_basic', 'qa', 4, 23); ?>
      </div>
    </div>

    <div class="latest_top_wr grid grid-cols-1 md:grid-cols-2 gap-4 text-black">
      <div>
        <?php echo latest('theme/tail_notice', 'basic', 4, 23); ?>
      </div>
      <div>
        <?php echo latest('theme/tail_notice', 'notice', 4, 23); ?>
      </div>
    </div>

    <div class="latest_top_wr grid grid-cols-1 md:grid-cols-2 gap-4 text-black">
      <div>
        <?php echo latest('theme/tail_pic_block', 'gallery', 4, 23); ?>
      </div>
      <div>
        <?php echo latest('theme/tail_pic_block', 'gallery', 4, 23); ?>
      </div>
    </div>

    <div class="latest_top_wr grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 text-black mb-6">
      <div>
        <?php echo latest('theme/tail_pic_list', 'gallery', 3, 23); ?>
      </div>
      <div>
        <?php echo latest('theme/tail_pic_list', 'gallery', 3, 23); ?>
      </div>
      <div>
        <?php echo latest('theme/tail_basic', 'free', 6, 23);  ?>
      </div>
      <div>
        <?php echo latest('theme/tail_basic', 'qa', 6, 23); ?>
      </div>
    </div>
  </div>
</section>

<?php
include_once(G5_THEME_PATH . '/tail.php');
