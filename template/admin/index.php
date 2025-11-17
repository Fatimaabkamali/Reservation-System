<?php

        require_once(BASE_PATH . '/template/admin/layouts/header.php');


?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
   
    <div class="btn-toolbar mb-2 mb-md-0">
      
        </div>
    </div>
    <div class="table-responsive ">
        <table class="table table-striped table-sm ">
           
            <thead>
                <tr>
                    <th>ردیف</th>
                    <th>تاریخ</th>
                    <th>نام مشاور</th>
                    <th>نام کاریر</th>
                    <th>ساعت</th>
                    <th>وضعیت مشاوره</th>
                    
                </tr>
            </thead>
            <tbody>
            <?php
             $counter = 1;
             foreach ($reservs as $reserv) { ?>
                <tr>
                    <td>
                       <?= $counter ?>
                    </td>
                    <td><?= $reserv['date'] ?></td>
                    <td>
                        <?= isset($users[$reserv['consultantID']]) ? $users[$reserv['consultantID']] : '-' ?>
                    </td>
                    <td>
                        <?= isset($users[$reserv['userID']]) ? $users[$reserv['userID']] : '-' ?>
                    </td>
                    <td>
                        <?= isset($hours[$reserv['hour_id']]) ? $hours[$reserv['hour_id']] : '-' ?>
                    </td>
                    <td>
                        <?php if ($reserv['status'] == 'reserved') { ?>
                             <a role="button" class="btn btn btn-success text-white" href="<?= url('active/' . $reserv['id']) ?>">رزرو</a>
                        <?php } elseif ($reserv['status'] == 'canceled') { ?>
                              <a role="button" class="btn btn btn-danger text-white" href="<?= url('active/' . $reserv['id']) ?>">کنسل</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php 
                    $counter++;
                } 
            ?>
            </tbody>

                </table>
        </div>




<?php

require_once(BASE_PATH . '/template/admin/layouts/footer.php');


?>