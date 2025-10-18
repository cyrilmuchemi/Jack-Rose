<?php $this->view('admin/admin-header')?>
<?php if($action == "new"):?>
    <div class="col-md-6 mx-auto p-3">
       <?php if(!empty($errors)): ?>
            <div class="alert alert-danger text-center">
                <?= implode('<br>', $errors) ?>
            </div>
        <?php endif; ?>
        <form action="post">
        <input type="text" class="form-control mt-3" name="username" placeholder="Username">
        <input type="email" class="form-control mt-3" name="email" placeholder="Email">
        <input type="password" class="form-control mt-3" name="password" placeholder="Password">
        <button class="btn btn-primary my-4">Save</button>
    </form>
    </div>
<?php elseif($action == "edit"):?>
    edit
<?php elseif($action == "delete"):?>
    delete
<?php else:?>
 <h3 class="h3 mb-0 text-gray-800">
    Users 
    <a href="<?=ROOT?>/admin/users/new"><button class="btn btn-primary">new user</button></a>
</h3>
 <table class="table table-striped table-bordered">
    <tr>
        <th>#</th>
        <th>Username</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    <?php if(!empty($rows)): ?>
        <?php foreach($rows as $row):?>
            <tr>
                <td><?= $row->id ?></td>
                <td><?= $row->username ?></td>
                <td><?= $row->email ?></td>
                <td>
                    <button class="btn btn-primary">Edit</button>
                    <button class="btn btn-danger">Delete</button>
                </td>
            </tr>
        <?php endforeach;?>
    <?php endif;?>
 </table>
 <?php endif;?>
<?php $this->view('admin/admin-footer')?>