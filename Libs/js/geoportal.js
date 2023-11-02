// JavaScript Document
$("#BasemapGalery1").hide(); 
 
$(function() {
    $(".Element").draggable();
    $(".Element").resizable();   
});
 
function ShowCenterForm(f){
		var winW = window.innerWidth;
		var winH = window.innerHeight;
		var dialogoverlay = document.getElementById(f);
		var Wdt = dialogoverlay.style.width;
		var Hdt = dialogoverlay.style.height;
		dialogoverlay.style.display = "block";
		dialogoverlay.style.left = eval(winW-Wdt )*0.5+"px";
	    dialogoverlay.style.top = eval(winH-Hdt)*0.3+"px";		
}

 
function BoxElevasiShow(){
if(dojo.byId('BoxElevasi').style.visibility=="hidden"){	
  	dijit.byId('BoxElevasi').show();
  }else{
 	dojo.byId('BoxElevasi').style.visibility="hidden";
	//dijit.byId('BoxElevasi').hidden();
 }
};
 //setTimeout(BoxElevasiHide, 8000);
//  
//function BoxElevasiHide(){
//   $("#BoxElevasi").hide();
//}


   
function BoxMeasure(){
  if(dojo.byId('Pengukuran').style.visibility=="hidden"){	
  	dijit.byId('Pengukuran').show();
  }else{
 	dojo.byId('Pengukuran').style.visibility="hidden";
 }
};

function BoxDrawing(){
	if(dojo.byId('DrawingTool1').style.visibility=="hidden"){	
  	dijit.byId('DrawingTool1').show();
  }else{
 	dojo.byId('DrawingTool1').style.visibility="hidden";
 }
};

function InfoAktif(){
	if(document.getElementById("infoWIn1").className== "ui-info-button"){
	   document.getElementById("infoWIn1").className= "ui-info-button-active";
	}else{
	   document.getElementById("infoWIn1").className= "ui-info-button";
	}
}

function LayerBox(){
    if (document.getElementById("LayerBox").style.display =="none"){
	   document.getElementById("LayerBox").style.display ="block";		
	  }else{
	   document.getElementById("LayerBox").style.display ="none";
	 };
  };

function PrintBox(){
//    if (document.getElementById("PrintToolBox1").style.display =="none"){
//	   document.getElementById("PrintToolBox1").style.display ="block";
//	  }else{
//	   document.getElementById("PrintToolBox1").style.display ="none";
//	 };
if(dojo.byId('PrintToolBox1').style.visibility=="hidden"){	
  	dijit.byId('PrintToolBox1').show();
  }else{
 	dojo.byId('PrintToolBox1').style.visibility="hidden";
 }
};
//$("#PrintToolBox1").hide();
 
function MapNavigasiBox(){
    if (document.getElementById("BoxMapOverview").style.top =="0px"){
	   document.getElementById("BoxMapOverview").style.top ="-160px";
	  }else{
	   document.getElementById("BoxMapOverview").style.top ="0px";
	 };
}


function AddMapBox(){
if(dojo.byId('AddMapList').style.visibility=="hidden"){	
  	dijit.byId('AddMapList').show();
  }else{
 	dojo.byId('AddMapList').style.visibility="hidden";
 }
}

function DlgJDSN(){
    if (document.getElementById("DlgJDSN").style.display =="none"){
		ShowCenterForm('DlgJDSN');
	   document.getElementById("DlgJDSN").style.display ="block";
	  }else{
	   document.getElementById("DlgJDSN").style.display ="none";
	 };
 };
$("#DlgJDSN").hide();


function AddJDSNMapService(s,n,i,t){
  $("#DlgJDSN").hide();
  document.getElementById("TxtJdsnService").value =s;
  document.getElementById("TxtJdsnName").value =n;
  document.getElementById("TxtJdsnId").value = i;
  document.getElementById("TxtJdsnTypeSrv").value = t;
  document.getElementById("NmPetaJDSN").innerHTML ="Opsi penambahan peta <br/><b><a href='"+s+"' target='_blank'>"+n+"</a></b>";
  DlgJDSN();
}

var TabbedPanels2 = new Spry.Widget.TabbedPanels("TabbedPanels2");
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");


