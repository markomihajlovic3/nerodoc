<div class="create-topic-box">
    <form action="<?= url('forum')?>" method="POST">
        <div class="form-group">
            <label for="">Topic title</label>
            <input class="form-control" name="title" type="text" value="" placeholder="Topic title"/>
        </div>

        <div class="form-group">
            <label for="">Content</label>
            <textarea class="form-control" cols="30" id="" name="content" rows="10"></textarea>
        </div>
 
       <button type="submit" class="btn btn-default">Create</button>
    </form>
</div>

