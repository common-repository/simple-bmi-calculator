// BMI Calculator Plugin
// Script.js

jQuery( document ).ready(function() {
	
	jQuery('#bmic-submit').click(function() {
	
	bmih = jQuery('#bmi-height').val();
	bmiw = jQuery('#bmi-weight').val();

	
	jQuery.ajax({
		
     		url:"http://bmicalculatorplugin.com/bmi/?weight="+bmiw+"&height="+bmih,
     		dataType: 'jsonp',
     		success:function(json){
                 	// do stuff with json (in this case an array) 			
			jQuery('.bmic-comment').html(json.result);	
			jQuery('.bmic-score span').html(json.bmi);
			jQuery('.bmic-result').show();			

                },
     		error:function(){
         		console.log("Error");
     		}      
   
	});
	});

});