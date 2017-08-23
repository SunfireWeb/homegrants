$(document).ready(function(){
	// ajax mailer
	$("#actualForm").submit(function(event) {
        event.preventDefault();
        $.post("mailer.php", $("#actualForm").serialize() ).done(function(){
          // successful completion
          $("#theForm").slideUp();
          $("#results").addClass("alert-success").html("Your message has been sent. Please watch your inbox for a confirmation email.").show();
          $("input").filter(':text').val('');
          $("textarea").val('');
          $("input").filter(':radio').prop('checked', false);
          $("input").filter(':checkbox').prop('checked', false);
          $("#results").delay(10000).hide(0);
          $("#openForm").show();
        }).fail(function(){
          // error display
          $("#results").addClass("alert-danger").html("Something went wrong. Error message: " + text).show(); // need to verify error message comes through...?
        }).always(function(){
          // done after every submit, if needed
        });
      });

	// adjust class on prequal questions for smaller screens
	if($("#theForm").width() < 600) {
		$(".control-label").removeClass("text-right");
		$(".yorn").removeClass("radio").addClass("radio-inline").addClass("text-center");
	}

	// background image carousel
	setInterval(function(){
		$(".site-wrapper").toggleClass('altbg');
	}, 60000);
});




// button press toggles form into view
$("#openForm").click(function(){
	$("#theForm").slideDown();
	$(this).hide();
});

// when General subject is selected
$("#generalQ").click(function(){
	$("#answerMore").removeClass('btn-warning').addClass('btn-default');
	$(this).removeClass('btn-default').addClass('btn-warning');
	$(".optional").slideUp();
	$(".prequal-notice").hide();
});

// selecting PreQualification button opens first optional question and notice
$("#answerMore").click(function(){
	$("#generalQ").removeClass('btn-warning').addClass('btn-default');
	$(this).removeClass('btn-default').addClass('btn-warning');
	$(".prequal-notice").show();
	$("#opt1").slideToggle();
});

// prequal navigation button functionality
$(".prequal-back").click(function(){
	$(this).parent().slideUp();
	$(this).parent().prev(".form-group.optional").slideDown();
});

$(".prequal-fwd").click(function(){
	$(this).parent().slideUp();
	$(this).parent().next(".form-group.optional").slideDown();
});
