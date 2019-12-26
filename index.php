<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script language="javascript">
   function showEditor(id)
   {
	   $("#id").val(id);
	   
	   $.ajax({
				type: "GET",
				async:true,
				url: 'crud.php',
				data: {
					cmd : 'edit',
					id         : $("#id").val() 
				},
				success: function (results) {
					dataArr = JSON.parse(results); 
					
					$("#first_name").val(dataArr[0].first_name);
					$("#last_name").val(dataArr[0].last_name);
					$("#address").val(dataArr[0].address);
					
					
				},
				error: function (request, status, error) {
						alert(request.responseText);
					}
			});
	   
	   
	   
   }
   
   function addUser()
   {
			$.ajax({
				type: "GET",
				async:true,
				url: 'crud.php',
				data: {
					cmd : 'add',
					first_name : $("#first_name").val(),
					last_name  : $("#last_name").val(),
					address    : $("#address").val(),
					id         : $("#id").val() 
				},
				success: function (results) {
					loadData();
				},
				error: function (request, status, error) {
						alert(request.responseText);
					}
			});
			
		$('.close').click(); 	
   }
   
   function setDeletedId(id){
	   
	   $("#delete_id").val(id);
   }
   
   function deleteUser()
   {
			$.ajax({
				type: "GET",
				async:true,
				url: 'crud.php',
				data: {
					cmd : 'delete',
					id  : $("#delete_id").val()
				},
				success: function (results) {
					loadData();
				},
				error: function (request, status, error) {
						alert(request.responseText);
					}
			});
			
		$('.close').click(); 
	
	   
   }
   
   function loadData()
   {
			$.ajax({
				type: "GET",
				async:true,
				url: 'crud.php',
				data: {
					cmd : 'load_data'
				},
				success: function (results) {
					dataArr = JSON.parse(results); 
					var str = '';
					$("#id_body").html(str);	  
					for(i=0;i<dataArr.length;i++)
					{
						str += '<tr>'+
								'<td>'+dataArr[i].first_name+'</td>'+
								'<td>'+dataArr[i].last_name+'</td>'+
								'<td>'+dataArr[i].address+'</td>'+
								'<td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" onClick="showEditor('+dataArr[i].id+');" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>'+
								'<td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" onClick="setDeletedId('+dataArr[i].id+');" ><span class="glyphicon glyphicon-trash"></span></button></p></td>'+
							  '</tr>';
					}
						  
					$("#id_body").html(str);	  
						  
				},
				error: function (request, status, error) {
						alert(request.responseText);
					}
			});
			
	   
   }
   $(document).ready(function(){
	     loadData();
	   });
</script>

<div class="container">
  <div class="row">

    <div class="col-md-12">
      <h1>Users Table</h1>
       <div class="row">
         <div class="col-md-12">
           <b></b>
           <br>
           <a href="#edit" class="btn btn-success" data-toggle="modal" onClick="showEditor('');"><i class="material-icons"></i> <span>Add New User</span></a>
         </div>
       </div>
      <div class="table-responsive">


        <table id="mytable" class="table table-bordred table-striped">
          <thead>
                <th>First name</th>
                <th>Last name</th>
                <th>Address</th>
                <th>Edit</th>
                <th>Delete</th>
          </thead>
          <tbody id="id_body">

          </tbody>

        </table>

        <div class="clearfix"></div>
       
      </div>
    </div>
  </div>
</div>


<!---Add new-->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Add</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <input class="form-control " type="text"  id="first_name" placeholder="First name">
        </div>
        <div class="form-group">
          <input class="form-control " type="text" id="last_name" placeholder="Last name">
        </div>
        <div class="form-group">
          <input class="form-control " type="text" id="address" placeholder="Address">
        </div>
      </div>
      <div class="modal-footer ">
        <input type="hidden" id="id">
        <button type="button" class="btn btn-warning btn-lg" style="width: 100%;" onClick="addUser()"><span class="glyphicon glyphicon-ok-sign"></span>Add</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>




<!--Delete-->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
      </div>
      <div class="modal-body">

        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>

      </div>
      <div class="modal-footer ">
        <input type="hidden" id="delete_id">
        <button type="button" class="btn btn-success" onClick="deleteUser();"><span class="glyphicon glyphicon-ok-sign"></span>Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>No</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

