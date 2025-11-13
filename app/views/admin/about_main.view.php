<?php $this->view('admin/admin-header')?>

<?php if($action == "new"):?>
<div class="col-md-8 mx-auto p-3">
    <h3 class="text-center mb-4">Add About Main Section</h3>

    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger text-center">
            <?= implode('<br>', $errors) ?>
        </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Main About Section</div>
            <div class="card-body">
                <label>Main Image:</label>
                <label class="d-block">
                    <img src="<?= get_image() ?>" id="mainImagePreview" style="width:300px;height:300px;object-fit:cover;cursor:pointer;" alt="main image">
                    <input onchange="previewImage(this, 'mainImagePreview')" type="file" name="image" hidden>
                </label>

                <div class="form-group mt-3">
                    <label>About Title:</label>
                    <input type="text" name="about_title" class="form-control" value="<?= old_value('about_title') ?>">
                </div>

                <div class="form-group mt-3">
                    <label>About Description:</label>
                    <textarea name="about_description" class="form-control" rows="5"><?= old_value('about_description') ?></textarea>
                </div>

                <div class="form-group mt-3">
                    <label>Phone (optional):</label>
                    <input type="text" name="phone" class="form-control" value="<?= old_value('phone') ?>">
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
    <h3 class="text-center mb-4">Edit About Main Section</h3>

    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger text-center">
            <?= implode('<br>', $errors) ?>
        </div>
    <?php endif; ?>

    <?php if(!empty($row)):?>
    <form method="post" enctype="multipart/form-data">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Main About Section</div>
            <div class="card-body">
                <label>Main Image:</label>
                <label class="d-block">
                    <img src="<?= get_image($row->image ?? '') ?>" id="mainImagePreview" style="width:300px;height:300px;object-fit:cover;cursor:pointer;" alt="main image">
                    <input onchange="previewImage(this, 'mainImagePreview')" type="file" name="image" hidden>
                </label>

                <div class="form-group mt-3">
                    <label>About Title:</label>
                    <input type="text" name="about_title" class="form-control" value="<?= old_value('about_title', $row->about_title ?? '') ?>">
                </div>

                <div class="form-group mt-3">
                    <label>About Description:</label>
                    <textarea name="about_description" class="form-control" rows="5"><?= old_value('about_description', $row->about_description ?? '') ?></textarea>
                </div>

                <div class="form-group mt-3">
                    <label>Phone:</label>
                    <input type="text" name="phone" class="form-control" value="<?= old_value('phone', $row->phone ?? '') ?>">
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
            <h5 class="mt-3"><?= escape($row->about_title ?? '') ?></h5>
            <button class="btn btn-danger my-4">Delete</button>
        </form>
    <?php else:?>
        <div class="alert alert-danger text-center">Record not found.</div>
    <?php endif;?>
</div>

<?php else:?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="h3 mb-0 text-gray-800">About Main Section</h3>
    <a href="<?= ROOT ?>/admin/about_main/new"><button class="btn btn-primary">Add New</button></a>
</div>

<table class="table table-striped table-bordered mt-3">
    <tr>
        <th>#</th>
        <th>Main Image</th>
        <th>Title</th>
        <th>Description</th>
        <th>Phone</th>
        <th>Action</th>
    </tr>
    <?php if(!empty($rows)): ?>
        <?php foreach($rows as $row): ?>
            <tr>
                <td><?= $row->id ?></td>
                <td><img src="<?= get_image($row->image) ?>" style="width:100px;height:100px;object-fit:cover;"></td>
                <td><?= escape($row->about_title) ?></td>
                <td><?= escape($row->about_description) ?></td>
                <td><?= escape($row->phone) ?></td>
                <td>
                    <a href="<?= ROOT ?>/admin/about_main/edit/<?= $row->id ?>"><button class="btn btn-primary btn-sm">Edit</button></a>
                    <a href="<?= ROOT ?>/admin/about_main/delete/<?= $row->id ?>"><button class="btn btn-danger btn-sm">Delete</button></a>
                </td>
            </tr>
        <?php endforeach;?>
    <?php else: ?>
        <tr><td colspan="6" class="text-center text-muted">No About Records Found</td></tr>
    <?php endif;?>
</table>
<?php endif;?>

<?php $this->view('admin/admin-footer')?>
