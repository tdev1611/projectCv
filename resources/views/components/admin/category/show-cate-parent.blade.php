@php
    showCategoriesParent($categories);
@endphp


<?php

function showCategoriesParent($categories, $cat_parent = null, $char = '')
{
    foreach ($categories as $key => $cat) {
        if ($cat->cat_parent == $cat_parent) {
            echo " <option value='$cat->id' > $char  $cat->name </option>";
            unset($categories->key);
            showCategoriesParent($categories, $cat->id, $char . ' -- ');
        }
    }
}

?>
