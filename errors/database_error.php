<?php
// include your header here
// NOTE: the path must be root-relative OR 
//       relative to your CONTROLLER (index.php)

?>

<main>
    <h1>Database Error</h1>
    <p class="first_paragraph">There was an error connecting to the database.</p>
    <p class="last_paragraph">Error message: <?php echo $error_message; ?></p>
    <?php var_dump(debug_backtrace()); ?>
</main>

<?php
// include your footer here 
// NOTE: the path must be root-relative OR 
//       relative to your CONTROLLER (index.php)

?>