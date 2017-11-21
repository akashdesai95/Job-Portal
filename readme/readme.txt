Recruiters place

----------------------------------------------------------------------Admin Side----------------------------------------------------------------------------------------

    Admin has all the rights to access all the details of all companies as well as all the users registered on the site.Admin can also see all applications send 
    to a company for a particular job.Admin can also block and unblock a company,employee,and even the job application of any employee if found inappropriate.
    Admin can also remove the jobs posted by the companies when requested by the company.


NOTE:-check for correct database name in each file that requires connection and also check for appropriate username and password and also the host.

Database name:-project
tables:
	clients->contains basic information of all companies that register to the site with unique company_id
	employees->contains basic information of all employees that register to the site with unique employee_id
	postjob->contains information of all jobs posted by the companies and provided company_id of the company that is posting that job and a unique job_id is given
	jobapplications->when a employee applies for a job the job_id,employee_id and the company_id of the company that has posted the job is stored in this table
		
		
------------------------------------------------------------------Description of files----------------------------------------------------------------------
home.php:-
	->It has 4 links. a]Employee b]Recruiters c]Availabe jobs d]Notification
	
employee.php:-
	->shows employee profile (viewemployeeprofile.php)
	->Link to view all the applications of the employee (applications.php)		
	->block/unblock account link (blockaccount.php/unblockaccount.php)
	
viewemployeeprofile.php:-
	->shows basic details of particular employee
	
applications.php:-
	->shows all the applications of the particular employee
	->block/unblock application link for a given job

blockaccount.php:-
	->blocks the account of particular employee 
	
unblockaccount.php:-
	->unblocks the account of particular employee 

employer.php:-
	->shows employer details
	->Link to view all jobs posted by the given company (myjobs.php)	
	->block/unblock company link (blockcompany.php/unblockcompany.php)

myjobs.php:-
	->All the jobs posted by given company are shown here.
	->All the received applications can be viewed (jobapplications.php)
	->View details of particular job (viewjobdetails.php)
	->Link to block/unblock particular job (blockjob.php/unblockjob.php)
	
jobapplications.php:-
	->View all the job applications for particular job.
	
blockjob.php:-
	->blocks posted job of particular company 
	
unblockjob.php:-
	->unblocks posted job of particular company 
		
blockcompany.php:-
	->blocks the account of particular company 
	
unblockaccount.php:-
	->unblocks the account of particular company 
	
blockapplication.php:-
	->blocks application for particular job of particular employee 
	
unblockapplication.php:-
	->unblocks application for particular job of particular employee 
	
viewjobdetails.php:-
	->View details of particular job 

viewjobdetail.php:-
	->View details of particular job (with different parameters)
	
jobs.php:-
	->List of all available jobs

notification.php:-
	->Recieve the notifications to remove a job from a company in descending order of requested date.
	->Link to remove job (removejob.php)
	
removejob.php:-
	->Removes selected job

