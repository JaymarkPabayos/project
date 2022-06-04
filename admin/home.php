
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <?php
				  		$mydb->setQuery("SELECT COUNT(*) as count FROM `tblapplicants`");
              $count = $mydb->loadSingleResult(); 
            ?>
              <h3><?php echo $count->count;?></h3>

              <p>Total Applicants</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href=" <?php echo web_root;?>/admin/applicants" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <?php
                $mydb->setQuery("SELECT COUNT(*) as count FROM `tbljob`");
                $count = $mydb->loadSingleResult(); 
              ?>
              <h3><?php echo $count->count;?></h3>
              <p>New Job Vacancies</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href=" <?php echo web_root;?>/admin/vacancy" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <?php
                $mydb->setQuery("SELECT COUNT(*) as count FROM `tblapplicants`");
                $count = $mydb->loadSingleResult(); 
              ?>
              <h3><?php echo $count->count;?></h3>
              <p>New User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <?php
                $mydb->setQuery("SELECT COUNT(*) as count FROM `tblcompany`");
                $count = $mydb->loadSingleResult(); 
              ?>
              <h3><?php echo $count->count;?></h3>
              <p>New Companies</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href=" <?php echo web_root;?>/admin/company" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <section>

        <h1>Recent Users</h1>
        <table id="dash-table" class="table  table-bordered table-hover table-responsive" style="font-size:12px;" cellspacing="0"> 
            <thead>
              <tr>
                <th>Account ID</th>
                <th> Account Name</th>
                <th>Username</th>
                <th>Role</th>
                <th width="10%" >Action</th>
              </tr>	
            </thead> 
            <tbody>
              <?php 
                // $mydb->setQuery("SELECT * 
                  // 			FROM  `tblusers` WHERE TYPE != 'Customer'");
                $mydb->setQuery("SELECT * 
                        FROM  `tblusers`");
                $cur = $mydb->loadResultList();
  
              foreach ($cur as $result) {
                echo '<tr>';
                // echo '<td width="5%" align="center"></td>';
                echo '<td>' . $result->USERID.'</a></td>';
                echo '<td>' . $result->FULLNAME.'</a></td>';
                echo '<td>'. $result->USERNAME.'</td>';
                echo '<td>'. $result->ROLE.'</td>';
                If($result->USERID==$_SESSION['ADMIN_USERID'] || $result->ROLE=='MainAdministrator' || $result->ROLE=='Administrator') {
                  $active = "Disabled";
  
                }else{
                  $active = "";
  
                }
  
                echo '<td align="center" > <a title="Edit" href="/peso-job-hunt/admin/user/index.php?view=edit&id='.$result->USERID.'"  class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>
                      <a title="Delete" href="/peso-job-hunt/admin/user/controller.php?action=delete&id='.$result->USERID.'" class="btn btn-danger btn-xs" '.$active.'><span class="fa fa-trash-o fw-fa"></span> </a>
                      </td>';
                echo '</tr>';
              } 
              ?>
            </tbody>
          </table>  
      </section>
      <section>
        <h1>Recent Applicants</h1>
        <form class="wow fadeInDownaction" action="/peso-job-hunt/admin/applicants/controller.php?action=delete" Method="POST">   		
							<table id="dash-table" class="table table-striped  table-hover table-responsive" style="font-size:12px" cellspacing="0">

							  <thead>
							  	<tr>
									<th>Applicant</th>
									<th>Job Title</th>
									<th>Company</th>
									<th>Applied Date</th> 
									<th>Remarks</th>
									<th width="14%" >Action</th> 
							  	</tr>	
							  </thead> 
							  <tbody>
							  	<?php   
							  		// $mydb->setQuery("SELECT * 
											// 			FROM  `tblusers` WHERE TYPE != 'Customer'");
							  		$mydb->setQuery("SELECT * FROM `tblcompany` c  , `tbljobregistration` j, `tbljob` j2, `tblapplicants` a WHERE c.`COMPANYID`=j.`COMPANYID` AND  j.`JOBID`=j2.`JOBID` AND j.`APPLICANTID`=a.`APPLICANTID` ");
							  		$cur = $mydb->loadResultList();

									foreach ($cur as $result) { 
							  		echo '<tr>';
							  		// echo '<td width="5%" align="center"></td>';
							  		echo '<td>'. $result->APPLICANT.'</td>';
							  		echo '<td>' . $result->OCCUPATIONTITLE.'</a></td>';
							  		echo '<td>' . $result->COMPANYNAME.'</a></td>'; 
							  		echo '<td>'. $result->REGISTRATIONDATE.'</td>';
							  		echo '<td>'. $result->REMARKS.'</td>';
					  				echo '<td align="center" >    
														<a title="View" href="/peso-job-hunt/admin/applicants/index.php?view=view&id='.$result->REGISTRATIONID.'"  class="btn btn-info btn-xs  ">
														<span class="fa fa-info fw-fa"></span> View</a> 
														<a title="Remove" href="/peso-job-hunt/admin/applicants/index.php?view=delete&id='.$result->REGISTRATIONID.'"  class="btn btn-danger btn-xs  ">
														<span class="fa fa-trash-o fw-fa"></span> Remove</a> 
					  					 </td>';
							  		echo '</tr>';
							  	} 
							  	?>
							  </tbody>
								
							</table>
							</form>
      </section>
      <section>
        <h1>Recent Employees</h1>
        <form class="wow fadeInDownaction" action="/peso-job-hunt/admin/employee/controller.php?action=delete" Method="POST">   		
							<table id="dash-table" class="table table-striped  table-hover table-responsive" style="font-size:12px" cellspacing="0">

							  <thead>
							  	<tr>
							  		<th width="5%">EmployeeNo</th>
							  		 <th>Name</th>
							  		<th>Address</th>
							  		 <th>Sex</th>
							  		 <th>Age</th>
							  		 <th>ContactNo</th>
							  		 <!-- <th>Department</th> -->
							  		 <th>Position</th>
							  		 <!-- <th>Work Status</th> -->
							  	 	<th width="14%" >Action</th> 
							  	</tr>	
							  </thead> 
							  <tbody>
							  	<?php   
							  		// $mydb->setQuery("SELECT * 
											// 			FROM  `tblusers` WHERE TYPE != 'Customer'");
							  		$mydb->setQuery("SELECT * 
														FROM   `tblemployees`");
							  		$cur = $mydb->loadResultList();

									foreach ($cur as $result) { 
							  		echo '<tr>';
							  		// echo '<td width="5%" align="center"></td>';
							  		echo '<td>' . $result->EMPLOYEEID.'</a></td>';
							  		echo '<td>'. $result->LNAME.', '. $result->FNAME.'</td>';
							  		echo '<td>'. $result->ADDRESS.'</td>';
							  		echo '<td>'. $result->SEX.'</td>';
							  		echo '<td>'. $result->AGE.'</td>';
							  		echo '<td>'. $result->TELNO.'</td>';
							  		// echo '<td>'. $result->DEPARTMENT.'</td>';
							  		echo '<td>'. $result->POSITION.'</td>';
							  		// echo '<td>'. $result->WORKSTATS.'</td>'; 
					  				echo '<td align="center" >    
					  		             <a title="Edit" href="/peso-job-hunt/admin/employee/index.php?view=edit&id='.$result->EMPLOYEEID.'"  class="btn btn-info btn-xs  ">
					  		             <span class="fa fa-edit fw-fa"></span></a> 
					  		             <a title="Delete" href="/peso-job-hunt/admin/employee/controller.php?action=delete&id='.$result->EMPLOYEEID.'"  class="btn btn-danger btn-xs  ">
					  		             <span class="fa fa-trash-o fw-fa"></span></a> 
					  					 </td>';
							  		echo '</tr>';
							  	} 
							  	?>
							  </tbody>
								
							</table>
 
							 
							</form>
      </section>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  