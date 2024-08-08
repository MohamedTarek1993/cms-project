<?php


?>


<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled">
                <?php   while($all_categories_side = mysqli_fetch_assoc($select_all_categories_sidbar)): ?>
                <li><a href="#"><?php echo $all_categories_side['cat_title']; ?></a></li>
                <?php endwhile ; ?>
            </ul>
        </div>

    </div>
    <!-- /.row -->
</div>