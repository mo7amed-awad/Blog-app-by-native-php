<?php if( !empty($url)) :

$rand=rand(000,999);
?>
<!-- Button trigger modal -->
 <a href="#" data-bs-toggle="modal" data-bs-target="#deleteForm<?php echo $rand; ?>" >
    <i class="fa fa-trash"></i>
 </a>
<!-- Modal -->
<div class="modal fade" id="deleteForm<?php echo $rand; ?>" tabindex="-1" aria-labelledby="deleteFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <form action="<?php echo $url; ?>" method="post">
                    <input type="hidden" name="_method" value="post">
                    <div class="alert alert-danger">
                        <h5><?php echo  trans('admin.delete_message') ; ?></h5>
                    </div>
                    <button type="submit" class="btn btn-danger"><?php echo  trans('admin.delete'); ?></button>
                    <a href="javascript;" data-bs-dismiss="modal" class="btn btn-success"><?php echo  trans('admin.cancel'); ?></a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif;?>