<?php

include "Common/Class_Lib.php";

//open file using extended class
//regex + object creation + array creation happening here
$bookFile = new BookFile("Contents/BookList.txt");


$bookList = $bookFile->getBookList();



foreach ($bookList as $b)
{
    echo $b->getId() . " ";
    echo $b->getTitle() ." ";
    echo $b->getPrice() . " ";
    echo "<br/>";
}

?>

<html>
<head>
    <title>Algonquin College Bookstore</title>
    <link rel="stylesheet" type="text/css" href="Contents/BookStore.css" />
</head>

<body>
</br>

<table border="1">

    <?php

    foreach ($bookList as $book) {
        echo "<tr>";
        echo "<td>$book</td>";
        echo "</tr>";

    }
//
//    ?>
</table>

</body>
</html>
