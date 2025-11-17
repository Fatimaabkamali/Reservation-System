<?php require_once('template/app/layouts/header.php'); ?>

<!-- Contact Us Section Start -->
<section class="contact_page_section">
    <div class="container">
        <div class="contact_inner" style="margin-bottom: 50px;">
            <div class="contact_form">
                <div class="section_title">
                    <p>فرم زیر را برای درخواست مشاوره پر کنید</p>
                </div>

                <!-- نمایش پیام‌های فلش -->
                <?php
                $reserved_error = flash('reserved_error');
                $success = flash('success');
                if (!empty($reserved_error)): ?>
                    <div class="mb-2 alert alert-danger">
                        <small class="form-text text-danger"><?= htmlspecialchars($reserved_error) ?></small>
                    </div>
                <?php endif; ?>
                <?php if (!empty($success)): ?>
                    <div class="mb-2 alert alert-success">
                        <small class="form-text text-success"><?= htmlspecialchars($success) ?></small>
                    </div>
                <?php endif; ?>

                <form action="<?= url('reservation/show') ?>" method="POST">
                   <input type="hidden" name="consultantID"  id="consultantID" value="<?= $id ?>">
                     <input type="hidden" name="userID" id="userID" value="<?= $_SESSION['user'] ?>">

                    <div class="form-group">
                        <label for="date">تاریخ جلسه</label>
                        <input type="date" id="date" name="date" class="form-control" required>
                    </div>

                  
                    <div class="form-group mb-0">
                        <button type="submit" class="btn puprple_btn">رزرو جلسه</button>
                    </div>
                </form>
            </div>
           
        </div>
    </div>
</section>
<!-- Contact Us Section End -->

<?php require_once(BASE_PATH . '/template/app/layouts/footer.php'); ?>