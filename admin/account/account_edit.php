<?php
include 'view/header.php';
include 'view/side-menu.php';
?>

<div class="ap_main_parent">
    <div class="ap_account_create_parent">
    <div class="ap_account_cont">
        <h1>Account Settings</h1>

        <div class="ap_account_create">

            <form action="." method="post">
                <?php if ($_SESSION['admin']['adminID'] != $admin_id): ?>
                    <input type="hidden" name="action" value="update_user">
                <?php else: ?>
                    <input type="hidden" name="action" value="update">
                <?php endif; ?>

                <input type="hidden" name="admin_id"  value="<?php echo $admin_id; ?>">

                <label>E-Mail:</label>

                <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">

                <?php echo $fields->getField('email')->getHTML(); ?>

                <label>First Name:</label>

                <input type="text" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>">

                <?php echo $fields->getField('first_name')->getHTML(); ?>

                <label>Last Name:</label>

                <input type="text" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>">

                <?php echo $fields->getField('last_name')->getHTML(); ?>
                
                <label>New Password:</label>

                <input type="password" name="password_1">

                <span>Leave blank to leave unchanged</span>

                <?php echo $fields->getField('password_1')->getHTML(); ?><br>



                <label>Retype Password:</label>

                <input type="password" name="password_2">

                <?php echo $fields->getField('password_2')->getHTML(); ?>



                <label>&nbsp;</label>

                <input type="submit" value="Update Account">

                <span class="error">

                    <?php echo htmlspecialchars($password_message); ?>

                </span><br>

            </form>

        </div>
    </div>
</div>
</div>

<?php include 'view/footer.php'; ?>

