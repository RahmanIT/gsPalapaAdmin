// JavaScript Document<script>
var map;var LyrInset;var layer;var layerSlec;var sch;var x_max;var x_min;var y_max;var y_min;var urlg='';var basemapLy;var BasemapSouece1;var BasemapSouece2;var BasemapSouece3;var BasemapSouece4;var BasemapSouece5;var BasemapSouece6;
function GetSumberCSW(){
 window.open(document.getElementById("SumberCSW").value, '_blank');
};
function GetSumberXML(){
 window.open(document.getElementById("SumberXML").value, '_blank');
};
function InfoMetadata(p){
document.getElementById('MetadataBody').innerHTML = "Loading..";
   $('#Loading').show();
	$.ajax({
	url: "/WebPortal/Metadata/info.json",
	data: "nama="+p,
	cache: false,
	success: function(msg){
		$('#MetadataBody').html(msg)	
		}
	});
};
function InfoMetadataISO(p){
document.getElementById('MetadataBody').innerHTML = "Loading..";
   $('#Loading').show();
	$.ajax({
	url: "/WebPortal/MetadataISO/info.json",
	data: "nama="+p,
	cache: false,
	success: function(msg){
		$('#MetadataBody').html(msg)	
		}
	});
};
function ListCountGeospasial(){	    
	var srcJson;
	$("#loding").show();
	if(document.getElementById("MapType_1").checked ==true){
	    srcJson = "/WebPortal/ListKatalog1.jsp/";
	 }else{
	 	srcJson = "/WebPortal/ListKatalog2.jsp/";
	}
	$.ajax({
	url: srcJson,
	data: "type="+srcJson,
	cache: false,
	success: function(msg){
		document.getElementById("ListCountMap").innerHTML = msg;
		$("#loding").hide();
		}
	});
	CariDataGeospasial();
};
function CariDataGeospasial(){
	document.getElementById("thumbs").innerHTML= '<div align="center"><img src="/WebPortal/images/loadingkotak.gif"></div>';	
	var srcMap;
	document.getElementById("Halaman").value=0;
	var kata = document.getElementById("TxtCariMeta").value;
	var Halaman = document.getElementById("Halaman").value;
	var skpd = document.getElementById("skpd").value;
	var kategori = document.getElementById("kategori").value;
	var tema = document.getElementById("schema").value;
	$("#lodingMap").show();
	if(document.getElementById("MapType_1").checked ==true){
	    srcMap = "/WebPortal/GeospasialKatalog1.json/";
	 }else{
	 	srcMap = "/WebPortal/GeospasialKatalog2.json/";
	}	
	$.ajax({
	url: srcMap,
	data: "kata="+kata+"&page="+Halaman+"&skpd="+skpd+"&kugi="+kategori+"&tematik="+tema,
	cache: false,
	success: function(msg){
		 document.getElementById("thumbs").innerHTML = msg;
		$("#lodingMap").hide();
		}
	});
};
function FilterTematik(n,s){
  	 var l= "#N_"+s;		
	$(l).removeClass('btn-default'); 
	$(l).addClass('btn-success');
	 if(document.getElementById("N_Tematik").value != ""){
	    var ks= "#N_"+document.getElementById("N_Tematik").value; 
	   $(ks).removeClass('btn-success');
	   $(ks).addClass('btn-default');
     };
	 if (document.getElementById("Selec_Tematik").value = document.getElementById("N_Tematik").value){
	   document.getElementById("schema").value ="";
	   document.getElementById("N_Tematik").value ="";
	 }else{
	    document.getElementById("schema").value =n;
	    document.getElementById("N_Tematik").value =s;
	 }
	 CariDataGeospasial();
};
function Tematik(n){
   	$.ajax({
	url: "/WebPortal/Metadata-Schema/",
	data: "tematik="+n,
	cache: false,
	success: function(msg){
		 document.getElementById("Tematik").innerHTML = msg;
		}
	}); 
};
Tematik(0);
function InfoDataMDschema(e){
  $('#LoadingPDF').hide();
   document.getElementById('MetadataBody').innerHTML = '<center><img src="/WebPortal/images/loadingkotak.gif" width="400" height="300" alt="Loading" longdesc="Mohon menuggu" /></center>';
   $('#Loading').show();
	$.ajax({
	url: "/WebPortal/info-Metadata-Schema/",
	method: "POST",
    data: {e:e},
	cache: false,
	success: function(msg){
		$('#MetadataBody').html(msg)	
		}
	});
};

