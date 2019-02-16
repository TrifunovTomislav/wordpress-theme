jQuery(document).ready(function($) {
  //custom Sunset scripts

  /** init functions */
  revealPosts();

  /* variable declarations */
  //var carousel = ".sparky-carousel-thumb";
  var last_scroll = 0;

  /** carousel functions */
  $(document).on("click", ".sparky-carousel-thumb", function() {
    var id = $("#" + $(this).attr("id"));
    $(id).on("slid.bs.carousel", function() {
      sparkyGetThumb(id);
    });
  });

  $(document).on("mouseenter", ".sparky-carousel-thumb", function() {
    var id = $("#" + $(this).attr("id"));
    sparkyGetThumb(id);
  });

  function sparkyGetThumb(id) {
    var nextThumb = $(id)
      .find(".item.active")
      .find(".next-image-preview")
      .data("image");
    var prevThumb = $(id)
      .find(".item.active")
      .find(".prev-image-preview")
      .data("image");
    $(this)
      .find(".carousel-control.right")
      .find(".thumbnail-container")
      .css({ "background-image": "url(" + nextThumb + ")" });
    $(this)
      .find(".carousel-control.left")
      .find(".thumbnail-container")
      .css({ "background-image": "url(" + prevThumb + ")" });
  }

  /* ajax function */
  $(document).on("click", ".sparky-load-more:not(.loading)", function() {
    var that = $(this);
    var page = $(this).data("page");
    var newPage = page + 1;
    var ajaxurl = $(this).data("url");
    var prev = that.data("prev");
    var archive = that.data("archive");

    if (typeof prev === "undefined") {
      prev = 0;
    }

    if (typeof archive === "undefined") {
      archive = 0;
    }

    that
      .addClass("loading")
      .find(".text")
      .slideUp(320);
    that.find(".sparky-icon").addClass("spin");

    $.ajax({
      url: ajaxurl,
      type: "post",
      data: {
        page: page,
        prev: prev,
        archive: archive,
        action: "sparkyLoadMore"
      },
      error: function(response) {
        console.log(response);
      },
      success: function(response) {
        if (response == 0) {
          $(".sparky-posts-container").append(
            '<div class="text-center"><h3>You reached the end of the line</h3><p>No more posts to load</p></div>'
          );
          that.slideUp(320);
        } else {
          setTimeout(function() {
            if (prev == 1) {
              $(".sparky-posts-container").prepend(response);
              newPage = page - 1;
            } else {
              $(".sparky-posts-container").append(response);
            }
            if (newPage == 1) {
              that.slideUp(320);
            } else {
              that.data("page", newPage);
              that
                .removeClass("loading")
                .find(".text")
                .slideDown(320);
              that.find(".sparky-icon").removeClass("spin");
            }
            revealPosts();
          }, 1000);
        }
      }
    });
  });

  /** scroll functions */
  $(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (Math.abs(scroll - last_scroll) > $(window).height() * 0.1) {
      last_scroll = scroll;
      $(".page-limit").each(function(index) {
        if (isVisible($(this))) {
          history.replaceState(null, null, $(this).attr("data-page"));
          return false;
        }
      });
    }
  });

  /* helper functions */
  function revealPosts() {
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();

    (function() {
      "use strict";
      window.addEventListener(
        "load",
        function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName("needs-validation");
          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener(
              "submit",
              function(event) {
                if (form.checkValidity() === false) {
                  event.preventDefault();
                  event.stopPropagation();
                }
                form.classList.add("was-validated");
              },
              false
            );
          });
        },
        false
      );
    })();

    var posts = $("article:not(.reveal)");
    var i = 0;
    setInterval(function() {
      if (i >= posts.length) return false;
      var el = posts[i];
      $(el)
        .addClass("reveal")
        .find(".sparky-carousel-thumb")
        .carousel();
      i++;
    }, 200);
  }

  function isVisible(element) {
    var scroll_pos = $(window).scrollTop();
    var window_height = $(window).height();
    var el_top = $(element).offset().top;
    var el_height = $(element).height();
    var el_bottom = el_top + el_height;
    return (
      el_bottom - el_height * 0.25 > scroll_pos &&
      el_top < scroll_pos + 0.5 * window_height
    );
  }

  /** sidebar functions */
  $(document).on("click", ".js-toggleSidebar", function() {
    $(".sparky-sidebar").toggleClass("sidebar-closed");
    $("body").toggleClass("no-scroll");
    $(".sidebar-overlay").fadeToggle(320);
  });

  /**contact form submission */
  $("#sparky-contact-form").on("submit", function(e) {
    e.preventDefault();

    $(".has-error").removeClass("has-error");
    $(".js-show-feedback").removeClass("js-show-feedback");

    var form = $(this),
      name = form.find("#name").val(),
      email = form.find("#email").val(),
      message = form.find("#message").val(),
      ajaxurl = form.data("url");

    if (name === "") {
      $("#name")
        .parent(".form-group")
        .addClass("has-error");
      return;
    }
    if (email === "") {
      $("#email")
        .parent(".form-group")
        .addClass("has-error");
      return;
    }
    if (message === "") {
      $("#message")
        .parent(".form-group")
        .addClass("has-error");
      return;
    }

    form.find("input, button, textarea").attr("disabled", "disabled");
    $(".js-form-submission").addClass("js-show-feedback");

    $.ajax({
      url: ajaxurl,
      type: "post",
      data: {
        name: name,
        email: email,
        message: message,
        action: "sparkySaveUserContactForm"
      },
      error: function(response) {
        $(".js-form-submission").removeClass("js-show-feedback");
        $(".js-form-error").addClass("js-show-feedback");
        form.find("input, button, textarea").removeAttr("disabled");
      },
      success: function(response) {
        if (response == 0) {
          setTimeout(function() {
            $(".js-form-submission").removeClass("js-show-feedback");
            $(".js-form-error").addClass("js-show-feedback");
            form.find("input, button, textarea").removeAttr("disabled");
          }, 1500);
        } else {
          setTimeout(function() {
            $(".js-form-submission").removeClass("js-show-feedback");
            $(".js-form-success").addClass("js-show-feedback");
            form
              .find("input, button, textarea")
              .removeAttr("disabled")
              .val("");
          }, 1500);
        }
      }
    });
  });
});
