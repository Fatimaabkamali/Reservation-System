<?php

        require_once(BASE_PATH . '/template/auth/layouts/header.php');


?>

          <!-- Comment Form Section -->
          <div class="signup_form">
            <form action="#">
              <div class="form-group">
                <input type="text" name="mobile" id="myInput" class="form-control" placeholder="شماره موبایل" >
              </div>
              <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="تایید شماره موبایل">
              </div>
              <div class="form-group">
                <input type="password" name="password"  class="form-control" placeholder="رمز عبور">
              </div>
              <div class="form-group">
                <input type="password" name="password"  class="form-control" placeholder="تایید رمز عبور">
              </div>
              <div class="form-group">
                <button class="btn puprple_btn" type="submit">ورود</button>
              </div>
            </form>
            
          </div>
         </section>
      </div>
      
    </div>


    <?php
    

require_once(BASE_PATH . '/template/auth/layouts/footer.php');


?>


 