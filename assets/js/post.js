
$(document).ready(function() {
	var oTable = $('#big_table').dataTable( {
		"bProcessing": false,
		"bServerSide": true,
		"sAjaxSource": base_url+'admin.php/post/datatable',
                "bJQueryUI": false,
                "sPaginationType": "full_numbers",
				 "iDisplayLength": 10,
   
              //  "oLanguage": {
          //  "sProcessing": "<img src='<?php //echo base_url(); ?>assets/images/ajax-loader_dark.gif'>"
      //  },  
      //  "fnInitComplete": function() {
                //oTable.fnAdjustColumnSizing();
      //   },
                'fnServerData': function(sSource, aoData, fnCallback)
            {
              $.ajax
              ({
                'dataType': 'json',
                'type'    : 'POST',
                'url'     : sSource,
                'data'    : aoData,
                'success' : fnCallback
              });
            }
	} );
} );

function deletepost(id){ 

	$.ajax( {
		url : base_url+'admin.php/post/delete', 
		type : 'post',
		data: 'postid='+id,
		success : function( resp ) {
		window.location.href = base_url+'admin.php/post/';
		}
	});
}
