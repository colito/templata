[page:Create Slug]
<form action="sample/create-slug" method="post">
    Product Name:<input type="text" name="product"> <br>

    <input type="submit" value="Submit">
</form>

<br><br>

<?php

    $ph = new PageHandler();

    if(!empty($_POST['product']))
    {
        var_dump($_POST['product']);

        $slug = $ph->create_slug($_POST['product']);

        echo $slug;
    }
?>