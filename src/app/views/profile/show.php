<div class="profile-wrapper">
    <!-- Image of the user -->
    <div class="left-side">
	<h4><?= $user->name?></h4>
	<img alt="" src="<?= url("users/{$user->username}/{$user->profile_image}")?>"/>


	<?php if($editable): ?>
	<label for="file-upload">
	    <span><i class="fa fa-user-circle" aria-hidden="true"></i> Change picture</span>

	    <form action="<?= url('profile/'. $user->username . '/upload')?>" method="POST"" id="picture-form" enctype="multipart/form-data">
		<input class="image-upload" name="picture" id="file-upload" type="file" value="Upload picture"/>
	    </form>
	</label>
	<?php endif; ?>
    </div>

    <!-- Information -->
    <div class="right-side">
	<!-- Show the profile information, add editable stuff -->
	<div class="profile-info">
	    <h3><i class="fa fa-address-card" aria-hidden="true"></i> Profile information</h3>

	    <?php if($editable): ?>
	    <h4 data-username ="<?= $user->username; ?>" data-field="username" data-value="<?= $user->username; ?>">Username  
		<span class="info-text username"> <?= $user->username ?></span> 
	    </h4>
	    <?php endif; ?>

	    <h4 data-username ="<?= $user->username; ?>" data-field="name" data-value="<?= $user->name; ?>">Name 
		<?php if($editable): ?><i class="fa fa-pencil" aria-hidden="true"></i><?php endif; ?>		
		<span class="info-text"> <?= $user->name; ?></span> 
	    </h4>

	    <h4 data-username ="<?= $user->username; ?>" data-field="city" data-value="<?= $user->city?>">City 
		<?php if($editable): ?><i class="fa fa-pencil" aria-hidden="true"></i><?php endif; ?>
		<span class="info-text"> <?= $user->city; ?></span> 
	    </h4>

	    <h4 data-username ="<?= $user->username; ?>" data-field="email" data-value="<?= $user->email; ?>">Email 
		<?php if($editable): ?><i class="fa fa-pencil" aria-hidden="true"></i><?php endif; ?>
		<span class="info-text"> <?= $user->email?></span> 
	    </h4>
	</div>

	<!-- Show topics by the user -->
	<div class="topics-started">
	    <?php if(count($user->topics())): ?>
		<h3>Topics started by <?= $user->name; ?></h3>
		<ul class="list-group">
		<?php foreach($user->topics() as $topic): ?>
		    <li class="list-group-item">
			<a href="<?= url('forum/topics/'. $topic->id)?>"> <?= $topic->title; ?>
			    <span class="badge"><?= $topic->numberOfPosts(); ?></span>
			</a>
		    </li>
		<?php endforeach; ?>
		</ul>
	    <?php else: ?>
		<h3>No topics started by user</h3>
	    <?php endif; ?>
	</div>
    </div>
</div>
