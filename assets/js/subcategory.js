
$(document).ready(function() {
	var oTable = $('#big_table').dataTable( {
		"bProcessing": false,
		"bServerSide": true,
		"sAjaxSource": base_url+'admin.php/subcategory/datatable',
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

function deletecategory(id){ 

	$.ajax( {
		url : base_url+'admin.php/subcategory/delete', 
		type : 'post',
		data: 'catid='+id,
		success : function( resp ) {
		window.location.href = base_url+'admin.php/subcategory/';
		}
	});
}
// JavaScript Document