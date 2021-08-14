	<?php 
		include 'models/functions/functions.php';
		$cats = get_categories();
		//print_r($cats); 
		$limit =  isset($_GET['limit'])? $_GET['limit'] : 0;
		$posts = get_posts($limit);
		//print_r($posts);
	?>
	<div id="sort-content">
		<ul id="sort-ul">
		<li><a href="#" class="reset">All</a></li>
		<?php 
			foreach($cats as $cat) :
		?>		
			<li><a href="#" class="sort_posts" data-order="<?= $cat->category_id; ?>"><?= $cat->category_name; ?></a></li>
			<?php endforeach; ?>

		<li><a href="#" class="order_posts" data-order="desc">Newest</a></li>
		<li><a href="#" class="order_posts" data-order="asc">Oldest</a></li>
			<!-- categories area -->

		</ul>
	</div>
	<div class="main-content">
		<div id="main-post-area">
		
		<?php
			foreach($posts as $post):
				$newDate = date("d-m-Y", strtotime($post->post_date));
        ?>
			<div class="post-row">
				<div class="blog-post">
					
					<div class="blog-post-inner">
						<a href="#" class="post-about">	
							<div class="post-member">
								<img src="assets/img/user_images/<?= $post->avatar_img ?>" alt="avatar-image">
								<span class="post-user"><?= $post->username ?></span>
								<span class="acc-role"><?= $post->role_name ?></span>
							</div>
						</a>
						<div class="post-content">
							<h2 class="blog-post-title"><?= $post->title ?></h2>
							<p><?= $post->content ?></p>
							<p><a href="index.php?page=post&post_id=<?= $post->post_id ?>" class="">Continue reading...</a></p>
						</div>
					</div>
					<div class="post-date">
						<i class="fa fa-clock-o" aria-hidden="true"></i>
						<?= $newDate; ?>
						
						
					</div>
				</div>
			</div>

			<?php endforeach;?>

			<!-- post area -->

		</div>
	</div>
	<div class="container">
		<div class="page-pag">
			<ul id="pag-list">
			<?php
				$num_of_posts = get_pagination_count();
				for($i = 0; $i < $num_of_posts; $i++):
			?>
				<li><a href="#" class="post-pag" data-limit="<?= $i ?>"><?= $i+1 ?></a></li>
				<?php endfor; ?>
			</ul>
		</div>
	</div>
</div>