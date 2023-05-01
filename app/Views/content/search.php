<section class="vh-100" id="home">
    <div class="container-fluid">
        <div class="container col-10 offset-1 pt-5 pb-10">
        <div class="card">
            <div class="card-header">
                Files related to '<?=htmlspecialchars($query)?>'
            </div>
            <div class="card-body">
                <div class="card-title">
                    <div class="row border-bottom pb-2">
                        <div class="col-1"><strong>Icon</strong></div>
                        <div class="col-5"><strong>Name</strong></div>
                        <div class="col-2"><strong>Duration</strong></div>
                        <div class="col-2"><strong>Type</strong></div>
                    </div>
                </div>
                <div class="card-data-container">
                    <?php
                    if (!empty($files)) {
                        $fileData = [];

                        foreach ($files as $index => $row) {
                            if($row->filetype == 'Image') {
                                $fileData['icon'] = base_url('public/images/' . $row->caption);
                                $fileData['iconType'] = $row->type;  
                            }
                            else {
                                $fileData['icon'] = ($row->filetype == 'Audio') ? base_url('public/audio/icon.png') : base_url('public/video/icon.png');
                                $fileData['iconType'] = 'image/png'; 
                            }
                    ?>      
                        <div class="card-data">
                            <div class="row pb-2">
                                <div class="col-1"><embed src="<?=$fileData['icon']?>" type="<?=$fileData['iconType']?>" width="30px" height="30px" /></div>
                                <div class="col-5">
                                    <a class="show-media link-primary" href="#" id="<?=$index?>"><?=htmlspecialchars($row->name) ?></a>
                                </div>
                                <div class="col-2"><?=$row->duration?></div>
                                <div class="col-2"><?php echo $row->type ?></div>
                                <div class="col-2">
                                    <a class="btn btn-primary btn-sm" href="<?=base_url($row->filetype)?>/delete/<?=$row->id?>">Delete</a>
                                    <button class="btn btn-primary btn-sm edit-btn">Edit</button>
                                </div>
                            </div>
                        </div>


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
                                        <?php if($row->filetype == 'Image'){ ?>
                                        <div class="embed-responsive">
                                            <img class="media" id="media<?=$index?>" src="public/images/<?=$row->caption?>">
                                        </div>
                                         <?php }
                                         if($row->filetype == 'Audio') {?>
                                            <audio class="w-100" id="media<?=$index?>" controls><source src="public/audio/<?=$row->caption?>" type="<?=$row->type?>"></audio>
                                         <?php }
                                         if($row->filetype == 'Video') {?>
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
                                        <span class="close-popup" index="<?=$index?>">&times;</span>
                                        <div class="row">
                                            <h5>Edit File</h5>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?=base_url()?>/Edit<?=$row->filetype?>" method="post" class="form">
                                            <div class="form-group">
                                                <label for="inputName">Name</label>
                                                <input type="hidden" name="id" value="<?=$row->id?>">
                                                <input type="text" class="form-control field" id="inputName" name="name" value="<?=htmlspecialchars($row->name)?>" placeholder="Name">
                                                
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
</section>

