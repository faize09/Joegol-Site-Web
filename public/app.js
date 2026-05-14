$(document).ready(function(){
	fetch();
	
	$('#addnew').click(function(){
		$('#add').modal('show');
	});
	$('#addForm').submit(function(e){
		e.preventDefault();
		var addform = $(this).serialize();
		
		$.ajax({
			method: 'POST',
			url: 'add.php',
			data: addform,
			dataType: 'json',
			success: function(response){
				$('#add').modal('hide');
				if(response.error){
					$('#alert').show();
					$('#alert_message').html(response.message);
				}
				else{
					document.getElementById("addForm").reset(); 
					
					fetch();
				}
			}
		});
	});
	


	$(document).on('click', '.edit', function(){
		var id = $(this).data('id');
		details(id);
		$('#edit').modal('show');
	});


	$('#editForm').submit(function(e){
		e.preventDefault();
		var editform = $(this).serialize();
		$.ajax({
			method: 'POST',
			url: 'edit.php',
			data: editform,
			dataType: 'json',
			success: function(response){
				if(response.error){
					
				}
				else{
					
					fetch();
				}
				
				$('#edit').modal('hide');
			}
		});
	});
	


	$(document).on('click', '.delete', function(){
		var id = $(this).data('id');
		details(id);
		$('#delete').modal('show');
	});

	$('.id').click(function(){
		var id = $(this).val();
		$.ajax({
			method: 'POST', 
			url: 'delete.php',
			data: {id:id},
			dataType: 'json',
			success: function(response){
				if(response.error){
				
				}
				else{
					
					fetch();
				}
				
				$('#delete').modal('hide');
			}
		});
	});
	//



});

function fetch(){
	$.ajax({
		method: 'POST',
		url: 'fetch.php',
		success: function(response){
			$('#tbody').html(response);
		}
	});
}

function details(id){
	$.ajax({
		method: 'POST',
		url: 'fetch_row.php',
		data: {id:id},
		dataType: 'json',
		success: function(response){
			if(response.error){
				$('#edit').modal('hide');
				$('#delete').modal('hide');
			
			}
			else{
				$('#id').val(response.data.id);
				$('#code_article').val(response.data.code_article);
				$('#libelle_article').val(response.data.libelle_article);
				$('#prix_unitaire').val(response.data.prix_unitaire);
				$('#observation').val(response.data.observation);
				$('#id_categorie_edit').val(response.data.id_categorie);
				
			}
		}
	});
}

$(document).ready(function () {
	$("#search").keyup(function () {
		var query = $(this).val();
		if (query != "") {
			$.ajax({
				url: 'search.php',
				method: 'POST',
				data: {
					query: query
				},
				success: function (data) {
					$('#tbody1').html(data);
					$('#tbody1').css('display', 'block');
					$("#search").focusout(function () {
						$('#tbody1').css('display', 'none');
						fetch();
					});
					$("#search").focusin(function () {
						$('#tbody1').css('display', 'block');
						
					});
				}
			});
		} else {
			
			$('#tbody1').css('display', 'none');
		}
	});
	
});