//ADD LEGENDA +++++++++++++++++++++++++++++++++++
//      map.on("layers-add-result", function (evt) {
//
//      });


//		on(dom.byId("InsertWMS"), 'click', function(evt){
//			    var georssUrl = document.getElementById("TxtInsertMap").value
//     			var georss = new GeoRSSLayer(georssUrl);
//    			georss.on("load", function() {
//      				domStyle.set("loadingWms", "display", "none");
//      				var template = new InfoTemplate("${name}", "${description}");
//      				var layers = georss.getFeatureLayers();
//      					arrayUtils.forEach(layers, function(l) {
//        					l.setInfoTemplate(template);
//      					});
//    		  });
//
//			//TOC REFRES DATA
//			var h = map.on('layer-add-result', function(evt){
//                       	toc.layerInfos.splice(1, 0, {
//                      		layer: georss,
//                      		title: "WMS LAyer",
//							//noLegend:true
//                      		collapsed: false, // whether this root layer should be collapsed initially, default false.
//                      		slider: true, // whether to display a transparency slider.
//                     	 	autoToggle: false //whether to automatically collapse when turned off, and expand when turn on for groups layers. default true.
//                    		});
//                    	toc.refresh();
//                    	h.remove();
//                   	});
//    				map.addLayer(georss);
//					toc.refresh();
//			});

            on(dom.byId("InsertNewLayer"), 'click', function(evt){
				var LyName = "Layer"+map.layerIds.length
                //if (dynaLayer3 == null) {
				  var SrvMap = document.getElementById("TxtInsertMap").value;
                  Layer = new ArcGISDynamicMapServiceLayer(SrvMap, {
                    //opacity: 0;
                  });
				   map.addLayer(Layer);
				  //alert(dynaLayer4.layerInfos.name)
                  var h = map.on('layer-add-result', function(evt){
                    toc.layerInfos.splice(1, 0, {
                      layer: Layer,
                      title: LyName,
                      // collapsed: true, // whether this root layer should be collapsed initially, default false.
                      slider: true, // whether to display a transparency slider.
                      autoToggle: false //whether to automatically collapse when turned off, and expand when turn on for groups layers. default true.
                    });
                    toc.refresh();
                    h.remove();
					//dom.byId("SetOpacity").disabled=true;
                  });
                 
               // } end if
            });

         //     on(dom.byId("InsertShp"), 'click', function(evt){
