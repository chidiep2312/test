<?php 
// Mảng bài cho
$a = [7, 19, 120, 189, 200, 381];

// Lặp qua mảng từ phần tử thứ hai để tính tổng dồn
for ($i = 1; $i < count($a); $i++) {
    $a[$i] += $a[$i - 1];
}

// Xuất kết quả
echo $a[count($a) - 1];
?>
?>