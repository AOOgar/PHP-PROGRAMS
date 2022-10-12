<div class="form-area">
            <form method="POST" action="">

                <div class="group">
                   <h2 class="form-heading">Reset Password</h2>
                </div><!--  close group div-->

          
                <div class="group">
                    <input type="password" name="password" id="password" class="control" placeholder="Your new password here....">
                </div><!--  close group div-->
				
				<div class="group">
                    <input type="password" name="confirm_password" id="confirm_password" class="control" placeholder="Retype your new password....">
                </div><!--  close group div-->

            <div class="group">
                <input type="submit" name="reset-password-submit" id="reset-password-submit" class="btn account-btn" value="User Login">
            </div><!--  close group div-->
			
            
            <input type="hidden" class="hide" name="token" id="token" value="<?php echo token_generator();?>">
            </form><!--  close form -->

        </div> <!--  close form-area div-->