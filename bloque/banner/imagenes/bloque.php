<script language=JavaScript>
<!--
function cargarImagen() 
{ 
	var documento=document; 
	
	if(documento.images)
	{ 
		if(!documento.imagenes) 
		{
			documento.imagenes=new Array();
		}	
		
		var i;
		var j=documento.imagenes.length;
		var a=cargarImagen.arguments; 
		
		for(i=0; i<a.length; i++)
		{
			if (a[i].indexOf("#")!=0)
			{ 
				documento.imagenes[j]=new Image; 
				documento.imagenes[j++].src=a[i];	
			}
		}
  	
	}
}


function cambiarImagen() 
{ 
  var i;
  var j=0;
  var x;
  var a=cambiarImagen.arguments;
  
  document.fuente=new Array; 
  
  for(i=0;i<a.length;i++)
  {
   	
   	if ((x=encontrarObjeto(a[i]))!= null)
   	{
   		document.fuente[j++]=x; 
   		
   		if(!x.fuente) 
   		{
   			x.fuente=x.src; 
   		}	
   		
   		x.src=a[i+1];   			
   		
   	}
   }
}




function imagenOriginal() 
{ 
	var i;
	var x;
	var a=document.fuente; 
	for(i=0;i<a.length;i++) 
	{
		x=a[i];
		x.src=x.fuente;
	}
}


function encontrarObjeto(n,documento) 
{ 
	var p;
	var i;
	var x;
	  
	if(!documento) 
	{
		documento=document;
	}	
	
	if(!x)
	{
		x=documento.getElementById(n);
	}
	return x;
	
}


//-->
</SCRIPT>
<table cellpadding=0 border=0 cellspacing=0>
	<tr>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-0-0.jpg" width="30" height="20"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-0-1.jpg" width="43" height="20"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-0-2.jpg" width="22" height="20"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-0-3.jpg" width="37" height="20"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-0-4.jpg" width="38" height="20"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-0-5.jpg" width="75" height="20"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-0-6.jpg" width="62" height="20"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-0-7.jpg" width="71" height="20"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-0-8.jpg" width="81" height="20"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-0-9.jpg" width="79" height="20"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-0-10.jpg" width="35" height="20"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-0-11.jpg" width="49" height="20"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-0-12.jpg" width="32" height="20"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-0-13.jpg" width="28" height="20"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-0-14.jpg" width="59" height="20"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-0-15.jpg" width="27" height="20"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-0-16.jpg" width="32" height="20"></td>
	</tr>
	<tr>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-1-0.jpg" width="30" height="16"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-1-1.jpg" width="43" height="16"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-1-2.jpg" width="22" height="16"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-1-3.jpg" width="37" height="16"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-1-4.jpg" width="38" height="16"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-1-5.jpg" width="75" height="16"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-1-6.jpg" width="62" height="16"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-1-7.jpg" width="71" height="16"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-1-8.jpg" width="81" height="16"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-1-9.jpg" width="79" height="16"></td>
		<td><img alt="P&aacute;gina Principal " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-1-10.jpg" width="35" height="16" border="0" usemap="#inicio"></td>
		<td><img alt="Noticias de Inter&eacute;s " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-1-11.jpg" width="49" height="16" border="0" usemap="#noticias"></td>
		<td><img alt="Sala de Chat " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-1-12.jpg" width="32" height="16" border="0" usemap="#chat"></td>
		<td><img alt="Foros en l&iacute;nea" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-1-13.jpg" width="28" height="16" border="0" usemap="#foro"></td>
		<td><img alt="Seminario" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-1-14.jpg" width="59" height="16" border="0" usemap="#seminario"></td>
		<td><img alt="Wiki de Telemedicina " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-1-15.jpg" width="27" height="16" border="0" usemap="#wiki"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-1-16.jpg" width="32" height="16"></td>
	</tr>
	<tr>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-2-0.jpg" width="30" height="22"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-2-1.jpg" width="43" height="22"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-2-2.jpg" width="22" height="22"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-2-3.jpg" width="37" height="22"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-2-4.jpg" width="38" height="22"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-2-5.jpg" width="75" height="22"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-2-6.jpg" width="62" height="22"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-2-7.jpg" width="71" height="22"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-2-8.jpg" width="81" height="22"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-2-9.jpg" width="79" height="22"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-2-10.jpg" width="35" height="22"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-2-11.jpg" width="49" height="22"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-2-12.jpg" width="32" height="22"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-2-13.jpg" width="28" height="22"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-2-14.jpg" width="59" height="22"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-2-15.jpg" width="27" height="22"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-2-16.jpg" width="32" height="22"></td>
	</tr>
	<tr>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-3-0.jpg" width="30" height="19"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-3-1.jpg" width="43" height="19"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-3-2.jpg" width="22" height="19"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-3-3.jpg" width="37" height="19"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-3-4.jpg" width="38" height="19"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-3-5.jpg" width="75" height="19"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-3-6.jpg" width="62" height="19"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-3-7.jpg" width="71" height="19"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-3-8.jpg" width="81" height="19"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-3-9.jpg" width="79" height="19"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-3-10.jpg" width="35" height="19"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-3-11.jpg" width="49" height="19"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-3-12.jpg" width="32" height="19"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-3-13.jpg" width="28" height="19"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-3-14.jpg" width="59" height="19"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-3-15.jpg" width="27" height="19"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-3-16.jpg" width="32" height="19"></td>
	</tr>
	<tr>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-4-0.jpg" width="30" height="65"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-4-1.jpg" width="43" height="65"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-4-2.jpg" width="22" height="65"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-4-3.jpg" width="37" height="65"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-4-4.jpg" width="38" height="65"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-4-5.jpg" width="75" height="65"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-4-6.jpg" width="62" height="65"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-4-7.jpg" width="71" height="65"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-4-8.jpg" width="81" height="65"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-4-9.jpg" width="79" height="65"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-4-10.jpg" width="35" height="65"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-4-11.jpg" width="49" height="65"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-4-12.jpg" width="32" height="65"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-4-13.jpg" width="28" height="65"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-4-14.jpg" width="59" height="65" id="logo_1"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-4-15.jpg" width="27" height="65" id="logo_2"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/banner-4-16.jpg" width="32" height="65" id="logo_3"></td>
	</tr>
