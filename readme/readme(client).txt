Database details:
  //PHPMYADMIN
 Database Name:project
 Database Username:root
 Database Password:''(null)
 Server Name:localhost
 Total no of Tables:4
 1.clients:It has the details of companys that have registered into the website.
         -Fields like...username,password,email,contact,website etc.
2.employees:It has the data details of registred applicant.
            -Fields like....username,password,email,birthday,number etc.
3.postjob:It has the details of the company's posted jobs.
          -Fields like....username,cmpname,email,role,jobdesc etc.
4.jobappicantion:
---------------------------------------------------------------------details of files------------------------------------------------------------------------------------
1.home.php-cotains the homepage of website,contact us,about us details.
            -team member details.
             -and browse which forwards to searchby.php
2.login.php-it asks user to log in as applicant or employer.provide username and password to the corresponding fields.
              -loginhomeemployer.php,loginhome.php does the same task as login.php but according to whether it is as a applicant or an employer. 
3.loginvalidate.php-it validates the username and password provide by login.php.
                     -sets a session variable and a cookie for remember me
4. register.php:-It contains two buttons with links register as Applicant and register as employer.
                -register as Applicant will open the page registerlogin.php
                -register as employer will open the page register employer.php.
                -No changes are required for other pc.

5. registerlogin.php:-It will display the form for the job applicant with basic details such as usename,
                      password,email,mobile no etc.
                     -It will also pass one hidden name with value applicant when form will be submitted.
                     -When form will be submitted it will check validation through register validation.php page.
                     -No changes are required for other pc.

6.registeremployer.php-It will display the form for the employer with basic details such as company name,password,email,
                       company website name,contact no etc.
                      -It will also pass one hidden name type with value employer when form will be submitted.
                      -When form will be submitted it will check validation through register validation.php page.
                      -No changes are required for other pc.

7.registervalidate.php-It will check for different validation like username,password,mobile no,website name
                       according to the value of type whether it is applicant or employer.
                      -To run the programme on the other pc one needs to check servername,database name,database password
                       table name in the query statement.
8.searchby.php:-it will show the data of a company according to the category,company,designation and a keyword that specify the 
                 search .if no search field is selected then it will show all the data.
9.searchbylogin.php:it is same as searchby but after logging in.it checks if seesion is there or not.
10.dashboard.php-it provides the dashboard of an  applicant.
                 -To run the programme on the other pc one needs to check servername,database name,database password
                       table name in the query statement.
                 -dashboardoption.php provides  details of employer.
                   same as dashboard.php but requires differnet different database tables.
11.post.php-it provides a form for  a company to post a job.
            -all fields are required to be field.
            -it will add this data in the database table:postjob.
            -To run the programme on the other pc one needs to check servername,database name,database password
                       table name in the query statement.
            -wil validate data of the form by forwarding to postvalidate.php
12.postvalidate.php-validates the data of the form in post.php 
                   -adds data in postjob table of databse.
                   -7.viewpost.php:it will show the posts that are posted by a company.
                it fetches the data according to the postjob database table.
               -To run the programme on the other pc one needs to check servername,database name,database password
                       table name in the query statement.
13.viewpostdelete.php-it will posted posts by a company.(a full detail about it)
                      one can also delete the post about the company.
                       it sends the employer to deletejob.php page when delete request is clicked.
                   -To run the programme on the other pc one needs to check servername,database name,database password
                       table name in the query statement.

14.viewpost.php:it will show the posts that are posted by a company.
                it fetches the data according to the postjob database table.
               -To run the programme on the other pc one needs to check servername,database name,database password
                       table name in the query statement.
15.deletejob.php-it send admin a request delete comapny's post.by modifying the field notification to 0 or 1 accordingly.
                -To run the programme on the other pc one needs to check servername,database name,database password
                       table name in the query statement.

16.jobprofile.php-it provides the profile of a job posted by employer.
                 -To run the programme on the other pc one needs to check servername,database name,database password
                       table name in the query statement.
17.jobprofilelogin.php-same as jobprofile.php-but requires login .checks the session variable.
18.cvupload.php-it is a form  for the applicant to apply for a particular job.
                -such as city,experience,name of the candidate,qualification and upload your cv.
                -it forwards the user to cvvalidate.php.
19.cvvalidate.php-it validates the data provided by an applicant in the cvupload.php.
                  -it adds the data into database table:employees.
                  -To run the programme on the other pc one needs to check servername,database name,database password
                       table name in the query statement.
20.cvedit.php-when the user clicks on the edit button it will redirect to this page.
               -user can edit its profile here.
               -it forwards the page to cvalter.php
21.cvalter.php-it will fire the update query to update the data of the user.
              -To run the programme on the other pc one needs to check servername,database name,database password
                       table name in the query statement.

22.profile.php-it display the website profile of the applicant.
              -requires to fetch data from employee table according to the email of the applicant.
              -To run the programme on the other pc one needs to check servername,database name,database password
                       table name in the query statement.
23.profileedit.php-it provides the form for editing the user profile of the website.
                 -it redirects to the page profilealter.php
24.profilealter.php-it fires update query the data of user website profile
25.profileemployer.php-it fetches the data of the company profile.
                       -it requires the database table clients
                        -To run the programme on the other pc one needs to check servername,database name,database password
                       table name in the query statement.
26.profilealteremployer.php-it provides updation to the profile of the company.
                           -fires updates query in table clients.
                           -To run the programme on the other pc one needs to check servername,database name,database password
                            table name in the query statement.
27.submitapplicatio.php-it adds the data into the jobapplication table 
                       -To run the programme on the other pc one needs to check servername,database name,database password
                       table name in the query statement.
28.logout.php-it closes the sessions that were started at the time of login.
             -after logout user cannot access his/her data.
                  