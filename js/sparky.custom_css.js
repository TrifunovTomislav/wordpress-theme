jQuery(document).ready(function($) {
  var updateCss = function() {
    $("#sparky_css").val(editor.getSession().getValue());
  };

  $("#custom_css_form").submit(updateCss);
});

var editor = ace.edit("customCss");
editor.setTheme("ace/theme/eclipse");
editor.getSession().setMode("ace/mode/css");
