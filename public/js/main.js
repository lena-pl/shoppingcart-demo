
/*
 * jQuery throttle / debounce - v1.1 - 3/7/2010
 * http://benalman.com/projects/jquery-throttle-debounce-plugin/
 *
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function(b,c){var $=b.jQuery||b.Cowboy||(b.Cowboy={}),a;$.throttle=a=function(e,f,j,i){var h,d=0;if(typeof f!=="boolean"){i=j;j=f;f=c}function g(){var o=this,m=+new Date()-d,n=arguments;function l(){d=+new Date();j.apply(o,n)}function k(){h=c}if(i&&!h){l()}h&&clearTimeout(h);if(i===c&&m>e){l()}else{if(f!==true){h=setTimeout(i?k:l,i===c?e-m:e)}}}if($.guid){g.guid=j.guid=j.guid||$.guid++}return g};$.debounce=function(d,e,f){return f===c?a(d,e,false):a(d,f,e!==false)}})(this);

/* our code */

$(function() {

  // jquery ready:

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('form#register input[name=email]').on('keyup input', $.debounce(750, checkRegisterEmailAvailability) );

  function checkRegisterEmailAvailability(evt) {
    var $this = $(this);
    if (this.validity && this.validity.valid) {
      $.get('/auth/email-available', {
        'email': $this.val()
      }, function(data) {
        var formClass = "has-error";
        var iconClass = "glyphicon-ban-circle";
        if (data.available) {
          formClass = "has-success";
          iconClass = "glyphicon-ok-circle";
        }
        $this.closest('.form-group').removeClass (function (index, css) {
          return (css.match(/(^|\s)has-\S+/g) || []).join(' ');
        }).addClass(formClass);
        $this.closest('.form-group').find('.glyphicon').removeClass (function (index, css) {
          return (css.match(/(^|\s)glyphicon-\S+/g) || []).join(' ');
        }).addClass(iconClass);
      }, 'json');
    }
  }

  $('form.attempts-update').on('click', 'button', function(evt){
    evt.preventDefault();
    var $this = $(this);
    var url = $this.closest('form').attr('action');
    var attemptId = $this.closest('form').data('attempt-id');
    var newStatus = $this.val();

    $.post(url, {
      'status': newStatus,
      '_method': 'PUT',
    }, function(data) {
      $this.closest('form').find('button').removeClass('active');
      $this.addClass('active').blur();

      var classes = {
        'success':   'success',
        'almost':    'warning',
        'miss':      'danger',
        'unchecked': 'info'
      };
      $this.closest('.row').find('img').removeClass (function (index, css) {
        return (css.match(/(^|\s)alert-\S+/g) || []).join(' ');
      }).addClass('alert-' + classes[newStatus]);

    }, 'json');

  });
});
