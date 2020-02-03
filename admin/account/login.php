<?php include 'view/header_signin.php'?>
<div class="signIn_container_parent">
    <div class="signInContainer">
        <div class="header">
            <img src="<?php echo $app_path?>img/logo-sns.png">
            <h3>Admin Login</h3>
        </div>
        <form action="." method="post">
            <input type="hidden" name="action" value="login">
            
            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email)?>">
            <?php echo $fields->getField('email')->getHTML();?>
            
            <label>Password</label>
            <input type = "password" name="password">
            <?php echo $fields->getField('password')->getHTML(); ?>
            
            <input type="submit" value="Submit">
            
            <?php if (!empty($password_message)) : ?>         
        <span class="error">
            <?php echo htmlspecialchars($password_message); ?>
        </span><br>
        <?php endif; ?>
            
        </form>
        <img src="<?php echo $app_path?>img/sns-1.png" class="sig">
    </div>
</div>
<?php include 'view/footer_signin.php'?>
