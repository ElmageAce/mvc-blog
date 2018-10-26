        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Posts <small>Post Categories</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil"></i> Posts
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil"></i> Categories
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <?php 

              //

                ?>

                <!--Row-->
                <div class="row">
                    <div class="col-lg-4">
                        <?php
                        echo (empty($editCat))? '<h3>Add New Category</h3>' : '<h3>Edit Category</h3>';

                        ?>
                        <form role="form" method="post" class="form">
                            <div class="form-group">
                                <label for="category_name">Name:</label>
                                <input type="text" name="category_name" class="form-control" value="">
                            </div>

                            <div class="form-group">
                                <label for="parent">Parent Category:</label>
                                <select class="form-control" id="post-action" name="parent">
                                    <option value="0">None</option>
                                    <?php

                                    for ($i=0; $i < 5; $i++) { 
                                    
                                    ?>
                                        <option value="">name</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div>
                                <label for="description">Description:</label>
                                <textarea name="description" rows="5" style="width: 100%"></textarea>
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="token" value="">
                                <button type="submit" class="btn btn-info" name="newCategory"><?php echo (empty($editCat)) ? 'Add New Category' : 'Update Category'; ?></button>
                            </div>


                        </form>
                    </div>

                    <div class="col-lg-8">
                        <!--Form-->
                        <form class="form-inline" role="form" method="get" action="">

                            <div class="form-group">
                                <select class="form-control" id="post-action" name="actions">
                                    <option>Bulk Action</option>
                                    <option value="editCategory">Edit</option>
                                    <option value="deleteCategory">Delete</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default applybtn" name="apply" value="editCategory">Apply</button>

                            <div class="table-responsive post-table">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="checkbox">
                                                    <label><input type="checkbox" value=""></label>
                                                </div>
                                                Category Name
                                            </th>
                                            <th>Description</th>
                                            <th>Parent Category</th>
                                            <th>Date Added</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                      //
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="categoryCheck[]" value=""></label>
                                            </div>

                                            name</td>
                                        <td class="desc">desc</td>
                                        <td>parent</td>
                                        <td>timestamp</td>
                                    </tr>
                                    <?php

                                        //
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        <!--- End form -->

                    </div>

                </div>
                <!--End row-->

                <div class="row">
                    <div class="col-lg-12">
                        <ul class="pager">
                            <?php
                                //if ($currentPage > 1) {
                            ?>
                                    <li class="previous"><a href="">Previous</a></li>
                            <?php
                                //}
                            ?>
                            <?php
                                //if (($postCount - $limit) > 0) {
                            ?>
                                    <li class="next"><a href="">Next</a></li>
                            <?php
                                //}
                            ?>
                        </ul>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
