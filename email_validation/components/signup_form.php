 <div class="form-area">
            <form id="register-form" method="post">

                <div class="group">
                   <h2 class="form-heading">Create new account</h2>
                </div><!--  close group div-->

                <div class="group">
                    <input type="text" name="first_name" id="first_name" class="control" placeholder="First name here...." value="">
                    <div class = "name-error error">
                        <?php //if (isset($name_error)):?>
                           <?php // echo $use_error;?>
                       <?php //endif;?>
                    </div><!--  close name-error div-->
                </div><!--  close group div-->

                <div class="group">
                    <input type="text" name="last_name" id="last_name" class="control" placeholder="Last name here...." value="">
                    <div class = "name-error error">
                        <?php //if (isset($name_error)):?>
                           <?php // echo $name_error;?>
                       <?php //endif;?>
                    </div><!--  close name-error div-->
                </div><!--  close group div-->

                <div class="group">
                    <input type="email" name="email" id="email" class="control" placeholder="Your email here...." value="">
                 <div class = "name-error error">
                    
					
                   </div><!--  close name-error div-->
                </div><!--  close group div-->


                <div class="group">
                    <input type="text" name="username" id="username" class="control" placeholder="Username here...." value="">
                    <div class = "name-error error">
                        <?php //if (isset($name_error)):?>
                           <?php // echo $name_error;?>
                       <?php //endif;?>
                    </div><!--  close name-error div-->
                </div><!--  close group div-->


                <div class="group">
                     <input type="password" name="password" id="password" class="control" placeholder="Your password here...." value="">
                    <div class = "name-error error">
                    
                   </div><!--  close name-error div-->
                </div><!--  close group div-->

                <div class="group">
                     <input type="password" name="confirm_password" id="confirm_password" class="control" placeholder="Confirm password here...." value="">
                    <div class = "name-error error">
                    
                   </div><!--  close name-error div-->
                </div><!--  close group div-->



            <div class="group">
                <input type="submit" ame="register-submit" id="register-submit" class="btn account-btn" value="Create account">
            </div><!--  close group div-->

            <div class="group">
                    <a href="index.php" class="link">Already have an account?</a>
            </div><!--  close group div-->
			
			  


            
            </form>

        </div> <!--  close form-area div-->