//                alert('Iinser Shapefile FILE');
//			     alert("DJ"+dojo.byId('dFloatingPane').style.visibility);
//              });
//
//			  on(dom.byId("InsertCSV"), 'click', function(evt){
//                alert('Iinser CSV FILE');
//			    dijit.byId('dFloatingPane').style.visibility="show";
//              });
//
//			  on(dom.byId("InsertGpx"), 'click', function(evt){
//                alert('Iinser GPS FILE');
//				 mapReady()
//
//              });


			//ADD FROM MAP SERVER
			on(dom.byId("CmdAddPetaJDSN"), 'click', function(evt){
				$("#LoadingMaster").show();
				var SrvMap = document.getElementById("TxtJdsnService").value;
				var NMSrvMap = document.getElementById("TxtJdsnName").value;
				if (document.getElementById("SldJDSN").value=="on"){
					var  SldSR = true;
					}else{
					var SldSR = false;
					}
				if ((document.getElementById("TxtJdsnTypeSrv").value=="MapServer") || (document.getElementById("TxtJdsnTypeSrv").value=="Dynamic")){

                  JdsnLyr1 = new ArcGISDynamicMapServiceLayer(SrvMap, {
				    mode: FeatureLayer.MODE_SNAPSHOT,
					opacity: 1.0
				   });
			   }
			    if (document.getElementById("TxtJdsnTypeSrv").value=="FeatureServer"){
                  JdsnLyr1 = new FeatureLayer(SrvMap, {
				    mode: FeatureLayer.MODE_SNAPSHOT,
                	outFields: ["*"],
					opacity: 1.0
				   });
			   }

                  var h = map.on('layer-add-result', function(evt){
                    toc.layerInfos.splice(1, 0, {
                      layer: JdsnLyr1,
                      title: NMSrvMap,
                      collapsed: true, // whether this root layer should be collapsed initially, default false.
                      slider: SldSR, // whether to display a transparency slider.
                      autoToggle: false //whether to automatically collapse when turned off, and expand when turn on for groups layers. default true.
					});

                    toc.refresh();
                    h.remove();
					$("#LoadingMaster").hide();
                  });
                  map.addLayer(JdsnLyr1);
				 $("#DlgJDSN").hide();
				 
				
			});


	  //PRINT ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     function createPrintDijit(printTitle) {
          var layoutTemplate, templateNames, mapOnlyIndex, templates;

          // create an array of objects that will be used to create print templates
          var layouts = [{
            name: "Letter ANSI A Landscape",
            label: "Landscape (PDF)",
            format: "pdf",
            options: {
              legendLayers: [], // empty array means no legend
              scalebarUnit: "Miles",
              titleText: printTitle + ", Landscape PDF"
            }
          }, {
            name: "Letter ANSI A Portrait",
            label: "Portrait (Image)",
            format: "jpg",
            options:  {
              legendLayers: [],
              scalebarUnit: "Miles",
              titleText: printTitle + ", Portrait JPG"
            }
          }];

          // create the print templates
          var templates = arrayUtils.map(layouts, function(lo) {
            var t = new PrintTemplate();
            t.layout = lo.name;
            t.label = lo.label;
            t.format = lo.format;
            t.layoutOptions = lo.options;
            return t;
          });

          app.printer = new Print({
            map: app.map,
            templates: templates,
            url: app.printUrl
          }, dom.byId("print_button"));
          app.printer.startup();
        }


	    // Elevasi +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	       //map.on("load", init);
		   var tbA, epWidget, lineSymbol;
					var chartOptions = {
						title: "Garafik Ketinggian",
						chartTitleFontSize: 12,
						axisTitleFontSize: 8,
						axisLabelFontSize: 8,
						indicatorFontColor: '#eee',
						indicatorFillColor: '#666',
						titleFontColor: '#eee',
						axisFontColor: '#ccc',
						axisMajorTickColor: '#333',
						skyTopColor: "#B0E0E6",
						skyBottomColor: "#4682B4",
						waterLineColor: "#eee",
						waterTopColor: "#ADD8E6",
						waterBottomColor: "#0000FF",
						elevationLineColor: "#D2B48C",
						elevationTopColor: "#8B4513",
						elevationBottomColor: "#CD853F",
						elevationMarkerStrokeColor: "#FF0000",
						elevationMarkerSymbol: "m -6 -6, l 12 12, m 0 -12, l -12 12"
					 };

						on(dom.byId('LineA'), "click", function (evt) {
                            initToolbarElvasi('line');
                        });

						on(dom.byId('PolylineA'), "click", function (evt) {
                            initToolbarElvasi('polyline');
                        });

						on(dom.byId('FreehandPolylineA'), "click", function (evt) {
                            initToolbarElvasi('freehandpolyline');
                        });

						on(dom.byId('StarA'), "click", function (evt) {
						    document.getElementById("InfoElv").innerHTML="";
							init();
                        });

						on(dom.byId('CloseElvasi'), "click", function (evt) {
                            epWidget.clearProfile(); //Clear profile
							//epWidget.stop();
                            tbA.finishDrawing();
							tbA.deactivate();
							map.graphics.clear();
							map.enableMapNavigation();
                        })

						on(dom.byId('ClaerElvasiA'), "click", function (evt) {
                            epWidget.clearProfile(); //Clear profile
							tbA.deactivate();
							map.graphics.clear();
							map.enableMapNavigation();
							tbA.finishDrawing();
                        })


				function init() {
                    on(dom.byId("unitsSelect"), "change", function (evt) {
                        if (epWidget) {
                            epWidget.set("measureUnits", evt.target.options[evt.target.selectedIndex].value);
                        }
                    })

                    // lineSymbol used for freehand polyline and line.
                    lineSymbol = new CartographicLineSymbol(
                            CartographicLineSymbol.STYLE_SOLID,
                            new Color([255, 0, 0]), 2,
                            CartographicLineSymbol.CAP_ROUND,
                            CartographicLineSymbol.JOIN_MITER, 2
                    );

                    var profileParams = {
                        map: map,
                        profileTaskUrl: "https://elevation.arcgis.com/arcgis/rest/services/Tools/ElevationSync/GPServer",
                        scalebarUnits: Units.MILES,
						chartOptions: chartOptions
                    };
                    epWidget = new ElevationsProfileWidget(profileParams, dom.byId("profileChartNode"));
                    epWidget.startup();
                }

                function initToolbarElvasi(toolName) {
                    epWidget.clearProfile(); //Clear profile

                    map.graphics.clear();
                    tbA = new Draw(map);
                    tbA.on("draw-end", addGraphic);
                    tbA.activate(toolName);
                    map.disableMapNavigation();
                }

                function addGraphic(evt) {
                    //deactivate the toolbar and clear existing graphics
                    tbA.deactivate();
                    map.enableMapNavigation();
                    var symbol = lineSymbol;
                    map.graphics.add(new Graphic(evt.geometry, symbol));
                    epWidget.set("profileGeometry", evt.geometry);

                    var sel = dom.byId("unitsSelect");
                    if (sel) {
                        var val = sel.options[sel.selectedIndex].value;
                        epWidget.set("measureUnits", val);
                    }
                }


	  //Measure/PENGUKURAN +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	  var sfs = new SimpleFillSymbol(
          "solid",
          new SimpleLineSymbol("solid", new Color([195, 176, 23]), 2),
          null
        );

        var parcelsLayer = new FeatureLayer("https://sampleserver1.arcgisonline.com/ArcGIS/rest/services/Louisville/LOJIC_LandRecords_Louisville/MapServer/0", {
          mode: FeatureLayer.MODE_ONDEMAND,
          outFields: ["*"]
        });
        parcelsLayer.setRenderer(new SimpleRenderer(sfs));
        map.addLayers([parcelsLayer]);

        //dojo.keys.copyKey maps to CTRL on windows and Cmd on Mac., but has wrong code for Chrome on Mac
        var snapManager = map.enableSnapping({
          snapKey: has("mac") ? keys.META : keys.CTRL
        });
        var layerInfos = [{
          layer: parcelsLayer
        }];
        snapManager.setLayerInfos(layerInfos);

        var measurement = new Measurement({
          map: map
        }, dom.byId("measurementDiv"));
        measurement.startup();

	  //Skala Batang +++++++++++++++++++++++++++++++++++++++++++
	  var scalebar = new Scalebar({
          map: map,
          scalebarUnit: "dual"
        });

	 //Pencarian Lokasi ++++++++++++++++++++++++++++++++++++++++
	  var search = new Search({
            enableButtonMode: true, //this enables the search widget to display as a single button
            enableLabel: false,
            enableInfoWindow: true,
            showInfoWindowOnSelect: false,
            map: map
         }, "search");

         var sources = search.get("sources");
         sources.push({
            featureLayer: new FeatureLayer("https://services.arcgis.com/V6ZHFr6zdgNZuVG0/arcgis/rest/services/CongressionalDistricts/FeatureServer/0"),
            searchFields: ["DISTRICTID"],
            displayField: "DISTRICTID",
            exactMatch: false,
            outFields: ["DISTRICTID", "NAME", "PARTY"],
            name: "Congressional Districts",
            placeholder: "3708",
            maxResults: 6,
            maxSuggestions: 6,

            //Create an InfoTemplate and include three fields
            infoTemplate: new InfoTemplate("Congressional District", "District ID: ${DISTRICTID}</br>Name: ${NAME}</br>Party Affiliation: ${PARTY}"),
            enableSuggestions: true,
            minCharacters: 0
         });

         sources.push({
            featureLayer: new FeatureLayer("https://services.arcgis.com/V6ZHFr6zdgNZuVG0/arcgis/rest/services/US_Senators/FeatureServer/0"),
            searchFields: ["Name"],
            displayField: "Name",
            exactMatch: false,
            name: "Senator",
            outFields: ["*"],
            placeholder: "Senator name",
            maxResults: 6,
            maxSuggestions: 6,

            //Create an InfoTemplate

            infoTemplate: new InfoTemplate("Senator information", "Name: ${Name}</br>State: ${State}</br>Party Affiliation: ${Party}</br>Phone No: ${Phone_Number}<br><a href=${Web_Page} target=_blank ;'>Website</a>"),
            enableSuggestions: true,
            minCharacters: 0
         });

		 //Set the sources above to the search widget
         search.set("sources", sources);
         search.startup();

	 //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 //NAVIGASI Tools
	  navToolbar = new Navigation(map);
          on(navToolbar, "onExtentHistoryChange", extentHistoryChangeHandler);

          registry.byId("zoomin").on("click", function () {
            navToolbar.activate(Navigation.ZOOM_IN);
          });

          registry.byId("zoomout").on("click", function () {
            navToolbar.activate(Navigation.ZOOM_OUT);
          });

          registry.byId("zoomfullext").on("click", function () {
            navToolbar.zoomToFullExtent();
          });

          registry.byId("zoomprev").on("click", function () {
            navToolbar.zoomToPrevExtent();
          });

          registry.byId("zoomnext").on("click", function () {
            navToolbar.zoomToNextExtent();
          });

          registry.byId("pan").on("click", function () {
            navToolbar.activate(Navigation.PAN);
          });

          registry.byId("deactivate").on("click", function () {
            navToolbar.deactivate();
          });

          function extentHistoryChangeHandler () {
            registry.byId("zoomprev").disabled = navToolbar.isFirstExtent();
            registry.byId("zoomnext").disabled = navToolbar.isLastExtent();
          }

	//DYNAMICN F INFO WINDOW ++++++++++++++++++++++++++++++++++++++++++++
	 //function mapReady () {

          map.on("click", executeIdentifyTask);

          identifyParams = new IdentifyParameters();
          identifyParams.tolerance = 10;
          identifyParams.returnGeometry = true;
          identifyParams.layerIds = [0, 2];
          identifyParams.layerOption = IdentifyParameters.LAYER_OPTION_ALL;
          identifyParams.width = map.width;
          identifyParams.height = map.height;
      // }

		 function UpdateRESTMap(){
			for(var s=1; s<map.layerIds.length; s++) {
    				var layerA = map.getLayer(map.layerIds[s]);
   					 if(layerA.visible==true){
					 	identifyTask = new IdentifyTask(layerA.url);
					     //alert(layerA.id + ' ' + layerA.opacity + ' ' + layerA.visible+ ' '+layerA.url);
					 }
  			 }
		 }

	  function executeIdentifyTask (event) {
		  if(document.getElementById("infoWIn1").className=="ui-info-button-active"){
		  UpdateRESTMap()
          identifyParams.geometry = event.mapPoint;
          identifyParams.mapExtent = map.extent;


          var deferred = identifyTask
            .execute(identifyParams)
            .addCallback(function (response) {
              // response is an array of identify result objects
              // Let's return an array of features.
              return arrayUtils.map(response, function (result) {
                var feature = result.feature;
                var layerName = result.layerName;
                feature.attributes.layerName = layerName;

                  console.log(feature.attributes.PARCELID);
                  var buildingFootprintTemplate = new InfoTemplate("",
                    "");
                  feature.setInfoTemplate(buildingFootprintTemplate);

                return feature;
              });
            });

          map.infoWindow.setFeatures([deferred]);
          map.infoWindow.show(event.mapPoint);
		   }//END actic tombol
    }
