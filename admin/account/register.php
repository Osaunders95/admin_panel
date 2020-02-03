<?php include 'view/header_signin.php'?>
<div class="signIn_signUp_Container">
    <div class="signInContainer">
        <div class="header">
            <img src="<?php echo $app_path?>img/logo-sns.png">
            <h3>Administrator Accounts</h3>
            <span>Add an Administrator</span>
        </div>
        <form action="." method="post">
            <input type="hidden" name="action" value="create">
            
            <label>First Name</label>
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($first_name)?>">
            <?php echo $fields->getField('first_name')->getHTML();?>
            
            <label>Last Name</label>
            <input type="text" name="last_name" value="<?php echo htmlspecialchars($last_name)?>">
            <?php echo $fields->getField('last_name')->getHTML();?>
            
            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email_message);?>">
            <span class="error"><?php echo $email_message; ?></span>
            <?php echo $fields->getField('email')->getHTML(); ?>
            
            <label>Password</label>
            <input type = "password" name="password_1">
            <span><?php echo htmlspecialchars($password_message); ?></span>
            <?php echo $fields->getField('password_1')->getHTML(); ?>
            
            <label>Retype Password</label>
            <input type = "password" name = "password_2">
            <?php echo $fields->getField('password_2')->getHTML(); ?>
            
            <input type="submit" value="Submit">
            
        </form>
        <img src="<?php echo $app_path?>img/sns-1.png" class="sig_img">
    </div>
</div>
<?php include 'view/footer_signin.php'?>
