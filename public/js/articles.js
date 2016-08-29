$(document).ready(function(){
	$('.article_status').click(function(e){
		var article_id = $(this).attr("id");
		var article_status = $(this).attr("data");
		var token  = $('meta[name=_token]').attr('content');
		e.preventDefault();
		$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': token }});     
		var mydata = {};
		mydata['_token'] = token;           
		mydata['status'] = article_status;           
		mydata['id'] = article_id;           
				
		$.ajax({
			method: "POST",
			url: "../adminzone/change_article_status",
			cache: false,
			data: mydata,
			dataType: 'json', 
			success: function (response) {	
				var article_new_status;
				var article_id;
				var myresult = "";
				article_new_status = response['article_new_status'];
				article_id = response['article_id'];
				if(article_new_status == 0){
					myresult = "<img src=\"../images/not_approve.png\" width=\"18px\"> Не опубликован";
				}else if(article_new_status == 1){
					myresult = "<img src=\"../images/Ok.png\" width=\"18px\"> Опубликован";
				}
				$('#'+article_id).html(myresult);
				
			},
			error: function (data) {
                console.log('Error:', data);
            }
		});
    });	
});
