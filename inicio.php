<?php 

session_start();

 ?>

<!DOCTYPE html> 
    <head>  


    	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">

		<link rel="stylesheet" href="jquery-ui.css">
        <link rel="stylesheet" href="bootstrap.min.css" />
		   
    
    </head>  
    <body> 

     <!------------------------Parte do botão do registro----------------------------------------------------------------------------------->

        <div class="container">
			<br />
			
			<?php
			 echo '<h1 align="center"> Olá '.$_SESSION['nome'].'</h1>';  ?><br />


			<br />
			<div align="right" style="margin-bottom:5px;">
			<button type="button" name="cadastrar" id="cadastrar" class="btn btn-success btn-lg">Novo Registro</button>
			<button type="button" class="btn btn-danger btn-lg"  onclick="window.location.href='logout.php' ">Sair</button><br>
		
			</div>
			<div class="table-responsive" id="tabela_user">
				
				<!-- aqui fica a tabela com os nome cadastro e campos--> 
			
			</div>
			<br />
		</div>

		<!------------------------------------------------------------------------------------------------------------------------------------>
		
		<div id="btn_cad" title="Cadastro Usuário">
			<form method="post" id="user_form">


				
 				<div class="">
					<label>Nome completo</label>
					<input type="text" name="nome" id="nome" placeholder="José da Silva Cabral" class="form-control" />
					<span id="error_nome" class="text-danger"></span>
				</div>

				<div class="">
					<label>Data Nascimento</label>
					<input type="date" name="datanascimento" id="datanascimento" class="form-control" />
					<span id="error_nasc" class="text-danger"></span>
				</div>
				
				<div class="">
					<label>Sexo</label>
    			<select name="sexo" id="sexo" class="form-control">
      					<option value="masculino">Masculino</option>  
     					 <option value="feminino">Feminino</option>
    		    </select>
				</div>
				<div class="">
					<label>Endereço</label>
					<input type="text" name="endereco" id="endereco" placeholder="rua 454 - centro" class="form-control" />
					<span id="error_endereco" class="text-danger"></span>
				</div>


				<div class="">
					<label>Password</label>
					<input type="password" name="password" id="password" placeholder="4 dígitos" maxlength="4" class="form-control" />
					<span id="error_password" class="text-danger"></span>
				</div>
				<div class="">
					<label>E-mail</label>
					<input type="email" name="email" id="email" placeholder="exemplo@exemplo.com" class="form-control" />
					<span id="error_email" class="text-danger"></span>
				</div>
				<br>
				<div class="">
					<input type="hidden" name="cad" id="cad" value="cadastrar" />
					<input type="hidden" name="hidden_id" id="hidden_id" />
					<input style="height: 50px " type="submit" name="btn_form" id="btn_form" class="btn btn-success btn-block" value="cadastrar" />
				</div>




			</form>
		</div>
		
		<div id="msg_cad" title="Mensagem">

			<!-- Mesangem de inserido, atualizado ou excluido-->
			
		</div>
		
		<div id="conf_delete" title="Mensagem">
		<p>Deseja realmente deletar este registro?</p>
		</div>
		
    </body>  

    	<script src="jquery.min.js"></script>  
		<script src="jquery-ui.js"></script>   
</html>  




