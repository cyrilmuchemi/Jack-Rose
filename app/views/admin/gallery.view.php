<?php $this->view('admin/admin-header')?>
<?php if($action == "new"):?>
    <div class="col-md-6 mx-auto p-3">
       <?php if(!empty($errors)): ?>
            <div class="alert alert-danger text-center">
                <?= implode('<br>', $errors) ?>
            </div>
        <?php endif; ?>
        <form method="post">
        <input value="<?=old_value('username')?>" type="text" class="form-control mt-3" name="username" placeholder="Username">
        <input value="<?=old_value('email')?>" type="email" class="form-control mt-3" name="email" placeholder="Email">
        <input value="<?=old_value('password')?>" type="password" class="form-control mt-3" name="password" placeholder="Password">
        <button class="btn btn-primary my-4">Save</button>
    </form>
    </div>
<?php elseif($action == "edit"):?>
    <div class="col-md-6 mx-auto p-3">
        <?php if(!empty($errors)): ?>
                <div class="alert alert-danger text-center">
                    <?= implode('<br>', $errors) ?>
                </div>
            <?php endif; ?>
            <?php if(!empty($row)):?>
            <form method="post">
                <input value="<?=old_value('username', $row->username)?>" type="text" class="form-control mt-3" name="username" placeholder="Username">
                <input value="<?=old_value('email', $row->email)?>" type="email" class="form-control mt-3" name="email" placeholder="Email">
                <input value="<?=old_value('password')?>" type="password" class="form-control mt-3" name="password" placeholder="Password (Leave empty to keep old password)">
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
    <a href="<?=ROOT?>/admin/users/new"><button class="btn btn-primary">new user</button></a>
</h3>
 <table class="table table-striped table-bordered mt-4">
    <tr>
        <th>#</th>
        <th>Username</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    <?php if(!empty($rows)): ?>
        <?php foreach($rows as $row):?>
            <div>
                <td><?= $row->id ?></td>
                <td><?= $row->image ?></td>
                <div>
                    <a href="<?=ROOT?>/admin/users/edit/<?=$row->id?>">
                        <button class="btn btn-primary">Edit</button>
                    </a>
                    <a href="<?=ROOT?>/admin/users/delete/<?=$row->id?>">
                        <button class="btn btn-danger">Delete</button>
                    </a>
                </div>
            </div>
        <?php endforeach;?>
    <?php endif;?>
 </table>
 <?php endif;?>
<?php $this->view('admin/admin-footer')?>