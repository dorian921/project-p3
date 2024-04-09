<?php

include "function.php";

deleteproduct($id);
header("location: productcrud.php");
exit();