function TampilkanPeta(){	
	var srcMap;
	var kata = document.getElementById("TxtCariMeta").value;
	var Halaman = eval(document.getElementById("Halaman").value)+1;
	var skpd = document.getElementById("skpd").value;
	var kategori = document.getElementById("kategori").value;
	var Destinasi = "thumbs_"+document.getElementById("Halaman").value;
	var tema = document.getElementById("schema").value
	document.getElementById("Halaman").value= Halaman
	$("#lodingMap").show();	
	if(document.getElementById("MapType_1").checked ==true){
	    srcMap = "/WebPortal/GeospasialKatalog1.json/";
	 }else{
	 	srcMap = "/WebPortal/GeospasialKatalog2.json/";
	}
	$.ajax({
	url: srcMap,
	data: "kata="+kata+"&page="+Halaman+"&skpd="+skpd+"&kugi="+kategori+"&tematik="+tema,
	cache: false,
	success: function(msg){
		 document.getElementById(Destinasi).innerHTML = msg;
		$("#lodingMap").hide();
		}
	});
};
function GetKategori(i){
  var kg= "#kugi"+i;
  var ks= "#kugi"+document.getElementById("kategori").value;  
  document.getElementById("kategori").value =i;
  document.getElementById("klikID").value =1;
  $(kg).addClass('btn-success');
  $(ks).removeClass('btn-success');
  if(document.getElementById("kdSelec").value == document.getElementById("kategori").value){
	document.getElementById("kategori").value='';
	document.getElementById("klikID").value =0;
  }else{
  document.getElementById("kdSelec").value = i;
   Tematik(0);
  }  
  CariDataGeospasial();
  
};
function GetSkpd(i){
  var kg= "#skpd"+i;
  var ks= "#skpd"+document.getElementById("skpd").value;  
  document.getElementById("skpd").value =i;
  document.getElementById("klikID").value =1;
  $(kg).addClass('btn-success');
  $(ks).removeClass('btn-success');
    if(document.getElementById("kdSelec2").value == document.getElementById("skpd").value){
	document.getElementById("skpd").value='';
	document.getElementById("klikID").value =0;
  }else{
  document.getElementById("kdSelec2").value = i;
  }
  CariDataGeospasial();
  Tematik(i);
};
function KartografiSkpd(i){
  var kg= "#Kartgf"+i;
  var ks= "#Kartgf"+document.getElementById("skpd").value;  
  document.getElementById("skpd").value =i;
  document.getElementById("klikID").value =1;
  $(kg).addClass('btn-success');
  $(ks).removeClass('btn-success');
    if(document.getElementById("kdSelec3").value == document.getElementById("skpd").value){
	document.getElementById("skpd").value='';
	document.getElementById("klikID").value =0;
  }else{
  document.getElementById("kdSelec3").value = i;
  }
  CariDataGeospasial();
};
CariDataGeospasial();
function MapGisView(sc,lyr,xmin,xmax,ymin,ymax,url){
	layer = lyr;sch = sc;x_max = xmax;y_max = ymax;x_min = xmin;y_min = ymin; urlg = decodeURIComponent(url);	
	document.getElementById('MapGISView').innerHTML = "<h2>Loading..., Mohon menunggu </h2>";
	setTimeout(MapGisViewCreate, 1000);	
	LoadPetaDasar();
}
function extToMerc(extent) {
    return ol.proj.transformExtent(extent, ol.proj.get('EPSG:4326'), ol.proj.get('EPSG:3857'))
};
function MapGisViewCreate(){
document.getElementById('MapGISView').innerHTML = '<img src="" style="z-index:1; position:absolute; right:10px;" id="ImgLegenda"><div id="map" style="width:100%;height:600px;"></div><div id="popup" class="ol-popup"><a href="#" id="popup-closer" class="ol-popup-closer"></a><div id="popup-content"></div></div>';
var container = document.getElementById('popup');
var content = document.getElementById('popup-content');
var closer = document.getElementById('popup-closer');
var overlay = new ol.Overlay({
  element: container,
  autoPan: true,
  autoPanAnimation: {
    duration: 250,
  },
});
closer.onclick = function () {
  overlay.setPosition(undefined);
  closer.blur();
  return false;
};


var attributions = '<a href="https://geoportal.kalselprov.go.id" target="_blank">&copy; Geoportal</a> ' +
  '<a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>';	
var attribution = new ol.control.Attribution({
		collapsible: false
 });

BasemapSouece6 = new ol.source.XYZ({
  url: 'https://geoservices.big.go.id/rbi/rest/services/BASEMAP/Rupabumi_Indonesia/MapServer/tile/{z}/{y}/{x}',
  attributions: ['<a href="https://services.arcgisonline.com/arcgis/rest/services/tile/{z}/{y}/{x}">ESRI</a> Sekretariat Simpul Jaringan Informasi Geospasial Daerah Provinsi Kalimantan Selatan <a href="https://geoportal.kalselprov.go.id">Geoportal Prov.Kalsel</a>'],
});

basemapLy = new ol.layer.Tile({
		source:BasemapSouece6,
		visible:true,
	});
		  
var map = new ol.Map({
	controls: ol.control.defaults({ attribution: false }).extend([attribution]),
	layers: [basemapLy],
	overlays: [overlay],
	target: 'map',
	view: new ol.View({
		center: ol.proj.fromLonLat([115.35247, -2.64673]),
		zoom:8
	})
}); 


var LyrInset = new ol.layer.Tile({
	source:  new ol.source.TileWMS({
		url: urlg,
		params: {'LAYERS': layer}
	}),
	extent: extToMerc([x_min,x_max,y_min,y_max]),
});
map.addLayer(LyrInset);
var extent = LyrInset.getExtent();
map.getView().fit(extent);
document.getElementById("ImgLegenda").src = urlg+'REQUEST=GetLegendGraphic&VERSION=1.0.0&FORMAT=image/png&LAYER='+layer;

var image = new ol.style.Circle({
  radius: 10,
  fill: null,
  stroke: new ol.style.Stroke({color: '#03E0FA', width: 3}),
});
var styles = {
  'Point': new ol.style.Style({
    image: image,
  }),
  'LineString': new ol.style.Style({
    stroke: new ol.style.Stroke({
      color: '#03E0FA',
      width: 8,
    }),
  }),
  'MultiLineString': new ol.style.Style({
    stroke: new ol.style.Stroke({
      color: '#03E0FA',
      width: 8,
    }),
  }),
  'MultiPoint': new ol.style.Style({
    image: image,
  }),
  'MultiPolygon': new ol.style.Style({
    stroke: new ol.style.Stroke({
      color: 'yellow',
      width: 3,
    }),
    fill: new ol.style.Fill({
      color: 'rgba(255, 255, 0, 0.1)',
    }),
  }),
  'Polygon': new ol.style.Style({
    stroke: new ol.style.Stroke({
      color: 'blue',
      lineDash: [4],
      width: 3,
    }),
    fill: new ol.style.Fill({
      color: 'rgba(0, 0, 255, 0.1)',
    }),
  }),
  'GeometryCollection': new ol.style.Style({
    stroke: new ol.style.Stroke({
      color: 'magenta',
      width: 3,
    }),
    fill: new ol.style.Fill({
      color: 'magenta',
    }),
    image: new ol.style.Circle({
      radius: 10,
      fill: null,
      stroke: new ol.style.Stroke({
        color: 'magenta',
      }),
    }),
  }),
  'Circle': new ol.style.Style({
    stroke: new ol.style.Stroke({
      color: 'red',
      width: 3,
    }),
    fill: new ol.style.Fill({
      color: 'rgba(255,0,0,0.2)',
    }),
  }),
};

var styleFunction = function (feature) {
  return styles[feature.getGeometry().getType()];
};


map.on('singleclick', function (evt) {
var coord4326 = ol.proj.transform(evt.coordinate,'EPSG:3857','EPSG:4326');	
var view = map.getView();
var PopUpLySource = LyrInset.getSource();
content.innerHTML = '<div id="tabelPupOp">Geoprocessing Intersect<br><code>'+ ol.coordinate.toStringHDMS(coord4326)+'</code></div>';
overlay.setPosition(evt.coordinate);
var url = PopUpLySource.getGetFeatureInfoUrl(evt.coordinate, view.getResolution(), view.getProjection(),{'INFO_FORMAT': 'application/json', 'FEATURE_COUNT':1});
   if(url){
	    var urld = encodeURIComponent(url);
		$.ajax({
			url: "/WebPortal/server-proxy/",
			data: "url="+urld,
			cache: false,
			async: false,
			success: function(msg){
				try {
					data = JSON.parse(decodeURIComponent(msg));
				} catch (error) {
					//
				};
				if(layerSlec){
					 map.removeLayer(layerSlec);
				   };
			   var vectorSource = new ol.source.Vector({
				  features: new ol.format.GeoJSON().readFeatures(data),
				});	
			   layerSlec = new ol.layer.Vector({
					  source: vectorSource,
					  style: styleFunction,											
				});
				map.addLayer(layerSlec);																	
			   var hmlhpopup="";
			   if(msg != 0){								   
				   infos = data['features'][0]['properties'];
					for (var key in infos) {
						var value = infos[key];
						content_html = "<tr><td>" + key + "</td><td>" + value + "</td></tr>";
						hmlhpopup = hmlhpopup + content_html;										
					};
					$("#tabelPupOp").html("<table class='table table-ligh table-sm'><tbody>"+hmlhpopup+ "</tbody></table>")
					}
			  }
		});	
	}
});
};

