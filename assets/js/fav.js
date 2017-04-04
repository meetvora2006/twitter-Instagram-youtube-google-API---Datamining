
$(document).ready(function() {
	
	var oTable = $('#big_table').dataTable( {
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": base_url+'admin.php/favourite/datatable',
		 "fnServerParams": function (aoData) { aoData.push({ "name": "postid", "value": postid }) },
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

