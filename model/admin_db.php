<?php

function is_valid_admin_login($email, $password) {
    global $db;
    $query = 'SELECT password FROM admins
              WHERE email = :email';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();
        $hash = $row['password'];
        return password_verify($password, $hash);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function admin_count() {
    global $db;
    $query = 'SELECT count(*) AS adminCount FROM admins';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result['adminCount'];
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_all_admins() {
    global $db;
    $query = 'SELECT * FROM admins ORDER BY lastName, firstName';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $admins = $statement->fetchAll();
        $statement->closeCursor();
        return $admins;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_admin($admin_id) {
    global $db;
    $query = 'SELECT * FROM admins WHERE adminID = :admin_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':admin_id', $admin_id);
        $statement->execute();
        $admin = $statement->fetch();
        $statement->closeCursor();
        return $admin;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_admin_by_email($email) {
    global $db;
    $query = 'SELECT * FROM admins WHERE email = :email';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $admin = $statement->fetch();
        $statement->closeCursor();
        return $admin;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function is_valid_admin_email($email) {
    global $db;
    $query = '
        SELECT * FROM admins
        WHERE email = :email';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $valid = ($statement->rowCount() == 1);
        $statement->closeCursor();
        return $valid;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function add_admin($first_name, $last_name, $email, $password_1) {
    global $db;
    $hash = password_hash($password_1, PASSWORD_DEFAULT);
    $query = '
        INSERT INTO admins (firstName, lastName, email, password)
        VALUES (:first_name, :last_name, :email, :password)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $hash);
        $statement->bindValue(':first_name', $first_name);
        $statement->bindValue(':last_name', $last_name);
        $statement->execute();
        $admin_id = $db->lastInsertId();
        $statement->closeCursor();
        return $admin_id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
    }
}

function update_admin($admin_id, $email, $first_name, $last_name,
        $password_1, $password_2) {
    global $db;
    $query = '
        UPDATE admins
        SET email = :email,
            firstName = :first_name,
            lastName = :last_name
        WHERE adminID = :admin_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':first_name', $first_name);
        $statement->bindValue(':last_name', $last_name);
        $statement->bindValue(':admin_id', $admin_id);
        $statement->execute();
        $statement->closeCursor();

        if (!empty($password_1) && !empty($password_2)) {
            if ($password_1 !== $password_2) {
                display_error('Passwords do not match.');
            } elseif (strlen($password_1) < 6) {
                display_error('Password must be at least six characters.');
            }
            $hash = password_hash($password_1, PASSWORD_DEFAULT);
            $query = '
            UPDATE admins
            SET password = :password
            WHERE adminID = :admin_id';
            $statement = $db->prepare($query);
            $statement->bindValue(':password', $hash);
            $statement->bindValue(':admin_id', $admin_id);
            $statement->execute();
            $statement->closeCursor();
        }
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function delete_admin($admin_id) {
    global $db;
    try {
        $query = 'DELETE FROM admins WHERE adminID = :admin_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':admin_id', $admin_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

?>