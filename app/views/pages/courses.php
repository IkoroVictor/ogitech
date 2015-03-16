<div ng-controller="CourseCtrl as ctrl">
<div class="Title">COURSES</div>


<div class="control-icons">
    <div><span class="controls" ng-click="ctrl.openAdd();" tooltip-placement="left" tooltip="Add"><span
                class="controls-small">&#xf067;</span>&#xf02d;</span></div>
    <div><span class="controls" tooltip-placement="left" tooltip="Print">&#xf02f;</span></div>
    <div><span class="controls" tooltip-placement="left" tooltip="Excel">&#xf1c3;</span></div>
</div>


<div class="fixed-top">
    <div class="fixed-main">

        <div class="sort-tools">
            <div class="row">
                <div class="col-xs-6">
                    <select class="form-control">
                        <option>Select Level</option>
                        <option>OND1</option>
                        <option>OND2</option>
                        <option>HND1</option>
                        <option>HND2</option>
                    </select>
                </div>

                <div class="col-xs-6">
                    <select class="form-control">
                        <option>Select Status</option>
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>
                </div>
            </div>
        </div>


        <div class="left-top">
        </div>

    </div>
</div>

<div class="table-content courses-list">
    <div id="formdata" name="formdata">
        <table class="table ng-table-responsive table-striped table-bordered ng-cloak"
               id="sheetable" ng-table="tableParams"
            >

            <tr class="row1" ng-repeat="d in ctrl.courses ">
                <td class="center" data-title="'S/N'">{{$index + 1}}</td>

                <td class="center" data-title="'Title'"
                    sortable="'title'">{{ d.title}}
                </td>

                <td class="center" data-title="'Code'"
                    sortable="'code'">{{ d.code}}
                </td>

                <td class="center" data-title="'Unit'"
                    sortable="'units'">{{ d.units}}
                </td>

                <td class="center" data-title="'Semester'"
                    sortable="'status'">{{ (d.semester == 1) ? "FIRST":"SECOND" }}
                </td>

                <td class="center" data-title="'Level'"
                    sortable="'level'">{{ getLevelName(d.level_id)}}
                </td>

                <td class="center" data-title="'Status'"
                    sortable="'status'">{{ (d.status == 1) ? "Active":"SUSPENDED" }}
                </td>


                <td class="center actions" data-title="'Actions'" id="actions">
                    <a role="button" ng-click="ctrl.openEdit(d)" class="btn btn-primary">Edit</a>
                    <a role="button" ng-click="ctrl.openDel(d)" class="btn btn-danger">Delete</a>
                </td>

            </tr>


        </table>
    </div>

</div>


<script type="text/ng-template" id="myModalContent.html">
    <div class="modal-header">
        <h3 class="modal-title"><span class="controls-small">&#xf067;</span>&#xf02d; Add Course</h3>
    </div>
    <div class="modal-body">

        <form class="form-horizontal">
            <div class="form-group">
                <label for="Surname" class="col-sm-3 control-label">Title</label>

                <div class="col-xs-6">
                    <input type="text" class="form-control" id="title" placeholder="Title"
                           ng-model="current_course.title">
                </div>
            </div>

            <div class="form-group">
                <label for="firstname" class="col-sm-3 control-label">Code</label>

                <div class="col-xs-6">
                    <input type="text" class="form-control" id="code" placeholder="Code" ng-model="current_course.code">
                </div>
            </div>

            <div class="form-group">
                <label for="othername" class="col-sm-3 control-label">Unit</label>

                <div class="col-xs-6">
                    <input type="number" class=" validate-numeric form-control" id="unit" placeholder="Unit"
                           ng-model="current_course.units">
                </div>
            </div>

            <div class="form-group">
                <label for="matric" class="col-sm-3 control-label">Semester</label>

                <div class="col-xs-6">
                    <select class="form-control" ng-model="current_course.semester">
                        <option value="1">First</option>
                        <option value="2">Second</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="matric" class="col-sm-3 control-label">Level</label>

                <div class="col-xs-6">
                    <select class="form-control" ng-model="current_course.level_id">
                        <option value="1">OND1</option>
                        <option value="2">OND2</option>
                        <option value="3">HND1</option>
                        <option value="4">HND2</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="matric" class="col-sm-3 control-label">Status</label>

                <div class="col-xs-6">
                    <select class="form-control" ng-model="current_course.status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>

        </form>

    </div>
    <div class="modal-footer">
        <div class="col-sm-8 down" ng-hide="course_progress_hidden">
            <progressbar class="progress-striped active down" max="200" value="200" type="primary"></progressbar>
        </div>
        <button class="btn btn-primary" ng-click="addCourse()">Save</button>
        <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
    </div>
</script>

<script type="text/ng-template" id="ModalEdit.html">
    <div class="modal-header">
        <h3 class="modal-title">&#xf044; Edit Course</h3>
    </div>
    <div class="modal-body">

        <form class="form-horizontal">
            <div class="form-group">
                <label for="Surname" class="col-sm-3 control-label">Title</label>

                <div class="col-xs-6">
                    <input type="text" class="form-control" id="title" placeholder="Title"
                           ng-model="current_course.title">
                </div>
            </div>

            <div class="form-group">
                <label for="firstname" class="col-sm-3 control-label">Code</label>

                <div class="col-xs-6">
                    <input type="text" class="form-control" id="code" placeholder="Code" ng-model="current_course.code">
                </div>
            </div>

            <div class="form-group">
                <label for="othername" class="col-sm-3 control-label">Unit</label>

                <div class="col-xs-6">
                    <input type="number" class=" validate-numeric form-control" id="unit" placeholder="Unit"
                           ng-model="current_course.units">
                </div>
            </div>

            <div class="form-group">
                <label for="matric" class="col-sm-3 control-label">Semester</label>

                <div class="col-xs-6">
                    <select class="form-control" ng-model="current_course.semester">
                        <option value="1">First</option>
                        <option value="2">Second</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="matric" class="col-sm-3 control-label">Level</label>

                <div class="col-xs-6">
                    <select class="form-control" ng-model="current_course.level_id">
                        <option value="1">OND1</option>
                        <option value="2">OND2</option>
                        <option value="3">HND1</option>
                        <option value="4">HND2</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="matric" class="col-sm-3 control-label">Status</label>

                <div class="col-xs-6">
                    <select class="form-control" ng-model="current_course.status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>

        </form>

    </div>
    <div class="modal-footer">
        <div class="col-sm-8 down" ng-hide="course_progress_hidden">
            <progressbar class="progress-striped active down" max="200" value="200" type="primary"></progressbar>
        </div>
        <button class="btn btn-primary" ng-click="saveCourse()">Save</button>
        <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
    </div>
</script>

<script type="text/ng-template" id="ModalDel.html">
    <div class="modal-header">
        <h3 class="modal-title">&#xf1f8; Delete Course</h3>
    </div>
    <div class="modal-body">


        <div class="center" style="color:red"><strong>Deleting a course might delete students' scores associated with it !!</strong></div>
        <br>
        <div class="center">Do you wish to continue?</div>

    </div>
    <div class="modal-footer">
        <div class="col-sm-8 down" ng-hide="course_progress_hidden">
            <progressbar class="progress-striped active down" max="200" value="200" type="danger"></progressbar>
        </div>

        <button class="btn btn-danger" ng-click="deleteCourse()" ng-disabled="!course_progress_hidden">Delete</button>
        <button class="btn btn-warning" ng-click="cancel()" ng-disabled="!course_progress_hidden">Cancel</button>
    </div>
</script>





</div>