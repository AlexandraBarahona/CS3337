// Javascript for popups
$(document).ready(function(){
    // When the button is clicked, show the popup
    $(".edit-btn").click(function(){
      var index = $(".edit-btn").index($(this));
       $(".edit-popup").eq(index).show();
    });

    // When the close button is clicked, hide the popup
    $(".close-popup").click(function(){
       $(this).closest(".edit-popup").hide();
       $(this).closest(".media-popup").hide();
    });

    document.addEventListener('click', function(event) {
      var target = event.target;

      if(target.classList.contains("close-popup")) {
          var index = target.getAttribute("index");
          var element = document.getElementById("media"+index);
          if(element instanceof HTMLVideoElement || element instanceof HTMLAudioElement) {
              element.pause();
          }
      }
      if(target.classList.contains('show-media')) {
          var index = target.getAttribute('id');
          $('.media-popup').eq(index).show();
          var element = document.getElementById("media"+index);
          if(element instanceof HTMLVideoElement || element instanceof HTMLAudioElement) {
              element.play();
          }
      }
    });
 });