<div class="col login">

    <div class="cont-b">
        <h1 class="has_background">Login</h1>
        <?php if (isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
        <form id="user-login-form" class="login-form" method="post">
            <div class="inp-b">
                <div class="inp-label"><label  class="required">Email <span class="required">*</span></label></div>
                <input class="inp-text" name="UserLoginForm[username]" id="UserLoginForm_email" type="text" autocomplete="off">		
            </div>

            <div class="inp-b">
                <div class="inp-label"><label  class="required">Password <span class="required">*</span></label></div>
                <input class="inp-text" name="UserLoginForm[password]" id="UserLoginForm_password" type="password" autocomplete="off" >		</div>

            <div class="inp-b">
                <input type="submit" class="btn btn-alt" value="Submit">
            </div>
        </form>
    </div>    
</div>