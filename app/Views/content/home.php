    <?php
$current_page = basename($_SERVER['REQUEST_URI'], ".php");
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"> </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <img src="/cat.png" alt="Cat" style="width: 70px; height: auto;">
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto ">
            <li class="nav-item <?php if($current_page == 'home') {echo 'active';} ?>">
                <a class="nav-link" href="/home">Home</a>
            </li>
            <li class="nav-item <?php if($current_page == 'image') {echo 'active';} ?>">
                <a class="nav-link" href="/image">Image</a>
            </li>
            <li class="nav-item <?php if($current_page == 'audioPage') {echo 'active';} ?>">
                <a class="nav-link" href="/audioPage">Audio</a>
            </li>
            <li class="nav-item <?php if($current_page == 'videoPage') {echo 'active';} ?>">
                <a class="nav-link" href="videoPage">Video</a>
            </li>
        </ul>
    </div>
    <a class="nav-item nav-link px-5 " href="/logout">Logout</a>
</nav>
 <section class="vh-100" id="home">

    <div class="container-fluid pb-5">
        <div class="row pt-5">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col px-2">Last 10 Updated/Added Images</div>
                        </div>
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
                                            <div class="col-2"><embed src="<?php echo base_url('public/images/' . $row->name); ?>" type="image/png" width="30px" height="30px" /></div>
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

        <div class="row pt-5">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col px-2">Last 10 Updated/Added Audio Files</div>
                        </div>
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
                                            <div class="col-2"><embed src="<?php echo base_url('public/audio/icon.png'); ?>" type="image/png" width="30px" height="30px" /></div>
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

        <div class="row pt-5">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col px-2">Last 10 Updated/Added Videos</div>
                        </div>
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
                            if (!empty($videos)) {
                                foreach ($videos as $row) {
                            ?>
                                    <div class="card-data">
                                        <div class="row pb-2">
                                            <div class="col-2"><embed src="<?php echo base_url('public/video/icon.png'); ?>" type="image/png" width="30px" height="30px" /></div>
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
    </div>
</section>