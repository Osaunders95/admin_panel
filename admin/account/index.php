<?php

require_once('../../util/main.php');
require_once ('util/sanitizeInputs.php');
require_once('model/admin_db.php');
require_once('model/fields.php');
require_once('model/validate.php');

$action = filter_input(INPUT_POST, 'action');
if (isset($_SESSION['admin'])) {
    if ($action == null) {
        $action = filter_input(INPUT_GET, 'action');
        if ($action == null) {
            $action = 'view_session_edit';
        }
    }
} elseif ($action == 'login') {
    $action = 'login';
} else {
    $action = 'view_login';
}

// Set up all possible fields to validate
$validate = new Validate();
$fields = $validate->getFields();

// for the Add Account page and other pages
$fields->addField('email');
$fields->addField('password_1');
$fields->addField('password_2');
$fields->addField('first_name');
$fields->addField('last_name');

// for the Login page
$fields->addField('password');

switch ($action) {
    case 'view_login':
        // Clear login data
        $email = '';
        $password = '';
        $password_message = '';

        include 'login.php';
        break;
    case 'login':
        // Get username/password
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');

        // Validate user data       
        $validate->email('email', $email);
        $validate->text('password', $password, true, 6, 30);

        // If validation errors, redisplay Login page and exit controller
        if ($fields->hasErrors()) {
            include 'admin/account/login.php';
            break;
        }

        // Check database - if valid username/password, log in
        if (is_valid_admin_login($email, $password)) {
            $_SESSION['admin'] = get_admin_by_email($email);
        } else {
            $password_message = 'Login failed. Invalid email or password.';
            include 'admin/account/login.php';
            break;
        }

        // Display Admin Menu page
        redirect('..');
        break;
    case 'view_edit':
        //get admin user data
        $admin_id = filter_input(INPUT_POST, 'admin_id', FILTER_VALIDATE_INT);
        $admin = get_admin($admin_id);
        $first_name = $admin['firstName'];
        $last_name = $admin['lastName'];
        $email = $admin['email'];
        $password_message = '';
        include 'account_edit.php';
        break;
    case 'view_session_edit':
        //get admin user data
        $admin_id = $_SESSION['admin']['adminID'];
        $admin = get_admin($admin_id);
        $first_name = $admin['firstName'];
        $last_name = $admin['lastName'];
        $email = $admin['email'];
        $password_message = '';
        include 'account_edit.php';
        break;
    case 'view_account':
        /// Get all accounts from database
        $admins = get_all_admins();

        // Set up variables for add form
        $email = '';
        $first_name = '';
        $last_name = '';
        if (!isset($email_message)) {
            $email_message = '';
        }
        if (!isset($password_message)) {
            $password_message = '';
        }

        // View admin accounts
        include 'view_accounts.php';
        break;
    case 'create':
        // Get admin user data
        $first_name = sanitizeFromString(filter_input(INPUT_POST, 'first_name'));
        $last_name = sanitizeFromString(filter_input(INPUT_POST, 'last_name'));
        $email = sanitizeFormEmail(filter_input(INPUT_POST, 'email'));
        $password_1 = sanitizeFormPassword(filter_input(INPUT_POST, 'password_1'));
        $password_2 = sanitizeFormPassword(filter_input(INPUT_POST, 'password_2'));

        $admins = get_all_admins();
        $email_message = '';
        $password_message = '';

        // Validate admin user data
        $validate->email('email', $email);
        $validate->text('first_name', $first_name, true, 2, 25);
        $validate->text('last_name', $last_name, true, 2, 25);
        $validate->password('password_1', $password_1, true);
        $validate->verify('password_2', $password_1, $password_2, true);

        // If validation errors, redisplay Login page and exit controller
        if ($fields->hasErrors()) {
            include 'admin/account/view_accounts.php';
            break;
        }

        if (is_valid_admin_email($email)) {
            $email_message = 'This email is already in use.';
            include 'admin/account/view_accounts.php';
            break;
        }

        // Add admin user
        $admin_id = add_admin($first_name, $last_name, $email, $password_1);

        // Set admin user in session
        if (!isset($_SESSION['admin'])) {
            $_SESSION['admin'] = get_admin($admin_id);
        }
        
        redirect('index.php?action=view_account');
        break;
    case 'update_user':
        $admin_id = filter_input(INPUT_POST, 'admin_id', FILTER_VALIDATE_INT);
        $first_name = sanitizeFromString(filter_input(INPUT_POST, 'first_name'));
        $last_name = sanitizeFromString(filter_input(INPUT_POST, 'last_name'));
        $email = sanitizeFormEmail(filter_input(INPUT_POST, 'email'));
        $password_1 = sanitizeFormPassword(filter_input(INPUT_POST, 'password_1'));
        $password_2 = sanitizeFormPassword(filter_input(INPUT_POST, 'password_2'));

        // Validate admin user data
        $validate->email('email', $email);
        $validate->text('first_name', $first_name);
        $validate->text('last_name', $last_name);
        $validate->text('password_1', $password_1, false, 6, 30);
        $validate->text('password_2', $password_2, false, 6, 30);


        // If validation errors, redisplay Login page and exit controller
        if ($fields->hasErrors()) {
            include 'admin/account/account_edit.php';
            break;
        }

        if ($password_1 !== $password_2) {
            $password_message = 'Passwords do not match.';
            include 'admin/account/account_edit.php';
            break;
        }
        

        update_admin($admin_id, $email, $first_name, $last_name,
                $password_1, $password_2);

        if ($admin_id == $_SESSION['admin']['adminID']) {
            $_SESSION['admin'] = get_admin($admin_id);
        }
        redirect($app_path . 'admin/account/.?action=view_account');
        break;
        
        case 'update':
        $admin_id = filter_input(INPUT_POST, 'admin_id', FILTER_VALIDATE_INT);
        $first_name = sanitizeFromString(filter_input(INPUT_POST, 'first_name'));
        $last_name = sanitizeFromString(filter_input(INPUT_POST, 'last_name'));
        $email = sanitizeFormEmail(filter_input(INPUT_POST, 'email'));
        $password_1 = sanitizeFormPassword(filter_input(INPUT_POST, 'password_1'));
        $password_2 = sanitizeFormPassword(filter_input(INPUT_POST, 'password_2'));

        // Validate admin user data
        $validate->email('email', $email);
        $validate->text('first_name', $first_name);
        $validate->text('last_name', $last_name);
        $validate->text('password_1', $password_1, false, 6, 30);
        $validate->text('password_2', $password_2, false, 6, 30);


        // If validation errors, redisplay Login page and exit controller
        if ($fields->hasErrors()) {
            include 'admin/account/account_edit.php';
            break;
        }

        if ($password_1 !== $password_2) {
            $password_message = 'Passwords do not match.';
            include 'admin/account/account_edit.php';
            break;
        }
        

        update_admin($admin_id, $email, $first_name, $last_name,
                $password_1, $password_2);

        if ($admin_id == $_SESSION['admin']['adminID']) {
            $_SESSION['admin'] = get_admin($admin_id);
        }
        redirect($app_path . 'admin/account/.?action=view_session_edit');
        break;
    case 'view_delete_confirm':
        $admin_id = filter_input(INPUT_POST, 'admin_id', FILTER_VALIDATE_INT);
        if ($admin_id == $_SESSION['admin']['adminID']) {
            display_error('You cannot delete your own account.');
        }
        $admin = get_admin($admin_id);
        $first_name = $admin['firstName'];
        $last_name = $admin['lastName'];
        $email = $admin['email'];
        include 'delete_account.php';
        break;
    case 'delete':
        $admin_id = filter_input(INPUT_POST, 'admin_id', FILTER_VALIDATE_INT);
        delete_admin($admin_id);
        redirect($app_path . 'admin/account/index.php?action=view_account');
        break;
    case 'logout':
        unset($_SESSION['admin']);
        redirect($app_path . 'admin/account');
        break;
    default:
        display_error('Unknown account action: ' . $action);
        break;
}
?>