<?php $this->view('admin/admin-header')?>
<?php if($action == "new"):?>
    <div class="col-md-6 mx-auto p-3">
       <?php if(!empty($errors)): ?>
            <div class="alert alert-danger text-center">
                <?= implode('<br>', $errors) ?>
            </div>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data" class="text-center">
            <label>
                <img src="<?=get_image()?>" style="width: 300px; height: 300px; object-fit: cover; cursor: pointer;" alt="image">
                <input onchange="display_image(this.files[0], event)" type="file" name="image">
            </label>
            <br/>
            <button class="btn btn-primary my-4">Save</button>
      </form>
      <script>
        function display_image(file, e){
            let img = e.currentTarget.parentNode.querySelector("img");
            img.src = URL.createObjectURL(file)
        }
      </script>
    </div>
<?php elseif($action == "edit"):?>
    <div class="col-md-6 mx-auto p-3">
        <?php if(!empty($errors)): ?>
                <div class="alert alert-danger text-center">
                    <?= implode('<br>', $errors) ?>
                </div>
            <?php endif; ?>
            <?php if(!empty($row)):?>
            <form method="post" enctype="multipart/form-data">
                <img src="<?=old_value($row->image)?>" style="width: 100px; height: 100px;" alt="image">
                <button class="btn btn-primary my-4">Save</button>
            </form>
            <?php else:?>
                <div class="alert alert-danger text-center">Record not found.</div>
            <?php endif;?>
    </div>
<?php elseif($action == "delete"):?>
    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger text-center">
            <?= implode('<br>', $errors) ?>
        </div>
    <?php endif; ?>
    <?php if(!empty($row)):?>
        <form method="post">
            <div class="form-control mt-3"><?=old_value('username', $row->username)?></div>
            <div class="form-control mt-3"><?=old_value('email', $row->email)?></div>
            <button class="btn btn-danger my-4">Delete</button>
        </form>
    <?php else:?>
        <div class="alert alert-danger text-center">Record not found.</div>
    <?php endif;?>
<?php else:?>
 <h3 class="h3 mb-0 text-gray-800">
    Image Gallery
    <a href="<?=ROOT?>/admin/gallery/new"><button class="btn btn-primary">new image</button></a>
</h3>
 <table class="table table-striped table-bordered mt-4">
    <tr>
        <th>#</th>
        <th>Action</th>
    </tr>
    <?php if(!empty($rows)): ?>
        <?php foreach($rows as $row):?>
            <div>
                <td><?= $row->id ?></td>
                <td><?= $row->image ?></td>
                <div>
                    <a href="<?=ROOT?>/admin/gallery/edit/<?=$row->id?>">
                        <button class="btn btn-primary">Edit</button>
                    </a>
                    <a href="<?=ROOT?>/admin/gallery/delete/<?=$row->id?>">
                        <button class="btn btn-danger">Delete</button>
                    </a>
                </div>
            </div>
        <?php endforeach;?>
    <?php endif;?>
 </table>
 <?php endif;?>
<?php $this->view('admin/admin-footer')?>