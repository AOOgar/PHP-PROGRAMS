<div class="form-area">
            <form method="POST" action="">

                <div class="group">
                   <h2 class="form-heading">Reset Password</h2>
                </div><!--  close group div-->

          
                <div class="group">
                    <input type="email" name="email" class="control" placeholder="Your email here....">
                </div><!--  close group div-->

            <div class="group">
                <input type="submit" name="login" class="btn account-btn" value="User Login">
            </div><!--  close group div-->
			
           <div class="group">
                    <a href="index.php" class="link">Back to login page</a>
            </div><!--  close group div-->
            
            <input type="hidden" class="hide" name="token" id="token" value="<?php echo token_generator();?>">
            </form><!--  close form -->

        </div> <!--  close form-area div-->