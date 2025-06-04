<?php
/* 
    Nếu $a < 0 -> in ra "Biến A âm" ngược lại in ra "Biến A dương"
*/



// Toán tử 3 ngôi
$a = 5;
// echo ($a < 0) ? "Biến A âm" : " Biến A dương";

if($a < 0): 
?>
    <ul>
        <li>item1</li>
        <li>item2</li>
        <li>item3</li>
        <li>item4</li>
    </ul>

<?php
else :
    echo "Biến A dương";

endif;

// Cú pháp thay thế for
// for($i = 0; $i < 4; $i++):
//     ?>

     <!-- <ul>
         <li>item1</li>
         <li>item2</li>
         <li>item3</li>
      <li>item4</li>
    </ul> -->
    
    <?php
//   endfor;


//   Cú pháp thay thế while
$i = 0;
while($i < 4):
    ?>

    <ul>
    <li>item1</li>
    <li>item2</li>
    <li>item3</li>
    <li>item4</li>
    </ul>

    <?php
    $i++;
endwhile;

// Cú pháp thay thế foreach
foreach($arr as $item):


endforeach;


include_once "function.php";

makeTotal(6,7);