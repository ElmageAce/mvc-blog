        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Comments <small>Moderate Comments</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                            <li class="active">
                                <i class="fa fa-comment"></i> Comments
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <!--Row-->
                <div class="row">

                    <div class="col-lg-12">
                        
                        <p class="filter-link"><a href="comments.php">All</a> (5) | <a href="comments.php?pending=1">Pending</a> (4) | <a href="comments.php?approved=1">Approved</a> (3) | <a href="comments.php?spam=1">Spam</a>  (2) | <a href="comments.php?trash=1">Trash</a>  (1)
                        <!--Form-->
                        <form class="form-inline" role="form" method="get">
                            <div class="form-group">
                                <select class="form-control" id="post-action" name="action">
                                    <option>Bulk Action</option>
                                    <option value="approve">Approve</option>
                                    <option value="isSpam">Mark as Spam</option>
                                    <option value="isTrash">Move to Trash</option>
                                    <option value="delete">Delete</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default applybtn" name="apply">Apply</button>

                            <div class="table-responsive post-table">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>

                                                <div class="checkbox">
                                                    <label><input type="checkbox" value=""></label>
                                                </div>

                                                Author
                                            </th>
                                            <th>Comment</th>
                                            <th>Response To</th>
                                            <th>Date Submitted</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>

                                                <td>

                                                        <div class="checkbox">
                                                            <label><input type="checkbox" name="modComment[]" value="<?php echo $id; ?>"></label>
                                                        </div>
                                                    name
                                                    <br><br>
                                                    <a href="#">email</a>
                                                </td>
                                                <td class="comment-msg">msg</td>
                                                <td class="comment-post"><a href="">title</a></td>
                                                <td>date</td>
                                            </tr>
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