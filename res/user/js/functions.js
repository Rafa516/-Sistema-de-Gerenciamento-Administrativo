
//ALERT PARA ALTERAÇÃO DE FOTO
function alertAlterarFoto() {

	Swal.fire({
		position: 'inherit',
		icon: 'info',
		title: '<p style="font-size: 20px;">Olá, após a alteração de foto você será redirecionado para a página de login.</p>',
		showConfirmButton: true

	})

}

//ALERT PARA ALTERAÇÃO DOS DADOS
function alertAlterarDados() {

	Swal.fire({
		position: 'inherit',
		icon: 'info',
		title: '<p style="font-size: 20px;">Olá, após a confirmação de  alteração dos dados você será redirecionado para a página de login.</p>',
		showConfirmButton: true

	})

}



/*lightbox das imagens*/

$(document).ready(function () {

	$('.image-link').magnificPopup({
		type: 'image',
		gallery: { enabled: true }
	});


});



/*Nav responsivo (mobile)*/
function mobileNav() {
	$(document).ready(function () {
		$('.nav_btn').click(function () {
			$('.mobile_nav_items').toggleClass('active');
		});
	});
}



//ALERT PARA DELETAR
function deletar(id, nome, URL, titulo) {
	Swal.fire({
		title: titulo,
		text: "Deseja excluir " + nome + "?",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Sim'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: URL,
				type: 'GET',
				data: {
					'_method': 'DELETE',
					'id': id
				},

			});
			Swal.fire({
				title: 'Excluíndo ' + nome,
				icon: 'success',
				timer: 2000,
				timerProgressBar: true,
				showConfirmButton: false,
			})
			autoRefreshPage()
		}

	})

}


//TEMPO PARA ATUALIZAR A PÁGINA
function autoRefreshPage() {
	setInterval(function () { location.reload(); }, 2000);
}












