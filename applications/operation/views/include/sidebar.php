<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <?php
        if(isset($left_category)){
            foreach($left_category as $left_category_temp) {
                echo "<li class='category'><a href='".URL."index?category_id=".$left_category_temp['id']."'>".$left_category_temp['name']."</a></li>";
            }
        }?>

    </ul>

</div>