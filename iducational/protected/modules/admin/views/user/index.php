<style type="text/css">
	.dataTables_processing{
		text-align: center;
		font-size: 20px;
		font-family: 'Century Gothic';
	}
</style>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">User Management</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
    <h2>User Table</h2>
    <div class="table-responsive">
      <table id="data" class="table table-bordered table-hover table-striped tablesort">
        <thead>
          <tr>
            <th>UserID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Fullname</th>
            <th>Email</th>
            <th>Date</th>
            <th>Gender</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="form-actions" style="margin-top:10px;">
    	<a data-toggle="modal" href="<?= Yii::app()->createUrl('admin/user/addUser'); ?>"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add</button></a>  
    </div>
  </div>
</div>
<!-- /.row -->
<script type="text/javascript">
			var oTable = $('#data').dataTable({
		    "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>",
		    "sPaginationType": "bootstrap",
		    "oLanguage": {
			    "sLengthMenu": "_MENU_ records per page"
		    },
		    "bProcessing": true,
		    "sAjaxSource": '<?= Yii::app()->baseUrl . '/' . $this->module->id . '/' .$this->id . '/' . $this->action->id  ?>',
		    "bServerSide": true,
		    "sServerMethod": "POST",
		    "fnServerData": function ( sSource, aoData, fnCallback,oSettings ) {
			    oSettings.jqXHR = $.ajax({
			    "dataType": 'json',
			    "type": "POST",
			    "url": sSource,
			    "data": aoData,			   
			    "success": function(data){	
				fnCallback(data);
				if(data.hasError){
				    parent.$.fancybox.open([
				    {      
					content : data.htmlError,
					afterClose : function(){
					    if(data.returnUrl!=undefined && data.returnUrl!=''){
						location.href =  data.returnUrl;
					    }
					}
				    }])
				}
			    }
			})
		    },
		     "fnServerParams": function ( aoData ) {
				aoData.push( {});
		      },
		   "aoColumns": [
				{"bSortable": true,"sName": "t.user_id"},
				{"bSortable": true,"sName": "t.username"},				
				{"bSortable": true,"sName": "t.password"},
				{"bSortable": true,"sName": "t.fullname"},
				{"bSortable": true,"sName": "t.email"},
				{"bSortable": true,"sName": "t.user_date"},
				{"bSortable": true,"sName": "gender"},
				{"bSortable": false,"sName": "action"}
				]
		});
     var htmlSearch = '<select id="searchField" class="input-medium">'+
			'<option value="">--Field--</option>'+
			'<option value="2">Username</option>'+
			'<option value="3">Tanggal Lahir</option>'+
			'<option value="4">Jenis Kelamin</option>'+
			'<option value="5">Agama</option>'+
			'<option value="5">Status Pernikahan</option>'+
		      '</select>';
    $('#data_filter').html('<div style="float:left; visibility:hidden; ">'+ htmlSearch +'&nbsp; <input class="input-medium" type="text" id="searchText" /><a class="btn" id="searchButton" >Search</a></div>');

    $('.dataTables_paginate ul').attr({
			'class':'dataTables_paginate paging_bootstrap pagination'
		});
</script>