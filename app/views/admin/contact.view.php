<?php $this->view('admin/admin-header')?>
<?php if($action == "edit"):?>
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
<?php else:?>
 <h3 class="h3 mb-0 text-gray-800">Contact</h3>
 <table class="table table-striped table-bordered mt-4">
    
    <?php if(!empty($rows)): ?>
        <?php foreach($rows as $row):?>
            <tr>
                <th>Twitter:</th><td><?= $row->id ?></td>
                <th>Facebook:</th>
                <th>Instagram:</th>
                <th>LinkedIn:</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
                <td>
                    <a href="<?=ROOT?>/admin/contact/edit<?=$row->id?>">
                        <button class="btn btn-primary">Edit</button>
                    </a>
                </td>
            </tr>  
        <?php endforeach;?>
    <?php endif;?>
 </table>
 <?php endif;?>
<?php $this->view('admin/admin-footer')?>