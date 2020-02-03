<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin Panel</title>
        <link rel="stylesheet" type="text/css"href="<?php echo $app_path ?>styles/main.css">
        <script src="https://kit.fontawesome.com/191d0bc2e8.js" crossorigin="anonymous"></script>
        <!-- Google Analytics-->
        <script>
            (function (w, d, s, g, js, fs) {
                g = w.gapi || (w.gapi = {});
                g.analytics = {q: [], ready: function (f) {
                        this.q.push(f);
                    }};
                js = d.createElement(s);
                fs = d.getElementsByTagName(s)[0];
                js.src = 'https://apis.google.com/js/platform.js';
                fs.parentNode.insertBefore(js, fs);
                js.onload = function () {
                    g.load('analytics');
                };
            }(window, document, 'script'));
        </script>

    </head>
    <body>
        <div class="ap_header_parent">
            <div class="ap_header_cont">
                <div class="ap_header_left">
                    <img class="ap_header_logo" src="<?php echo $app_path ?>img/logo-sns.png">
                </div>
                <div class = "ap_header_right">

                    <div class="nav_right_list">
                        <h3><?php echo $_SESSION['admin']['firstName'] . ' ' . $_SESSION['admin']['lastName'] ?></h3>
                        <div class="nav_right_items">
                            <?php
                            $account_url = $app_path . 'admin/account';
                            $logout_url = $account_url . '?action=logout';
                            ?>
                            <a href="<?php echo $app_path; ?>admin"><i class="fas fa-home"></i></a>
                            <a href="<?php echo $app_path; ?>admin/account/"><i class="fas fa-cog"></i></a>
                            <a href="<?php echo $logout_url; ?>"><i class="fas fa-sign-out-alt"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  