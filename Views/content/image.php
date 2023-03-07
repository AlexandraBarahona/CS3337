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
                        acceptedFiles: ".jpg,.png,.gif"
                    };
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
                                <div class="col-5"><strong>Name</strong></div>
                                <div class="col-5"><strong>Type</strong></div>
                            </div>
                        </div>
                        <div class="card-data-container">
                            <?php
                            if (!empty($images)) {
                                foreach ($images as $row) {
                            ?>      
                                <div class="card-data">
                                    <div class="row pb-2">
                                        <div class="col-2"><embed src="<?php echo base_url('images/' . $row->name); ?>" type="<?php echo $row->type; ?>" width="30px" height="30px" /></div>
                                        <div class="col-5"><?php echo $row->name ?></div>
                                        <div class="col-5"><?php echo $row->type ?></div>
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

<!-- https://learnsql.com/cookbook/how-to-order-alphabetically-in-sql/ -->

<!-- https://www.codexworld.com/codeigniter-drag-and-drop-file-upload-with-dropzone/ -->

<!-- https://codeigniter.com/user_guide/database/results.html -->