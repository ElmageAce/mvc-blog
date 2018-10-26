        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Posts <small>Post Editor</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil"></i> Posts
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil"></i> Add / Edit Post
                            </li>
                        </ol>
                    </div>
                </div>

                <!--form-->
                <form method="post" role="form" action="<?php echo URL ?>dashboard/savePost" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-lg-12">
                            <h1><?php echo (empty($this->pageData['postData'])) ? 'Add New Post' : 'Edit Post'; ?></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                                <div class="form-group">
                                    <input type="text" name="title" class="form-control" id="title" value="<?php echo (empty($this->pageData['postData'])) ? '' : explode('<br>', $this->pageData['postData'][0]->title)[0]; ?>" placeholder="Enter Blog Title">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="subtitle" class="form-control" id="subtitle" value="<?php echo (empty($this->pageData['postData'])) ? '' : explode('<br>', $this->pageData['postData'][0]->title)[1]; ?>" placeholder="Enter Blog Subtitle">
                                </div>
                                
                                <textarea id="mytextarea" name="mytextarea">
                                    <?php echo (empty($this->pageData['postData'])) ? '' : $this->pageData['postData'][0]->postContent; ?>
                                </textarea>
                        </div>

                        <div class="col-lg-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>Publish</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input type="submit" name="saveDraft" class="btn btn-default" value="Save Draft">
                                    </div>
                                    <h5>Status</h5>
                                    <select class="form-control" name="publishOption">
                                        <option value="draft" <?php echo (!empty($this->pageData['postData'][0]->isDraft) && $this->pageData['postData'][0]->isDraft)? 'selected' : ''; ?>>Draft</option>
                                        <option value="reviewPending" <?php echo (!empty($this->pageData['postData'][0]->isDraft) &&  $this->pageData['postData'][0]->isDraft)? '' : 'selected'; ?>>Pending Review</option>
                                    </select>
                                    <h5>Visibility</h5>
                                    <div class="radio">
                                        <label><input type="radio" name="visibility" value="public" <?php echo (!empty($this->pageData['postData'][0]->visibility) && $this->pageData['postData'][0]->visibility == 'public')? 'checked' : ''; ?>>Public</label>
                                    </div>
                                    <label>
                                        <input type="checkbox" name="stick" value="sticky" <?php echo (!empty($this->pageData['postData'][0]->sticky) && $this->pageData['postData'][0]->sticky)? 'checked' : ''; ?>>
                                        Stick to front page
                                    </label>
                                    <div class="radio">
                                        <label><input type="radio" name="visibility" value="private" <?php echo (!empty($this->pageData['postData'][0]->visibility) && $this->pageData['postData'][0]->visibility == 'private')? 'checked' : ''; ?>>Private</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="visibility" value="protected" <?php echo (!empty($this->pageData['postData'][0]->visibility) && $this->pageData['postData'][0]->visibility == 'protected')? 'checked' : ''; ?>>Protected</label>
                                    </div>
                                    <div class="radio disabled">
                                        <label><input type="radio" name="visibility" value="adminOnly" disabled>Exclusive</label>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <input type="submit" name="publish" class="btn btn-primary" value="publish">
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>Categories</h4>
                                </div>
                                <div class="panel-body">
                                    <h5>All Categories</h5>
                                    <div class="form-group">
                                        <?php

                                        $categoryList = $this->pageData['categories'];

                                        for ($i=0; $i < count($categoryList); $i++) { 
                                        ?> 
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="chkbox[]" value="<?php echo($categoryList[$i]->categoryID); ?>" <?php echo (!empty($this->pageData['postData'][1])) ? $this->sortCat($categoryList[$i]->categoryID, $this->pageData['postData'][1]) : ''; ?>>
                                            <?php echo $this->getCatName($categoryList[$i]->categoryID); ?>
                                            </label>
                                        </div>
                                        <?php
                                        }

                                        ?>    
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <a href="#">+ Add New Category</a>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>Featured Image</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>Set Featured Image</label>
                                        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="imgChkbox" value="1" checked>Use default Featured Image</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="token" value="<?php echo \Elmage\util\Token::generate(); ?>">
                    <input type="hidden" name="EditPost" value="<?php echo (!empty($this->pageData['postData'][0]->postID))? $this->pageData['postData'][0]->postID : ''; ?>">
                </form>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


