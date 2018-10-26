        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Posts <small>Published Posts</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil"></i> Posts
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                    <!--New row-->
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="<?php echo URL; ?>dashboard/pages/editCategory" class="btn btn-default pull-right new-cat">New Category</a>
                            <a href="<?php echo URL; ?>dashboard/pages/newpost" class="btn btn-info pull-right new-post">New Post</a>
                            
                        </div>
                    </div>

                <!--Row-->
                <div class="row">

                    <div class="col-lg-12">
                        
                        <p class="filter-link"><a href="<?php echo URL; ?>dashboard/pages/posts">All</a> (<?php echo $this->postCount('all'); ?>) | <a href="<?php echo URL; ?>dashboard/filter/author">My Posts</a> (<?php echo $this->postCount('author'); ?>) | <a href="<?php echo URL; ?>dashboard/filter/published">Published</a> (<?php echo $this->postCount('published'); ?>) | <a href="<?php echo URL; ?>dashboard/filter/draft">Draft</a>  (<?php echo $this->postCount('draft'); ?>)</p>
                        <!--Form-->
                        <form class="form-inline" role="form" method="post" action="<?php echo URL; ?>dashboard/filterPost">
                            <div class="form-group">
                                <select class="form-control" id="post-action" name="actions">
                                    <option>Bulk Action</option>
                                    <option value="edit">Edit</option>
                                    <option value="trash">Trash</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default applybtn" name="apply" value="post">Apply</button>
                            <div class="form-group">
                                <select class="form-control" id="filter-date" name="dateFilter">
                                    <option value="">All Dates</option>
                                    <option value="May 2018">May 2018</option>
                                    <option value="June 2018">June 2018</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <select class="form-control" id="filter-category" name="cat">
                                    <option value="0">All Categories</option>
                                <?php
                                $Categories = $this->cats;

                                $num = count($Categories);

                                for ($i=0; $i < $num; $i++) { 
                                ?>
                                    <option value="<?php echo $Categories[$i]->categoryID; ?>">
                                        <?php echo $this->getCatName($Categories[$i]->categoryID);//$Categories[$i]->categoryName; ?>
                                    </option>
                                <?php
                                }
                                ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default" name="apply" value="filter">Filter</button>

                            <div class="table-responsive post-table">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" value=""></label>
                                                    </div>
                                                Title
                                            </th>
                                            <th>Review Status</th>
                                            <th>Post Rating</th>
                                            <th>Author</th>
                                            <th>Categories</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $allPosts = $this->posts;

                                    $allCategories = $this->cats;

                                    $postCount = count($allPosts);

                                    for ($i=0; $i < $postCount; $i++) {

                                        if ($i > 0 && $allPosts[$i]->postID === $allPosts[$i - 1]->postID) {
                                            continue;
                                        }

                                        $catId = '';

                                        $fullTitle = $allPosts[$i]->title;

                                        $titleArray = explode('<br>', $fullTitle);

                                        $title = $titleArray[0];

                                        $review = '';
                                        if ($allPosts[$i]->isApproved == true) {
                                            $review = 'Approved';
                                        } elseif ($allPosts[$i]->isSpam == true) {
                                            $review = 'SPAM post';
                                        } else {
                                            $review = 'Pending Review';
                                        }

                                        $date = $allPosts[$i]->dateAdded;
                                    ?>
                                        <tr>

                                            <td>
                                                <div class="checkbox">
                                                    <label><input type="checkbox" name="chkbox[]" value="<?php echo $allPosts[$i]->postID; ?>"></label>
                                                </div>
                                                <a href="<?php echo URL ?>page/pages/<?php echo $allPosts[$i]->postID; ?>"><?php echo $title; ?></a> 
                                            </td>
                                            <td><?php echo $review; ?></td>
                                            <td><?php echo $allPosts[$i]->rating; ?></td>
                                            <td>Creator</td>
                                            <td><?php
                                                for ($j=0; $j < count($allPosts); $j++) { 
                                                    
                                                    if ($allPosts[$j]->postID == $allPosts[$i]->postID) {
                                                       
                                                       $catId .= ', ' . $this->getCategoryName($allPosts[$j]->categoryID);
                                                    }
                                                }
                                                if (strlen($catId) > 0) {
                                                    echo ltrim($catId, ',');
                                                } else {
                                                    echo 'Uncategorized';
                                                }

                                            ?></td>
                                            <td><?php echo \formatDate($date); ?></td>
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
                                    <li class="previous"><a href="">Previous</a></li>
                                    <li class="next"><a href="">Next</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
