<section class="vh-100" id="home">
    <div class="container-fluid">
        <div class="row pt-5 justify-content-center">
            <div class="col-10">
                <form action="<?php echo base_url(); ?>/ImageUpload" method="post" class="dropzone" id="imageupload">
                </form>
            </div>
        </div>

        <div class="col-10 offset-1 pt-5 pb-5">
            <div class="card">
                <div class="card-header">
                    Image Files
                </div>
                <div class="card-body">
                    <div class="card-title">
                        <div class="row border-bottom pb-2">
                            <div class="col-1"><strong>Icon</strong></div>
                            <div class="col-5"><strong>Name</strong></div>
                            <div class="col-4"><strong>Type</strong></div>
                        </div>
                    </div>
                    <div class="card-data-container">
                        <?php
                        if (!empty($images)) {
                            foreach ($images as $index => $row) {
                        ?>      
                            <div class="card-data">
                                <div class="row pb-2">
                                    <div class="col-1"><embed src="<?php echo base_url('public/images/' . $row->caption); ?>" type="<?php echo $row->type; ?>" width="30px" height="30px" style="object-fit: contain;"/></div>
                                    <div class="col-5">
                                        <a class="show-media link-primary" href="#" id="<?=$index?>"><?= htmlspecialchars($row->name) ?></a>
                                    </div>
                                    <div class="col-4"><?php echo $row->type ?></div>
                                    <div class="col-2">
                                        <a class="btn btn-primary btn-sm del-btn" href="<?=base_url('Image/delete/'.$row->id)?>">Delete</a>
                                        <button class="btn btn-primary btn-sm edit-btn">Edit</button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- HTML for the image popup -->
                            <div class="media-popup" id="media-popup-<?=$index?>">
                                <div class="media-popup-content">
                                    <div class="card">
                                        <div class="card-header">
                                        <span class="close-popup"  >&times;</span>
                                            <div class="row">
                                                <h5><?=htmlspecialchars($row->name)?></h5>
                                            </div>
                                        </div>
                                        <div class="card-body" style="max-height: 60%">
                                            <div class="embed-responsive">
                                                <img class="media" src="public/images/<?=$row->caption?>">
                                            </div>
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
                                                <h5>Edit Image</h5>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form action="<?=base_url('EditImage')?>" method="post" class="form">
                                                <div class="form-group">
                                                    <label for="inputName">Name</label>
                                                    <input type="hidden" name="id" value="<?=$row->id?>">
                                                    <input type="text" class="form-control mb-2 field" id="inputName" name="name" value="<?=htmlspecialchars($row->name)?>" placeholder="Name">
                                                    
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
 
