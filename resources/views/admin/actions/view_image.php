<?php if(!empty($image)) :

$rand=rand(000,999);
?>
<!-- Button trigger modal -->
<img src="{{ $image }}" data-bs-toggle="modal" data-bs-target="#showImage{{$rand}}" style="width:25px;height:25px;cursor:pointer" />
<!-- Modal -->
<div class="modal fade" id="showImage{{$rand}}" tabindex="-1" aria-labelledby="showImageLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
            <img src="{{ $image }}" style="width:100%;height:100%;" />
            </div>
        </div>
    </div>
</div>
<?php endif;?>