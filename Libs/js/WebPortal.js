// JavaScript Document
jssor_1_slider_init = function() {
	var jssor_1_options = {
	  $AutoPlay: 1,
	  $Idle: 0,
	  $SlideDuration: 5000,
	  $SlideEasing: $Jease$.$Linear,
	  $PauseOnHover: 4,
	  $SlideWidth: 180,
	  $Align: 0
	};
	var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
	var MAX_WIDTH = 980;
	function ScaleSlider() {
		var containerElement = jssor_1_slider.$Elmt.parentNode;
		var containerWidth = containerElement.clientWidth;
		if (containerWidth) {
			var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);
			jssor_1_slider.$ScaleWidth(expectedWidth);
		}
		else {
			window.setTimeout(ScaleSlider, 30);
		}
	}
	ScaleSlider();
	$Jssor$.$AddEvent(window, "load", ScaleSlider);
	$Jssor$.$AddEvent(window, "resize", ScaleSlider);
	$Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
};

function CkugiData(){
	document.getElementById('Cdatakugi').innerHTML = '<img src="/WebPortal/images/loading1.gif"  alt="Loading.." />';
	$.ajax({
		url: "/WebPortal/Ckugi/iso19110.json",
		data: "sni=19115",
		cache: false,
		async: false,
		success: function(msg){
		   $('#Cdatakugi').html(msg);		   
		 }
	 });			
};

function CSRTData(){
document.getElementById('csrtrilis').innerHTML = '<img src="/WebPortal/images/loading1.gif" alt="Loading.." />';
$.ajax({
	url: "/WebPortal/CSRTnew/list.json",
	cache: false,
	async: false,
	success: function(msg){
	   $('#csrtrilis').html(msg);
	   setTimeout(CkugiData, 1000);
	 }
 });			
};

function NewKartografisData(){
	document.getElementById('projects').innerHTML = '<img src="/WebPortal/images/loading1.gif" alt="Loading.." />';
	$.ajax({
		url: "/WebPortal/KartografiBaru/data.json",
		data: "max=4",
		cache: false,
		async: false,
		success: function(msg){
		   $('#projects').html(msg);
		   setTimeout(CSRTData, 500);
		 }
	 });			
};

function NewWmsData(){
	document.getElementById('NewPetaWMS').innerHTML = '<img src="/WebPortal/images/loading1.gif"  alt="Loading.." />';
	$.ajax({
		url: "/WebPortal/PetaBaruWms/layer.json",
		data: "max=4",
		cache: false,
		async: false,
		success: function(msg){
		   $('#NewPetaWMS').html(msg);
		  setTimeout(NewKartografisData, 500);
		 }
	 });			
};

function UnitProduksiData(){
document.getElementById('UnitProduksi').innerHTML = '<img src="/WebPortal/images/loading1.gif" alt="Loading.." />';
$.ajax({
	url: "/WebPortal/UnitProduksiData/unitkliring.json",
	data: "role=1",
	cache: false,
	async: false,
	success: function(msg){
	   $('#UnitProduksi').html(msg);
	   jssor_1_slider_init();
	   setTimeout(NewWmsData, 500);
	 }
 });			
};

function WebAppData(){
document.getElementById('WebApp').innerHTML = '<img src="/WebPortal/images/loading1.gif" alt="Loading.." />';
$.ajax({
	url: "/WebPortal/WebApp1/app.json",
	data: "group=4",
	cache: false,
	async: false,
	success: function(msg){
	   $('#WebApp').html(msg);
	   setTimeout(UnitProduksiData, 1000);
	 }
 });			
};
WebAppData();

function DataSKPD(s){
	document.getElementById("IsiDataSKPD").innerHTML ="<h1>Loading...</h1>"
	$.ajax({
	url: "/WebPortal/UniProduksi/skpd.json",
	data: "no="+s,
	cache: false,
	success: function(msg){
			document.getElementById("IsiDataSKPD").innerHTML = msg;		
		}
	});
};

function PetaKugi(s){
	document.getElementById("MdlData").innerHTML ="<h1>Loading...</h1>"
	$.ajax({
	url: "/WebPortal/DataKugi/metadata.json",
	data: "no="+s,
	cache: false,
	success: function(msg){
			document.getElementById("MdlData").innerHTML = msg;		
		}
	});
};