<div class="page-title">
	<div class="container">
		<a href="<?php echo base_url('posts/'); ?>?>">
			<h2>Posts</h2>
		</a>
	</div>
</div>

<div class="row">
	<div class="col-lg-9 col-md-12 post view-content">
		<img class="post-thumbnail" src="<?php echo site_url(); ?>uploads/<?php echo $post['post_image']; ?>">
		<h4 class="post-title"><?php echo ucfirst($post['title']); ?></h4>
		<hr class="separator">
		<div class="meta-data">
			<a href="<?= base_url(); ?>users/fetch_user/<?= $post['pid']; ?>">
				<span>
					<img src="<?php echo $post['avatar']; ?>" class="post-avatar avatar-image" alt="user profile image">
					<p><?php echo ucfirst($post['username']); ?> </p>
				</span>
			</a>
			<span>
				<ion-icon name="alarm-outline"></ion-icon>
				<p><?php echo date("M d, Y", strtotime($post['created_at'])); ?> </p>
			</span>
			<span>
				<ion-icon name="earth-outline"></ion-icon>
				<p><?php echo $post['cname']; ?></p>
			</span>
			<span>
				<ion-icon name="chatbubbles-outline"></ion-icon>
				<p><?=$counts?> </p>
			</span>
		</div>
		<p><?php echo ucfirst($post['body']); ?></p>
		<hr class="separator">
		<?php if ($this->session->userdata('user_id') == $post['id']) : ?>
			<div class="buttons">
				<a class="btn btn-primary pull-left edit" href="<?php echo base_url(); ?>posts/edit/<?php echo $post['slug']; ?>">Edit</a>
				<?php echo form_open('/posts/delete/' . $post['pid']); ?>
				<input class="btn btn-danger pull-right" type="submit" value="Delete" class="btn btn-danger">
				</form>
			</div>
			<hr class="separator">
		<?php endif; ?>
		<div id="comments" class="comment-heading">
			<h5><strong>COMMENTS <ion-icon name="chevron-down-outline"></ion-icon></strong></h5>
		</div>
		<?php if ($comments) : ?>
			<div id="comment-div">
				<?php foreach ($comments as $comment) : ?>
					<div class="comment-details">
						<div class="comment-info">
							<img src="<?php echo $comment['avatar']; ?>" class="comment-avatar avatar-image" alt="user profile image">
							<span>
								<h5><?php echo ucfirst($comment['username']); ?> &nbsp;</h5>
								<p><?php echo $comment['body']; ?></p>
							</span>
						</div>

					</div>
					<hr class="separator">
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<p>There are no comments</p>
		<?php endif; ?>
		<?php if ($this->session->userdata('logged_in')) : ?>
			<div class="comment-heading">
				<h6><strong> Add a Comment </strong></h6>
			</div>
			<?php echo validation_errors(); ?>
			<?php echo form_open('comments/create/' . $post['pid'] . '/#comments'); ?>
			<div class="form-group">
				<textarea name="body" class="md-textarea form-control comment-body" rows="1" placeholder="Write your comment here"></textarea>
			</div>
			<input type="hidden" name="slug" value="<?php echo $post['slug']; ?>">
			<button class="btn btn-primary submit-btn float-right" type="submit">Post Comment</button>
			<br>
			</form>
		<?php endif; ?>
	</div>

	<!-- People Nearby -->
	<div class="col-lg-3 col-md-12 nearby-sidebar">
		<div class="sticky-top">
			<br>
			<aside class="sidebar">
				<section class="search-bar">
					<form action="<?= base_url(); ?>users/fetch" method="post" class="form-inline">
						<input id="input-form" name="search" class="form-control mr-2 text-black search-input" type="text" placeholder="Search">
						<button class="search-button" id="search-bar-btn" type="submit">
							<ion-icon name="search-outline"></ion-icon>
						</button>
					</form>
				</section>
				<section class="people-nearby">
					<h5>People Nearby</h5>
					<div class="nearby-meta-data">
						<img src="<?php echo $post['avatar']; ?>" class="nearby-avatar avatar-image" alt="user profile image">
						<a href="<?= base_url(); ?>users/fetch_user/<?= $post['id']; ?>">
							<?php echo ucfirst($post['username']); ?>
						</a>
					</div>
					<hr class="separator">
				</section> <br>
				<section class="latest-post">
				<h5>Recent Posts</h5>
					<?php foreach($latests as $latest) : ?>
					<div class="post-data">
						<div class="post-info">
							<img class="post-thumbnail" src="<?php echo site_url(); ?>uploads/<?php echo $latest['post_image']; ?>">
							<a href="<?php echo site_url('/posts/' . $latest['slug']); ?>?>">
								<h6 class="post-title"><?php echo ucfirst($latest['title']); ?></h6>
							</a>
						</div>
						<div class="meta-data d-flex justify-content-between">
							<p class="ml-auto">
								<?php echo date("M d, Y", strtotime($latest['created_at'])) . '&nbsp;'; ?>
							</p>
							<p>/ <?=$counts?></p>
						</div>
					</div>
					<?php endforeach ?>
					<hr class="separator">
				</section>
			</aside>
		</div>

	</div>
</div>