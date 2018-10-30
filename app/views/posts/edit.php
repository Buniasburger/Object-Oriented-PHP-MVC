<?php require_once APPROOT . '/views/inc/header.php' ?>
<a href="<?php echo URLROOT ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light mt-5">
    <?php flash() ?>
    <h2>Edit Post</h2>
    <p>Edit a post with this form</p>
    <form action="<?php echo URLROOT ?>/posts/edit/<?php echo $data['id'] ?>" method="post">
        <div class="form-group">
            <label for="title">Title: <sup>*</sup></label>
            <input type="text" name="title"
                   class="form-control form-control-lg <?php echo !empty($data['title_error']) ? 'is-invalid' : '' ?>"
                   value="<?php echo $data['title'] ?>"/>
            <span class="invalid-feedback"><?php echo $data['title_error'] ?></span>
        </div>
        <div class="form-group">
            <label for="body">Body: <sup>*</sup></label>
            <textarea name="body"
                      class="form-control form-control-lg <?php echo !empty($data['body_error']) ? 'is-invalid' : '' ?>"/>
            <?php echo $data['body'] ?> </textarea>
            <span class="invalid-feedback"><?php echo $data['body_error'] ?></span>

        </div>
        <div class="row">
            <div class="col-6">
                <input type="submit" value="Edit Post" class="btn btn-success btn-block"/>
            </div>
            <div class="col-6">
                <a href="<?php echo URLROOT ?>/users/register" class="btn btn-light btn-block">No account? Register</a>
            </div>
        </div>
    </form>
</div>
<?php require_once APPROOT . '/views/inc/footer.php' ?>