


<div ng-controller="ClassCtrl as ctrl">
<div class="Title">CLASS LIST</div>



<div class="control-icons">
<div><span class="controls" ng-click="ctrl.openAdd()" tooltip-placement="left" tooltip="Add" ><span class="controls-small">&#xf067;</span>&#xf007;</span></div>
<div><span class="controls" tooltip-placement="left" tooltip="Print" >&#xf02f;</span></div>
<div><span class="controls" tooltip-placement="left" tooltip="Excel" >&#xf1c3;</span></div>
</div>


<div class="fixed-top">
<div class="fixed-main" ng>


<div class="sort-tools">
<div class="row">
 <div class="form-group">
 <select class="form-control" ng-model="ctrl.state.state_id">
     <?php foreach($states as $s):?>
     <option value="<?php echo $s->id?>"><?php echo $s->session . "/" . ($s->session+ 1) ?></option>
     <?php endforeach; ?>
 </select>
 </div>
  </div>
  </div>
   
   
   
<div class="left-top">
<span>{{ ctrl.state.level_name }}</span>
<span>({{ ctrl.state.state_name }})</span>
</div>


</div>
</div>


<div class="table-content class-list">
<div id="formdata" name="formdata">
			<table class="table ng-table-responsive table-striped table-bordered ng-cloak"
			id="sheetable" ng-table="tableParams"
			>
				
					<tr class="row1" ng-repeat="d in ctrl.class_list ">
						<td class="center" data-title="'S/N'">{{$index + 1}}</td>
						
						<td class="center" data-title="'Surname'"
								sortable="'surname'">{{ d.student.user.lastname}}</td>
		
						<td class="center" data-title="'First Name'"
								sortable="'firstname'">{{ d.student.user.firstname}}</td>
								
								<td class="center" data-title="'Other Name'"
								sortable="'othername'">{{ d.student.user.othername}}</td>
						
						<td class="center" data-title="'Matric Number'"
								sortable="'matric'">{{ d.student.matric_no}}</td>
						<td class="center actions" data-title="'Actions'" id="actions">
						<a role="button" ng-click="ctrl.openEdit(d.student)" class="btn btn-primary">Edit</a>
						<a role="button" ng-click="ctrl.openDel(d.student)" class="btn btn-danger">Delete</a>
						</td>
						
					</tr>
				
					
			</table>
		</div>
	
</div>



<script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header">
            <h3 class="modal-title"><span class="controls-small">&#xf067;</span>&#xf007; Add Student</h3>
        </div>
        <div class="modal-body">
         
		<form class="form-horizontal">
  <div class="form-group">
    <label for="Surname" class="col-sm-3 control-label">Surname</label>
    
	<div class="col-xs-6">
      <input type="text" class="form-control" id="surname" placeholder="Surname">
    </div>
  </div>

<div class="form-group">
    <label for="firstname" class="col-sm-3 control-label">First Name</label>
    
	<div class="col-xs-6">
      <input type="text" class="form-control" id="firstname" placeholder="First Name">
    </div>
  </div>

<div class="form-group">
    <label for="othername" class="col-sm-3 control-label">Other Name</label>
    
	<div class="col-xs-6">
      <input type="text" class="form-control" id="othername" placeholder="Other Name">
    </div>
  </div>

<div class="form-group">
    <label for="matric" class="col-sm-3 control-label">Matric Number</label>
    
	<div class="col-xs-6">
      <input type="text" class="form-control" id="matric" placeholder="Matric Number">
    </div>
  </div>
  </form>

        </div>
        <div class="modal-footer">
<div class="col-sm-8 down"><progressbar class="progress-striped active down" max="200" value="200" type="primary"></progressbar></div>
            <button class="btn btn-primary" ng-click="addStud()">Save</button>
            <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
        </div>
    </script>

<script type="text/ng-template" id="ModalEdit.html">
        <div class="modal-header">
            <h3 class="modal-title">&#xf044; Edit Student</h3>
        </div>
        <div class="modal-body">
         
		<form class="form-horizontal">
  <div class="form-group">
    <label for="Surname" class="col-sm-3 control-label">Surname</label>
    
	<div class="col-xs-6">
      <input type="text" class="form-control" id="surname" placeholder="Surname" ng-model="current_student.user.lastname">
    </div>
  </div>

<div class="form-group">
    <label for="firstname" class="col-sm-3 control-label">First Name</label>
    
	<div class="col-xs-6">
      <input type="text" class="form-control" id="firstname" placeholder="First Name" ng-model="current_student.user.firstname">
    </div>
  </div>

<div class="form-group">
    <label for="othername" class="col-sm-3 control-label">Other Name</label>
    
	<div class="col-xs-6">
      <input type="text" class="form-control" id="othername" placeholder="Other Name" ng-model="current_student.user.othername">
    </div>
  </div>

<div class="form-group">
    <label for="matric" class="col-sm-3 control-label">Matric Number</label>
    
	<div class="col-xs-6">
      <input type="text" class="form-control" id="matric" placeholder="Matric Number" ng-model="current_student.matric_no">
    </div>
  </div>
  </form>

        </div>
        <div class="modal-footer">
<div class="col-sm-8 down" ng-hide="student_progress_hidden"><progressbar class="progress-striped active down" max="200" value="200" type="primary"></progressbar></div>
            <button class="btn btn-primary" ng-click="saveStudent()">Save</button>
            <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
        </div>
    </script>

<script type="text/ng-template" id="ModalDel.html">
        <div class="modal-header">
            <h3 class="modal-title">&#xf1f8; Delete Student</h3>
        </div>
        <div class="modal-body">
         
		<div class="center">Are you sure you want to delete?</div>

        </div>
        <div class="modal-footer">
		<div class="col-sm-8 down" ng-hide="student_progress_hidden"><progressbar class="progress-striped active down" max="200" value="200" type="danger"></progressbar></div>

            <button class="btn btn-danger" ng-click="addStudent()">Delete</button>
            <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
        </div>
    </script>




</div>