<div class="content-wrapper">
    <div class="forum-index">
        <div class="forum-menu">
            <form class="form-inline new-topic-form" action="<?= url('forum')?>" method="POST">
                <label for=""><i class="fa fa-comments" aria-hidden="true"></i> Hello <?= container('Auth')->user()->name; ?>! Would you like to create a new </label>
                <div class="form-group">
                    <input class="form-control" name="title" type="text" value="" placeholder="Topic"/>
                </div>

                <button class="btn btn-default">Create</button>
            </form>
        </div>

        <div class="forum-topics">
            <h3>Current topics</h3>
            <ul class="list-group">
                <?php foreach($topics as $topic): ?>
                    <li class="list-group-item">
			<span class="badge"><?= $topic->numberOfPosts(); ?></span>
                        <a href="<?= url('forum/topics/' . $topic->id);?>"><?= $topic->title?> <span class="list-topic-date">Asked by <?= $topic->user()->name;?> on <?= date('j F Y', $topic->created_at); ?></span></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
