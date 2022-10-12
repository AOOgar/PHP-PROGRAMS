
<div class="form-area">
            <form method="POST" action="">

                <div class="group">
                   <h2 class="form-heading">
                    <?php if(logged_in()) {
                        echo "Welcome to admin page";
                    }
                    else{
                        redirect("index.php");
                    }

                    ?></h2>
                </div><!--  close group div-->


			
           <a href="logout.php" class="reset">Logout</a>
            
            </form><!--  close form -->

        </div> <!--  close form-area div-->