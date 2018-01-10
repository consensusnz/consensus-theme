//Accept proposals.

function acceptProposal(){ // function that will initialize when the user clicks the button.

 var postID = document.getElementById("postID").value; // Get the post ID from the hidden input text field.
 var lawyerUserID = document.getElementById("lawyerUserID").value; // Get the selected lawyer's user ID from the hidden input text field.
 var proposalIndexNumber = document.getElementById("proposalIndexNumber").value; // Get the selected proposal index number from the hidden input text field.
 var postPermalink = document.getElementById("postPermalink").value; // Get the post permalink from the hidden input text field.

 var button = jQuery('#accept'); // submit button

 jQuery(document).ready(function($) {
    jQuery.ajax({ // We use jQuery instead $ sign, because WordPress.
    url: 'http://consensus.test/wp/wp-admin/admin-ajax.php',
    //url : consensus_ajax_params.ajaxurl, // admin-ajax.php URL
     type : 'POST',
     data : {
         action : 'acceptproposal',
         postID : postID,
         lawyerUserID : lawyerUserID,
         proposalIndexNumber : proposalIndexNumber
     },
     beforeSend: function(xhr){
       // what to do just after the form has been submitted
     },
     success: function(data){
        console.log(data);
     },
     complete: function(){
         window.location.replace(postPermalink + "?new_relationship=1");
     }
    });
 });
}
