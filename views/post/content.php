<!--banner img-->
<div class="container-fluid" id="blog-post">

    <div class="post-heading">
        <h1><?php echo $this->getPostContent('title'); ?></h1>
        <h2 class="subheading"><?php echo $this->getPostContent('sub-title'); ?></h2>
        <span class="meta">Posted by <a href="<?php echo URL ?>page/authors/<?php echo $this->post->creatorID; ?>"><?php echo $this->getPostContent('author'); ?></a>, on <?php echo $this->getPostContent('date'); ?></span>
    </div>

</div>

<!-- Post Content -->
<article>
    <div class="container">

        <?php

        echo $this->getPostContent('content');

        ?>
        
    </div>
</article>