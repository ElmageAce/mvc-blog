        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Users <small>Registered Users</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                            <li class="active">
                                <i class="fa fa-users"></i> Users
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <!--New row-->
                <div class="row">
                    <div class="col-lg-12">
                        <a href="#" class="btn btn-default pull-right new-cat">Change Role</a>
                        <a href="<?php echo URL; ?>register" class="btn btn-info pull-right new-post">Add User</a>
                    </div>
                </div>

                <!--Row-->
                <div class="row">

                    <div class="col-lg-12">
                        <p class="filter-link"><a href="<?php echo URL; ?>dashboard/pages/users">All</a> (<?php echo $this->countUsers(); ?>) | <a href="<?php echo URL; ?>dashboard/filterUsers/Super-Administrator">Super Administrator</a> (<?php echo $this->countUsers('Super-Administrator'); ?>) | <a href="<?php echo URL; ?>dashboard/filterUsers/Administrator">Administrator</a> (<?php echo $this->countUsers('Administrator'); ?>) | <a href="<?php echo URL; ?>dashboard/filterUsers/Editor">Editor</a>  (<?php echo $this->countUsers('Editor'); ?>) | <a href="<?php echo URL; ?>dashboard/filterUsers/Author">Author</a>  (<?php echo $this->countUsers('Author'); ?>) | <a href="<?php echo URL; ?>dashboard/filterUsers/Public">Public</a> (<?php echo $this->countUsers('Public'); ?>)</p>
                        <!--Form-->
                        <form class="form-inline" role="form" method="post" action="<?php echo URL ?>dashboard/userMod">

                            <div class="form-group">
                                <select class="form-control" id="post-action" name="action">
                                    <option value="">Bulk Action</option>
                                    <option value="remove">Remove</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default applybtn" name="apply" value="moduser">Apply</button>

                            <div class="form-group">
                                <select class="form-control" id="filter-date" name="userRole">
                                    <option value="">Change Role to..</option>
                                    <option value="superAdmin">Super Administrator</option>
                                    <option value="admin">Administrator</option>
                                    <option value="editor">Editor</option>
                                    <option value="author">Author</option>
                                    <option value="public">Public</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default" name="apply" value="change">Change</button>

                            <div class="table-responsive post-table">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="checkbox">
                                                    <label><input type="checkbox" value=""></label>
                                                </div>
                                                Username
                                            </th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Post</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $num = count($this->users);

                                        for ($i=0; $i < $num; $i++) {

                                            $users = $this->users;

                                            $id = $users[$i]->id;

                                            $username = $users[$i]->username;

                                            $name = $users[$i]->fullname;

                                            $email = $users[$i]->email;

                                            $role = $users[$i]->userType;

                                            $postCount = $users[$i]->postCount;
                                        ?>
                                            <tr>

                                                <td>
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="chkbox[]" value="<?php echo $id; ?>"></label>
                                                    </div>
                                                    <a href="#"><?php echo $username; ?></a> 
                                                </td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $email; ?></td>
                                                <td><?php echo $role; ?></td>
                                                <td><?php echo $postCount; ?></td>
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