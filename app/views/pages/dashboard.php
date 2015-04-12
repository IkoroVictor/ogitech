<div ng-controller="DashboardCtrl as ctrl">

    <div class="Title">DASHBOARD</div>


    <div class="row">
        <div class="col-xs-12">

            <div align="center" style="font-family: Miso; font-size: 300%">
                <span>SESSION: </span>
                <span style="color: orange; ">{{ ctrl.state.state_name }}</span>
                <span>&NonBreakingSpace; &NonBreakingSpace;</span>
                <span>SEMESTER: </span>
                <span style="color: orange; ">{{ (ctrl.state.state_obj.semester == 1) ? "FIRST":"SECOND"}}</span>

            </div>
        </div>


    </div>
    <br>
    <br>

    <div class="row"style="font-family: Miso;">
        <div class="col-xs-3" ng-repeat="l in ctrl.data">
            <table class="table">
                <thead>
                <tr>
                    <th style=" background-color: rgba(3, 11, 39, 0.78);color: orange; font-size: 190%; text-align: center">{{ l.info.title }}
                    </th>
                    <th style=" background-color: rgba(3, 11, 39, 0.78);color: orange; font-size: 190%; text-align: center">
                    </th>
                </tr>
                </thead>
                <tbody style="font-size: 160%">
                    <tr >
                        <td>Total No. of Students</td>
                        <td>245</td>
                    </tr>
                    <tr >
                        <td>Regular</td>
                        <td>169</td>
                    </tr>
                    <tr >
                        <td>Extra Year</td>
                        <td>12</td>
                    </tr>
                    <tr >
                        <td>Probation</td>
                        <td>64</td>
                    </tr>
                    <tr >
                        <td>Inactive</td>
                        <td>64</td>
                    </tr>

                </tbody>
            </table>
            <table class="table">
                <thead>
                <tr>
                    <th style=" background-color: rgba(3, 11, 39, 0.78);color: orange; font-size: 190%; text-align: center">Top 5 Students(CGPA)
                    </th>
                    <th style=" background-color: rgba(3, 11, 39, 0.78);color: orange; font-size: 190%; text-align: center">
                    </th>
                </tr>
                </thead>
                <tbody style="font-size: 160%">
                    <tr ng-repeat="std in l.top5_cgpa">
                        <td>{{ std.student.user.firstname }} {{ std.student.user.othername }} {{ std.student.user.lastname }}</td>
                        <td>{{ std.cgpa }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table">
                <thead>
                <tr>
                    <th style=" background-color: rgba(3, 11, 39, 0.78);color: orange; font-size: 190%; text-align: center">Pie Chart(Degree)
                    </th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <div class="row">

                    </div>
                </tr>
                </tbody>
            </table>
            <highchart id="chart1" config="ctrl.chart_config_cgpa[$index]" ></highchart>
        </div>


    </div>



</div>