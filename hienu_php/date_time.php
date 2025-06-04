<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$date = date('y:m:d H:i:s');
echo $date.'<br>';
echo date_default_timezone_get().'<br>';

echo 'Timestamp của thời điêm hiện tại : '.time().'<br>';

// now, 21 March 1996, next Monday -> strtotime()

echo strtotime('now').'<br>';
echo 'Timesstamp của 21 March 1996: '.strtotime('21 March 1996').'<br>';
echo 'Timesstamp của next Monday: '.strtotime('next Monday').'<br>';


