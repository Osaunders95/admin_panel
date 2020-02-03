<?php include 'view/header.php'; 
include 'view/side-menu.php';
?>
<div class="ap_main_parent">
    <div class="ap_account_create_parent">
    <div class="ap_account_create">
        <h1>Administrator Accounts</h1>
        <?php if (isset($_SESSION['admin'])) : ?>
            <h2>My Account</h2>
            <p><?php
                echo $_SESSION['admin']['firstName'] . ' ' .
                $_SESSION['admin']['lastName'] .
                ' (' . $_SESSION['admin']['email'] . ')';
                ?></p>
            <form action="." method="post">
                <input type="hidden" name="action" value="view_edit">
                <input type="hidden" name="admin_id" 
                       value="<?php echo $_SESSION['admin']['adminID']; ?>">
                <input type="submit" value="Edit">
            </form>
        <?php endif; ?>
        <?php if (count($admins) > 1) : ?>
            <h2>Other Administrators</h2>
            <table>
                <?php
                foreach ($admins as $admin):
                    if ($admin['adminID'] != $_SESSION['admin']['adminID']) :
                        ?>
                        <tr>
                            <td><?php
                                echo $admin['lastName'] . ', ' .
                                $admin['firstName'];
                                ?>
                            </td>
                            <td>
                                <div class="ap_account_buttons">
                                    <form action="." method="post">
                                        <input type="hidden" name="action" value="view_edit">
                                        <input type="hidden" name="admin_id"
                                               value="<?php echo $admin['adminID']; ?>">
                                        <input type="submit" value="Edit">
                                    </form>
                                    <form action="." method="post">
                                        <input type="hidden" name="action"
                                               value="view_delete_confirm">
                                        <input type="hidden" name="admin_id"
                                               value="<?php echo $admin['adminID']; ?>">
                                        <input type="submit" value="Delete">
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
        <h2>Add an Administrator</h2>
        <form action="." method="post">
            <input type="hidden" name="action" value="create">
            <label>First Name</label>
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($first_name) ?>">
            <?php echo $fields->getField('first_name')->getHTML(); ?>

            <label>Last Name</label>
            <input type="text" name="last_name" value="<?php echo htmlspecialchars($last_name) ?>">
            <?php echo $fields->getField('last_name')->getHTML(); ?>

            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email_message); ?>">
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
    </div>
</div>
</div>
<?php include 'view/footer.php' ?>
