<?php
/*
    kadai01_3.php
    Date:2024/09/30
*/
    $num = 1;
    $word = '1';

    //変数の中身確認用表示
    echo 'num = ',$num,'<br>';
    echo 'word = ',$word,'<br><br>';

    if($num == $word){
        echo '==で比較したとき、num と word は等しいです。<br>';
    }
    else{
        echo '==で比較したとき、num と word は等しくありません。<br>';
    }

    if($num === $word){
        echo '===で比較したとき、num と word は等しいです。<br>';
    }
    else{
        echo '===で比較したとき、num と word は等しくありません。<br>';
    }
?>