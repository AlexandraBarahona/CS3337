<section class="vh-100" id="home">
    <div class="container-fluid">
    <?php
        $index = 0;
        $files = [$images, $audio, $videos];
        $type = ['Image', 'Audio', 'Video'];
        for($i = 0; $i < 3; $i++) { ?>
        <div class="row pt-5 <?php if($type[$i] == 'Video') echo 'mb-5'?>">
            <div class="col-10 offset-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <?php if($i == 0) {?>
                            <div class="col px-2">Last 10 Updated/Added Images</div>
                            <?php } else if($i == 1) {?>
                            <div class="col px-2">Last 10 Updated/Added Audio Files</div>
                            <?php } else {?>
                            <div class="col px-2">Last 10 Updated/Added Videos</div>
                            <?php }?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <div class="row border-bottom pb-2">
                                <?php if($i == 0) {?>
                                <div class="col-1"><strong>Icon</strong></div>
                                <div class="col-5"><strong>Name</strong></div>
                                <div class="col-4"><strong>Type</strong></div>
                                <?php } else {?>
                                <div class="col-1"><strong>Icon</strong></div>
                                <div class="col-5"><strong>Name</strong></div>
                                <div class="col-2"><strong>Duration</strong></div>
                                <div class="col-2"><strong>Type</strong></div>
                                <?php }?>
                            </div>
                        </div>
                        <div class="card-data-container">
                            <?php
                            if (!empty($files[$i])) {
                                foreach ($files[$i] as $row) {
                                    if($i == 0) {
                            ?>      
                                    <div class="card-data">
                                        <div class="row pb-2">
                                            <div class="col-1"><embed src="<?php echo base_url('public/images/' . $row->caption); ?>" type="image/png" width="30px" height="30px" /></div>
                                            <div class="col-5">
                                                <a class="show-media link-primary" href="#" id="<?=$index?>"><?= htmlspecialchars($row->name) ?></a>
                                            </div>
                                            <div class="col-4"><?php echo $row->type ?></div>
                                            <div class="col-2">
                                                <a class="btn btn-sm btn-primary" href="<?=base_url('/Image/delete/'.$row->id)?>">Delete</a>
                                                <button class="btn btn-sm btn-primary edit-btn">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } else { 
                                        ?> 
                                    <div class="card-data">
                                        <div class="row pb-2">
                                            <div class="col-1">
                                                <embed src="<?php echo base_url('public/'. strtolower($type[$i]) . '/icon.png'); ?>" type="image/png" width="30px" height="30px" />
                                            </div>
                                            <div class="col-5">
                                                <a class="show-media link-primary" id="<?=$index?>" href="#"><?= htmlspecialchars($row->name) ?></a>
                                            </div>
                                            <div class="col-2"><?=$row->duration?></div>
                                            <div class="col-2"><?php echo $row->type ?></div>
                                            <div class="col-2">
                                                <a class="btn btn-sm btn-primary" href="<?=base_url('/'.$type[$i].'/delete/'.$row->id)?>">Delete</a>
                                                <button class="btn btn-sm btn-primary edit-btn">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <!-- HTML for the media popup -->
                                    <div class="media-popup" id="media-popup-<?=$index?>">
                                        <div class="media-popup-content">
                                            <div class="card">
                                                <div class="card-header">
                                                <span class="close-popup"  index="<?=$index?>">&times;</span>
                                                    <div class="row">
                                                        <h5><?=htmlspecialchars($row->name)?></h5>
                                                    </div>
                                                </div>
                                                <div class="card-body" style="max-height: 60%">
                                                    <?php if($type[$i] == 'Image'){ ?>
                                                    <div class="embed-responsive">
                                                        <img class="media" id="media<?=$index?>" src="public/images/<?=$row->caption?>">
                                                    </div>
                                                    <?php }
                                                    if($type[$i] == 'Audio') {?>
                                                        <audio class="w-100" id="media<?=$index?>" controls><source src="public/audio/<?=$row->caption?>" type="<?=$row->type?>"></audio>
                                                    <?php }
                                                    if($type[$i] == 'Video') {?>
                                                        <div class="embed-responsive">
                                                            <video class="media" id="media<?=$index?>" controls><source src="public/video/<?=$row->caption?>" type="<?=$row->type?>"></video>
                                                        </div>
                                                    <?php } ?>
                                                    <hr>
                                                    <h5>Description:</h5>
                                                    <pre><?=htmlspecialchars($row->note)?></pre>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 

                                     <!-- HTML for the edit popup -->
                                    <div class="edit-popup" id="edit-popup<?=$index?>">
                                        <div class="edit-popup-content">
                                            <div class="card">
                                                <div class="card-header">
                                                    <span class="close-popup">&times;</span>
                                                    <div class="row">
                                                        <h5>Edit <?=$type[$i]?></h5>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <form action="<?=base_url('Edit'.$type[$i])?>" method="post" class="form">
                                                        <div class="form-group">
                                                            <label for="inputName">Name</label>
                                                            <input type="hidden" name="id" value="<?=$row->id?>">
                                                            <input type="text" class="form-control field mb-2" id="inputName" name="name" value="<?=htmlspecialchars($row->name)?>" placeholder="Name">
                                                            
                                                            <label for="inputNote">Description</label>
                                                            <textarea class="form-control w-100 note" id="inputNote" name="note" wrap="hard" placeholder="Description"><?=htmlspecialchars($row->note)?></textarea>

                                                            <div class="row d-flex justify-content-center"> 
                                                                <input type="submit" value="Save" class="btn btn-info btn-green mt-4 mx-auto">
                                                            </div>  
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                $index++;
                                }
                            } else {
                                ?>
                                <p>No file(s) found...</p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }?>
    </div>
</section>


