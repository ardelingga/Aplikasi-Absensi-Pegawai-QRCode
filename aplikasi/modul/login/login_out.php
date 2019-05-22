<?php
if (!defined('nsi')) { exit(); }

unset($_SESSION['uname']);
unset($_SESSION['level']);
set_notif('logout', 1);
redirect('?m=login');