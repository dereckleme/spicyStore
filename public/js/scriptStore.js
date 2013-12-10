$(document).ready(function(){	
	$("a[rel^='prettyPhoto']").prettyPhoto();
	$('input[type=file]').bootstrapFileInput();
	$(".icon").hover(function(){
		$(".downImage",this).animate({top: "150px"}, 200)
	},function(){
		$(".downImage",this).animate({top: "190px"}, 200)
	});
	$(".categoriaSet").change(function(){
		if($(this).val() != "")
			{
				$.ajax({
	    	        url: basePatch+"/ajax-subcategoria",
	    	        type: 'POST',
	    	        success: function( data )  
	                {  
	                    $("#ajaxSub").html(data);
	                },
	    	        data: {idCategoria:$(this).val()},
	    	    });
			}
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