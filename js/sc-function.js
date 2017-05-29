var stype = '';
var purchased_block = 0;

jQuery( document ).on( 'click', '.purchase-btn', function() {

  stype = $(this).attr('stype');
  if( $('.' + stype + '-block').val() != '' )
  {
      var block = $('.' + stype + '-block').val();
      var block_def = $('.' + stype + '-block option:selected').html();

      jQuery('.sc-modal-text').html('<p>Are you sure you want to purchase '+ block_def +'?</p>');
      var modal = document.getElementById('confirmModal');
      modal.style.display = "block";

      purchased_block = block;
  }
  else
  {
      jQuery('.sc-notif-modal-text').html('<p>Please select type of credits you want to purchase.</p>');
      var modal = document.getElementById('notificationModal');
      modal.style.display = "block";
  }

	

  return false;

});


jQuery( document ).on( 'click', '.sc-confirm-purchase', function() {

  jQuery(this).html('Please wait..');
  jQuery(this).attr('disabled',true);
  jQuery('.sc-cancel').attr('disabled', true);

  jQuery.ajax({
        url: postscfunction.ajax_url,
        type:'POST',
        dataType: 'json',
        data : {
          action : 'purchaseblock',
          block : purchased_block
        },
        success: function(response){

          //pop up notification;
          // alert(response);

          jQuery('.sc-confirm-purchase').html('Yes');
          jQuery('.sc-confirm-purchase').removeAttr("disabled");
          jQuery('.sc-cancel').removeAttr("disabled");

          var modal = document.getElementById('confirmModal');
          modal.style.display = "none";

          jQuery('.sc-notif-modal-text').html('<p>' + response['message'] + '</p>');
          var modal = document.getElementById('notificationModal');
          modal.style.display = "block";

          setTimeout(function () {
            var modal = document.getElementById('notificationModal');
            modal.style.display = "none";
          }, 3000);

          //update credits remaining
          var up_rem = +parseFloat(jQuery('.' + stype + '-rem').html().replace(",", "").replace(".", "")) + +parseFloat(response['credits']);
          jQuery('.' + stype + '-rem').html( up_rem.toLocaleString() );

         
        }
  }); 

  return false;

}); 


jQuery( document ).on( 'click', '.sc-close', function() {

    jQuery(this).parent().parent().parent().fadeOut();

    // var modal = document.getElementById('confirmModal');
    // modal.style.display = "none";

    // var modal = document.getElementById('notificationModal');
    // modal.style.display = "none";

    return false;

});

jQuery( document ).on( 'click', '.sc-cancel', function() {

    jQuery(this).parent().parent().parent().fadeOut();

    // var modal = document.getElementById('confirmModal');
    // modal.style.display = "none";

    // var modal = document.getElementById('notificationModal');
    // modal.style.display = "none";

    return false;
});


jQuery( document ).on( 'change', '.onoffswitch-checkbox', function() {

  var autotopup = 'Off';

  if( jQuery(this).is(':checked') )
      autotopup = 'On';
  else
      autotopup = 'Off';

  var service = jQuery(this).attr('service');

  jQuery.ajax({
      url: postscfunction.ajax_url,
      type:'POST',
      dataType: 'json',
      data : {
        action : 'autotopup',
        service : service,
        autotopup : autotopup
      },
      success: function(response){

        // alert( response['success'] );
       
      }
  }); 


});
