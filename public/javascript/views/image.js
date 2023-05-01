// Dropzone settings
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
       $(this).closest(".media-popup").hide();
    });

    document.addEventListener('click', function(event) {
      var target = event.target;
      if(target.classList.contains('show-media')) {
          var index = target.getAttribute('id');
          $('.media-popup').eq(index).show();
      }
    });
 });