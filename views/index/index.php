<!--banner img-->
<div class="container-fluid" id="blog-post">

    <div class="post-heading">
        <h1 class="main">Trending News</h1>
    </div>

</div>

<!--Content-->
<div class="container" id="blog-post-container">
<?php

$num = count($this->postList);

for ($i=0; $i < $num; $i++) { 
	if ($i > 0 && $this->postList[$i]->postID == $this->postList[$i - 1]->postID) {
		continue;
	}

	$titles = explode('<br>', $this->postList[$i]->title);
	
?>
	<div class="row">
		<div class="col-lg-6 col-md-10">
			<div class="post-preview">
	            <a href="<?php echo URL ?>page/pages/<?php echo $this->postList[$i]->postID; ?>">
	                <h2 class="post-title">
	                    <?php echo $titles[0]; ?>
	                </h2>
	                <h3 class="post-subtitle">
	                    <?php echo $titles[1]; ?>
	                </h3>
	            </a>
	            <p class="post-meta">Posted by <a href="<?php echo URL ?>page/authors/<?php echo $this->postList[$i]->creatorID; ?>"><?php echo $this->getAuthor($this->postList[$i]->creatorID); ?></a> on <?php echo \formatDate($this->postList[$i]->dateAdded, true); ?></p>
	        </div>
	        <hr>
		</div>

	</div>
<?php

	}

?>
	<!-- Pager -->
	<ul id="pager" class="pager pull-right home-pager">
        <li class="next">
            <a href="#">Older Posts &rarr;</a>
        </li>
    </ul>

    <ul class="pager pull-left home-pager">
        <li class="previous">
            <a href="#">&larr; Newer Posts</a>
        </li>
    </ul>
</div>
<hr class="last">