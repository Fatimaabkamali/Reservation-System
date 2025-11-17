<?php require_once('template/app/layouts/header.php'); ?>

<section class="row_am app_solution_section">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="app_text">
          <div class="section_title" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
            <h2><span>معرفی مشاوران ما</span></h2>
          </div>
          <p data-aos="fade-up" data-aos-duration="1500">
            در سامانه‌ی رزرو جلسه با مشاور، مجموعه‌ای از متخصصان مجرب و متعهد در کنار شما هستند تا در مسیر رشد فردی، تحصیلی، شغلی و روانی، راهنمایی‌های دقیق و کاربردی ارائه دهند.
          </p>
          <p data-aos="fade-up" data-aos-duration="1500">
            مشاوران ما از میان افرادی انتخاب شده‌اند که:<br>
            دارای تحصیلات دانشگاهی مرتبط در حوزه‌های روانشناسی، مشاوره، توسعه فردی یا منابع انسانی هستند،<br>
            سابقه‌ی چندین سال فعالیت حرفه‌ای در حوزه‌ی مشاوره دارند،<br>
            و با رویکردی علمی، اخلاق‌مدار و کاربرمحور، پاسخ‌گوی نیازهای شما خواهند بود.
          </p>
          <p data-aos="fade-up" data-aos-duration="1500">
            ✅ رزومه‌ی هر مشاور را مشاهده کنید،<br>
            ✅ زمان‌های آزاد او را بررسی نمایید،<br>
            ✅ و به‌سادگی جلسه‌ی مشاوره‌ی موردنظر خود را رزرو کنید.
          </p>
          <p data-aos="fade-up" data-aos-duration="1500">
            با انتخاب مشاور مناسب، یک قدم به تصمیم‌گیری آگاهانه‌تر و زندگی متعادل‌تر نزدیک‌تر شوید.
          </p>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="app_images" data-aos="fade-in" data-aos-duration="1500">
          <ul>
            <li><img src="<?= asset('public/app/images/abt_01.png') ?>" alt=""></li>
            <li><img src="<?= asset('public/app/images/abt_02.png') ?>" alt=""></li>
            <li><img src="<?= asset('public/app/images/abt_03.png') ?>" alt=""></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="row_am experts_team_section">
  <div class="container">
    <div class="section_title" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
      <h2>آشنایی با <span>مشاوران ما</span></h2>
      <p>در این بخش می‌توانید با مشاوران متخصص و باتجربه‌ی ما آشنا شوید.<br>هر مشاور آماده است تا با دانش و تجربه‌ی خود، در مسیر رشد فردی، تحصیلی یا شغلی همراه شما باشد.</p>
    </div>
    <div class="row">

      <?php foreach ($consultants as $consultant): ?>
        
        <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
          <div class="experts_box">
            <img src="<?= asset($consultant['img']) ?>" alt="مشاور" style="border-radius:250px;">
            <div class="text">
              <h3><?= htmlspecialchars($consultant['name']) ?></h3>
              <ul class="social_media">
                <li><a href="<?= url('reservation/' . $consultant['id']) ?>">درخواست مشاوره</a>
</li>
              </ul>
            </div>
          </div>
        </div>
     
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require_once(BASE_PATH . '/template/app/layouts/footer.php'); ?>
