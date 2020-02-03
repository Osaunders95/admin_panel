<?php include 'view/header.php'; 
include 'view/side-menu.php';
?>

<main>
    <h1>Delete Account</h1>
    <p>Are you sure you want to delete the account for
       <?php echo htmlspecialchars($last_name) . ', ' . 
                  htmlspecialchars($first_name) .
                  ' (' . htmlspecialchars($email) . ')'; ?>?</p>
    <form action="." method="post">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="admin_id"
               value="<?php echo $admin_id; ?>">
        <input type="submit" value="Delete Account">
    </form>
    <form action="index.php?action=view_account" method="post">
        <input type="submit" value="Cancel">
    </form>
</main>
<?php include 'view/footer.php';?>