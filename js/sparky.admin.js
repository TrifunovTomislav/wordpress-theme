jQuery(document).ready(function($) {
  var mediaUploader;
  $("#upload_button").on("click", function(e) {
    e.preventDefault();
    if (mediaUploader) {
      mediaUploader.open();
      return;
    }
    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: "choose a profile picture",
      button: {
        text: "choose picture"
      },
      multiple: false
    });
    mediaUploader.on("select", function() {
      attachment = mediaUploader
        .state()
        .get("selection")
        .first()
        .toJSON();
      $("#profile_picture").val(attachment.url);
      $("#profile_picture_preview").css(
        "background-image",
        "url(" + attachment.url + ")"
      );
    });
    mediaUploader.open();
  });
  $("#remove_picture").on("click", function(e) {
    e.preventDefault();
    var answer = confirm(
      "are you sure you want to remove your profile picture?"
    );
    if (answer == true) {
      $("#profile_picture").val("");
      $(".sparky_theme_general_form").submit();
    }
    return;
  });
});
