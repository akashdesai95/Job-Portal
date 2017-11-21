-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2016 at 01:11 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(30) NOT NULL,
  `company` varchar(100) NOT NULL,
  `website` varchar(500) NOT NULL,
  `number` bigint(10) NOT NULL,
  `closejob` varchar(10) NOT NULL DEFAULT 'open',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `username`, `email`, `password`, `company`, `website`, `number`, `closejob`) VALUES
(17, 'flipkart', 'jobs@flipkart.com', 'flipkart', 'Flipkart', 'http://www.flipkart.com/', 9879108970, 'open'),
(18, 'makemytrip', 'makemytrip@gmail.com', 'makemytrip', 'MakeMyTrip', 'www.makemytrip.com', 9876543210, 'open'),
(19, 'finolex', 'finolex@gmail.com', 'finolex', 'Finolex', 'www.finolex.com', 987321, 'open'),
(20, 'steria', 'steria@gmail.com', 'steria', 'Steria Ltd.', 'www.steria.com', 789456, 'open'),
(21, 'accenture', 'accenture@gmail.com', 'accenture', 'Accenture', 'www.accenture.com', 7891236540, 'open'),
(22, 'benchmark', 'benchmarker@gmail.com', 'benchmark', 'Benchmarker Soln.', 'www.benchmarker.com', 987123465, 'open'),
(23, 'netkey', 'netkey@gmail.com', 'netkey', 'Netkey Solutions', 'www.netkey.com', 987456123, 'open'),
(24, 'premier', 'premier@gmail.com', 'premier', 'Premier Informations', 'www.premierinformation.com', 7465812655, 'open'),
(25, 'ethos', 'ethos@gmail.com', 'ethos', 'Ethos Pvt. Ltd.', 'www.ethos.com', 48791256, 'open'),
(26, 'careerb', 'careerbright@gmail.com', 'careerb', 'Career Bright Recruiters Pvt Ltd', 'www.careerbright.com', 984521587, 'open'),
(27, 'fundr', 'fundraising@gmail.com', 'fundr', 'Home Fundraising India Pvt Ltd', 'www.homefundraising.com', 952479825, 'open');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `birthday` date NOT NULL,
  `city` varchar(50) NOT NULL,
  `number` bigint(12) NOT NULL,
  `experience` varchar(20) NOT NULL,
  `education` varchar(255) NOT NULL,
  `resume` varchar(500) NOT NULL,
  `univ` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `closejob` varchar(10) NOT NULL DEFAULT 'open',
  `showjob` int(11) NOT NULL,
  `propic` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `username`, `email`, `password`, `fname`, `birthday`, `city`, `number`, `experience`, `education`, `resume`, `univ`, `year`, `closejob`, `showjob`, `propic`) VALUES
