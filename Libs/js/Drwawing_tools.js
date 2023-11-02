       function initToolbar1() {	
          tb = new Draw(map);
          tb.on("draw-end", addGraphic1);

          // event delegation so a click handler is not
          // needed for each individual button
          on(dom.byId("info"), "click", function(evt) {
			  
			 if ( evt.target.id === "Point" || evt.target.id === "Multipoint") { 
			    $("#TdWarna").show();
				$("#TdIcon").show();
				$("#TdBesarIcon").show();
			  	$("#TdTransparan").hide();
			  	$("#TdOpacty").hide();
			  	$("#TdGaris").hide();
			  	$("#TdWarnaGaris").hide();
			  	$("#TdTebalGaris").hide();
				$('#TdTypeGaris').hide();
				$("#TdTextBox").hide();
				$("#TdFontType").hide();
				$("#TdBesarHuruf").hide();
			  } else if ( evt.target.id === "Line" || evt.target.id === "Polyline" || evt.target.id === "FreehandPolyline") {
				 $("#TdWarna").hide();
				 $("#TdIcon").hide();
				 $("#TdBesarIcon").hide();
			  	$("#TdTransparan").show();
			  	$("#TdOpacty").hide();
			  	$("#TdGaris").hide();
			  	$("#TdWarnaGaris").show();
			  	$("#TdTebalGaris").show();
				$('#TdTypeGaris').show();
				$("#TdTextBox").hide();
				$("#TdFontType").hide();
				$("#TdBesarHuruf").hide()
			  } else if (evt.target.id === "Triangle" || evt.target.id === "Extent" || evt.target.id === "Circle" || evt.target.id === "Ellipse" || evt.target.id === "Polygon" || evt.target.id === "FreehandPolygon"){
			  	$("#TdWarna").show();
				$("#TdIcon").hide();
				$("#TdBesarIcon").hide();
			  	$("#TdTransparan").hide();
			  	$("#TdOpacty").show();
			  	$("#TdGaris").show();
			  	$("#TdWarnaGaris").show();
			  	$("#TdTebalGaris").show();
				$('#TdTypeGaris').hide();
				$("#TdTextBox").hide();
				$("#TdFontType").hide();
				$("#TdBesarHuruf").hide()
			  } else {
			     $("#TdWarna").show();
				 $("#TdIcon").hide();
				 $("#TdBesarIcon").hide();
			  	$("#TdTransparan").hide();
			  	$("#TdOpacty").hide();
			  	$("#TdGaris").hide();
			  	$("#TdWarnaGaris").hide();
			  	$("#TdTebalGaris").hide();
				$('#TdTypeGaris').hide();
				$("#TdTextBox").show();
				$("#TdFontType").show();
				$("#TdBesarHuruf").show(); 
			  }
			  
            if ( evt.target.id === "info" ) {
              return;
            }
            var tool = evt.target.id.toLowerCase();
            map.disableMapNavigation();
            tb.activate(tool);
          });
        }

        function addGraphic1(evt) {
          //deactivate the toolbar and clear existing graphics 
          tb.deactivate(); 
          map.enableMapNavigation();

//===============================================================
		var LnC1 = document.getElementById("TxtColor1").value;
	    var LnC2 = document.getElementById("TxtColor2").value;
		var TbLn = document.getElementById("integerspinner2").value
		var alp = document.getElementById("Alpa2").value
		var alp1 = document.getElementById("Trnaparan1").value
		var c = new Color(LnC1);
		var d =  new Color(LnC2);
		
          var symbol1;
          if ( evt.geometry.type === "point" || evt.geometry.type === "multipoint") {
			  
			  // markerSymbol is used for point and multipoint, see http://raphaeljs.com/icons/#talkq for more examples
			  
			  var Icn = document.getElementById("IconXcode").value;
        		var markerSymbol = new SimpleMarkerSymbol();
        			markerSymbol.setPath(Icn)
					markerSymbol.setSize(document.getElementById("BesarIcon").value)
       				markerSymbol.setColor(new Color(LnC1));
            	symbol1 = markerSymbol;
          } else if ( evt.geometry.type === "line" || evt.geometry.type === "polyline") {
			  if (document.getElementById("CboStyleGaris").value==1){
				  var StLn1  = CartographicLineSymbol.STYLE_SOLID
			  } else if (document.getElementById("CboStyleGaris").value == 2){
				  var StLn1  = CartographicLineSymbol.STYLE_DASH
			  }else if (document.getElementById("CboStyleGaris").value == 3){
				  var StLn1  = CartographicLineSymbol.STYLE_DASHDOT
			  }else if (document.getElementById("CboStyleGaris").value == 4){
				  var StLn1  = CartographicLineSymbol.STYLE_DASHDOTDOT
			  }else if (document.getElementById("CboStyleGaris").value == 5){
				  var StLn1  = CartographicLineSymbol.STYLE_DOT
			  }else if (document.getElementById("CboStyleGaris").value == 6){
				  var StLn1  = CartographicLineSymbol.STYLE_LONGDASH
			  }else if (document.getElementById("CboStyleGaris").value == 7){
				  var StLn1  = CartographicLineSymbol.STYLE_LONGDASHDOT
			  }else if (document.getElementById("CboStyleGaris").value == 8){
				  var StLn1  = CartographicLineSymbol.STYLE_SHORTDASH
			  }else if (document.getElementById("CboStyleGaris").value == 9){
				  var StLn1  = CartographicLineSymbol.STYLE_SHORTDASHDOT
			  }else if (document.getElementById("CboStyleGaris").value == 10){
				  var StLn1  = CartographicLineSymbol.STYLE_SHORTDASHDOTDOT
			  }else if (document.getElementById("CboStyleGaris").value == 11){
				  var StLn1  = CartographicLineSymbol.STYLE_SHORTDOT
			  }else if (document.getElementById("CboStyleGaris").value == 12){
				  var StLn1  = CartographicLineSymbol.STYLE_NULL
			  }
		      var lineSymbol = new CartographicLineSymbol();
			      lineSymbol.setColor([d.r, d.g, d.b, alp1]);
				  lineSymbol.setWidth(TbLn);
				  lineSymbol.setStyle(StLn1);
			  	  lineSymbol.setCap(CartographicLineSymbol.CAP_ROUND);
				  lineSymbol.setJoin(CartographicLineSymbol.JOIN_ROUND);
				  lineSymbol.setMiterLimit(1); 
            symbol1 = lineSymbol;
          }  else if ( evt.geometry.type === "polygon") {
			  
			  if (document.getElementById("CboStyleLn").value==1){
				  var FillStln1 = SimpleFillSymbol.STYLE_SOLID;
			  } else if (document.getElementById("CboStyleLn").value==2){
			  	  var FillStln1 = SimpleFillSymbol.STYLE_CROSS;
			  } else if (document.getElementById("CboStyleLn").value==3){
			  	  var FillStln1 = SimpleFillSymbol.STYLE_DIAGONAL_CROSS;
			  }else if (document.getElementById("CboStyleLn").value==4){
			  	  var FillStln1 = SimpleFillSymbol.STYLE_FORWARD_DIAGONAL;
			  }else if (document.getElementById("CboStyleLn").value==5){
			  	  var FillStln1 = SimpleFillSymbol.STYLE_BACKWARD_DIAGONAL;
			  }else if (document.getElementById("CboStyleLn").value==6){
			  	  var FillStln1 = SimpleFillSymbol.STYLE_HORIZONTAL;
			  }else if (document.getElementById("CboStyleLn").value==7){
			  	  var FillStln1 = SimpleFillSymbol.STYLE_VERTICAL;
			  }else if (document.getElementById("CboStyleLn").value==8){
			  	  var FillStln1 = SimpleFillSymbol.STYLE_NULL;
			  }else{
				 alert(evt.geometry.type);
				
			  }
			  
			  var StyPoly = new SimpleFillSymbol();
			      StyPoly.setStyle(FillStln1);
				  StyPoly.setColor([c.r,c.g,c.b,alp]);
				  StyPoly.setOutline(new SimpleLineSymbol(SimpleLineSymbol.STYLE_SOLID, new Color(LnC2), TbLn));
            symbol1 = StyPoly;
          }

          map.graphics.add(new Graphic(evt.geometry, symbol1));
        }
	
	 on(dom.byId("clearDrw"), 'click', function(evt){
       tb.finishDrawing();
	   map.graphics.clear();
	   
     });
	 
    var myPalette = new ColorPalette({
        palette: "7x10",
        onChange: function(val){ 
		   //alert(val); 
		   document.getElementById("TxtColor1").value = val;
		   document.getElementById("TxtColor1").style.background = val;
		 }
    }, "placeHolder").startup();
	
	var myPalette1 = new ColorPalette({
        palette: "7x10",
        onChange: function(val){ 
		   //alert(val); 
		   document.getElementById("TxtColor2").value = val;
		   document.getElementById("TxtColor2").style.background = val;
		 }
    }, "placeHolder1").startup();
  