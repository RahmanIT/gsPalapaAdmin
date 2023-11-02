<?php error_reporting(0);  if($P[0]["ROLE"]>=2 && $P[0]["ROLE"]<=3 && $P[0]["EMAIL"]!=""){
$query_RstFtLyr = "SELECT NM_FEATURE, URL_FEATURE FROM tb_feature_edit WHERE KD_FT = $segmen3";
$RstFtLyr = mysqli_query($Congis, $query_RstFtLyr) or die(mysqli_error());
$row_RstFtLyr = mysqli_fetch_assoc($RstFtLyr);
$totalRows_RstFtLyr = mysqli_num_rows($RstFtLyr);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1,user-scalable=no">
    <title>Feaute Services edittor</title>

    <link rel="stylesheet" href="https://js.arcgis.com/3.26/dijit/themes/claro/claro.css">
    <link rel="stylesheet" href="https://js.arcgis.com/3.26/esri/css/esri.css">
    <style>
      html, body {
        height: 100%;
        width: 100%;
        margin: 0;
      }

      body {
        background-color: #fff;
        overflow: hidden;
        font-family: Helvetica, san-serif;
      }

      #templatePickerPane {
        width: 225px;
        overflow: hidden;
      }

      #panelHeader {
        background-color: #92A661;
        border-bottom: solid 1px #92A860;
        color: #FFF;
        font-size: 18px;
        height: 24px;
        line-height: 22px;
        margin: 0;
        overflow: hidden;
        padding: 10px 10px 10px 10px;
      }

      #map {
        margin-right: 5px;
        padding: 0;
      }

      .esriEditor .templatePicker {
        padding-bottom: 5px;
        padding-top: 5px;
        height: 500px;
        border-radius: 0px 0px 4px 4px;
        border: solid 1px #92A661;
      }

      .dj_ie .infowindow .window .top .right .user .content, .dj_ie .simpleInfoWindow .content {
        position: relative;
      }
    </style>

    <script src="https://js.arcgis.com/3.26/"></script>
    <script>
      var map;

      require([
	    "esri/dijit/FeatureTable",
        "esri/geometry/Extent",
        "esri/symbols/SimpleMarkerSymbol",
        "esri/symbols/SimpleLineSymbol",
        "esri/Color",
		
	  "dojo/dom-construct",
      "dojo/dom",
      "dojo/number",
      "dojo/ready",
      "dojo/on",
      "dojo/_base/lang",
      "dijit/registry",
      "dijit/form/Button",
      "dijit/layout/ContentPane",
      "dijit/layout/BorderContainer",
      "dijit/form/TextBox",
	  
        "esri/config",
        "esri/map",
        "esri/SnappingManager",
        "esri/dijit/editing/Editor",
        "esri/layers/FeatureLayer",
        "esri/tasks/GeometryService",
        "esri/toolbars/draw",
        "dojo/keys",
        "dojo/parser",
        "dojo/_base/array",
        "dojo/i18n!esri/nls/jsapi",
        "dijit/layout/BorderContainer",
        "dijit/layout/ContentPane",
        "dojo/domReady!"
      ], function (
	    FeatureTable, Extent, SimpleMarkerSymbol, SimpleLineSymbol, Color, 
		
		domConstruct, dom, dojoNum, ready, on,lang,
      registry, Button, ContentPane, BorderContainer, TextBox,
		
        esriConfig, Map, SnappingManager, Editor, FeatureLayer, GeometryService,
        Draw, keys, parser, arrayUtils, i18n
        ) {

        parser.parse();

        //snapping is enabled for this sample - change the tooltip to reflect this
        i18n.toolbars.draw.start += "<br/>Press <b>CTRL</b> to enable snapping";
        i18n.toolbars.draw.addPoint += "<br/>Press <b>CTRL</b> to enable snapping";

        //This sample requires a proxy page to handle communications with the ArcGIS Server services. You will need to
        //replace the url below with the location of a proxy on your machine. See the 'Using the proxy page' help topic
        //for details on setting up a proxy page.
        esriConfig.defaults.io.proxyUrl = "/proxy/";

        //This service is for development and testing purposes only. We recommend that you create your own geometry service for use within your applications
        esriConfig.defaults.geometryService = new GeometryService("https://utility.arcgisonline.com/ArcGIS/rest/services/Geometry/GeometryServer");

        map = new Map("map", {
          basemap: "topo",
          center: [-77.036, 38.891],
          zoom: 16
        });
        
		//map.on("load", loadTable);
        map.on("layers-add-result", initEditing);

        var LyFt = new FeatureLayer("<?php echo $row_RstFtLyr['URL_FEATURE']; ?>", {
          mode: FeatureLayer.MODE_ONDEMAND,
          outFields: ["*"]
        });

        map.addLayers(LyFt);
        map.infoWindow.resize(400, 300);
		
		
		  // create new FeatureTable and set its properties 
          var myFeatureTable = new FeatureTable({
            featureLayer : LyFt,
            map : map,
            showAttachments: true,
            // only allows selection from the table to the map 
            syncSelection: true, 
            zoomToSelection: true, 
            gridOptions: {
              allowSelectAll: true,
              allowTextSelection: true,
            },
            editable: true,
            dateOptions: {
              // set date options at the feature table level 
              // all date fields will adhere this 
              datePattern: "MMMM d, y"
            },
            // define order of available fields. If the fields are not listed in 'outFields'
            // then they will not be available when the table starts. 
            outFields: ["*"],
            // use fieldInfos property to change field's label (column header), 
            // the editability of the field, and to format how field values are displayed
            fieldInfos: [
              {
                name: 'Building_Size_Sqft', 
                alias: 'Building Size', 
                editable: false,
                format: {
                  template: "${value} sqft"
                }
              },
              {
                name: 'Available_Size_Sqft', 
                alias: 'Available Size',
                format: {
                  template: "${value} sqft"
                }
              },
              {
                name: 'Primary_Parking_Type', 
                format: {
                  template: "${value} parking"
                }
              }
            ],
          }, 'myTableNode');

          myFeatureTable.startup();

          // listen to show-attachments event
          myFeatureTable.on("show-attachments", function(evt){
            console.log("show-attachments event - ", evt);
          });
		  
		  
        // end function tabel
		

        function initEditing (event) {
          var featureLayerInfos = arrayUtils.map(event.layers, function (layer) {
            return {
              "featureLayer": layer.layer
            };
          });

          var settings = {
            map: map,
            layerInfos: featureLayerInfos
          };
          var params = {
            settings: settings
          };
          var editorWidget = new Editor(params, 'editorDiv');
          editorWidget.startup();

          //snapping defaults to Cmd key in Mac & Ctrl in PC.
          //specify "snapKey" option only if you want a different key combination for snapping
          map.enableSnapping();
        }
      });
    </script>
  </head>
  
  <body class="claro">
    <div id="mainWindow" data-dojo-type="dijit/layout/BorderContainer" data-dojo-props="design:'headline',gutters:false" style="width:100%; height:100%;">
      <div id="map" data-dojo-type="dijit/layout/ContentPane" data-dojo-props="region:'center'"></div>
      <div data-dojo-type="dijit/layout/ContentPane" id="templatePickerPane" data-dojo-props="region:'left'">
        <div id="panelHeader">
          Default Editor
        </div>
        <div style="padding:10px;" id="editorDiv">

        </div>
    </div>
	        <div id="bot" data-dojo-type="dijit/layout/ContentPane" data-dojo-props="region:'bottom', splitter:true" style="height:40%">
				<div id="myTableNode">tb</div>
			</div>
      </div>
	
  </body>

</html>
<?php
 mysqli_free_result($RstFtLyr);
}
?>
