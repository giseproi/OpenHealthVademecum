//==============================================
//              GoogleMaps
//==============================================
//<![CDATA[

	
    function load() 
    {
      if (GBrowserIsCompatible()) 
      {
        
        var gmarkers = [];
	var gicons = [];
		
	gicons["especialista"] = new GIcon();	
	gicons["especialista"].image = 'grafico/iconos/especialista.png';
	gicons["especialista"].shadow = 'grafico/iconos/shadow.png';
	gicons["especialista"].iconSize = new GSize(21, 31); 
	gicons["especialista"].shadowSize = new GSize(52, 29);
	gicons["especialista"].iconAnchor = new GPoint(10,31); 
	gicons["especialista"].infoWindowAnchor = new GPoint(21, 0);	
	
	gicons["entidad"] = new GIcon(gicons["especialista"],"grafico/iconos/entidad.png");
	gicons["empresa_equipo"] = new GIcon(gicons["especialista"],"grafico/iconos/equipo.png");
	gicons["empresa_inter"] = new GIcon(gicons["especialista"],"grafico/iconos/interconexion.png");
	gicons["proyecto"] = new GIcon(gicons["especialista"],"grafico/iconos/proyecto.png");

        
        var map = new GMap2(document.getElementById("map"));
        map.setCenter(new GLatLng(4.627933762434,-74.06577944755554), 17);
        map.addControl(new GMapTypeControl());
        map.addControl(new GLargeMapControl());
       // map.addControl(new GOverviewMapControl());
        //map.setMapType(G_SATELLITE_MAP);
        
        map.setMapType(G_NORMAL_MAP);
        
	
        
	
	GEvent.addListener(map, 'click', function(overlay, point) 
	{
		
		
		//Borrar el marcador
		if (overlay) 
		{
			map.removeOverlay(overlay);	
		} 
		else if (point) 
		{	
			//Categoria Principal
			var categoria;
			if(document.getElementById("categoria"))
			{
				categoria=document.getElementById("categoria").value;
			}
			else
			{
				categoria="desconocida";
			
			}
			
			//Remover todos los marcadores
			map.clearOverlays();
			
			//Colocar un marcador
			//map.recenterOrPanToLatLng(point);
			//var marker = new GMarker(point,{draggable: true});
			var html = "<html><head></head><body>Latitud="+ point.y +"<br>Longitud="+ point.x +"<br>Categoria="+ categoria +"</body></html>"; 
			var marker = createMarker(point,"nombre",html,categoria,gicons[categoria]);
			
			
			GEvent.addListener(marker, "dragstart", function() 
			{
				map.closeInfoWindow();
			});
			
			GEvent.addListener(marker, "dragend", function() 
			{
			
				var html = "<html><head></head><body>Latitud="+ this.getPoint().lat() +"<br>Longitud="+ this.getPoint().lng() +"</body></html>"; 
				marker.openInfoWindowHtml(html);
			});
			
			//Guardar los datos de latitud y longitud
			
				document.getElementById("latitud").value=point.y;
				
				document.getElementById("longitud").value=point.x;
			
			map.addOverlay(marker);
			marker.openInfoWindowHtml(html);
			
		}
	
	});
	
	var tipo;
	if(document.getElementById("marcador"))
	{
		tipo=document.getElementById("marcador").value;
	}
	else
	{
		tipo="desconocido";
	
	}
	marcador(tipo,map);
	
      }
    }
    
    // Crear marcador y mostrar infowindow
      function createMarker(point,nombre,html,categoria,icono) 
      {
        
        var marker = new GMarker(point,icono, {draggable: true});
        
        // === Clasificar por categoria como propiedad del marcador ===
        marker.categoria = categoria;                                 
        marker.nombre = nombre;
        GEvent.addListener(marker, "click", function() {
          marker.openInfoWindowHtml(html);
        });
       // gmarkers.push(marker);
        return marker;
      }
      
      
       // Mostrar marcadores de una sola categoria
      function show(categoria) 
      {
        for (var i=0; i<gmarkers.length; i++) 
        {
          	if (gmarkers[i].categoria == categoria) 
          	{
            		gmarkers[i].show();
        	}
      	}
        //document.getElementById(categoria+"box").checked = true;
      }

      // Ocultar marcadores
      function hide(category) 
      {
		for (var i=0; i<gmarkers.length; i++) 
		{
			if (gmarkers[i].mycategory == category) 
			{
				gmarkers[i].hide();
			}
		}
		//document.getElementById(category+"box").checked = false;
		// == close the info window, in case its open on a marker that we just hid
		map.closeInfoWindow();
      }

	// == a checkbox has been clicked ==
	function boxclick(box,categoria) 
	{
		if (box.checked) 
		{
		show(categoria);
		} 
		else 
		{
		hide(categoria);
		}
		// == rebuild the side bar
		//makeSidebar();
	}

	function myclick(i) 
	{
		GEvent.trigger(gmarkers[i],"click");
	}   
    
    
	function limpiar_mapa()
	{
	
		var map = new GMap2(document.getElementById("map"));
		var marker = map.getFirstMarker();
		while (marker != null)
		{
			marker.remove();	
			marker = map.getFirstMarker();
		}
	
	}
	
	
	function marcador(tipo,map)
	{
		var pagina;
		pagina=tipo;
		GDownloadUrl(pagina, function(data) {
				var xml = GXml.parse(data);
				var markers = xml.documentElement.getElementsByTagName("marker");
				for (var i = 0; i < markers.length; i++) 
				{
				var name = markers[i].getAttribute("name");
				var html = "<html><head></head><body>"+ markers[i].getAttribute("name") +"<br>"+ markers[i].getAttribute("direccion") +"</body></html>"; 
				var point = new GLatLng(parseFloat(markers[i].getAttribute("lat")),
							parseFloat(markers[i].getAttribute("lng")));
				var marker = createMarker(point,name,"","","");
				map.setCenter(point, 16);
				map.addOverlay(marker);
				marker.openInfoWindowHtml(html);
				}
			});
		
			
		return true; 
	
	}

    //]]>

//=========================================================