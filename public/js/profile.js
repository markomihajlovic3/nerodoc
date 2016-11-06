$(document).ready(function(){
    //submit the upload image form by selecting a file
    $('#file-upload').change(function(){
	$('#picture-form').submit();
    });


    //edit commands
    $('.profile-info i').click(function(){
	//get the parent h4 
	var h4 = $(this).parent();

	//show or remove the edit input field
	var input = h4.find('input');
	if(input.length == 1)
	    removeEditInput(h4);
	else
	    showEditInput(h4);
    });

});



//show edit input in the header
function showEditInput(h4){
    console.log('Creating input');
    var inputHTML = "<button class=\"update-button\"><i class=\"fa fa-check\" aria-hidden=\"true\"></i></button><input class=\"info-edit\" type=\"text\" value=\"" + h4.data('value') + "\" style=\"display:none\"/>";
    
    h4.find('.info-text').replaceWith(inputHTML);
    h4.find('.info-edit').animate({width:'toggle'},350);
    h4.find('input[type=text]').val(h4.attr('data-value'));
    h4.find('button').click(updateInfo);
}


//remove edit input from the header
function removeEditInput(h4){
    console.log('Deleting input');

    //find the input and animate its toggle
    var input = h4.find('input').animate({width:'toggle'},350);

    //wait for the toggle animation then replace html
    setTimeout(function(){
	input.replaceWith("<span class=\"info-text\">" + h4.data('value') + "</span>");
	h4.find('.update-button').remove();
    }, 350);
}


//called on checkmark click
function updateInfo(){
    var h4 = $(this).parent();

    //get the parameters from the header
    var parameters = {};
    var field = h4.data('field');
    parameters[field] = h4.find('.info-edit').val();

    console.log("Sending " + parameters[field]);

    console.log("ajax/profile/" + h4.data('username'));

    $.ajax({
	url: "http://localhost/nerodoc/public/ajax/profile/" + h4.data('username') ,
	type: 'GET',
	data: parameters,
	success: function(response) {
	    console.log(response);

	    //update the attribute value
	    h4.attr('data-value', parameters[field]);

	    //find the input and animate its toggle
	    var input = h4.find('input').animate({width:'toggle'},350);

	    //update the profile info
	    setTimeout(function(){
		input.replaceWith("<span class=\"info-text\">" + parameters[field] + "</span>");
		h4.find('.update-button').remove();
	    }, 350);

	    //if its name change, update all the other occurences
	    if(h4.data('field') == 'name'){
		//update image caption
		$('.left-side h4').text(parameters[field]);

		//update the topics started section
		$('.topics-started h3').text("Topics started by " + parameters[field]);
	    }
	},
	error: function(xhr) {
	    alert('Error');
	}
    });
}

