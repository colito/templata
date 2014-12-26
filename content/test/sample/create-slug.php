[page:Create Slug]
<form action="sample/create-slug" method="post">
    Name:&nbsp;<input type="text" name="product">
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