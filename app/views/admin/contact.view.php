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
                <label>Twitter link:</label>
                <input value="<?=old_value('twitter_link', $row->twitter_link)?>" type="text" class="form-control mb-3" name="twitter_link" placeholder="Twitter Link">
            </form>
            <?php else:?>
                <div class="alert alert-danger text-center">Record not found.</div>
            <?php endif;?>
    </div>
<?php else:?>
 <h3 class="h3 mb-0 text-gray-800">Contact Info Links</h3>
 <table class="table table-striped table-bordered mt-4">
    
    <?php if(!empty($rows)): ?>
        <?php foreach($rows as $row):?>
            <tr><th>Twitter:</th><td><?= $row->twitter_link ?></td></tr>
            <tr><th>Facebook:</th><td><?= $row->facebook_link ?></td></tr>
            <tr><th>Instagram:</th><td><?= $row->instagram_link ?></td></tr>
            <tr><th>LinkedIn:</th><td><?= $row->linkedin_link ?></td></tr>
            <tr><th>Email:</th><td><?= $row->email ?></td></tr>
            <tr><th>Phone:</th><td><?= $row->phone ?></td></tr>
            <th>Action</th>
            <td>
                <a href="<?=ROOT?>/admin/contact/edit/<?=$row->id?>">
                    <button class="btn btn-primary">Edit</button>
                </a>
            </td>
            </tr>  
        <?php endforeach;?>
    <?php endif;?>
 </table>
 <?php endif;?>
<?php $this->view('admin/admin-footer')?>