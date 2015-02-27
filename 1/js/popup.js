function S(i) { return document.getElementById(i); }
function download( evt, fid){
var _event = evt ? evt : event;
var _target = evt ? evt.target : event.srcElement;
var _p = S( "downloadPanel" );
Show( "downloadPanel" , true );	
_p.focus();
}
function Show(obj, bShow) {
obj = (typeof(obj) == "string" ? S(obj) : obj);
if (obj) obj.style.display= (bShow ? "" : "none");
}
function hideDownloadPanel( evt ){
Show( "downloadPanel" ,false);	
}
function checkClick(evt){
var _target = evt ? evt.target : event.srcElement ;
var _id = _target.id;
if( _id == "" ){
_id = _target.parentNode.id;
	}
if( _id !="downloadDirect" && _id != "downloadAgent" && _id != "downloadPanel" && _id.indexOf( "downloadFile_" ) < 0 && _id.indexOf( "downloadLink_" ) < 0 ){
Show( "downloadPanel" , false );
}
}
