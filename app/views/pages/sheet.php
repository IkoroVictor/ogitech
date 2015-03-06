<div ng-controller="SheetCtrl as ctrl">


<div class="control-icons">
<div><span class="controls" tooltip-placement="left" tooltip="Save" href="#" ng-click="ctrl.save()">&#xf0c7;</span></div>
<div><span class="controls" tooltip-placement="left" tooltip="Print" href="#">&#xf02f;</span></div>
<div><span class="controls" tooltip-placement="left" tooltip="Excel" href="#">&#xf1c3;</span></div>
<div><span class="controls" ng-click="openUpd()" tooltip-placement="left" tooltip="Upload" href="#">&#xf093;</span></div>
</div>


<div class="Title">SCORE SHEET</div>


<div class="fixed-top">
<div class="fixed-main"> 


<div class="sort-tools">
</div>


<div class="left-top">
<span>OND 1</span>
<span>First Semester</span>
<span>(2014/2015)</span> 
</div>


</div>
</div>


<div class="sheet-control">
<div class="sheet-courses-title">&#xf044; Courses</div>
<div class="divider"></div>


<div ng-repeat="c in ctrl.courses">
<div><span class="courses" ng-click="ctrl.load_course(c)">{{ c.code }}</span></div>
</div>

</div>




<div class="course-title"> 
<span>{{ ctrl.current_course.code }}</span> - <span>{{ ctrl.current_course.title  }}</span>
</div>



<div class="table-content score-sheet">
<div id="formdata" name="formdata">
			<table class="table ng-table-responsive table-striped table-bordered ng-cloak"
			id="sheetable" ng-table="tableParams"
			>
				
					<tr class="row1" ng-repeat="d in ctrl.scores_list ">
						<td class="center" data-title="'S/N'">{{$index + 1}}</td>
						
						<td class="center" data-title="'Name'"
								sortable="'surname'">{{ d.student.user.surname}} {{ d.student.user.firstname}} {{  d.student.user.othername}}</td>
		
						<td class="center" data-title="'Matric Number'"
								sortable="'matric'">{{ d.student.matric_no}}</td>
						<td class="center" data-title="'Level'"
								sortable="'level'">{{ getLevelName(d.studentstate.level_id)}}</td>
						
						
						<td class="center small" data-title="'Score'"
								sortable="'score'">
								
									<input class=" form-control validate-numeric "
										type="number" ng-value="d.total" ng-model="d.total"
										>
								
							</td>
							
						
						
						<td class="center" data-title="'Grade'"
								sortable="'matric'">{{ toGrade(d.total)}}</td>
						
						
					</tr>
				
					
			</table>
		</div>
</div>



<script type="text/ng-template" id="ModalUpd.html">
        <div class="modal-header">
            <h3 class="modal-title">&#xf093; Upload Score Sheet</h3>
        </div>
        <div class="modal-body">
         <div class="file-upload">
		<div class="col-xs-6">
      <input type="file" class="form-control" ng-file-select="assignfile($files)"  name="data">
    </div>
  	<div class="col-xs-6">
		<button class="btn btn-primary" ng-click="uploadcsv()" >Upload</button>
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