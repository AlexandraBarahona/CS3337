<section class="vh-100" id="home">
    <div class="container-fluid">
        <div class="container col-10 offset-1 pt-5 pb-10">
        <div class="card">
            <div class="card-header">
                Files related to '<?=$query?>'
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
                                    <a href="<?=base_url()?>/Download<?=$row->filetype?>?id=<?=$row->id?>"><?php echo $row->name ?></a>
                                </div>
                                <div class="col-2"><?=$row->duration?></div>
                                <div class="col-2"><?php echo $row->type ?></div>
                                <div class="col-2">
                                    <a class="btn btn-primary btn-sm" href="<?=base_url()?>/Delete<?=$row->filetype?>?id=<?=$row->id?>">Delete</a>
                                    <button class="btn btn-primary btn-sm edit-btn">Edit</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- HTML for the edit popup -->
                        <div class="edit-popup" id="edit-popup<?=$index?>">
                            <div class="edit-popup-content">
                                <div class="card">
                                    <div class="card-header">
                                        <span class="close-edit-popup">&times;</span>
                                        <div class="row">
                                            <h5>Edit File</h5>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?=base_url()?>/Edit<?=$row->filetype?>" method="post" class="form">
                                            <div class="form-group">
                                                <label for="inputName">Name</label>
                                                <input type="hidden" name="id" value="<?=$row->id?>">
                                                <input type="text" class="form-control" id="inputName" name="name" value="<?=$row->name?>" placeholder="Name">
                                                
                                                <div class="row d-flex justify-content-center"> 
                                                    <input type="submit" class="btn btn-info btn-green mt-4 mx-auto">
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

<!-- Javascript for edit popup -->
<script>
  $(document).ready(function(){
      // When the button is clicked, show the popup
      $(".edit-btn").click(function(){
        var index = $(".edit-btn").index($(this));
        console.log(index);
         $(".edit-popup").eq(index).show();
      });

      // When the close button is clicked, hide the popup
      $(".close-edit-popup").click(function(){
         $(this).closest(".edit-popup").hide();
      });
   });
</script>