document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('date').addEventListener('change', function () {
        const date = this.value;
        const consultantID = document.getElementById('consultantID').value;

        if (date && consultantID) {
            console.log("تاریخ انتخاب شده:", date);
            console.log("آیدی مشاور:", consultantID);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '<?= url("reservation/check") ?>', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log('پاسخ سرور:', xhr.responseText);

                    // پس از پاسخ موفق از سرور، صفحه را رفرش کن
                    location.reload();
                }
            };

            xhr.send('date=' + encodeURIComponent(date) + '&consultantID=' + encodeURIComponent(consultantID));
        }
    });
});