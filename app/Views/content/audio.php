<section id="home">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto ">
                <li class="nav-item">
                    <a class="nav-link" href="/home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/image">Image</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-dark" href="/audioPage">Audio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="videoPage">Video</a>
                </li>
            </ul>
        </div>
        <a class="nav-item mr-3 nav-link px-5" href="/logout">Logout</a>
    </nav>

    <div class="container-fluid">
        <div class="row pt-5 justify-content-center">
            <div class="col-10">
                <form action="<?php echo base_url(); ?>/AudioUpload" method="post" class="dropzone" id="audioupload">
                </form>

                <script type="text/javascript">
                    Dropzone.options.audioupload = {
                        paramName: "file",
                        maxFilesize: 100,
                        maxFiles: 1,
                        addRemoveLinks: true,
                        dictRemoveFile: "Remove",
                        dictCancelUpload: "Cancel",
                        dictDefaultMessage: "Drop files here to upload",
                        acceptedFiles: ".mp3,.m4a,.aac",
                        init: function () {
                        this.on("success", function (file) {
                            location.reload();});}
                    };
                </script>
            </div>
        </div>
            <div class="container col-8 offset-2 pt-5 pb-5">
                <div class="card">
                    <div class="card-header">
                        Audio Files
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
                            if (!empty($audio)) {
                                foreach ($audio as $row) {
                            ?>  
                                    <div class="card-data">
                                        <div class="row pb-2">
                                            <div class="col-2"><embed src="<?php echo base_url('audio/icon.png'); ?>" type="image/png" width="30px" height="30px" /></div>
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
