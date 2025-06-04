<?php

if (isset($_GET['action'])) {
    echo $_GET['action'];
} else {
    echo 'Giá trị không tồn tại';
}
