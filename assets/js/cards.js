$( document ).ready(function() {
	
	var sPageURL = window.location.hash.substr(1);
	 $.ajax( {
		url : base_url+'index.php/allcard/checktest', 
		type : 'post',
		data : {
			pageurl : sPageURL
			
		},
	success: function(result){ 
	$.each( arr, function( i, val ) {
	var load = $(result).filter('#checkval_'+ val).html();
	$( "#test_" + val ).html(load);
	
  
});
		
$("select").multiselect('refresh').multiselectfilter();

 var values = $(".chekoptionselect:checked").map(function () {
 return this.value;
}).get();
  
  $.ajax( {
		url : base_url+'index.php/allcard/getfilterresult', 
		type : 'post',
		data : {
			checkedValues : values,
		},
	success: function(result){
	
	$( "#cardblock" ).animate({
        height: 'toggle'
        } ,'swing', function() {
		$(this).html(result).animate({
        height: 'toggle'
        }, 400, 'swing');
    });
	
   		 }
	});
		}
	});
	
  });	



$(document).on('click', ".icon-heart", function () {
var useridval = $("#user_ses_id").val();	
	
	if (useridval != ''){
	var postidval = $(this).attr('id');

if(!$(this).hasClass( "active" ) ){	
    $(this).addClass("active");
	$.ajax( {
		url : base_url+'index.php/allcard/addtofav', 
		type : 'post',
		data : {
			postid : postidval,
			userid : useridval,
		}
	});
	
}
else{
	
	
	$(this).removeClass("active");

	$.ajax( {
		url : base_url+'index.php/allcard/delfromfav', 
		type : 'post',
		data : {
			postid : postidval,
			userid : useridval,
		}
	});
	
	}	
		
  }
  else {
	  alert ('login');
	  }
	});
	
	
$(document).on('click', ".toggleLink", function () {		 
	var useridval = $("#user_ses_id").val();	
		 if (useridval != ''){
			 
			 
		  jQuery(".share_sheet").fadeOut('fast');
		  var postidval = $(this).attr('id');
		 
		 jQuery(this).next('.share_sheet').delay(400).fadeIn('fast');
		 
		 $.ajax( {
		url : base_url+'index.php/allcard/getstacklist', 
		type : 'post',
		data : {
			postid : postidval,
			userid : useridval
		},
		success: function(result){
        $(".share_this").html(result);
   		 }
	});
		 
		 }
		else {
			
			alert('login');
			
			} 
		 
    });
	

	$(document).on('click', ".addstackbutton", function () {	
		var useridval = $("#user_ses_id").val();
	    var stackname = $(this).prev('.stackadd').val();
		var postidval = $(this).attr('id');
       
	   
	   $.ajax( {
		url : base_url+'index.php/allcard/addnewstack', 
		type : 'post',
		data : {
			stackname : stackname,
			postid : postidval,
			userid : useridval
		},
		success: function(result){
        $(".share_this").append(result);
		
		// $("#"+postidval).next('.icon-add-to-list').addClass('active');
   		 }
			});
    });


$(document).on('click', "#pagination a", function (event) {
 event.preventDefault();
 
 var values = $(".chekoptionselect:checked").map(function () {
 return this.value;
}).get();

$.ajax({
   type: "POST",
   url: $(this).attr("href"),
   data : {
			checkedValues : values,
		},
   success: function(res){
      $("#cardblock").html(res);
   }
   });
   return false;
   });	


$(document).on('click', ".chekoptionselect , .ui-multiselect-none , .ui-multiselect-all", function () {	

 var values = $(".chekoptionselect:checked").map(function () {
 return this.value;
}).get();

  $.ajax( {
		url : base_url+'index.php/allcard/getfilterresult', 
		type : 'post',
		data : {
			checkedValues : values,
		},
	success: function(result){ 
        $("#cardblock").html(result);
		var myHtml = $(result).filter('#urlstring').html();
		 window.location.hash = $.trim(myHtml.slice(0, -5));
		
   		 }
	});

		});

function rmvfrmfltr(id){
$("select option[value='"+id+"']").removeAttr("selected");
$("select").multiselect('refresh').multiselectfilter();
 var values = $(".chekoptionselect:checked").map(function () {
 return this.value;
}).get();
  
 $.ajax( {
		url : base_url+'index.php/allcard/getfilterresult', 
		type : 'post',
		data : {
			checkedValues : values,
		},
	success: function(result){
        $("#cardblock").html(result);
		var myHtml = $(result).filter('#urlstring').html();
		 window.location.hash = $.trim(myHtml.slice(0, -5));
   		 }
	}); 

		}	


function clearall(){
$("option:selected").removeAttr("selected");
$("select").multiselect('refresh').multiselectfilter();

var checkedValues ;
  
  $.ajax( {
		url : base_url+'index.php/allcard/getfilterresult', 
		type : 'post',
		data : {
			checkedValues : checkedValues,
		},
	success: function(result){
        $("#cardblock").html(result);
		var myHtml = $(result).filter('#urlstring').html();
		window.location.hash = $.trim(myHtml.slice(0, -1));
   		 }
	});

		}	
	
	

function addtostack(postid,stackid,userid){
     $.ajax( {
		url : base_url+'index.php/allcard/addtostack', 
		type : 'post',
		data : {
			postid : postid,
			stackid : stackid,
			userid : userid
		},
		success: function(result){
        $(".share_this").html(result);
   		 }
	});
	
	 }
	 
function getuserstacklist(id){
	jQuery.ajax( {
		url : base_url+'index.php/stacklist/'+id, 
		type : 'post',
		data: '',
		success : function( resp ) {
		 jQuery("#cardblock").html(resp);

		}
	});
	
	}
	
	
function getstacklistcard(id){
	jQuery.ajax( {
		url : base_url+'index.php/stacklistinner/'+id, 
		type : 'post',
		data: '',
		success : function( resp ) {
		 jQuery("#cardblock").html(resp);
		}
	});
	
	}
	 
function removefromstack(postid,stackid,userid){
	
     $.ajax( {
		url : base_url+'index.php/allcard/removefromstack', 
		type : 'post',
		data : {
			postid : postid,
			stackid : stackid,
			userid : userid
		},
		success: function(result){
        $(".share_this").html(result);
   		 }
	});
	
	 }
	 
var settings = {
// these are required:
suggestUrl: 'http://gujaratpickers.com/gujratpick/jsoncontent.php?q=', // the URL that provides the data for the suggest
// these are optional:
instantVisualFeedback: 'all', // where the instant visual feedback should be shown, 'top', 'bottom', or 'all', default: 'all'
throttleTime: 300, // the number of milliseconds before the suggest is triggered after finished input, default: 300ms
highlight: true, // whether matched words should be highlighted, default: true
queryVisualizationHeadline: '', // A headline for the image visualization, default: empty
animationSpeed: 300, // speed of the animations, default: 300ms
minChars: 3, // minimum number of characters before the suggests shows, default: 3
maxWidth: 400 // the maximum width of the suggest box, default: as wide as the input box
};
// apply the settings to an input that should get the unibox

$(document).ready(function() { $("#searchBox").unibox(settings); });
