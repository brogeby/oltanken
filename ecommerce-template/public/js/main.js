/* Overlay menu */
/* Open when someone clicks on the span element */
function openNav() {
  document.getElementById("myNav").style.width = "100%";
}
  
/* Close when someone clicks on the "x" symbol inside the overlay */
function closeNav() {
  document.getElementById("myNav").style.width = "0%";
}


// Om vi i framtiden vill ha Shop-by-style eller liknande i menyn
// let menu = document.getElementsByClassName("hidden-menu-links");
// menu.style.display = "none";
// function hiddenMenu() {
//   if (menu.style.display === "none") {
//     menu.style.display = "block";
//   } else {
//     menu.style.display = "none";
//   }
// };

function hiddenMenu() {
  var x = document.getElementById("hidden-menu");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

// Add product function with AJAX
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
				$('#form-message').html(data['msg']);
			},
		});
  }
  
});	