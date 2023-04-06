<section class="vh-100" id="home">
    <div class="container-fluid">
        <div class="row pt-5 justify-content-center">
            <div class="col-10">
                <form action="<?php echo base_url(); ?>/ImageUpload" method="post" class="dropzone" id="imageupload">
                </form>

                <script type="text/javascript">
                    Dropzone.options.imageupload = {
                        paramName: "file",
                        maxFilesize: 25,
                        maxFiles: 1,
                        addRemoveLinks: true,
                        dictRemoveFile: "Remove",
                        dictCancelUpload: "Cancel",
                        dictDefaultMessage: "Drop files here to upload",
                        acceptedFiles: ".jpg,.png,.gif",
                        init: function () {
                        this.on("success", function (file) {
                            location.reload();});},
                    }
                </script>
            </div>
        </div>


        <div class="container col-8 offset-2 pt-5 pb-5">
            <div class="card">
                <div class="card-header">
                    Image Files
                </div>
                <div class="card-body">
                    <div class="card-title">
                        <div class="row border-bottom pb-2">
                            <div class="col-2"><strong>Icon</strong></div>
                            <div class="col-4"><strong>Name</strong></div>
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
                                    <div class="col-2"><embed src="<?php echo base_url('public/images/' . $row->caption); ?>" type="<?php echo $row->type; ?>" width="30px" height="30px" /></div>
                                    <div class="col-4">
                                        <a href="<?=base_url()?>/DownloadImage?id=<?=$row->id?>"><?php echo $row->name ?></a>
                                    </div>
                                    <div class="col-4"><?php echo $row->type ?></div>
                                    <div class="col-2">
                                        <a href="<?=base_url()?>/DeleteImage?id=<?=$row->id?>">Delete</a>
                                        <button class="edit-btn">Edit</button>
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
                                                <h5>Edit Image</h5>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form action="<?=base_url('EditImage')?>" method="post" class="form">
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