function LoadPetaDasar(){
  $.ajax({
	url: "/api/basemaps/list/",
	cache: false,
	async: false,
	success: function(msg){
		var data =  msg;
		 var s = "";
		  var n =0;
		  for (var key in data) {
			   var baseURL = "'"+data[n]['url']+"'"; 
			   var baseType = "'"+data[n]['type']+"'";
			   var baseParam = "'"+data[n]['params']+"'";
				s = s +	'<div class="card" style="width:100px; margin:5px 10px;">'+
						'<img class="thumbnail" style="width:90px;height:60px;" src="data:image/png;base64,'+data[n]['logo']+'" alt="'+data[n]['name']+'" id="'+data[n]['id']+'" height="90" width="60" onClick="GantiPetaDasar('+baseURL+','+baseType+','+baseParam+')">'+
						'<div class="card-body text-info small"><p class="card-text text-info small">'+data[n]['name']+'</p></div></div>';
			  n++;
		  };		
	   $('#BasemapList').html(s);
	}
	});
};

function GantiPetaDasar(n,type,param){
var  BasemapS;
 if(type == 'ESRI'){
     BasemapS = new ol.source.XYZ({
      url:n+'/tile/{z}/{y}/{x}',
    });
 }else if (type == 'WMS'){
	BasemapS = new ol.source.TileWMS({
			url: n,
			params: {
			  'LAYERS': param
			}
		});
 };
  basemapLy.setSource(BasemapS);
};