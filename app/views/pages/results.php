<div ng-controller="ResultsCtrl as ctrl">
<div class="Title">RESULTS</div>


<div class="control-icons">
<div><span class="controls" tooltip-placement="left" tooltip="Print" >&#xf02f;</span></div>
<div><span class="controls" tooltip-placement="left" tooltip="Excel" >&#xf1c3;</span></div>
</div>


<div class="fixed-top">
<div class="fixed-main"> 

<div class="sort-tools">
<div class="row">
 <div class="col-xs-12">

     <select class="form-control" ng-model="ctrl.state.state_id">
         <?php foreach($states as $s):?>
             <?php if($s->semester == 1) $sem = "First Semester"; else $sem = "Second Semester";?>
             <option value="<?php echo $s->id?>"><?php echo $s->session . "/" . ($s->session+ 1). " [" . $sem . "]" ?></option>
         <?php endforeach; ?>
     </select>

 </div>

  </div>
  </div>
   
   
   
<div class="left-top">
<span>{{ ctrl.state.level_name }}</span>
<span>{{ ctrl.state.state_name }}</span>

</div>

</div>
</div>


<div class="table-content result-sheet">
<div id="formdata" name="formdata">
			<table class="table ng-table-responsive table-striped table-bordered ng-cloak"
			id="sheetable" ng-table="tableParams"
			>
				
					<tr class="row1" ng-repeat="d in ctrl.results ">
						<td class="center" data-title="'S/N'">{{$index + 1}}</td>
						
						<td class="center" data-title="'Name'"
								sortable="'name'">{{ d.student.user.lastname}} {{ d.student.user.firstname }} {{ d.student.user.othername }}</td>
		
						<td class="center" data-title="'Matric Number'"
								sortable="'matric'">{{ d.student.matric_no}}</td>


						<div ng-repeat="cs in ctrl.courses">
                        <td class="center"   data-title="$index">{{cs.code}}</td>
                        </div>

								
								
						<td class="center" data-title="'Prev.'"
								sortable="'prev'">{{ d.prev}}</td>
								
						<td class="center" data-title="'Carry Overs'"
								sortable="'carry'">{{ d.carry}}</td>
						
						
						<td class="center" data-title="'GPA'"
								sortable="'gpa'">{{ d.gpa}}</td>
						
						<td class="center" data-title="'CGPA'"
								sortable="'cgpa'">{{ d.cgpa}}</td>
						
						<td class="center" data-title="'Class'"
								sortable="'class'">{{ d.class}}</td>
								
						
						
					</tr>
				
					
			</table>
		</div>
	
</div>

</div>