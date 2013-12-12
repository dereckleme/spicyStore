$(document).ready(function(){	
	var idCategoria;
	$("a[rel^='prettyPhoto']").prettyPhoto();
	$('input[type=file]').bootstrapFileInput();
	$(".icon").hover(function(){
		$(".downImage",this).animate({top: "150px"}, 200)
	},function(){
		$(".downImage",this).animate({top: "190px"}, 200)
	});
	$(".salvarCat").on("click",function(){
		if($(".tituloCategoria").val() == "")
			{
			 alert("Nome da categoria está em branco.");
			}
		else
			{
				$.ajax({
	    	        url: basePatch+"/ajax-categoria-set",
	    	        type: 'POST',
	    	        success: function( data ) 
	                {  
	    	        	$.ajax({
	    	    	        url: basePatch+"/ajax-categoria",
	    	    	        type: 'POST',
	    	    	        success: function( data )  
	    	                {  
	    	    	        	$(".mostraTituloCategoria").fadeOut(function(){
	    	    	        		$("#ajaxCat").html(data);
	    	    	        	});
	    	                },
	    	    	    });
	                },
	    	        data: {nomeCategoria:$(".tituloCategoria").val()},
	    	    });
			}
		return false;
	})
	$(document).on("change",".categoriaSet",function(){
		$(".mostraTituloSubCategoria").fadeOut();
		if($(this).val() != "" && $(this).val() != "adiciona")
			{
			idCategoria = $(this).val();
				$.ajax({
	    	        url: basePatch+"/ajax-subcategoria",
	    	        type: 'POST',
	    	        success: function( data )  
	                {  
	    	        	if(data == "")
	    	        		{
	    	        			$("#ajaxSub").html("<br/>");
	    	        			$(".mostraTituloSubCategoria").fadeIn();
	    	        		}
	    	        	else
	    	        		{
	                    $("#ajaxSub").html(data);
	    	        		}
	                },
	    	        data: {idCategoria:idCategoria},
	    	    });
			}
		else if($(this).val() == "adiciona")
			{
				$(this).fadeOut(function(){
					$("#ajaxSub").html("");
					$(".mostraTituloCategoria").fadeIn();
				});
				$(".cancelarCategoria").on("click",function(){
					$(".mostraTituloCategoria").fadeOut(function(){
							$(".categoriaSet").fadeIn();
					});
				});
				
			}
	});
	$(".salvarSubCat").on("click",function(){
		if($(".titulosubcategoria").val() == "")
			{
			 alert("Nome da subcategoria está em branco.");
			}
		else
			{
				$.ajax({
	    	        url: basePatch+"/ajax-subcategoria-set",
	    	        type: 'POST',
	    	        success: function( data ) 
	                {  
	    	        	$.ajax({
	    	    	        url: basePatch+"/ajax-subcategoria",
	    	    	        type: 'POST',
	    	    	        success: function( data )  
	    	                { 
	    	    	        	$(".mostraTituloSubCategoria").fadeOut();
	    	    	        	$("#ajaxSub").html(data);
	    	                },
	    	    	        data: {idCategoria:idCategoria},
	    	    	    });
	                },
	    	        data: {nomeSubCategoria:$(".titulosubcategoria").val(),idCategoria:idCategoria},
	    	    });
			}
		return false;
	})
	$(document).on("change",".subcategoriaSet",function(){
		if($(this).val() == "adiciona")
		{
			$(this).fadeOut(function(){
				$(".mostraTituloSubCategoria").fadeIn();
				$(".cancelarSubCategoria").on("click",function(){
					$(".mostraTituloSubCategoria").fadeOut(function(){
							$(".subcategoriaSet").fadeIn();
					});
				});
			});
		}
	});
	$(".actionSaveRef").on("click",function(){
		if($(".tituloTag").val() == "")
			{
				alert("Titulo da Tag está em branco.");
			}
		else
			{
			$.ajax({
    	        url: basePatch+"/ajax-tag-set",
    	        type: 'POST',
    	        success: function( data )  
                { 
    	        	$.ajax({
    	    	        url: basePatch+"/ajax-tag-get",
    	    	        type: 'POST',
    	    	        success: function( data )  
    	                { 
    	    	        	$(".updateAjaxTipos").html(data);
    	                },
    	    	    });
                },
    	        data: {tituloTag:$(".tituloTag").val()},
    	    	});
			}
		return false;
	});
	$(".eventAdicionaTag").on("click",function(){
		$(".viewAddTag").fadeOut(function(){
			$(".viewTexttag").fadeIn();
		});
		return false;
	});
	$( "#adicionaImagem" ).dialog({
		title:"Adicionar Imagem",
	      resizable: false,
	      width:"40%",
	      height:500,
	      autoOpen:false,
	      modal: true,
	      buttons: {
	        "Adicionar": function() {
	        	var erros = "";
	        	if($(".tituloImagem").val() == "") erros = erros+"- Digite o título da imagem\n";
	        	if($(".categoriaSet").val() == "") erros = erros+"- Selecione uma categoria\n";
	        	if($('input[type=file]')[0].files[0] == null) erros = erros+"- Insira uma imagem\n";
	        	if(erros == "")
	        		{
			        	var arrayReferencia = new Array();
			        	var formData = new FormData();
			        	$( ".referenciaSet:checked" ).each(function (i) {
			        		arrayReferencia[i] = $(this).val();
			        	})
			        	var referenciaSetados = arrayReferencia.join();
			        	formData.append('imagem', $('input[type=file]')[0].files[0]);
			        	formData.append('referencias', referenciaSetados);
			        	formData.append('titulo', $(".tituloImagem").val());
			        	formData.append('descricao', $(".descricaoImagem").val());
			        	formData.append('categoria', $(".categoriaSet").val());
			        	formData.append('subcategoria', $(".subcategoriaSet").val());
			        	 $.ajax({
			        	        url: basePatch+"/upload-imagem",
			        	        type: 'POST',
			        	        success: function( data )  
			                    {  
			        	        	
			                        if(data == "")
			                        	{
			                        	location.reload();
			                        	}
			                        else
			                        	{
			                        	alert("Formato de imagem inválido!");
			                        	}
			                    },
			                    beforeSend: function(){
			                    	$("#carregandoView").fadeIn();
			                    },
			                    complete:function(){
			                    	$("#carregandoView").fadeOut();
			                    },
			                    error:function(){alert("Formato de imagem inválido!");},
			        	        data: formData,
			        	        cache: false,
			        	        contentType: false,
			        	        processData: false
			        	    });
	        		}
	        	else
	        		{
	        			alert("Existe alguns erros abaixo:\n\n"+erros);
	        		}
	        },
	        "Cancelar": function() {
	          $( this ).dialog( "close" );
	        }
	      }
	    });
	$(".abrirCadastrar").on("click",function(){
		$( "#adicionaImagem" ).dialog("open");
		return false;
	})
})