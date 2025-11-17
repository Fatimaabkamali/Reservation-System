<?php require_once('template/app/layouts/header.php'); ?>

<!-- Contact Us Section Start -->
<section class="contact_page_section" dir="rtl">
    <div class="container">
        <div class="contact_inner">
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

                <?php if (empty($availableHours)): ?>
                    <p class="alert alert-warning">هیچ تایم آزادی برای این تاریخ در دسترس نیست.</p>
                <?php else: ?>
                    <form action="<?= url('reservation/create') ?>" method="POST" id="reservationForm">
                        <input type="hidden" name="consultantID" id="consultantID" value="<?= isset($id) ? htmlspecialchars($id) : '' ?>">
                        <input type="hidden" name="date" id="date" value="<?= isset($date) ? htmlspecialchars($date) : '' ?>">
                        <input type="hidden" name="userID" id="userID" value="<?= isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']) : '' ?>">

                        <div class="form-group">
                            <label for="hour_id">ساعت جلسه</label>
                            <select class="form-control" name="hour_id" id="hour_id" required>
                                <option value="">یک ساعت انتخاب کنید</option>
                                <?php foreach ($availableHours as $hour): ?>
                                    <option value="<?= $hour['id'] ?>"><?= htmlspecialchars($hour['time']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">توضیحات (اختیاری)</label>
                            <textarea name="description" id="description" class="form-control" placeholder="موضوع جلسه یا سوالات شما..."></textarea>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn puprple_btn">رزرو جلسه</button>
                        </div>
                    </form>

                    
                   
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- Contact Us Section End -->

<?php require_once(BASE_PATH . '/template/app/layouts/footer.php'); ?>
 <script>
                        document.getElementById('reservationForm').addEventListener('submit', function(e) {
                            const hourId = document.getElementById('hour_id').value;
                            if (!hourId) {
                                e.preventDefault();
                                alert('لطفاً یک ساعت انتخاب کنید.');
                            }
                        });
                    </script>