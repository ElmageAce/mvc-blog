<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="<?php echo URL; ?>dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="<?php echo URL; ?>dashboard/pages/posts"><i class="fa fa-fw fa-pencil"></i>Posts</a>
                    </li>
                <?php
                    if (true) {
                ?>
                    <li>
                        <a href="<?php echo URL; ?>dashboard/pages/users"><i class="fa fa-fw fa-users"></i>Users</a>
                    </li>
                <?php
                    }
                ?>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Profile <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="<?php echo URL; ?>dashboard/pages/profile">Your Profile</a>
                            </li>

                        <?php
                            if (true) {
                        ?>
                            <li>
                                <a href="">Add User</a>
                            </li>
                        <?php
                            }
                        ?>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-edit"></i> Pages</a>
                    </li>
                    <li>
                        <a href="<?php echo URL; ?>dashboard/pages/comments"><i class="fa fa-fw fa-comment"></i> Comments</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-file"></i> Media</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-wrench"></i> Tools</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-dashboard"></i> Settings</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>