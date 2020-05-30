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
		
	$('#addProductBtn').on('click', function(e) {
		e.preventDefault();

		let title = $('input[name="title"]');
		let brewery = $('input[name="brewery"]');
		let type = $('input[name="type"]');
		let price = $('input[name="price"]');
		let description = $('textarea[name="description"]');
		let img_url = $('input[name="img_url"]');
		$.ajax ({
			type: 'POST',
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
				// console.log(data);
				$('#form-message').html(data['msg']);
				appendProductList(data);
				
			},
		});
		$("#add-product-form")[0].reset();
	});

	$('.delete-btn').on('click', function(e) {
		e.preventDefault();
		
		let id = $(this).parent().find('input[name="productId"]');
		console.log(id.val());
		$.ajax({
			method: 'POST',
			url: 'deleteproduct.php',
			data: {
				deleteBtn: true, 
				productId: id.val() 
			},
			dataType: 'json',
			success: function(data) {
				console.log(data);
				$('#form-message').html(data['msg']);
				appendProductList(data);
			},
		});
	});

	function appendProductList(data) {
		let html = '';
		for (content of data) {
			// console.log(content);
			// console.log(html);

			html +=
				'<tr>' +
					'<td>' + content['id'] + '</td>' +
					'<td>' + content['title'] + '</td>' +
					'<td>' + content['brewery'] + '</td>' +
					'<td>' + content['type'] + '</td>' +
					'<td>' + content['price'] + '</td>' +
					'<td>' + content['description'] + '</td>' +
					'<td>' + content['img_url'] + '</td>' +
					'<td>' +
						'<form action="updateproduct.php" method="GET">' +
							'<input type="hidden" name="updateId" value="' + content['id'] + '">' +
							'<input type="submit" name="updateBtn" class="update-btn" value="Update">' +
						'</form>' +              
					'</td>' +
					'<td>' +
						'<form action="#" method="POST">' +
							'<input type="hidden" name="productId" value="' + content['id'] + '">' +
							'<input type="submit" name="deleteBtn" id="delete-btn" class="delete-btn" value="Delete">' +
						'</form>' +
					'</td>' +
				'</tr>';
		}
		$('#product-list').html(html);

		// $('.delete-btn').on('click', deletePunEvent);
	}
});	




let modal = document.getElementById("create-product-modal");
let btn = document.getElementById("create-product");
let span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
  modal.style.display = "block";
}
span.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}