<section class="vh-100" id="home">
    <div class="container-fluid">
        <div class="row pt-5 justify-content-center">
            <div class="col-10">
                <form action="<?php echo base_url(); ?>/VideoUpload" method="post" class="dropzone" id="videoupload">
                </form>

                <script type="text/javascript">
                    Dropzone.options.videoupload = {
                        paramName: "file",
                        maxFilesize: 1000,
                        maxFiles: 1,
                        addRemoveLinks: true,
                        dictRemoveFile: "Remove",
                        dictCancelUpload: "Cancel",
                        dictDefaultMessage: "Drop files here to upload",
                        acceptedFiles: ".mp4,.mov,.webm"
                    };
                </script>
            </div>
        </div>
            <div class="container col-8 offset-2 pt-5 pb-5">
                <div class="card">
                    <div class="card-header">
                        Video Files
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
                            if (!empty($video)) {
                                foreach ($video as $row) {
                            ?>      
                                    <div class="card-data">
                                        <div class="row pb-2">
                                            <div class="col-2"><embed src="<?php echo base_url('video/icon.png'); ?>" type="image/png" width="30px" height="30px" /></div>
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