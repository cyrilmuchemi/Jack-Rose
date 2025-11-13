<?php $this->view('admin/admin-header')?>

<?php if($action == "new"):?>
<div class="col-md-8 mx-auto p-3">
    <h3 class="text-center mb-4">Add About Person</h3>

    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger text-center">
            <?= implode('<br>', $errors) ?>
        </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">Person Information</div>
            <div class="card-body">
                <label>Person Image:</label>
                <label class="d-block">
                    <img src="<?= get_image() ?>" id="personImagePreview" style="width:200px;height:200px;object-fit:cover;cursor:pointer;" alt="person image">
                    <input onchange="previewImage(this, 'personImagePreview')" type="file" name="image" hidden>
                </label>

                <div class="form-group mt-3">
                    <label>Person Name:</label>
                    <input type="text" name="name" class="form-control" value="<?= old_value('name') ?>">
                </div>

                <div class="form-group mt-3">
                    <label>Role (e.g. Bride/Groom):</label>
                    <input type="text" name="role" class="form-control" value="<?= old_value('role') ?>">
                </div>

                <div class="form-group mt-3">
                    <label>Person Description:</label>
                    <textarea name="person_description" class="form-control" rows="4"><?= old_value('person_description') ?></textarea>
                </div>

                <div class="form-group mt-3">
                    <label>Twitter Link:</label>
                    <input type="text" name="twitter_link" class="form-control" value="<?= old_value('twitter_link') ?>">
                </div>

                <div class="form-group mt-3">
                    <label>Facebook Link:</label>
                    <input type="text" name="facebook_link" class="form-control" value="<?= old_value('facebook_link') ?>">
                </div>

                <div class="form-group mt-3">
                    <label>Instagram Link:</label>
                    <input type="text" name="instagram_link" class="form-control" value="<?= old_value('instagram_link') ?>">
                </div>

                <div class="form-group mt-3">
                    <label>LinkedIn Link:</label>
                    <input type="text" name="linkedin_link" class="form-control" value="<?= old_value('linkedin_link') ?>">
                </div>
            </div>
        </div>

        <button class="btn btn-primary my-4 w-100">Save</button>
    </form>
</div>

<script>
function previewImage(input, imgId){
    const img = document.getElementById(imgId);
    if(input.files && input.files[0]){
        img.src = URL.createObjectURL(input.files[0]);
    }
}
</script>

<?php elseif($action == "edit"):?>
<div class="col-md-8 mx-auto p-3">
    <h3 class="text-center mb-4">Edit About Person</h3>

    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger text-center">
            <?= implode('<br>', $errors) ?>
        </div>
    <?php endif; ?>

    <?php if(!empty($row)):?>
    <form method="post" enctype="multipart/form-data">
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">Person Information</div>
            <div class="card-body">
                <label>Person Image:</label>
                <label class="d-block">
                    <img src="<?= get_image($row->image ?? '') ?>" id="personImagePreview" style="width:200px;height:200px;object-fit:cover;cursor:pointer;" alt="person image">
                    <input onchange="previewImage(this, 'personImagePreview')" type="file" name="image" hidden>
                </label>

                <div class="form-group mt-3">
                    <label>Person Name:</label>
                    <input type="text" name="name" class="form-control" value="<?= old_value('name', $row->name ?? '') ?>">
                </div>

                <div class="form-group mt-3">
                    <label>Role (e.g. Bride/Groom):</label>
                    <input type="text" name="role" class="form-control" value="<?= old_value('role', $row->role ?? '') ?>">
                </div>

                <div class="form-group mt-3">
                    <label>Person Description:</label>
                    <textarea name="person_description" class="form-control" rows="4"><?= old_value('person_description', $row->person_description ?? '') ?></textarea>
                </div>

                <div class="form-group mt-3">
                    <label>Twitter Link:</label>
                    <input type="text" name="twitter_link" class="form-control" value="<?= old_value('twitter_link', $row->twitter_link ?? '') ?>">
                </div>

                <div class="form-group mt-3">
                    <label>Facebook Link:</label>
                    <input type="text" name="facebook_link" class="form-control" value="<?= old_value('facebook_link', $row->facebook_link ?? '') ?>">
                </div>

                <div class="form-group mt-3">
                    <label>Instagram Link:</label>
                    <input type="text" name="instagram_link" class="form-control" value="<?= old_value('instagram_link', $row->instagram_link ?? '') ?>">
                </div>

                <div class="form-group mt-3">
                    <label>LinkedIn Link:</label>
                    <input type="text" name="linkedin_link" class="form-control" value="<?= old_value('linkedin_link', $row->linkedin_link ?? '') ?>">
                </div>
            </div>
        </div>

        <button class="btn btn-primary my-4 w-100">Update</button>
    </form>
    <?php else:?>
        <div class="alert alert-danger text-center">Record not found.</div>
    <?php endif;?>
</div>

<?php elseif($action == "delete"):?>
<div class="col-md-6 mx-auto text-center p-3">
    <?php if(!empty($row)):?>
        <div class="alert alert-warning">Are you sure you want to delete this record?</div>
        <form method="post">
            <img src="<?= get_image($row->image ?? '') ?>" style="width:250px;height:250px;object-fit:cover;">
            <h5 class="mt-3"><?= escape($row->name ?? '') ?></h5>
            <button class="btn btn-danger my-4">Delete</button>
        </form>
    <?php else:?>
        <div class="alert alert-danger text-center">Record not found.</div>
    <?php endif;?>
</div>

<?php else:?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="h3 mb-0 text-gray-800">About People Section</h3>
    <a href="<?= ROOT ?>/admin/about_people/new"><button class="btn btn-primary">Add New</button></a>
</div>

<table class="table table-striped table-bordered mt-3">
    <tr>
        <th>#</th>
        <th>Image</th>
        <th>Name</th>
        <th>Role</th>
        <th>Description</th>
        <th>Social Links</th>
        <th>Action</th>
    </tr>
    <?php if(!empty($rows)): ?>
        <?php foreach($rows as $row): ?>
            <tr>
                <td><?= $row->id ?></td>
                <td><img src="<?= get_image($row->image) ?>" style="width:100px;height:100px;object-fit:cover;"></td>
                <td><?= escape($row->name) ?></td>
                <td><?= escape($row->role) ?></td>
                <td><?= escape($row->person_description) ?></td>
                <td>
                    <?php if($row->twitter_link): ?><a href="<?= $row->twitter_link ?>" target="_blank">Twitter</a><br><?php endif; ?>
                    <?php if($row->facebook_link): ?><a href="<?= $row->facebook_link ?>" target="_blank">Facebook</a><br><?php endif; ?>
                    <?php if($row->instagram_link): ?><a href="<?= $row->instagram_link ?>" target="_blank">Instagram</a><br><?php endif; ?>
                    <?php if($row->linkedin_link): ?><a href="<?= $row->linkedin_link ?>" target="_blank">LinkedIn</a><?php endif; ?>
                </td>
                <td>
                    <a href="<?= ROOT ?>/admin/about_people/edit/<?= $row->id ?>"><button class="btn btn-primary btn-sm">Edit</button></a>
                    <a href="<?= ROOT ?>/admin/about_people/delete/<?= $row->id ?>"><button class="btn btn-danger btn-sm">Delete</button></a>
                </td>
            </tr>
        <?php endforeach;?>
    <?php else: ?>
        <tr><td colspan="7" class="text-center text-muted">No People Added Yet</td></tr>
    <?php endif;?>
</table>
<?php endif;?>

<?php $this->view('admin/admin-footer')?>
