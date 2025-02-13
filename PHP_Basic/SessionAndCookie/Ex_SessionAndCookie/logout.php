<?php

session_start();


// Xóa thông tin đăng nhập trong Session
// Sử dụng cả session_unset() và session_destroy() trong file logout.php 
//      đảm bảo rằng mọi thứ liên quan đến phiên làm việc của người dùng đều bị xóa sạch. 
//      session_unset() xóa các biến session, 
//      trong khi session_destroy() đảm bảo rằng không chỉ các biến 
//      mà toàn bộ phiên làm việc (bao gồm session ID) đều bị hủy.
session_unset();
session_destroy();

// xóa cookie nếu có
setcookie('username','', time() - 3600,'/');
setcookie('password','', time() - 3600,'/');

// chuyển hướng trang 
header('Locale: index.php');
exit();