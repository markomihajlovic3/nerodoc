<div class="content-wrapper">
    <div class="topic-show">
        <h3><i class="fa fa-comments" aria-hidden="true"></i>  <?= $topic->title; ?></h3>

        <!-- Let's show all the posts -->
        <?php foreach($topic->posts() as $post): ?>
            <div class="post">
                <div class="post-header">
		    <img alt="" src="<?= url("users/" .$post->user()->username . "/" .$post->user()->profile_image)?>"/>
                    <a href="<?= url('profile/'. $post->user()->username)?>"><?= $post->user()->name; ?></a> <span>on <?= date('j. F Y', $post->created_at);?></span>
                </div>

                <div class="post-body">
                    <?= nl2br($post->content); ?>
                </div>
            </div>
        <?php endforeach; ?>
        

        <hr/>

        <!-- Form for adding a new post -->
        <form action="<?= url('forum/topics/' . $topic->id);?>" method="POST">
            <div class="form-group">
                <label for="">Your post</label>
                <textarea class="form-control" cols="30" id="" name="content" rows="10"></textarea>
            </div>

            <button class="btn btn-default">Post</button>
        </form>
    </div>
</div>

