
<div ng-controller="ResultsCtrl as ctrl">
<div class="Title">RESULTS</div>


<div class="control-icons">
<div><span class="controls" tooltip-placement="left" tooltip="Print" >&#xf02f;</span></div>
<div><span class="controls" tooltip-placement="left" tooltip="Excel" >&#xf1c3;</span></div>
<div><span class="controls" ng-click="openUpd()" tooltip-placement="left" tooltip="Upload" href="#">&#xf093;</span></div>
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
                <thead>
                <tr>
                    <th class="text-center"><strong>S/N</strong></th>
                    <th class="text-center"><strong>Name</strong></th>
                    <th class="text-center"><strong>Matric Number</strong></th>
                    <td class="text-center" ng-repeat="cs in ctrl.courses"><strong>{{cs.code}}<br>({{ cs.units }})</strong></td>
                    <th class="text-center"><strong>Carry Overs</strong></th>
                    <th class="text-center"><strong>TCL</th>
                    <th class="text-center"><strong>GP</strong></th>
                    <th class="text-center"><strong>GPA</strong></th>
                    <th class="text-center"><strong>CTCL</th>
                    <th class="text-center"><strong>CGP</strong></th>
                    <th class="text-center"><strong>CGPA</strong></th>
                    <th class="text-center"><strong>Class</strong></th>

                </tr>

                </thead>

                <tbody>
                <tr class="row1" ng-repeat="d in ctrl.results ">
						<td class="center" >{{$index + 1}}</td>
						
						<td class="center"
								sortable="'name'">{{ d.student.user.lastname}} {{ d.student.user.firstname }} {{ d.student.user.othername }}</td>
		
						<td class="center"
								sortable="'matric'">{{ d.student.matric_no}}</td>


                        <td class="text-center" ng-repeat="z in ctrl.courses">{{ctrl.getBasicCourseScore(z.id, d.results)}}</td>

								

								
						<td class="center"
								sortable="'carry'"><strong ng-repeat="c in ctrl.getCarryOvers(d)">{{c.course.code}}({{ c.course.units }}) - <i>{{ toGrade(c.total)}}<i>, </strong> </td>

                    <td class="center"
                        sortable="'prev'">{{ d.tcl}}</td>

                    <td class="center"
                        sortable="'prev'">{{ d.gp}}</td>


						<td class="center"
								sortable="'gpa'">{{ d.gpa}}</td>

                    <td class="center"
                        sortable="'prev'">{{ d.ctcl}}</td>

                    <td class="center"
                        sortable="'prev'">{{ d.cgp}}</td>

                    <td class="center"
								sortable="'cgpa'">{{ d.cgpa}}</td>
						
						<td class="center"
								sortable="'class'">{{ d.class}}</td>
								
						
						
					</tr>
                <tbody>
				
					
			</table>
		</div>
	
</div>


<script type="text/ng-template" id="ModalUpd.html">
        <div class="modal-header">
            <h3 class="modal-title">&#xf093; Upload Result Sheet</h3>
        </div>
        <div class="modal-body">
            <div class="file-upload">
                <div class="col-xs-6">
                    <input type="file" class="form-control" ng-file-select="assignfile($files)"  name="data">
                </div>
                <div class="col-xs-6">
                    <button class="btn btn-primary" ng-click="uploadcsv(0)" >Upload</button>
                </div>
            </div>

            <div class="divider-full"></div>



            <div ng-hide="uploadcsv_details_hidden" class="upload-report">


                <div class="Report-title">File Uploaded Successfully</div>


                <div class="report-content">



                    <div class="error-report">
                        <div ng-repeat="err in uploadcsv_response.errors track by $index">
                            <div class="report-item"><code>{{err}}</code></div>
                        </div>
                    </div>



                </div>
            </div>

        </div>
        <div class="modal-footer">
            <div class="col-sm-8 down" ng-hide="uploadcsv_progress_hidden"><progressbar class="progress-striped active down" max="200" value="200" type="primary"></progressbar></div>


            <button class="btn btn-warning" ng-click="cancel()">Close</button>
        </div>
    </script>


</div>