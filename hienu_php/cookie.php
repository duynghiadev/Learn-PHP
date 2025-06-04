<?php

// Set cookie
 setcookie(
     'user',
     'Hoc lap trinh PHP',
     time() + 86400,
     '/hienu_php',
     '',
     false,
     true    
    );

// Đọc cookie
//echo $_COOKIE['user'];

// Xoá cookie 
setcookie(
    'user',
    'Hoc lap trinh PHP',
    time()-60,
    '/hienu_php',
    '',
    false,
    true    
   );