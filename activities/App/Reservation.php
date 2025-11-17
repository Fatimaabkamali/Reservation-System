<?php
namespace App;
use database\DataBase;

class Reservation 
{
    protected function redirect($url)
    {
        header('Location: ' . trim(CURRENT_DOMAIN, '/ ') . '/' . trim($url, '/ '));
        exit;
    }

    protected function redirectBack()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // نمایش فرم بررسی زمان‌ها
    public function index($id)
    {
        require_once(BASE_PATH . '/template/app/reservationcheck.php');
    }

    // بررسی تایم‌های رزرو نشده
    public function check($request)
    {
        $db = new DataBase();
        $consultantID = $request['consultantID'] ?? null;
        $date = $request['date'] ?? null;

        if (!$consultantID || !$date) {
            return ['error' => 'شناسه مشاور و تاریخ الزامی هستند'];
        }

        // همه تایم‌ها
        $allHours = $db->select('SELECT id, time FROM hours')->fetchAll();

        // تایم‌های رزرو شده
        $bookedHoursRaw = $db->select(
            'SELECT hour_id FROM appointments WHERE consultantID = ? AND date = ? AND status = "reserved"',
            [$consultantID, $date]
        )->fetchAll();

        $bookedHourIDs = array_column($bookedHoursRaw, 'hour_id');

        // فیلتر تایم‌های آزاد
        $availableHours = array_filter($allHours, function ($hour) use ($bookedHourIDs) {
            return !in_array($hour['id'], $bookedHourIDs);
        });

        return [
            'success' => true,
            'bookedHours' => $bookedHourIDs,
            'availableHours' => array_values($availableHours),
        ];
    }

   public function showAvailableTimes($request)
{
    $result = $this->check($request);

    if (isset($result['error'])) {
        flash('reserved_error', $result['error']);
        $this->redirectBack();
    }

    // آماده‌سازی متغیرها برای view
    $availableHours = $result['availableHours'];
    $bookedHours = $result['bookedHours'];
    $id = $request['consultantID']; // تغییر برای هماهنگی با view فعلی
    $date = $request['date'];
    

    require_once(BASE_PATH . '/template/app/reservationcreate.php');
}


    // ایجاد رزرو
    public function create($request)
    {
        $db = new DataBase();

        $requiredFields = ['userID', 'consultantID', 'date', 'hour_id'];
        foreach ($requiredFields as $field) {
            if (empty($request[$field])) {
                flash('reserved_error', 'تمامی فیلدها الزامی هستند');
                $this->redirectBack();
            }
        }

        // بررسی فرمت تاریخ
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $request['date'])) {
            flash('reserved_error', 'فرمت تاریخ نامعتبر است');
            $this->redirectBack();
        }

        // بررسی تایم آزاد بودن
        $checkResult = $this->check([
            'consultantID' => $request['consultantID'],
            'date' => $request['date']
        ]);

        if (isset($checkResult['error'])) {
            flash('reserved_error', $checkResult['error']);
            $this->redirectBack();
        }

        $availableHourIDs = array_column($checkResult['availableHours'], 'id');
        if (!in_array($request['hour_id'], $availableHourIDs)) {
            flash('reserved_error', 'تایم انتخاب‌شده در دسترس نیست');
            $this->redirectBack();
        }

        try {
         

       
            // درج رزرو
            $db->insert('appointments',array_keys($request), $request);

          
            flash('success', 'رزرو با موفقیت انجام شد');
            $this->redirect('home');
        } catch (\Exception $e) {
            $db->rollBack();
            flash('reserved_error', 'خطا در ثبت رزرو: ' . $e->getMessage());
            $this->redirectBack();
        }
    }
}
