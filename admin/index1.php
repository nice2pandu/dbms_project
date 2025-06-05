<?php
$search1 = '9840973046';

$query = "SELECT top 10000 * FROM Tbl_Forte_Chndata WHERE ChnMobileno = '$search1' or [ChnAlternativeno] = '$search1' or ChnAlternativeno = '91$search1' or ChnAlternativeno = '+91$search1'";
echo $query;
?>