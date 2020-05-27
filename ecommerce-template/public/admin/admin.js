
$(document).ready(function() {

	$('#addProductBtn').on('click', addProductEvent);
	function addProductEvent(e) {
		e.preventDefault();
		
		let title = $('input[name="title"]');
		let brewery = $('input[name="brewery"]');
		let type = $('input[name="type"]');
		let price = $('input[name="price"]');
		let description = $('textarea[name="description"]');
		let img_url = $('input[name="img_url"]');
		$.ajax({
			method: 'POST',
			url: 'addproduct.php',
			data: { // Skickas till addproduct.php i form av POST parametrar
				addProductBtn: true, 
				title: title.val(), 
				brewery: brewery.val(), 
				type: type.val(), 
				price: price.val(), 
				description: description.val(), 
				img_url: img_url.val() 
			}, 
			dataType: 'json',
			success: function(data) {
				//console.log(data);
				$('#form-message').html(data['message']);
				adminList(data);
			},
		});
	}
});	