</table>
<map name="inicio">
<area shape="rect" coords="0,0,35,16" href="index.php"  onmouseout="imagenOriginal()" onmouseover="cambiarImagen('logo_1','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/inicio-1.jpg','logo_2','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/inicio-2.jpg','logo_3','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/inicio-3.jpg')"/>
</map>
<map name="noticias">
<area shape="rect" coords="0,0,35,16" href="index.php"  onmouseout="imagenOriginal()" onmouseover="cambiarImagen('logo_1','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/noticias-1.jpg','logo_2','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/noticias-2.jpg','logo_3','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/noticias-3.jpg')"/>
</map>
<map name="chat">
<area shape="rect" coords="0,0,35,16" href="index.php"  onmouseout="imagenOriginal()" onmouseover="cambiarImagen('logo_1','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/chat-1.jpg','logo_2','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/chat-2.jpg','logo_3','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/chat-3.jpg')"/>
</map>
<map name="foro">
<area shape="rect" coords="0,0,35,16" href="index.php"  onmouseout="imagenOriginal()" onmouseover="cambiarImagen('logo_1','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/foro-1.jpg','logo_2','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/foro-2.jpg','logo_3','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/foro-3.jpg')"/>
</map>
<map name="seminario">
<area shape="rect" coords="0,0,35,16" href="index.php"  onmouseout="imagenOriginal()" onmouseover="cambiarImagen('logo_1','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/seminario-1.jpg','logo_2','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/seminario-2.jpg','logo_3','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/seminario-3.jpg')"/>
</map>
<map name="wiki">
<area shape="rect" coords="0,0,35,16" href="index.php"  onmouseout="imagenOriginal()" onmouseover="cambiarImagen('logo_1','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/wiki-1.jpg','logo_2','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/wiki-2.jpg','logo_3','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/banner/" ?>imagen/wiki-3.jpg')"/>
</map>
