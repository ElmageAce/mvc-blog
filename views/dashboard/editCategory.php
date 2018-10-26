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

                $catArray = $this->cats;

                $catNum = count($this->cats);

                ?>

                <!--Row-->
                <div class="row">
                    <div class="col-lg-4">
                        <?php
                        echo (empty($this->catToEdit))? '<h3>Add New Category</h3>' : '<h3>Edit Category</h3>';

                        ?>
                        <form role="form" method="post" class="form" action="<?php echo URL ?>dashboard/modCategory/modify">
                            <div class="form-group">
                                <label for="category_name">Name:</label>
                                <input type="text" name="category_name" class="form-control" value="<?php echo (empty($this->catToEdit)) ? '' : $this->catToEdit->categoryName; ?>">
                            </div>

                            <div class="form-group">
                                <label for="parent">Parent Category:</label>
                                <select class="form-control" id="post-action" name="parent">
                                    <option value="0">None</option>
                                    <?php

                                    for ($i=0; $i < $catNum; $i++) { 
                                    
                                    ?>
                                        <option value="<?php echo $catArray[$i]->categoryID; ?>" <?php if(!empty($this->catToEdit) && $this->catToEdit->categoryID == $catArray[$i]->categoryID) echo "selected";?>><?php echo $catArray[$i]->categoryName; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div>
                                <label for="description">Description:</label>
                                <textarea name="description" rows="5" style="width: 100%"><?php echo (empty($this->catToEdit)) ? '' : $this->catToEdit->description; ?></textarea>
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="token" value="">
                                <input type="hidden" name="status" value="<?php echo (empty($this->catToEdit)) ? 'new' : $this->catToEdit->categoryID; ?>">
                                <button type="submit" class="btn btn-info" name="newCategory"><?php echo (empty($this->catToEdit)) ? 'Add New Category' : 'Update Category'; ?></button>
                            </div>


                        </form>
                    </div>

                    <div class="col-lg-8">
                        <!--Form-->
                        <form class="form-inline" role="form" method="post" action="<?php echo URL ?>dashboard/modCategory/moderate">

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

                                        for ($i=0; $i < $catNum; $i++) { 
                                    
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="categoryCheck[]" value="<?php echo $catArray[$i]->categoryID; ?>"></label>
                                            </div>
                                            <?php echo $catArray[$i]->categoryName; ?>
                                            </td>
                                        <td class="desc"><?php echo $catArray[$i]->description; ?></td>
                                        <td><?php echo $this->getCategoryName( (int)$catArray[$i]->parent ); ?></td>
                                        <td><?php echo $catArray[$i]->dateAdded; ?></td>
                                    </tr>
                                    <?php

                                        }
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
                                if (true) {
                            ?>
                                    <li class="previous"><a href="">Previous</a></li>
                            <?php
                                }
                            ?>
                            <?php
                                if (true) {
                            ?>
                                    <li class="next"><a href="">Next</a></li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
