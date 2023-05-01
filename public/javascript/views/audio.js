// Dropzone settings 

Dropzone.options.audioupload = {
    paramName: "file",
    maxFilesize: 100,
    maxFiles: 1,
    addRemoveLinks: true,
    dictRemoveFile: "Remove",
    dictCancelUpload: "Cancel",
    dictDefaultMessage: "Drop files here to upload",
    acceptedFiles: "audio/*, .webm",
    autoProcessQueue: false,
    init: function () {
        var dropzoneInstance = this;
        this.on("addedfile", function(file) {
            
            var audioElement = new Audio();
            audioElement.src = URL.createObjectURL(file);
            var fileDuration = 0; // Set initial duration to 0

            audioElement.addEventListener('error', function() {
                // I use this just in case the user uploads an empty file
                // or a file that has the correct extension but not in the
                // correct format
                fileDuration = audioElement.duration || 0;
                console.log("element error");
                
                document.getElementById("fileDuration").value = fileDuration;
                dropzoneInstance.processQueue(); 
            });

            audioElement.addEventListener('loadedmetadata', function() {
                // getting the duration of the file
                fileDuration = audioElement.duration || 0;
                
                document.getElementById("fileDuration").value = fileDuration;
                dropzoneInstance.processQueue();    
            });
        }); 

        this.on("success", function (file) {
            location.reload();});
    }
};

// Javascript for popups
$(document).ready(function(){
    // When the button is clicked, show the popup
    $(".edit-btn").click(function(){
      var index = $(".edit-btn").index($(this));
      console.log(index);
       $(".edit-popup").eq(index).show();
    });

    // When the close button is clicked, hide the popup
    $(".close-popup").click(function(){
       $(this).closest(".edit-popup").hide();
       $(this.closest(".media-popup")).hide();
    });

    // Shows the audio player when clicking the name
    document.addEventListener('click', function(event) {
      var target = event.target;

      if(target.classList.contains("close-popup")) {
          var index = target.getAttribute("index");
          document.getElementById("media"+index).pause();
      }

      if(target.classList.contains('show-media')) {
          var index = target.getAttribute('id');
          $('.media-popup').eq(index).show();
          document.getElementById("media"+index).play();
      }
    });
 });