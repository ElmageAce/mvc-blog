<!--banner img-->
<div class="container-fluid" id="blog-post">

    <div class="post-heading">
        <h1 class="main"><?php echo $this->authorData->displayName;; ?></h1>
    </div>

</div>

<!-- Post Content -->
<article>
    <div class="container">
        <div class="avatar">
            
        </div>
        <h4><?php echo $this->authorData->userType; ?></h4>
        <div class="bio">
            <h5><?php echo $this->authorData->fullname; ?></h5>

            <p>User <?php echo $this->authorData->bio; ?></p>
            <p>Contact: <?php echo $this->authorData->email; ?></p>
            <hr>
        </div>
        
        
    </div>
</article>