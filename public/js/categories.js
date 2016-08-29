$(document).ready(function(){
	$('.category').click(function(e){
		var my_category = $(this).attr("id");
		var token  = $('meta[name=_token]').attr('content');
		e.preventDefault();
		$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': token }});     
		var mydata = {};
		mydata['_token'] = token;           
		mydata['id'] = my_category;           
				
		$.ajax({
			method: "POST",
			url: "../subcategories",
			cache: false,
			data: mydata,
			dataType: 'json', 
			success: function (response) {
				var myout = '';
				myout = myout + '<table>';
				var subcategories = {};
				subcategories = response['subcategories'];
				subcategories.forEach(function(subcategory, i, subcategories) 
				{
					myout = myout + '<tr><td>' + subcategory['name'] + '</td><td>'
						+'<form method="POST" action="http://uni08.loc/adminzone/delete_category" accept-charset="UTF-8">'
						+'<input name="_token" type="hidden" value="F4GEVh36YVo89zO2rpPxWcGlCGfZJ7b2a4o8zKgv">'
						+'<input name="categoty_id" type="hidden" value="'+subcategory['id']+'">'
						+'<input type="submit" value="Удалить">	</form></td>'
						+'<td><button class="change" id="'+subcategory['id']+'">Изменить</button></td></tr>';
				});
				myout = myout + '</table>';
				$('#result').html(myout);
			},
			error: function (data) {
                console.log('Error:', data);
            }
		});
    });	
});