(17, 'khushie', 'khushibealways@gmail.com', '2941997', 'Khushi Desai', '2016-04-30', 'Valsad', 9879108970, 'Undergraduate', 'Btech CE', 'C:/wamp/www/PHPProject/uploads/khushibealways@gmail.com.docx', 'Dharamsinh Desai University, Nadiad', 0, 'open', 0, 'jpg'),
(18, 'vishwa', 'vishwadesai23@gmail.com', '1234', 'Vishwa Desai', '1999-03-23', 'Valsad', 9428365287, 'High School', 'Class 12 Commerce', 'C:/wamp/www/PHPProject/uploads/vishwadesai23@gmail.com.docx', 'Atul Vidyalaya, Atul', 2, 'open', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `jobapplications`
--

CREATE TABLE IF NOT EXISTS `jobapplications` (
  `unique_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(10) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` int(10) NOT NULL,
  `applied_date` date NOT NULL,
  `closejob` varchar(10) NOT NULL DEFAULT 'open',
  PRIMARY KEY (`unique_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `jobapplications`
--

INSERT INTO `jobapplications` (`unique_id`, `job_id`, `company_id`, `employee_id`, `applied_date`, `closejob`) VALUES
(21, 28, 20, 18, '2016-03-31', '1'),
(22, 30, 22, 18, '2016-03-31', '1'),
(23, 25, 17, 18, '2016-03-31', 'open'),
(28, 34, 25, 17, '2016-03-31', 'open'),
(29, 27, 19, 17, '2016-03-31', 'open');

-- --------------------------------------------------------

--
-- Table structure for table `postjob`
--

CREATE TABLE IF NOT EXISTS `postjob` (
  `username` varchar(10) NOT NULL,
  `cmpname` varchar(50) NOT NULL,
  `category` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `jobdesc` varchar(1000) NOT NULL,
  `stipend` int(10) NOT NULL,
  `location` varchar(25) NOT NULL,
  `vacancy` int(5) NOT NULL,
  `profile` varchar(1000) NOT NULL,
  `posted_date` date NOT NULL,
  `contact` bigint(20) NOT NULL,
  `cmpdesc` varchar(1000) NOT NULL,
  `deadline` date NOT NULL,
  `closejob` varchar(10) NOT NULL DEFAULT 'open',
  `logos` varchar(500) NOT NULL,
  `notification` int(11) NOT NULL,
  `requestdate` date NOT NULL,
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `postjob`
--

INSERT INTO `postjob` (`username`, `cmpname`, `category`, `email`, `job_id`, `company_id`, `role`, `jobdesc`, `stipend`, `location`, `vacancy`, `profile`, `posted_date`, `contact`, `cmpdesc`, `deadline`, `closejob`, `logos`, `notification`, `requestdate`) VALUES
('flipkart', 'Flipkart', 'IT', 'jobs@flipkart.com', 24, 17, 'Technical Architect', 'Architects at Flipkart are responsible for driving Technology &amp; Good Practices in Engineering in their respective teams. We are a rapidly growing &amp; constantly improving organization&amp; we a seek very high levels of ownership in all individuals, especially roles like this ownership of systems in your team and their impact on the entire Flipkart eco-system. Going beyond your role &amp; contributing to make the organization &amp; business better is an expectation. Actively participate in development along with team members for as much as 75% of their time, creating modules &amp; systems that can then be treated as a working reflection of the best practices\r\nâ€¢ Participating in code reviews, design reviews, architecture discussions.\r\nâ€¢ Being responsible for Scaling, Performance &amp; Quality for the team.', 500000, 'Bangalore, Karnataka', 3, 'Education : Any Graduate, Postgraduate or Doctorate. Requisites : Quick &amp; Excellent Problem Solving skills for complex &amp; large scale problems.\r\nâ€¢ Technical Breadth Exposure to a wide variety of problem spaces, technologies.\r\nâ€¢ Very Strong System design and OO skills with a nifty ability to craft clean interfaces and operate at the right levels of abstraction.\r\nâ€¢ Solid coding skills with ability to drive teams through massive refactoring exercise &amp; improve coding standards across large code bases.\r\nâ€¢ Good knowledge, understanding &amp; experience of working with a large variety of multi-tier architectures. Awareness of pitfalls &amp; use cases for a large variety of solutions.', '2016-03-30', 180056, 'Flipkart is made of people who love being themselves and their independence of thoughts pave way for disruptive innovation on tech, biz and ops fronts. We are looking for engineers who are well rounded - quality conscious, product thinkers, business congnizant and smart - not mere coders. Engineers get to significantly amplify their impact with the scale that Flipkart operates at. The same scale also demands the engineers to produce super-efficient solutions. Engineers participate and breed the culture of self-drive which is fuelled with merit based opportunities. In the pursuit of excellence, Flipsters compete against themselves because there is no competitor in the radar.', '2016-04-30', 'open', 'png', 0, '0000-00-00'),
('flipkart', 'Flipkart University', 'Consultant', 'hrjobs@flipkart.com', 25, 17, 'Senior Consultant', 'You will be responsible for enabling &amp; supporting the community based, informal learning networks &amp; initiatives within Flipkart. You also will be responsible for enabling, structuring, managing &amp; sustaining the knowledge assets/ artefacts within the Flipkart Academies, business communities and internal social networks.', 700000, 'Kozhikode, Kerela', 2, 'Education : MBA or Masters in Psychology, Social Works\r\n 3 - 5 years overall experience of document &amp; content management experience in IT/ ITES/ Consulting industry/ experience of running community initiatives in large organizations\r\nRequisite : Ability to generate enthusiasm for community based learning activities, understand needs of end users and proactively make things happen\r\n Ability to work across organizational boundaries with strong network orientation\r\n Ability to communicate across all levels of hierarchy. Possess very good communication skills, both verbal and written.\r\n Excellent facilitation &amp; coordination skills\r\n Ability to influence people without formal authority', '2016-03-30', 794613852, 'Flipkart University recognises the shift from the knowledge worker to the learning worker with the consequent need to provide a range of new activities and services, utilising a wider range of platforms and tools and new guiding principles. You contribution will be vital to the success of Flipkart University.', '2016-07-30', 'open', 'png', 0, '0000-00-00'),
('finolex', 'Career Placement', 'Engineering', 'jobs@finolex.com', 27, 19, 'Engineer', 'Having 1-2 yrs Exp in the field of Sales/marketing for auto Components. Having Good communication skill', 400000, 'Pune', 2, 'Education : BE/ BTech Any specialisation, Mechanical', '2016-03-30', 654321, 'Career Placements is 21 year old Pune based Recruitment Consultants, providing suitable and timely manpower in multiple disciplines across all levels. We have offices in pan India and over seas in Dubai and US.', '2016-05-30', 'open', 'png', 0, '0000-00-00'),
('steria', 'Steria', 'FMCG', 'jobs@steria.com', 28, 20, 'Performance Test', 'Must have highly skilled in performance engineering processes Expert using LoadRunner or Performance Center or JMeter;\r\nShould have worked on performance test result analysis ; \r\nShould have worked on protocols like HTTP, RDP, Web Service;', 800000, 'Noida', 3, 'B.Tech/B.E. - Computers, Electronics/Telecommunication', '2016-03-30', 456547, 'Steria, is a European multinational organization, and a leading provider of IT enabled business services. Headquartered in Paris and listed on the Euronext market, our annual revenue is 1.80 billion euros.', '2016-06-30', 'open', 'png', 0, '0000-00-00'),
('accenture', 'Accenture', 'Accounting', 'jobs@accenture.com', 29, 21, 'Accountant', 'Accenture is hiring for Finance &amp; Accounting (A/C payables, A/C receivables) &amp; Taxation (Indian Taxation) &amp; Payroll role.', 200000, 'Ujjain', 3, 'Education: Any(Only commerce). Requisite: Freshers should have good understanding in Finance &amp; Accounting (A/C payables, A/C receivables) &amp; Taxation (Indian Taxation) &amp; Payroll.', '2016-03-30', 987654120, 'Accenture is a leading global professional services company, providing a broad range of services and solutions in strategy, consulting, digital, technology and operations', '2016-05-30', 'open', 'jpg', 0, '0000-00-00'),
('benchmark', 'Benchmarker Solns.', 'Bank', 'jobs@benchmarker.com', 30, 22, 'Credit Officer', '1) Credit Underwrting\r\n 2) Credit Appraisal\r\n 3) Document Verification\r\n 4) Credit Health Check\r\n 5) Should Have Knowledge of CIBIL\r\n 6) Balance Sheet Analysis\r\n 7) Ratio Analysis\r\n 8) Understanding of Credit Appraisal Memorandum', 175000, 'Thane', 20, 'Education: BCom - Commerce Post Graduation Not Required. Any Doctorate - Any Specialization, Doctorate Not Required', '2016-03-30', 79435861, 'Benchmarker started operations as an NBFC in 2005 with the mission of providing a full range of financial services to the economically active poor who are not adequately served by financial institutions.', '2016-07-30', 'open', 'png', 0, '0000-00-00'),
('netkey', 'Netkey Solutions', 'Ecommerce', 'jobs@netkey.com', 31, 23, 'Online Marketing Executive', 'Candidate must have minimum 1 year of relevant experience in SEO. \r\n Should have Good Knowledge on Google updates, PPC. \r\n Candidate should have knowledge of latest SEO/SEM trends, methods and best practices.\r\n Good in SMO Strategy Planning and Marketing.', 700000, 'Kolkata', 5, 'Any Graduate, Graduation Not Required. Any Postgraduate, Post Graduation Not Required.\r\nAny Doctorate - Any Specialization, Any Specialization, Doctorate Not Required', '2016-03-30', 987123654, 'NetKey Solutions\r\nEsteemed Client of Netkey Solutions', '2016-10-30', 'open', 'jpg', 0, '0000-00-00'),
('netkey', 'Netkey Solutions', 'Insurance', 'jobs1@netkey.com', 32, 23, 'Insurance Operator', 'Candidate should be able to handle the end to end HR Operations.\r\n Manpower Planning and Recruitment.\r\n Employee Relations.\r\n Training and Development.\r\n Payroll Processing.\r\n Performance Appraisal.', 400000, 'Mangalore', 4, 'Any Graduate - Any Specialization, Graduation Not Required.\r\nGood Communication skills.\r\n Strong leadership skills.\r\n Effective problem solving skills.\r\n MBA HR Preferred', '2016-03-30', 978134565, 'NetKey Solutions\r\nEsteemed Client of NetKey Solutions', '2016-07-30', 'open', 'jpg', 0, '0000-00-00'),
('premier', 'Premier Informations', 'Media', 'jobs@premier.com', 33, 24, 'Supervisor', 'should have working experience in supervising. Should have good communication skill.', 250000, 'Bangalore', 1, 'Diploma - Any Specialization, Mechanical, B.Tech/B.E. - Any Specialization. Post Graduation Not Required. Doctorate Not Required', '2016-03-30', 47625981, 'One of our reputed client. Ours is a leading job consultancy based in bangalore. We source efficient candidates to our reputed client companies.', '2016-07-05', 'open', 'png', 0, '0000-00-00'),
('ethos', 'Ethos HR Management &amp; Projects', 'Medical', 'jobs@ethos.com', 34, 25, 'Health Care Assistance', 'Healthcare Assistant , Care homes offer accommodation, personal and nursing care for people who may not be able to live independently. Some homes specialise in caring for particular groups such as people suffering from dementia or younger adults with learning disabilities.', 200000, 'Shimla', 50, 'B.Sc - Nursing, Diploma. Post Graduation Not Required.', '2016-03-30', 79885545, 'The Care home has has four care homes, providing general, nursing and residential care, together with respite, holiday and post operative care. The Homes are predominantly elegant Georgian mansions and are set within the cities of Plymouth and Exeter, and seaside locations in Seaton and Dawlish', '2016-05-03', 'open', 'jpg', 1, '0000-00-00'),
('ethos', 'Ethos Healthcare', 'Medical', 'jobs1@ethos.com', 35, 25, 'Nurse', 'Healthcare Assistant , Care homes offer accommodation, personal and nursing care for people who may not be able to live independently. Some homes specialise in caring for particular groups such as people suffering from dementia or younger adults with learning disabilities.', 150000, 'Chennai', 10, 'B.Sc - Nursing, Diploma', '2016-03-30', 9547812, 'The Care home has has four care homes, providing general, nursing and residential care, together with respite, holiday and post operative care. The Homes are predominantly elegant Georgian mansions and are set within the cities of Plymouth and Exeter, and seaside locations in Seaton and Dawlish', '2016-02-29', 'open', 'jpg', 1, '0000-00-00'),
('careerb', 'Career Bright Recruiters Pvt Ltd', 'Real Estate', 'jobs@careerbright.com', 36, 26, 'Project Engineer', 'The main purpose of a project engineering manager is to complete engineering and construction projects by planning, organizing and controlling all elements of the project. The manager supervises all development and implementation of a project.', 225000, 'Lucknow', 2, 'Any Specialization, Graduation Not Required, B.Tech/B.E. - Any Specialization, Civil. Project engineers must demonstrate knowledge in civil engineering principles, practices and methods, environmental regulations, engineering project management methods, workplace safety, budgeting, employee supervision and personnel management.', '2016-03-30', 94582555, 'The main purpose of a project engineering manager is to complete engineering and construction projects by planning, organizing and controlling all elements of the project. The manager supervises all development and implementation of a project.', '2016-06-30', 'open', 'jpg', 0, '0000-00-00'),
('ethos', 'khdbwhjb', 'Accounting', 'alalal@gmail.co', 37, 25, 'jsnjsn', 'jghjgjhgj', 656566, 'jnnk', 565, 'jkhjkhkhk', '2016-03-31', 5454664, 'jhgjhgjgjh', '2016-01-31', 'removed', 'jpg', 2, '2016-03-31'),
('ethos', 'Ethos dummy', 'Others', 'dummy@ethos.com', 38, 25, 'dummy', 'dummy', 5, 'dummy', 5, 'dummy', '2016-03-31', 99, 'dummy', '2016-02-29', 'open', 'jpg', 0, '0000-00-00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