<script>  
$(document).ready(function(){  

	load_data();
    
	function load_data()
	{
		$.ajax({
			url:"list_user.php",
			method:"POST",
			success:function(data)
			{
				$('#tabela_user').html(data);
			}
		});
	}
	
	$("#btn_cad").dialog({
		autoOpen:false,
		width:400
	});
	
	$('#cadastrar').click(function(){
		$('#btn_cad').attr('title', 'Cadastro Usuário');
		$('#cad').val('cadastrar');
		$('#btn_form').val('cadastar');
		$('#user_form')[0].reset();
		$('#btn_form').attr('disabled', false);
		$("#btn_cad").dialog('open');
	});
	
	$('#user_form').on('submit', function(event){
		event.preventDefault();
		var error_nome = '';
		var error_nasc = '';
		var error_endereco = '';
		var error_password = '';
		var error_email = '';
		
		if($('#nome').val() == '')
		{
			error_nome = '* Campo obrigatorio';
			$('#error_nome').text(error_nome);
			$('#error_nome').css('border-color', '#cc0000');
		}
		else{
			error_nome = '';
			$('#error_nome').text(error_nome);
			$('#nome').css('border-color', '');
		}

		if($('#datanascimento').val() == ''){

			error_nasc = '* Campo obrigatorio';
			$('#error_nasc').text(error_nasc);
			$('#error_nasc').css('border-color', '#cc0000');
		}
		else{
			error_nasc = '';
			$('#error_nasc').text(error_nasc);
			$('#datanascimento').css('border-color', '');
		}
		
		if($('#endereco').val() == ''){
			error_endereco = '* Campo obrigatório';
			$('#error_endereco').text(error_endereco);
			$('#error_endereco').css('border-color', '#cc0000');
		}
		else{
			error_endereco = '';
			$('#error_endereco').text(error_endereco);
			$('#endereco').css('border-color', '');
		}
		
		if($('#password').val() == ''){
			error_password = '* Campo obrigatório';
			$('#error_password').text(error_password);
			$('#error_password').css('border-color', '#cc0000');
		}
		else{
			error_password = '';
			$('#error_password').text(error_password);
			$('#password').css('border-color', '');
		}
		
		if($('#email').val() == ''){
			error_email = '* Campo obrigatório';
			$('#error_email').text(error_email);
			$('#error_email').css('border-color', '#cc0000');
		}
		else{
			error_email = '';
			$('#error_email').text(error_email);
			$('#email').css('border-color', '');
		}
			
				
	    if(error_nome != '' || error_nasc != '' || error_endereco != '' || error_password != '' || error_email != '')
		{
			return false;
		}
		else{

			$('#btn_form').attr('disabled', 'disabled');
			var form_data = $(this).serialize();
			$.ajax({
				url:"proc_db.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					$('#btn_cad').dialog('close');
					$('#msg_cad').html(data);
					$('#msg_cad').dialog('open');
					load_data();
					$('#btn_form').attr('disabled', false);
				}
			});
		}
		
	});
	
	$('#msg_cad').dialog({
		autoOpen:false
	});

	/*-------------------------------------aqui começa a parte de editar------------------------------------------------------*/
	
	$(document).on('click', '.edit', function(){
		var id = $(this).attr('id');
		var cad = 'fetch_single';
		$.ajax({
			url:"proc_db.php",
			method:"POST",
			data:{id:id, cad:cad},
			dataType:"json",
			success:function(data)
			{
				$('#nome').val(data.nome);
				$('#email').val(data.email);
				$('#sexo').val(data.sexo);
				$('#datanascimento').val(data.datanascimento);
				$('#password').val(data.password);
				$('#btn_cad').attr('title', 'Atualização de Usuário');
				$('#cad').val('editar');
				$('#hidden_id').val(id);
				$('#btn_form').val('editar');
				$('#btn_cad').dialog('open');
			}
		});
	});

	/*-------------------------------------------aqui começa a parte de excluir----------------------------------------------------------*/
	
	$('#conf_delete').dialog({
		autoOpen:false,
		modal: true,
		buttons:{
			Ok : function(){
				var id = $(this).data('id');
				var cad = 'delete';
				
				$.ajax({
					url:"proc_db.php",
					method:"POST",
					data:{id:id, cad:cad},
					success:function(data)
					{
						$('#conf_delete').dialog('close');
						$('#msg_cad').html(data);
						$('#msg_cad').dialog('open');
						load_data();
					}
				});
			},
			Cancel : function(){
				$(this).dialog('close');
			}
		}	
	});
	
	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		$('#conf_delete').data('id', id).dialog('open');
	});
	
});  
</script>