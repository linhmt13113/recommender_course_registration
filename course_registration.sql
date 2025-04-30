-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 30, 2025 at 06:09 AM
-- Server version: 9.1.0
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course_registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_staff`
--

CREATE TABLE `academic_staff` (
  `staff_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academic_staff`
--

INSERT INTO `academic_staff` (`staff_id`, `staff_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
('STAFF01', 'Thai My Linh', 'staff@example.com', '$2y$12$Vst2RIOSqHRtJn0zxNVAke.aLn.VLc5fwInrsGxk/FcO0AtMU.ElK', NULL, '2025-04-03 08:31:22'),
('STAFF02', 'Ngoc Linh', 'staff02@example.com', '$2y$12$M.OXb7XrG4JOBs6BwnKR8eEnMczxNZ2o9Urb2l/ojlFL8i1bXYF4i', '2025-04-03 08:33:30', '2025-04-07 02:14:24');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
('AD1742826045', 'Quản trị viên', 'admin@example.com', '$2y$12$A/rz2Q5ud9e58cm9UE/LPev9u.NSvxD4xQ.biBYfl7H5B7jyGUgHS', '2025-03-24 07:20:46', '2025-04-07 02:21:57');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_description` text COLLATE utf8mb4_unicode_ci,
  `credits` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `lecturer_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_description`, `credits`, `lecturer_id`, `created_at`, `updated_at`) VALUES
('IT013IU', 'Algorithms and Data Strutures', 'Learn the important features of data structures and algorithms. How to use these structures to aid in algorithm design. Introduction to searching, sorting, and hashing techniques.', 4, 'LEC012', '2025-04-01 21:26:48', '2025-04-01 21:26:48'),
('IT017IU', 'Operating System', 'The course equips students with the ability to define and explain the principles of operating systems. Understand the architecture of an operating system. Ability to program to communicate with system functions and services.', 4, 'LEC01', '2025-04-01 22:31:11', '2025-04-01 22:31:11'),
('IT024IU', 'Computer Graphics', 'Implement algorithms and languages ​​for interaction in computer graphics. Concepts of coordinate systems in 2D, 3D space, vector space of curves, surfaces are born from the design, layout and construction of graphic objects. In addition, develop camera combination models for image creation and image processing.', 4, 'LEC05', '2025-04-01 23:30:28', '2025-04-01 23:30:28'),
('IT044IU', 'Human-Computer Interaction', 'This course emphasizes the integration of user experience design theory with common industry and educational practices to create effective interactive experiences. Students will learn about the User-Centred Design process, with an emphasis on designing products, applications, and software for users. Specifically, students will learn about techniques for gathering and understanding end-user requirements, the importance of common sense and accessibility design, and methods for rapid prototyping. Additionally, students will focus on integrating knowledge into practice by designing and conducting usability studies. They will apply this knowledge to design and evaluate a digital design using industry-standard tools.', 4, 'LEC03', '2025-04-01 23:27:08', '2025-04-01 23:27:08'),
('IT056IU', 'IT Project Management', 'This course provides students with a foundational understanding of software project management, with a particular focus on software products, project management, and contemporary issues in delivering enterprise software solutions. It examines plan-driven and agile methodologies, estimation techniques, change management, risk management, and the role of project management in business. And it identifies the management aspects and management reporting required from the beginning of a software development project.', 4, 'LEC02', '2025-04-01 23:25:37', '2025-04-01 23:25:37'),
('IT058IU', 'Thesis', 'These are practical or highly scientific topics, designed to ensure that students grasp and apply the knowledge learned in the program. Students will work in groups to collect requirements, design, implement and provide solutions to practical problems. Students can use appropriate models, must manage the project themselves, according to the project management techniques learned. The results of the thesis can be products according to requirements and related documents.', 10, NULL, '2025-04-01 23:10:48', '2025-04-01 23:10:48'),
('IT064IU', 'Introduction to computing', 'The course introduces basic concepts, models and trends in the Information Technology industry. In addition, students are introduced to majors, the structure of subjects in each major, the meaning of subjects, careers related to each major, and career orientation for students.', 3, 'LEC01', '2025-04-01 20:21:26', '2025-04-01 20:21:43'),
('IT067IU', 'Digital Logic Design', 'The course provides students with knowledge of binary numbers, Boolean algebra, Karnaugh maps, combinational circuits, MSI combinational circuits, sequential logic, synchronous state machine design, and sequential MSI circuits.', 4, 'LEC08', '2025-04-01 20:55:03', '2025-04-01 20:55:03'),
('IT068IU', 'Principles of Electrical Engineering I', 'The course is designed to provide students with knowledge of electrical circuit components; independent sources; dependent sources; analysis of steady-state DC and AC circuits; electrical network theory; operational amplifiers; power calculations.', 3, 'LEC01', '2025-04-01 21:30:47', '2025-04-01 21:30:47'),
('IT069IU', 'Object Oriented Programming', 'Programming and basic data structures use Java language. Basic control structures such as loops, arrays, recursive and cursors. Supporting design: class, inheritance, overload and polymorphism. Abstract data structure: Link list, list, husband and goods. Introducing analysis of algorithms, using O symbols, search and arrangement methods.', 4, 'LEC05', '2025-04-01 20:35:45', '2025-04-01 20:35:45'),
('IT074IU', 'Electronics Devices', 'This course provides students with basic knowledge of semiconductor devices and microelectronic circuits, characteristics of P-N junctions, Zener diodes and similar diode circuits. Theory of operation of MOSFET and BJT, biasing and analysis of transistors at intermediate frequency.', 3, 'LEC06', '2025-04-01 22:04:20', '2025-04-01 22:04:20'),
('IT076IU', 'Software Engineering', 'The course introduces the software engineering process. Survey of business operations. Discussion with customers about requirements. Selection of design technology. Object-oriented system analysis. Project design and programming.', 4, 'LEC05', '2025-04-01 22:51:59', '2025-04-01 22:51:59'),
('IT079IU', 'Principle of Database Management', 'The course aims to provide learners with an overview of: database architecture, database management methods; hierarchical data models, network data models and relational data models; methods for designing combined entity models and relational database models; functional dependencies for data and data normalization, data integrity constraints and data security; transaction management mechanisms for multi-user database management systems; in addition, the course also introduces some popular database management systems such as SQL Server and some other commercial database management systems.', 4, 'LEC02', '2025-04-01 21:34:01', '2025-04-01 21:34:01'),
('IT082IU', 'Internship', 'The subject aims to create conditions for students to have the opportunity to contact with the real environment, in order to solve practical problems in production and daily life. The main content includes: building and managing information systems using web or applications; computerizing office work, daily work; designing, installing and operating computer networks for businesses and organizations. Learning and applying new technologies.', 3, NULL, '2025-04-01 22:45:24', '2025-04-01 22:45:24'),
('IT083IU', 'Special Study of the Field', 'The course aims to guide students to learn how to solve a real-life synthetic problem. The main content of the instruction includes: problem approach, steps in the problem investigation process, methods of finding solutions, steps of planning and proposing solutions to the problem.', 3, NULL, '2025-04-01 23:02:18', '2025-04-01 23:02:18'),
('IT089IU', 'Computer Architecture', 'History and principles of computer architecture, computer construction, assembly language and computer code, computer arithmetic, ALU design, computer performance, data and control paths, pipelining, memory hierarchy, input and output devices, and mobile and multicore processors.', 4, 'LEC05', '2025-04-01 22:02:48', '2025-04-01 22:02:48'),
('IT090IU', 'Object Oriented Analysis and Design', 'Systems modeling. Concepts of systems analysis and design. Product development life cycle. Integrated process and implementation phases such as requirements, analysis, design, implementation and testing. Advanced content includes object-oriented databases, design patterns, Extreme programming.', 4, 'LEC07', '2025-04-01 22:06:34', '2025-04-01 22:06:34'),
('IT091IU', 'Computer Networks', 'Introduction to networking, OSI structure, packet switching, local area networks, Ethernet, wireless networks, and network protocols.', 4, 'LEC07', '2025-04-01 20:49:12', '2025-04-01 20:49:12'),
('IT092IU', 'Principle of Programming Languages', 'The course aims to familiarize students with some basic concepts of programming languages, thereby improving their ability to acquire other programming languages. Different types of programming languages ​​(such as logical programming languages, functional programming languages, procedural programming languages, object-oriented programming languages) are also compared and implementation methods are also studied and discussed.', 4, 'LEC012', '2025-04-01 22:26:48', '2025-04-01 22:26:48'),
('IT093IU', 'Web Application Development', 'Use knowledge and skills to develop Web applications based on Java utilities, technologies and development environments such as HTML, Java Server Page, Java Bean, MVC Model. In addition, it also expands knowledge related to Java architecture such as Ajax and Struts. This subject is the foundation for students to carry out course projects as well as graduation theses in the Web direction.', 4, 'LEC01', '2025-04-01 21:45:30', '2025-04-01 21:45:30'),
('IT094IU', 'Information System Management', 'The course aims to describe how an information system is used by businesses and its impact on business operations. Along with presenting and learning about technology in information systems, the basic issues are how technologies are used to solve business problems and the opportunities to exploit them. Specific content includes issues related to organization, management, business networks; business information technology infrastructure; management and organization support systems for digital businesses; building and managing information systems', 4, 'LEC01', '2025-04-01 23:23:34', '2025-04-01 23:23:34'),
('IT096IU', 'Net-Centric Programming', 'The course provides basic and advanced knowledge of TCP/IP and UDP network programming techniques. It helps students build data formats to design data transmission protocols on the network. It guides students to program applications with independent Client/Server network connections using socket level and some popular application-level network protocols such as HTTP, FTP, DNS, Email, etc. The course also provides students with software development skills on tools and visual environments such as PyCharm, Visual Studio, etc.', 4, 'LEC06', '2025-04-01 23:31:45', '2025-04-01 23:31:45'),
('IT103IU', 'Digital Signal Processing', 'This course introduces the fundamentals, methods and applications of digital signal processing, emphasizing its algorithmic, computational and programming aspects. Specific topics include: analog-to-digital conversion, concepts of discrete-time linear systems, filtering, spectral analysis of discrete-time signals and filter design.', 3, 'LEC010', '2025-04-01 23:08:17', '2025-04-01 23:08:17'),
('IT105IU', 'Digital System Design', 'This course introduces methods and techniques for designing digital systems. Topics include basic concepts, analysis, and system design using hardware description languages ​​(HDLs). The course provides an in-depth look at the design of asynchronous sequential circuits and complex synchronous systems. The design process is introduced through concepts, documentation, and simulation.', 3, 'LEC07', '2025-04-01 22:59:23', '2025-04-01 22:59:23'),
('IT110IU', 'Concepts in VLSI Design', 'This course provides an introduction to digital VLSI chip design based on CMOS technology and includes dynamic clock logic, MOSFET timing analysis and layout design rules. The course develops the use of computer-aided design software tools as well as an understanding of basic circuit testing.', 3, 'LEC011', '2025-04-01 23:09:10', '2025-04-01 23:09:10'),
('IT114IU', 'Software Architecture', 'Provides students with thorough understanding of different methods and techniques in analysis, design and deployment of information systems using UML.', 4, 'LEC01', '2025-04-01 23:49:42', '2025-04-01 23:49:42'),
('IT115IU', 'Embedded Systems', 'The course provides students with knowledge of Embedded Systems design, both from a hardware and software perspective. The main focus is on real-time processing for signal processing and communications systems. Programming projects in high-level languages ​​such as C/C++ will be an essential component of the course, as well as hardware design with modern design tools.', 3, 'LEC08', '2025-04-01 23:00:13', '2025-04-01 23:00:13'),
('IT116IU', 'C/C++ Programming', 'This course introduces the principles of programming using C and C++ and helps to develop algorithms. Topics include: introduction to computers and computing, program development, C/C++ programming language syntax, and basic numerical methods for engineers. The Unix environment and some of its utilities are also introduced.', 4, 'LEC02', '2025-04-01 20:29:15', '2025-04-01 20:29:15'),
('IT120IU', 'Entrepreneurship', 'The course provides knowledge about business startup, creative thinking to launch new products and services related to technology. The role of young businesses in the economy and how to manage businesses to inspire creative ideas in working groups. Building and turning business ideas into reality.', 3, 'LEC06', '2025-04-01 22:53:29', '2025-04-01 22:53:29'),
('IT128IU', 'Micro-processing Systems', 'The course equips students with basic knowledge of: programming in machine language and assembly language, architecture and instruction sets of microprocessor systems, and applications of microprocessor design.', 3, 'LEC02', '2025-04-01 22:34:18', '2025-04-01 22:34:18'),
('IT130IU', 'Digital Image Processing', 'This course introduces students to the principles, algorithms, and requirements of data mining. Students will study data mining concepts and algorithms to solve knowledge discovery problems. Students will develop skills in using current data mining software to solve real-world problems and gain experience in conducting independent research and learning.', 4, 'LEC05', '2025-04-01 23:53:46', '2025-04-01 23:53:46'),
('IT133IU', 'Mobile Application Development', 'This course is designed to introduce and familiarize students with programming in a mobile environment: The Android platform will be used throughout the course. The course begins with an introduction to the basic components, concepts, structures of Android applications and then continues with common user interface components, persistent storage, databases for mobile devices, etc. An introduction to most of the common tools and techniques for writing Android applications is also accompanied by hands-on experience in the form of programming projects and lab exercises.', 4, 'LEC04', '2025-04-01 23:28:36', '2025-04-01 23:28:36'),
('IT134IU', 'Internet of Things', 'The course explains the architecture and components of the Internet of Things. Students will learn about various communication techniques, from short-range to long-range such as Bluetooth, Zigbee, Wifi, LoRa, NB-IoT, etc. In addition, data storage, organization and analysis techniques are also learned in this course. After that, students will learn the basic concepts, principles and basic structure of IoT systems for industrial applications such as healthcare, manufacturing, agriculture, etc.', 4, 'LEC012', '2025-04-01 23:16:33', '2025-04-01 23:16:33'),
('IT135IU', 'Introduction to Data Science', 'This course provides a general introduction to four key aspects of data science: data retrieval and visualization, data visualization, statistical computing and machine learning, and presentation and communication. Students will use data from multiple sources, be introduced to modern computing environments and databases such as R/Python and SQL, and be exposed to research outside the classroom. Through this course, the student will become familiar with the challenges of contemporary data science and gain the fundamental skills needed to turn data into information.', 3, 'LEC04', '2025-04-01 20:31:38', '2025-04-01 20:31:38'),
('IT136IU', 'Regression Analysis', 'Regression analysis is one of the most powerful methods in statistics for determining relationships between variables and using these relationships to predict future observations. The foundation of regression analysis is very useful for modeling problems. Regression models are used to predict and forecast future outcomes. Its popularity in finance is very high; it is also very popular in other fields such as biological sciences, management, and engineering.', 4, 'LEC09', '2025-04-01 22:12:06', '2025-04-01 22:12:06'),
('IT137IU', 'Data Analysis', 'This course introduces the fundamentals of data analysis through the processes of data analysis along with descriptive and inferential statistics. Students will learn how to collect, process and transform data into useful information and knowledge that is important for decision making. From raw data to useful information to knowledge, students will examine a number of figures and case studies from different perspectives. Students can develop practical solutions to business and engineering problems, and gain hands-on experience using modern data analysis tools.', 4, 'LEC04', '2025-04-01 22:38:30', '2025-04-01 22:38:30'),
('IT138IU', 'Data Science and Visualization', 'The objective of this course is to introduce students to the key principles, methods, and techniques for effective visual data analysis. The course begins with the main objectives and principles of data visualization. The course continues with various aspects of visualization including techniques and methods for presenting different types of data as well as discussing and analyzing visualizations. Throughout the course, students will be introduced to various visualization systems and visualization tools through hands-on exercises.', 4, 'LEC010', '2025-04-01 22:18:23', '2025-04-01 22:18:23'),
('IT139IU', 'Scalable and Distributed Computing', 'This course covers the theory, design, implementation, and analysis of distributed systems. Through lectures, labs, projects, and exercises, students will learn the fundamentals of distributed systems, system modeling, remote procedure calls, distributed objects, operating system support, security in distributed systems, distributed file systems, concurrency, transactions and synchronization, and replication. The course also covers advanced topics related to distributed and cloud data processing technologies: data partitioning, storage schemes, stream processing, and parallel algorithms. The course\'s lab hours will allow students to explore modern Internet and cloud computing services running on multiple geographically distributed data centers: Google, Yahoo, Facebook, iTunes, Amazon, eBay, Bing, and more.', 4, 'LEC03', '2025-04-01 22:36:11', '2025-04-01 22:36:11'),
('IT140IU', 'Fundamental Concepts of Data Security', 'This course introduces students to cryptographic principles and systems (symmetric and public-key), and their applications in data security, secure communications, authentication, and authorization. These core principles will be applied to information risk management concepts, and the analysis and remediation of compromised systems. The ethics of computer crime, privacy, and intellectual property are covered in detail. Finally, the course will cover criteria and controls for classifying information.', 4, 'LEC011', '2025-04-01 21:20:53', '2025-04-01 21:20:53'),
('IT144IU', 'Business Process Analysis', 'Every organization thrives on implementing effective business processes to increase employee and customer satisfaction, enhance business performance, reduce costs, and increase productivity. All activities including changing critical processes, merging or splitting business units require a unified change management framework. The course aims to provide a basic understanding of business process analysis, improvement, and evaluation. Various methods, techniques, and software tools are used to analyze', 4, 'LEC02', '2025-04-01 23:50:34', '2025-04-01 23:50:34'),
('IT145IU', 'Decision Support Systems', 'A Decision Support System (DSS) is an interactive computer-based system or subsystem that helps decision makers use communication technology, data, documents, knowledge, and/or models to identify and solve problems, complete decision-processing tasks, and make decisions. DSS simulates human cognitive decision functions based on artificial intelligence methodologies (including expert systems, data mining, machine learning, connectionism, logical reasoning, etc.) to perform decision support functions. DSS is a general term for any computer application that assists a person or group in decision making. Additionally, DSS refers to a field of study that encompasses the design and study of DSS in the context of use.', 4, 'LEC03', '2025-04-01 23:51:41', '2025-04-01 23:51:41'),
('IT146IU', 'Theory of Networks', 'The course introduces the interconnectedness of modern life, answering the question of how our social, economic, and technological worlds are interconnected. Students will study modern network models, such as game theory, the structure of the Internet, social diffusion, the spread of social power and information, and information flows.', 4, 'LEC06', '2025-04-01 23:55:36', '2025-04-01 23:55:36'),
('IT149IU', 'Fundamentals of Programming', 'This course covers algorithm development and computer programming principles using languages ​​commonly used in data analysis, such as C/C++ or R/Python. Topics include introduction to computers and computation, program development, programming language syntax, and prime number methods for data scientists. Programming environments and utilities are also introduced.', 3, 'LEC03', '2025-04-01 20:30:27', '2025-04-01 20:30:27'),
('IT150IU', 'Blockchain', 'This course introduces students to the foundations of blockchain technology and its applications. Students will study the concepts and principles of how blockchain works. This course covers topics related to the blockchain space. The course starts with the basics of blockchain, cryptography, and basic understanding of bitcoin. Then, the applications of blockchain technology in the fields of finance, healthcare, supply chain, etc. are introduced. A complete picture of the ecosystem surrounding blockchain technology and the development trends are also discussed.', 4, 'LEC011', '2025-04-01 23:42:53', '2025-04-01 23:42:53'),
('IT151IU', 'Statistical Method', 'Provides students with a foundation in statistical methods for analyzing data, including summarizing and describing data and inferential techniques. Topics include basic probability distributions (e.g., normal and binomial distributions), expected value, estimation (maximum likelihood, confidence intervals), hypothesis testing, and multiple regression analysis.', 3, 'LEC010', '2025-04-01 21:15:24', '2025-04-01 21:15:24'),
('IT153IU', 'Discrete Mathematics', 'The course helps students develop the ability to think, reason and interpret based on mathematics and logic, applying this ability to analyze, process and solve discrete objects in reality. This is an application-oriented course based on the study of events that occur as small or discrete segments in science, economics, industry, etc. Students will be introduced to mathematical tools of discrete mathematics such as: combinatorial theory; relational theory (equivalence relations, ordering relations); counting problems (introduction to problems and extensions of recurrence relations); existence problems; enumeration problems; Boolean algebra theory; graph and tree theory. Practical applications will be introduced throughout the course.', 3, 'LEC06', '2025-04-01 20:43:53', '2025-04-01 20:43:53'),
('IT154IU', 'Linear Algebra', 'Linear algebra provides a mathematical framework for organizing information and then using that information to solve problems, especially data analysis problems. Linear algebra is essential for understanding and creating machine learning algorithms, especially neural networks and deep learning models. This course will provide students with the linear algebra knowledge necessary for machine learning and neural network modeling. Students will gain an overview of basic matrix and vector algebra as applied to linear systems. They will then learn how to manipulate matrices to gain useful knowledge from data, quantify learning rates and optimize learning rates in vector spaces, and perform linear transformations to explore data. Lessons and practice exercises will equip students with the mathematical foundation needed to build and train simple neural networks in data mining applications', 3, 'LEC09', '2025-04-01 21:10:02', '2025-04-01 21:10:02'),
('IT156IU', 'Development & Operation', 'This course is an introduction to DevOps to help students understand its principles and practices. Key concepts and terminology will be covered with case studies, examples, and real-world practical exercises. Popular and common tools to achieve the DevOps model will also be introduced.', 4, 'LEC012', '2025-04-01 23:45:32', '2025-04-01 23:45:32'),
('IT157IU', 'Deep Learning', 'This course helps students understand the possibilities, challenges, and consequences of deep learning and prepares students to participate in the development of leading AI technology. In this course, students will build and train neural network architectures such as Convolutional Neural Networks, Recurrent Neural Networks, Transformers and learn how to make them better with strategies like Dropout, BatchNorm, etc. Students are prepared to master theoretical concepts and industrial applications using Python and PyTorch and solve real-world cases.', 4, 'LEC06', '2025-04-01 22:56:23', '2025-04-01 22:56:23'),
('IT159IU', 'Artificial intelligence', 'The course aims to provide a technical approach to the fundamental concepts in the field of artificial intelligence. Specific topics include: history of artificial intelligence, agents, search methods (state space search, informed and uninformed search, constraint satisfaction search or game search), knowledge representation (logical representation of concrete knowledge, logical reasoning systems), planning, and the Lisp language. This course is suitable for students who want to have a solid foundation in artificial intelligence or prepare for further developments in the field of artificial intelligence.', 4, 'LEC03', '2025-04-01 21:37:12', '2025-04-01 21:37:12'),
('IT160IU', 'Data Mining', 'This course introduces students to the principles, algorithms, and requirements of data mining. Students will study data mining concepts and algorithms to solve knowledge discovery problems. Students will develop skills in using current data mining software to solve real-world problems and gain experience in conducting independent research and learning.', 4, 'LEC011', '2025-04-01 22:22:35', '2025-04-01 22:22:35'),
('IT163IU', 'Optimization and Applications', 'This course is an introduction to the basic methods used in research identification activities and the use of numerical analysis and linear algebra to solve industrial engineering problems. Topics to be covered include: problem formulation, simplex methods in tables of models, dualism theory, introduction to the geometry of simplex methods, sensitivity analysis, transport and network traffic.', 3, 'LEC07', '2025-04-01 23:56:23', '2025-04-01 23:56:23'),
('IT164IU', 'Cloud Computing', 'This course focuses on parallel programming techniques for cloud computing and the large-scale distributed systems that make up cloud infrastructure. Topics include an overview of cloud computing, cloud systems, parallel processing in the cloud, distributed storage systems, virtualization, security in the cloud, and multicore operating systems. Students will study state-of-the-art cloud computing solutions developed by Google, Amazon, Microsoft, Yahoo, VMWare, and others. Students will also apply what they learn to a programming assignment and project conducted on Amazon Web Services.', 4, 'LEC07', '2025-04-01 23:34:14', '2025-04-01 23:34:14'),
('IT165IU', 'Security Technology and Implementation', 'The course introduces students to the principles of information security, cryptographic systems (symmetric and public key cryptography), risk management, security in architecture and design, security in business continuity, access control, TCP/IP network protection, firewalls, virtual networks, IPSec, security in software development.', 4, 'LEC08', '2025-04-01 23:35:30', '2025-04-01 23:35:30'),
('IT166IU', 'Software Quality Verification and Validation', 'Introduction to software verification, validation, and testing. Strategies and techniques are presented for software testing as well as software test planning.', 4, 'LEC09', '2025-04-01 23:37:17', '2025-04-01 23:37:17'),
('IT167IU', 'Game Application Development', 'This course is an introduction to the theory and practice of game design and play experiences. Students are introduced to the methods, concepts, techniques, and materials used in game design. The strategy is process-oriented, focusing on aspects such as: Rapid prototyping, game testing, and design iteration using a player-centered approach.', 4, 'LEC010', '2025-04-01 23:39:49', '2025-04-01 23:39:49'),
('IT170IU', 'Natural Language Processing', 'The course provides students with fundamental knowledge of natural language processing methods. At the same time, new approaches in the direction of machine learning and deep learning for natural language processing are also introduced.', 4, 'LEC08', '2025-04-01 23:57:44', '2025-04-01 23:57:44'),
('IT171IU', 'Statistical Learning', 'his is an advanced undergraduate course that introduces Bayesian statistical inference methods for analyzing data in a variety of applications, especially in Data Science. The course provides an introduction to Bayesian inference theory, and data analysis using statistical software (primarily Python) will also be emphasized.', 4, 'LEC08', '2025-04-01 22:09:56', '2025-04-01 22:13:24'),
('IT173IU', 'Big Data Analytics', 'This course provides an overview of the technologies used in Big Data solutions. It covers the development of Big Data solutions using the Hadoop system, including MapReduce, HDFS, Apache Pig and Hive programming frameworks. This course helps students build a foundation for working with Apache Big Data solutions.', 4, 'LEC09', '2025-04-01 23:05:32', '2025-04-01 23:05:32'),
('IT174IU', 'Internship for Engineers', 'The subject aims to create conditions for students to have the opportunity to contact with the real environment, in order to solve practical problems in production and daily life. The main content includes: building and managing information systems using web or applications; computerizing office work, daily work; designing, installing and operating computer networks for businesses and organizations. Learning and applying new technologies.', 7, NULL, '2025-04-01 22:48:27', '2025-04-01 22:48:27');

-- --------------------------------------------------------

--
-- Table structure for table `course_major`
--

CREATE TABLE `course_major` (
  `id` bigint UNSIGNED NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `major_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_elective` tinyint(1) NOT NULL,
  `recommended_semester` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_major`
--

INSERT INTO `course_major` (`id`, `course_id`, `major_id`, `is_elective`, `recommended_semester`, `created_at`, `updated_at`) VALUES
(32, 'IT064IU', 'CE01', 0, '1', '2025-04-01 20:21:26', '2025-04-01 20:21:26'),
(33, 'IT064IU', 'CS01', 0, '1', '2025-04-01 20:21:26', '2025-04-01 20:21:26'),
(34, 'IT116IU', 'CE01', 0, '1', '2025-04-01 20:29:15', '2025-04-01 20:29:15'),
(35, 'IT116IU', 'CS01', 0, '1', '2025-04-01 20:29:15', '2025-04-01 20:29:15'),
(36, 'IT149IU', 'DS01', 0, '1', '2025-04-01 20:30:27', '2025-04-01 20:30:27'),
(37, 'IT135IU', 'DS01', 0, '1', '2025-04-01 20:31:38', '2025-04-01 20:31:38'),
(38, 'IT069IU', 'CE01', 0, '2', '2025-04-01 20:35:45', '2025-04-01 20:35:45'),
(39, 'IT069IU', 'CS01', 0, '2', '2025-04-01 20:35:45', '2025-04-01 20:35:45'),
(40, 'IT069IU', 'DS01', 0, '2', '2025-04-01 20:35:45', '2025-04-01 20:35:45'),
(41, 'IT153IU', 'CE01', 0, '2', '2025-04-01 20:43:53', '2025-04-01 20:43:53'),
(42, 'IT153IU', 'CS01', 0, '2', '2025-04-01 20:43:53', '2025-04-01 20:43:53'),
(43, 'IT153IU', 'DS01', 1, NULL, '2025-04-01 20:43:53', '2025-04-01 20:43:53'),
(44, 'IT091IU', 'CE01', 0, '2', '2025-04-01 20:49:12', '2025-04-01 20:49:12'),
(45, 'IT091IU', 'CS01', 0, '2', '2025-04-01 20:49:12', '2025-04-01 20:49:12'),
(46, 'IT067IU', 'CE01', 0, '2', '2025-04-01 20:55:03', '2025-04-01 20:55:03'),
(47, 'IT154IU', 'CE01', 0, '3', '2025-04-01 21:10:02', '2025-04-01 21:10:02'),
(48, 'IT154IU', 'CS01', 0, '3', '2025-04-01 21:10:02', '2025-04-01 21:10:02'),
(49, 'IT154IU', 'DS01', 0, '2', '2025-04-01 21:10:02', '2025-04-01 21:10:02'),
(50, 'IT151IU', 'DS01', 0, '3', '2025-04-01 21:15:24', '2025-04-01 21:15:24'),
(51, 'IT140IU', 'CE01', 1, NULL, '2025-04-01 21:20:53', '2025-04-01 21:20:53'),
(52, 'IT140IU', 'DS01', 0, '3', '2025-04-01 21:20:53', '2025-04-01 21:20:53'),
(53, 'IT013IU', 'CE01', 0, '3', '2025-04-01 21:26:48', '2025-04-01 21:26:48'),
(54, 'IT013IU', 'CS01', 0, '3', '2025-04-01 21:26:48', '2025-04-01 21:26:48'),
(55, 'IT013IU', 'DS01', 0, '3', '2025-04-01 21:26:48', '2025-04-01 21:26:48'),
(56, 'IT068IU', 'CE01', 0, '3', '2025-04-01 21:30:47', '2025-04-01 21:30:47'),
(57, 'IT079IU', 'CE01', 0, '5', '2025-04-01 21:34:01', '2025-04-01 21:34:01'),
(58, 'IT079IU', 'CS01', 0, '3', '2025-04-01 21:34:01', '2025-04-01 21:34:01'),
(59, 'IT079IU', 'DS01', 0, '3', '2025-04-01 21:34:01', '2025-04-01 21:34:01'),
(60, 'IT159IU', 'CE01', 0, '7', '2025-04-01 21:37:12', '2025-04-01 21:37:12'),
(61, 'IT159IU', 'CS01', 0, '6', '2025-04-01 21:37:12', '2025-04-01 21:37:12'),
(62, 'IT159IU', 'DS01', 0, '4', '2025-04-01 21:37:12', '2025-04-01 21:37:12'),
(63, 'IT093IU', 'CE01', 1, NULL, '2025-04-01 21:45:30', '2025-04-01 21:45:30'),
(64, 'IT093IU', 'CS01', 0, '4', '2025-04-01 21:45:30', '2025-04-01 21:45:30'),
(65, 'IT093IU', 'DS01', 1, NULL, '2025-04-01 21:45:30', '2025-04-01 21:45:30'),
(66, 'IT089IU', 'CE01', 0, '4', '2025-04-01 22:02:48', '2025-04-01 22:02:48'),
(67, 'IT089IU', 'CS01', 0, '4', '2025-04-01 22:02:48', '2025-04-01 22:02:48'),
(68, 'IT074IU', 'CE01', 0, '4', '2025-04-01 22:04:20', '2025-04-01 22:04:20'),
(69, 'IT090IU', 'CE01', 1, NULL, '2025-04-01 22:06:34', '2025-04-01 22:06:34'),
(70, 'IT090IU', 'CS01', 0, '4', '2025-04-01 22:06:34', '2025-04-01 22:06:34'),
(71, 'IT171IU', 'DS01', 0, '4', '2025-04-01 22:09:56', '2025-04-01 22:09:56'),
(72, 'IT136IU', 'DS01', 0, '4', '2025-04-01 22:12:06', '2025-04-01 22:12:06'),
(73, 'IT138IU', 'CE01', 1, NULL, '2025-04-01 22:18:23', '2025-04-01 22:18:23'),
(74, 'IT138IU', 'CS01', 1, NULL, '2025-04-01 22:18:23', '2025-04-01 22:18:23'),
(75, 'IT138IU', 'DS01', 0, '5', '2025-04-01 22:18:23', '2025-04-01 22:18:23'),
(76, 'IT160IU', 'CE01', 1, NULL, '2025-04-01 22:22:35', '2025-04-01 22:22:35'),
(77, 'IT160IU', 'CS01', 1, NULL, '2025-04-01 22:22:35', '2025-04-01 22:22:35'),
(78, 'IT160IU', 'DS01', 0, '5', '2025-04-01 22:22:35', '2025-04-01 22:22:35'),
(79, 'IT092IU', 'CE01', 1, NULL, '2025-04-01 22:26:48', '2025-04-01 22:26:48'),
(80, 'IT092IU', 'CS01', 0, '5', '2025-04-01 22:26:48', '2025-04-01 22:26:48'),
(81, 'IT017IU', 'CE01', 0, '5', '2025-04-01 22:31:11', '2025-04-01 22:31:11'),
(82, 'IT017IU', 'CS01', 0, '7', '2025-04-01 22:31:11', '2025-04-01 22:31:11'),
(83, 'IT128IU', 'CE01', 0, '5', '2025-04-01 22:34:18', '2025-04-01 22:34:18'),
(84, 'IT139IU', 'CE01', 1, NULL, '2025-04-01 22:36:11', '2025-04-01 22:36:11'),
(85, 'IT139IU', 'DS01', 0, '5', '2025-04-01 22:36:11', '2025-04-01 22:36:11'),
(86, 'IT137IU', 'DS01', 0, '5', '2025-04-01 22:38:30', '2025-04-01 22:38:30'),
(87, 'IT082IU', 'CS01', 0, '6', '2025-04-01 22:45:24', '2025-04-01 22:45:24'),
(88, 'IT082IU', 'DS01', 0, '8', '2025-04-01 22:45:24', '2025-04-01 22:45:24'),
(89, 'IT174IU', 'CE01', 0, '6', '2025-04-01 22:48:27', '2025-04-01 22:48:27'),
(90, 'IT076IU', 'CE01', 1, NULL, '2025-04-01 22:51:59', '2025-04-01 22:51:59'),
(91, 'IT076IU', 'CS01', 0, '6', '2025-04-01 22:51:59', '2025-04-01 22:51:59'),
(92, 'IT076IU', 'DS01', 1, NULL, '2025-04-01 22:51:59', '2025-04-01 22:51:59'),
(93, 'IT120IU', 'CE01', 0, '8', '2025-04-01 22:53:29', '2025-04-01 22:53:29'),
(94, 'IT120IU', 'CS01', 0, '6', '2025-04-01 22:53:29', '2025-04-01 22:53:29'),
(95, 'IT120IU', 'DS01', 1, NULL, '2025-04-01 22:53:29', '2025-04-01 22:53:29'),
(96, 'IT157IU', 'CE01', 1, NULL, '2025-04-01 22:56:23', '2025-04-01 22:56:23'),
(97, 'IT157IU', 'CS01', 1, NULL, '2025-04-01 22:56:23', '2025-04-01 22:56:23'),
(98, 'IT157IU', 'DS01', 0, '6', '2025-04-01 22:56:23', '2025-04-01 22:56:23'),
(99, 'IT105IU', 'CE01', 0, '6', '2025-04-01 22:59:23', '2025-04-01 22:59:23'),
(100, 'IT115IU', 'CE01', 0, '6', '2025-04-01 23:00:13', '2025-04-01 23:00:13'),
(101, 'IT083IU', 'CE01', 0, '8', '2025-04-01 23:02:18', '2025-04-01 23:02:18'),
(102, 'IT083IU', 'CS01', 0, '7', '2025-04-01 23:02:18', '2025-04-01 23:02:18'),
(103, 'IT083IU', 'DS01', 0, '7', '2025-04-01 23:02:18', '2025-04-01 23:02:18'),
(104, 'IT173IU', 'DS01', 0, '7', '2025-04-01 23:05:32', '2025-04-01 23:05:32'),
(105, 'IT103IU', 'CE01', 0, '7', '2025-04-01 23:08:17', '2025-04-01 23:08:17'),
(106, 'IT110IU', 'CE01', 0, '7', '2025-04-01 23:09:10', '2025-04-01 23:09:10'),
(107, 'IT058IU', 'CE01', 0, '9', '2025-04-01 23:10:48', '2025-04-01 23:10:48'),
(108, 'IT058IU', 'CS01', 0, '8', '2025-04-01 23:10:48', '2025-04-01 23:10:48'),
(109, 'IT058IU', 'DS01', 0, '8', '2025-04-01 23:10:48', '2025-04-01 23:10:48'),
(110, 'IT134IU', 'CE01', 0, '8', '2025-04-01 23:16:33', '2025-04-01 23:16:33'),
(111, 'IT134IU', 'CS01', 1, NULL, '2025-04-01 23:16:33', '2025-04-01 23:16:33'),
(112, 'IT094IU', 'CE01', 1, NULL, '2025-04-01 23:23:34', '2025-04-01 23:23:34'),
(113, 'IT094IU', 'CS01', 1, NULL, '2025-04-01 23:23:34', '2025-04-01 23:23:34'),
(114, 'IT094IU', 'DS01', 1, NULL, '2025-04-01 23:23:34', '2025-04-01 23:23:34'),
(115, 'IT056IU', 'CE01', 1, NULL, '2025-04-01 23:25:37', '2025-04-01 23:25:37'),
(116, 'IT056IU', 'CS01', 1, NULL, '2025-04-01 23:25:37', '2025-04-01 23:25:37'),
(117, 'IT056IU', 'DS01', 1, NULL, '2025-04-01 23:25:37', '2025-04-01 23:25:37'),
(118, 'IT044IU', 'CS01', 1, NULL, '2025-04-01 23:27:08', '2025-04-01 23:27:08'),
(119, 'IT044IU', 'DS01', 1, NULL, '2025-04-01 23:27:08', '2025-04-01 23:27:08'),
(120, 'IT133IU', 'CE01', 1, NULL, '2025-04-01 23:28:36', '2025-04-01 23:28:36'),
(121, 'IT133IU', 'CS01', 1, NULL, '2025-04-01 23:28:36', '2025-04-01 23:28:36'),
(122, 'IT024IU', 'CE01', 1, NULL, '2025-04-01 23:30:28', '2025-04-01 23:30:28'),
(123, 'IT024IU', 'CS01', 1, NULL, '2025-04-01 23:30:28', '2025-04-01 23:30:28'),
(124, 'IT096IU', 'CE01', 1, NULL, '2025-04-01 23:31:45', '2025-04-01 23:31:45'),
(125, 'IT096IU', 'CS01', 1, NULL, '2025-04-01 23:31:45', '2025-04-01 23:31:45'),
(126, 'IT164IU', 'CS01', 1, NULL, '2025-04-01 23:34:14', '2025-04-01 23:34:14'),
(127, 'IT164IU', 'DS01', 1, NULL, '2025-04-01 23:34:14', '2025-04-01 23:34:14'),
(128, 'IT165IU', 'CE01', 1, NULL, '2025-04-01 23:35:30', '2025-04-01 23:35:30'),
(129, 'IT165IU', 'CS01', 1, NULL, '2025-04-01 23:35:30', '2025-04-01 23:35:30'),
(130, 'IT166IU', 'CE01', 1, NULL, '2025-04-01 23:37:17', '2025-04-01 23:37:17'),
(131, 'IT166IU', 'CS01', 1, NULL, '2025-04-01 23:37:17', '2025-04-01 23:37:17'),
(132, 'IT167IU', 'CE01', 1, NULL, '2025-04-01 23:39:49', '2025-04-01 23:39:49'),
(133, 'IT167IU', 'CS01', 1, NULL, '2025-04-01 23:39:49', '2025-04-01 23:39:49'),
(134, 'IT150IU', 'CE01', 1, NULL, '2025-04-01 23:42:53', '2025-04-01 23:42:53'),
(135, 'IT150IU', 'CS01', 1, NULL, '2025-04-01 23:42:53', '2025-04-01 23:42:53'),
(136, 'IT150IU', 'DS01', 1, NULL, '2025-04-01 23:42:53', '2025-04-01 23:42:53'),
(137, 'IT156IU', 'CE01', 1, NULL, '2025-04-01 23:45:32', '2025-04-01 23:45:32'),
(138, 'IT156IU', 'CS01', 1, NULL, '2025-04-01 23:45:32', '2025-04-01 23:45:32'),
(139, 'IT114IU', 'CE01', 1, NULL, '2025-04-01 23:49:42', '2025-04-01 23:49:42'),
(140, 'IT114IU', 'CS01', 1, NULL, '2025-04-01 23:49:42', '2025-04-01 23:49:42'),
(141, 'IT144IU', 'CE01', 1, NULL, '2025-04-01 23:50:34', '2025-04-01 23:50:34'),
(142, 'IT144IU', 'DS01', 1, NULL, '2025-04-01 23:50:34', '2025-04-01 23:50:34'),
(143, 'IT145IU', 'CE01', 1, NULL, '2025-04-01 23:51:41', '2025-04-01 23:51:41'),
(144, 'IT145IU', 'DS01', 1, NULL, '2025-04-01 23:51:41', '2025-04-01 23:51:41'),
(145, 'IT130IU', 'CS01', 1, NULL, '2025-04-01 23:53:46', '2025-04-01 23:53:46'),
(146, 'IT146IU', 'DS01', 1, NULL, '2025-04-01 23:55:36', '2025-04-01 23:55:36'),
(147, 'IT163IU', 'DS01', 1, NULL, '2025-04-01 23:56:23', '2025-04-01 23:56:23'),
(148, 'IT170IU', 'DS01', 1, NULL, '2025-04-01 23:57:44', '2025-04-01 23:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `curriculum`
--

CREATE TABLE `curriculum` (
  `id` bigint UNSIGNED NOT NULL,
  `curriculum_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `major_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` int NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_mandatory` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `lecturer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lecturer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`lecturer_id`, `lecturer_name`, `password`, `created_at`, `updated_at`) VALUES
('LEC01', 'Nguyen Van Sinh', '$2y$12$HE6h2NCOHxvcZkyDOBakqu47tYLge7rY9BD7SkvxGn7wS.3W95Eqq', '2025-03-28 04:16:43', '2025-04-07 03:06:14'),
('LEC010', 'Le Hai Duong', '$2y$12$ubeJ0Aklwi5A4gi1T8ERvu268/S.6.lSmEqkZ89mokwvrhJaowiu6', '2025-04-01 19:38:39', '2025-04-01 19:38:39'),
('LEC011', 'Nguyen Trung Ky', '$2y$12$8pl1.3bd2NJT6FaRKFV5W./xwkSzn42ZiHjBhU/sbMU6GYIh57OfK', '2025-04-01 19:38:48', '2025-04-01 19:38:48'),
('LEC012', 'Vi Chi Thanh', '$2y$12$T1qKSjR4yOrJCTVpr2VWwu7hS55M/b/JfDjx4Xdpk2pLVZ205Hh9m', '2025-04-01 19:38:58', '2025-04-01 19:38:58'),
('LEC02', 'Tran Thanh Tung', '$2y$12$.BMeVIeG/RbWdSWyyA3xSe2bMFefAEr6VKbqimaekgYL9aY6qgmo6', '2025-04-01 19:35:56', '2025-04-01 20:13:15'),
('LEC03', 'Dinh Duc Anh Vu', '$2y$12$G3kjwDSnKdnjfPfnqw3gneAjATcYllH00WxKfmP0tFWLWhShb8/6O', '2025-04-01 19:37:03', '2025-04-01 19:37:03'),
('LEC04', 'Huynh Kha Tu', '$2y$12$5P0QQUKOzzu0YsoxZvsouuhHujjGaEfPIpdTo./WycdePIMucR.6G', '2025-04-01 19:37:15', '2025-04-01 19:37:15'),
('LEC05', 'Nguyen Thi Thuy Loan', '$2y$12$nOwf1rQ1F.NpJC9d0hYrKO3yunQOsOTJyZiV7QydGq.SSdm11x.P6', '2025-04-01 19:37:27', '2025-04-01 19:37:27'),
('LEC06', 'Vo Thi Luu Phuong', '$2y$12$z7ICcVbCad8s0Ct8ZQc/7O8CWRrgIyRfXWWEcYjAgS0eWcXZ.bJYq', '2025-04-01 19:37:38', '2025-04-01 19:37:38'),
('LEC07', 'Ha Viet Uyen Synh', '$2y$12$EShev/YSdsvRUNnU9KK52.wFS.chgRgRF3bf6LZjQXS9Pw0Z.YZ9e', '2025-04-01 19:37:49', '2025-04-01 19:37:49'),
('LEC08', 'Ho Long Van', '$2y$12$X7JaRg7JZ.QAgfXVb2YYxOua5CGwQhuRJlaj30QbgmScIBa8eC3ga', '2025-04-01 19:38:02', '2025-04-01 19:38:02'),
('LEC09', 'Le Duy Tan', '$2y$12$ZOiSmIqmCa9cQalCT3fTqOgVxrh5edCE8n/fKrVLq223Hi3M4J7qu', '2025-04-01 19:38:30', '2025-04-01 19:38:30');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_courses`
--

CREATE TABLE `lecturer_courses` (
  `id` bigint UNSIGNED NOT NULL,
  `lecturer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `major_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `major_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`major_id`, `major_name`, `created_at`, `updated_at`) VALUES
('CE01', 'Computer Engineering', NULL, NULL),
('CS01', 'Computer Science', NULL, NULL),
('DS01', 'Data Science', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_03_20_091127_create_majors_table', 1),
(2, '2025_03_20_091218_create_students_table', 1),
(3, '2025_03_20_091400_create_lecturers_table', 1),
(4, '2025_03_20_091411_create_courses_table', 1),
(5, '2025_03_20_091605_create_admins_table', 1),
(6, '2025_03_20_091634_create_course_major_table', 1),
(7, '2025_03_20_091735_create_prerequisites_table', 1),
(8, '2025_03_20_091756_create_curriculum_table', 1),
(9, '2025_03_20_091903_create_student_courses_table', 1),
(10, '2025_03_20_091924_create_schedules_table', 1),
(11, '2025_03_20_091941_create_student_schedules_table', 1),
(12, '2025_03_20_092001_create_lecturer_courses_table', 1),
(13, '2025_03_24_072829_create_semesters_table', 1),
(14, '2025_03_24_142658_create_sessions_table', 2),
(15, '2025_03_26_085556_remove_semester_order_from_curriculum_table', 3),
(16, '2025_03_26_094538_add_credits_to_courses_table', 4),
(17, '2025_03_26_104410_add_recommended_semester_to_course_major_table', 5),
(18, '2025_03_26_104830_add_semester_to_student_courses_table', 5),
(19, '2025_03_27_052943_drop_student_schedule_table', 6),
(20, '2025_03_27_053207_update_schedules_table', 6),
(21, '2025_03_27_053358_drop_student_schedules_table', 7),
(22, '2025_03_27_073923_create_semester_courses_table', 8),
(23, '2025_03_28_095816_create_student_registrations_table', 9),
(24, '2025_03_29_104549_update_start_and_end_time_nullable_in_schedules_table', 10),
(25, '2025_03_30_092036_create_student_preferences_table', 11),
(26, '2025_04_03_085820_create_academic_staff_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `prerequisites`
--

CREATE TABLE `prerequisites` (
  `id` bigint UNSIGNED NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prerequisite_course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `major_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prerequisite_type` enum('Required','Optional','Previous') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prerequisites`
--

INSERT INTO `prerequisites` (`id`, `course_id`, `prerequisite_course_id`, `major_id`, `prerequisite_type`, `created_at`, `updated_at`) VALUES
(14, 'IT069IU', 'IT149IU', 'DS01', 'Required', '2025-04-01 20:39:04', '2025-04-01 20:39:04'),
(15, 'IT069IU', 'IT116IU', 'CE01', 'Previous', '2025-04-01 20:39:04', '2025-04-01 20:39:04'),
(16, 'IT069IU', 'IT116IU', 'CS01', 'Required', '2025-04-01 20:39:04', '2025-04-01 20:39:04'),
(17, 'IT153IU', 'IT116IU', 'CE01', 'Required', '2025-04-01 20:46:09', '2025-04-01 20:46:09'),
(18, 'IT153IU', 'IT116IU', 'CS01', 'Previous', '2025-04-01 20:46:09', '2025-04-01 20:46:09'),
(19, 'IT153IU', 'IT149IU', 'DS01', 'Previous', '2025-04-01 20:46:09', '2025-04-01 20:46:09'),
(25, 'IT091IU', 'IT116IU', 'CE01', 'Previous', '2025-04-01 20:51:59', '2025-04-01 20:51:59'),
(26, 'IT091IU', 'IT116IU', 'CS01', 'Previous', '2025-04-01 20:51:59', '2025-04-01 20:51:59'),
(27, 'IT091IU', 'IT069IU', 'CE01', 'Previous', '2025-04-01 20:51:59', '2025-04-01 20:51:59'),
(28, 'IT091IU', 'IT069IU', 'CS01', 'Previous', '2025-04-01 20:51:59', '2025-04-01 20:51:59'),
(30, 'IT154IU', 'IT149IU', 'DS01', 'Previous', '2025-04-01 21:11:26', '2025-04-01 21:11:26'),
(31, 'IT154IU', 'IT116IU', 'CE01', 'Previous', '2025-04-01 21:11:26', '2025-04-01 21:11:26'),
(32, 'IT154IU', 'IT116IU', 'CS01', 'Previous', '2025-04-01 21:11:26', '2025-04-01 21:11:26'),
(33, 'IT151IU', 'IT149IU', 'DS01', 'Required', '2025-04-01 21:15:24', '2025-04-01 21:15:24'),
(38, 'IT079IU', 'IT149IU', 'DS01', 'Previous', '2025-04-01 21:34:41', '2025-04-01 21:34:41'),
(39, 'IT079IU', 'IT116IU', 'CE01', 'Previous', '2025-04-01 21:34:41', '2025-04-01 21:34:41'),
(40, 'IT079IU', 'IT116IU', 'CS01', 'Previous', '2025-04-01 21:34:41', '2025-04-01 21:34:41'),
(42, 'IT159IU', 'IT069IU', 'CE01', 'Previous', '2025-04-01 21:39:44', '2025-04-01 21:39:44'),
(43, 'IT159IU', 'IT069IU', 'CS01', 'Previous', '2025-04-01 21:39:44', '2025-04-01 21:39:44'),
(44, 'IT159IU', 'IT069IU', 'DS01', 'Previous', '2025-04-01 21:39:44', '2025-04-01 21:39:44'),
(49, 'IT093IU', 'IT069IU', 'CS01', 'Previous', '2025-04-01 21:51:14', '2025-04-01 21:51:14'),
(50, 'IT093IU', 'IT079IU', 'CS01', 'Required', '2025-04-01 21:51:14', '2025-04-01 21:51:14'),
(51, 'IT093IU', 'IT069IU', 'CE01', 'Previous', '2025-04-01 21:51:14', '2025-04-01 21:51:14'),
(52, 'IT093IU', 'IT079IU', 'CE01', 'Required', '2025-04-01 21:51:14', '2025-04-01 21:51:14'),
(53, 'IT093IU', 'IT069IU', 'DS01', 'Previous', '2025-04-01 21:51:14', '2025-04-01 21:51:14'),
(54, 'IT093IU', 'IT079IU', 'DS01', 'Required', '2025-04-01 21:51:14', '2025-04-01 21:51:14'),
(55, 'IT089IU', 'IT067IU', 'CE01', 'Previous', '2025-04-01 22:02:48', '2025-04-01 22:02:48'),
(56, 'IT074IU', 'IT068IU', 'CE01', 'Required', '2025-04-01 22:04:20', '2025-04-01 22:04:20'),
(58, 'IT090IU', 'IT069IU', 'CS01', 'Required', '2025-04-01 22:07:04', '2025-04-01 22:07:04'),
(59, 'IT090IU', 'IT069IU', 'CE01', 'Required', '2025-04-01 22:07:04', '2025-04-01 22:07:04'),
(61, 'IT171IU', 'IT151IU', 'DS01', 'Previous', '2025-04-01 22:13:24', '2025-04-01 22:13:24'),
(63, 'IT160IU', 'IT069IU', 'DS01', 'Previous', '2025-04-01 22:23:25', '2025-04-01 22:23:25'),
(64, 'IT160IU', 'IT069IU', 'CE01', 'Previous', '2025-04-01 22:23:25', '2025-04-01 22:23:25'),
(65, 'IT160IU', 'IT069IU', 'CS01', 'Previous', '2025-04-01 22:23:25', '2025-04-01 22:23:25'),
(67, 'IT017IU', 'IT013IU', 'CE01', 'Previous', '2025-04-01 22:31:43', '2025-04-01 22:31:43'),
(68, 'IT017IU', 'IT013IU', 'CS01', 'Previous', '2025-04-01 22:31:43', '2025-04-01 22:31:43'),
(69, 'IT128IU', 'IT067IU', 'CE01', 'Previous', '2025-04-01 22:34:18', '2025-04-01 22:34:18'),
(70, 'IT137IU', 'IT151IU', 'DS01', 'Previous', '2025-04-01 22:38:30', '2025-04-01 22:38:30'),
(72, 'IT076IU', 'IT069IU', 'CS01', 'Previous', '2025-04-01 22:52:36', '2025-04-01 22:52:36'),
(73, 'IT076IU', 'IT069IU', 'CE01', 'Previous', '2025-04-01 22:52:36', '2025-04-01 22:52:36'),
(74, 'IT076IU', 'IT069IU', 'DS01', 'Previous', '2025-04-01 22:52:36', '2025-04-01 22:52:36'),
(76, 'IT157IU', 'IT013IU', 'DS01', 'Previous', '2025-04-01 22:57:06', '2025-04-01 22:57:06'),
(77, 'IT157IU', 'IT013IU', 'CE01', 'Previous', '2025-04-01 22:57:06', '2025-04-01 22:57:06'),
(78, 'IT157IU', 'IT013IU', 'CS01', 'Previous', '2025-04-01 22:57:06', '2025-04-01 22:57:06'),
(80, 'IT115IU', 'IT067IU', 'CE01', 'Required', '2025-04-01 23:00:13', '2025-04-01 23:00:13'),
(81, 'IT173IU', 'IT137IU', 'DS01', 'Previous', '2025-04-01 23:05:32', '2025-04-01 23:05:32'),
(82, 'IT110IU', 'IT067IU', 'CE01', 'Previous', '2025-04-01 23:09:10', '2025-04-01 23:09:10'),
(84, 'IT058IU', 'IT083IU', 'CE01', 'Required', '2025-04-01 23:11:30', '2025-04-01 23:11:30'),
(85, 'IT058IU', 'IT083IU', 'CS01', 'Required', '2025-04-01 23:11:30', '2025-04-01 23:11:30'),
(86, 'IT058IU', 'IT083IU', 'DS01', 'Required', '2025-04-01 23:11:30', '2025-04-01 23:11:30'),
(88, 'IT134IU', 'IT091IU', 'CE01', 'Previous', '2025-04-01 23:17:25', '2025-04-01 23:17:25'),
(89, 'IT134IU', 'IT091IU', 'CS01', 'Previous', '2025-04-01 23:17:25', '2025-04-01 23:17:25'),
(90, 'IT105IU', 'IT067IU', 'CE01', 'Previous', '2025-04-01 23:19:58', '2025-04-01 23:19:58'),
(92, 'IT094IU', 'IT079IU', 'CE01', 'Previous', '2025-04-01 23:24:16', '2025-04-01 23:24:16'),
(93, 'IT094IU', 'IT079IU', 'CS01', 'Previous', '2025-04-01 23:24:16', '2025-04-01 23:24:16'),
(94, 'IT094IU', 'IT079IU', 'DS01', 'Previous', '2025-04-01 23:24:16', '2025-04-01 23:24:16'),
(96, 'IT056IU', 'IT069IU', 'CE01', 'Previous', '2025-04-01 23:26:09', '2025-04-01 23:26:09'),
(97, 'IT056IU', 'IT069IU', 'CS01', 'Previous', '2025-04-01 23:26:09', '2025-04-01 23:26:09'),
(98, 'IT056IU', 'IT069IU', 'DS01', 'Previous', '2025-04-01 23:26:09', '2025-04-01 23:26:09'),
(99, 'IT133IU', 'IT069IU', 'CE01', 'Previous', '2025-04-01 23:29:05', '2025-04-01 23:29:05'),
(100, 'IT133IU', 'IT069IU', 'CS01', 'Previous', '2025-04-01 23:29:05', '2025-04-01 23:29:05'),
(102, 'IT024IU', 'IT069IU', 'CE01', 'Previous', '2025-04-01 23:30:43', '2025-04-01 23:30:43'),
(103, 'IT024IU', 'IT069IU', 'CS01', 'Previous', '2025-04-01 23:30:43', '2025-04-01 23:30:43'),
(105, 'IT096IU', 'IT091IU', 'CE01', 'Previous', '2025-04-01 23:32:08', '2025-04-01 23:32:08'),
(106, 'IT096IU', 'IT091IU', 'CS01', 'Previous', '2025-04-01 23:32:08', '2025-04-01 23:32:08'),
(108, 'IT165IU', 'IT091IU', 'CE01', 'Previous', '2025-04-01 23:35:45', '2025-04-01 23:35:45'),
(109, 'IT165IU', 'IT091IU', 'CS01', 'Previous', '2025-04-01 23:35:45', '2025-04-01 23:35:45'),
(111, 'IT166IU', 'IT069IU', 'CE01', 'Previous', '2025-04-01 23:37:36', '2025-04-01 23:37:36'),
(112, 'IT166IU', 'IT069IU', 'CS01', 'Previous', '2025-04-01 23:37:36', '2025-04-01 23:37:36'),
(114, 'IT167IU', 'IT069IU', 'CE01', 'Previous', '2025-04-01 23:40:17', '2025-04-01 23:40:17'),
(115, 'IT167IU', 'IT069IU', 'CS01', 'Previous', '2025-04-01 23:40:17', '2025-04-01 23:40:17'),
(117, 'IT145IU', 'IT069IU', 'CE01', 'Previous', '2025-04-01 23:51:57', '2025-04-01 23:51:57'),
(118, 'IT145IU', 'IT069IU', 'DS01', 'Previous', '2025-04-01 23:51:57', '2025-04-01 23:51:57'),
(119, 'IT170IU', 'IT013IU', 'DS01', 'Previous', '2025-04-01 23:57:44', '2025-04-01 23:57:44'),
(120, 'IT013IU', 'IT069IU', 'CE01', 'Previous', '2025-04-02 22:50:06', '2025-04-02 22:50:06'),
(121, 'IT013IU', 'IT069IU', 'CS01', 'Previous', '2025-04-02 22:50:06', '2025-04-02 22:50:06'),
(122, 'IT013IU', 'IT069IU', 'DS01', 'Previous', '2025-04-02 22:50:06', '2025-04-02 22:50:06');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint UNSIGNED NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_of_week` tinyint NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `course_id`, `day_of_week`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(12, 'IT064IU', 1, '08:00:00', '10:00:00', '2025-04-01 20:21:26', '2025-04-01 20:21:43'),
(13, 'IT116IU', 2, '08:00:00', '10:00:00', '2025-04-01 20:29:15', '2025-04-01 20:29:15'),
(14, 'IT149IU', 1, '08:00:00', '10:00:00', '2025-04-01 20:30:27', '2025-04-01 20:30:27'),
(15, 'IT135IU', 2, '08:00:00', '10:00:00', '2025-04-01 20:31:38', '2025-04-01 20:31:38'),
(16, 'IT069IU', 1, '08:00:00', '10:00:00', '2025-04-01 20:35:45', '2025-04-01 20:39:04'),
(17, 'IT153IU', 6, '08:00:00', '10:00:00', '2025-04-01 20:43:53', '2025-04-01 20:46:09'),
(18, 'IT091IU', 2, '08:00:00', '10:00:00', '2025-04-01 20:49:12', '2025-04-01 20:51:59'),
(19, 'IT067IU', 3, '08:00:00', '10:00:00', '2025-04-01 20:55:03', '2025-04-01 20:55:03'),
(20, 'IT154IU', 4, '08:00:00', '10:00:00', '2025-04-01 21:10:02', '2025-04-01 21:11:26'),
(21, 'IT151IU', 3, '08:00:00', '10:00:00', '2025-04-01 21:15:24', '2025-04-01 21:15:24'),
(22, 'IT140IU', 6, '08:00:00', '10:00:00', '2025-04-01 21:20:53', '2025-04-01 21:21:33'),
(23, 'IT013IU', 4, '08:00:00', '10:00:00', '2025-04-01 21:26:48', '2025-04-02 22:50:06'),
(24, 'IT068IU', 3, '08:00:00', '10:00:00', '2025-04-01 21:30:47', '2025-04-01 21:30:47'),
(25, 'IT079IU', 5, '08:00:00', '10:00:00', '2025-04-01 21:34:01', '2025-04-01 21:34:41'),
(26, 'IT159IU', 5, '08:00:00', '10:00:00', '2025-04-01 21:37:12', '2025-04-01 21:39:44'),
(27, 'IT093IU', 6, '10:00:00', '12:00:00', '2025-04-01 21:45:30', '2025-04-01 21:51:14'),
(28, 'IT089IU', 1, '10:00:00', '12:00:00', '2025-04-01 22:02:48', '2025-04-01 22:02:48'),
(29, 'IT074IU', 2, '10:00:00', '12:00:00', '2025-04-01 22:04:20', '2025-04-01 22:04:20'),
(30, 'IT090IU', 3, '10:00:00', '12:00:00', '2025-04-01 22:06:34', '2025-04-01 22:07:04'),
(31, 'IT171IU', 1, '10:00:00', '12:00:00', '2025-04-01 22:09:56', '2025-04-01 22:13:24'),
(32, 'IT136IU', 2, '10:00:00', '12:00:00', '2025-04-01 22:12:06', '2025-04-01 22:12:06'),
(33, 'IT138IU', 4, '10:00:00', '12:00:00', '2025-04-01 22:18:23', '2025-04-01 22:18:42'),
(34, 'IT160IU', 5, '10:00:00', '12:00:00', '2025-04-01 22:22:35', '2025-04-01 22:23:25'),
(35, 'IT092IU', 1, '12:00:00', '14:00:00', '2025-04-01 22:26:48', '2025-04-01 22:27:15'),
(36, 'IT017IU', 2, '12:00:00', '14:00:00', '2025-04-01 22:31:11', '2025-04-01 22:31:43'),
(37, 'IT128IU', 3, '12:00:00', '14:00:00', '2025-04-01 22:34:18', '2025-04-01 22:34:18'),
(38, 'IT139IU', 4, '12:00:00', '14:00:00', '2025-04-01 22:36:11', '2025-04-01 22:36:40'),
(39, 'IT137IU', 1, '12:00:00', '14:00:00', '2025-04-01 22:38:30', '2025-04-01 22:38:30'),
(40, 'IT082IU', 7, NULL, NULL, '2025-04-01 22:45:24', '2025-04-01 22:45:41'),
(41, 'IT174IU', 7, NULL, NULL, '2025-04-01 22:48:27', '2025-04-01 22:48:27'),
(42, 'IT076IU', 6, '12:00:00', '14:00:00', '2025-04-01 22:51:59', '2025-04-01 22:52:36'),
(43, 'IT120IU', 5, '12:00:00', '14:00:00', '2025-04-01 22:53:29', '2025-04-01 22:53:49'),
(44, 'IT157IU', 4, '12:00:00', '14:00:00', '2025-04-01 22:56:23', '2025-04-01 22:57:06'),
(45, 'IT105IU', 1, '12:00:00', '14:00:00', '2025-04-01 22:59:23', '2025-04-01 23:19:58'),
(46, 'IT115IU', 2, '12:00:00', '14:00:00', '2025-04-01 23:00:13', '2025-04-01 23:00:13'),
(47, 'IT083IU', 7, NULL, NULL, '2025-04-01 23:02:18', '2025-04-01 23:02:42'),
(48, 'IT173IU', 1, '12:00:00', '14:00:00', '2025-04-01 23:05:32', '2025-04-01 23:05:32'),
(49, 'IT103IU', 5, '12:00:00', '14:00:00', '2025-04-01 23:08:17', '2025-04-02 00:00:17'),
(50, 'IT110IU', 6, '12:00:00', '14:00:00', '2025-04-01 23:09:10', '2025-04-01 23:09:10'),
(51, 'IT058IU', 7, NULL, NULL, '2025-04-01 23:10:48', '2025-04-01 23:11:30'),
(52, 'IT134IU', 3, '12:00:00', '14:00:00', '2025-04-01 23:16:33', '2025-04-01 23:17:25'),
(53, 'IT094IU', 1, '14:00:00', '16:00:00', '2025-04-01 23:23:34', '2025-04-01 23:24:16'),
(54, 'IT056IU', 1, '16:00:00', '18:00:00', '2025-04-01 23:25:37', '2025-04-01 23:26:09'),
(55, 'IT044IU', 2, '14:00:00', '16:00:00', '2025-04-01 23:27:08', '2025-04-01 23:27:08'),
(56, 'IT133IU', 2, '16:00:00', '18:00:00', '2025-04-01 23:28:36', '2025-04-01 23:29:05'),
(57, 'IT024IU', 3, '14:00:00', '16:00:00', '2025-04-01 23:30:28', '2025-04-01 23:30:43'),
(58, 'IT096IU', 3, '16:00:00', '18:00:00', '2025-04-01 23:31:45', '2025-04-01 23:32:08'),
(59, 'IT164IU', 6, '12:00:00', '14:00:00', '2025-04-01 23:34:14', '2025-04-01 23:34:14'),
(60, 'IT165IU', 4, '14:00:00', '16:00:00', '2025-04-01 23:35:30', '2025-04-01 23:35:45'),
(61, 'IT166IU', 4, '16:00:00', '18:00:00', '2025-04-01 23:37:17', '2025-04-01 23:37:36'),
(62, 'IT167IU', 5, '14:00:00', '16:00:00', '2025-04-01 23:39:49', '2025-04-01 23:40:17'),
(63, 'IT150IU', 6, '14:00:00', '16:00:00', '2025-04-01 23:42:53', '2025-04-01 23:42:53'),
(64, 'IT156IU', 6, '16:00:00', '18:00:00', '2025-04-01 23:45:32', '2025-04-01 23:45:32'),
(65, 'IT114IU', 1, '08:00:00', '10:00:00', '2025-04-01 23:49:42', '2025-04-01 23:49:42'),
(66, 'IT144IU', 2, '08:00:00', '10:00:00', '2025-04-01 23:50:34', '2025-04-01 23:50:34'),
(67, 'IT145IU', 3, '08:00:00', '10:00:00', '2025-04-01 23:51:41', '2025-04-01 23:51:57'),
(68, 'IT130IU', 5, '12:00:00', '14:00:00', '2025-04-01 23:53:46', '2025-04-01 23:53:46'),
(69, 'IT146IU', 1, '14:00:00', '16:00:00', '2025-04-01 23:55:36', '2025-04-01 23:55:36'),
(70, 'IT163IU', 1, '16:00:00', '18:00:00', '2025-04-01 23:56:23', '2025-04-01 23:56:23'),
(71, 'IT170IU', 2, '16:00:00', '18:00:00', '2025-04-01 23:57:44', '2025-04-01 23:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` bigint UNSIGNED NOT NULL,
  `semester_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `registration_status` enum('open','closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'closed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `semester_id`, `start_date`, `end_date`, `registration_status`, `created_at`, `updated_at`) VALUES
(1, 'SEM_TEST', '2025-03-25', '2025-05-31', 'open', NULL, '2025-04-03 05:50:46'),
(3, 'abcd', '2025-04-03', '2025-04-11', 'closed', '2025-04-03 05:51:08', '2025-04-07 02:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `semester_courses`
--

CREATE TABLE `semester_courses` (
  `id` bigint UNSIGNED NOT NULL,
  `semester_id` bigint UNSIGNED NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `semester_courses`
--

INSERT INTO `semester_courses` (`id`, `semester_id`, `course_id`, `created_at`, `updated_at`) VALUES
(134, 1, 'IT154IU', '2025-04-02 20:20:49', '2025-04-02 20:20:49'),
(139, 1, 'IT159IU', '2025-04-02 20:20:49', '2025-04-02 20:20:49'),
(143, 1, 'IT083IU', '2025-04-02 20:20:49', '2025-04-02 20:20:49'),
(223, 1, 'IT064IU', '2025-04-05 02:43:18', '2025-04-05 02:43:18'),
(224, 1, 'IT116IU', '2025-04-05 02:43:18', '2025-04-05 02:43:18'),
(225, 1, 'IT149IU', '2025-04-05 02:43:18', '2025-04-05 02:43:18'),
(226, 1, 'IT135IU', '2025-04-05 02:43:18', '2025-04-05 02:43:18'),
(227, 1, 'IT151IU', '2025-04-05 02:43:18', '2025-04-05 02:43:18'),
(228, 1, 'IT140IU', '2025-04-05 02:43:18', '2025-04-05 02:43:18'),
(229, 1, 'IT013IU', '2025-04-05 02:43:18', '2025-04-05 02:43:18'),
(230, 1, 'IT068IU', '2025-04-05 02:43:18', '2025-04-05 02:43:18'),
(231, 1, 'IT079IU', '2025-04-05 02:43:18', '2025-04-05 02:43:18'),
(232, 1, 'IT138IU', '2025-04-05 02:43:18', '2025-04-05 02:43:18'),
(233, 1, 'IT160IU', '2025-04-05 02:43:18', '2025-04-05 02:43:18'),
(234, 1, 'IT092IU', '2025-04-05 02:43:18', '2025-04-05 02:43:18'),
(235, 1, 'IT017IU', '2025-04-05 02:43:18', '2025-04-05 02:43:18'),
(236, 1, 'IT128IU', '2025-04-05 02:43:18', '2025-04-05 02:43:18'),
(237, 1, 'IT139IU', '2025-04-05 02:43:18', '2025-04-05 02:43:18'),
(238, 1, 'IT137IU', '2025-04-05 02:43:18', '2025-04-05 02:43:18'),
(239, 1, 'IT173IU', '2025-04-05 02:43:18', '2025-04-05 02:43:18'),
(240, 1, 'IT103IU', '2025-04-05 02:43:18', '2025-04-05 02:43:18'),
(241, 1, 'IT110IU', '2025-04-05 02:43:18', '2025-04-05 02:43:18'),
(243, 1, 'IT058IU', '2025-04-07 02:46:09', '2025-04-07 02:46:09'),
(244, 1, 'IT157IU', '2025-04-12 22:06:23', '2025-04-12 22:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1MBEySvpYsx1JgYTxpTWZp9Gzxa0ZaMx3vYaN4i7', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoibzFLdUtVNnBPV3duelp3Y3MyOW5xYVNueEJib0p3aEVqUFh0R0kyYyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdHVkZW50L2NvdXJzZS1yZWdpc3RyYXRpb24iO31zOjk6InVzZXJfcm9sZSI7czo3OiJzdHVkZW50IjtzOjQ6InVzZXIiO086MTg6IkFwcFxNb2RlbHNcU3R1ZGVudCI6MzA6e3M6MTM6IgAqAGNvbm5lY3Rpb24iO3M6NToibXlzcWwiO3M6ODoiACoAdGFibGUiO3M6ODoic3R1ZGVudHMiO3M6MTM6IgAqAHByaW1hcnlLZXkiO3M6MTA6InN0dWRlbnRfaWQiO3M6MTA6IgAqAGtleVR5cGUiO3M6Njoic3RyaW5nIjtzOjEyOiJpbmNyZW1lbnRpbmciO2I6MDtzOjc6IgAqAHdpdGgiO2E6MDp7fXM6MTI6IgAqAHdpdGhDb3VudCI7YTowOnt9czoxOToicHJldmVudHNMYXp5TG9hZGluZyI7YjowO3M6MTA6IgAqAHBlclBhZ2UiO2k6MTU7czo2OiJleGlzdHMiO2I6MTtzOjE4OiJ3YXNSZWNlbnRseUNyZWF0ZWQiO2I6MDtzOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7czoxMzoiACoAYXR0cmlidXRlcyI7YTo2OntzOjEwOiJzdHVkZW50X2lkIjtzOjg6IklUSVRDRTAxIjtzOjEyOiJzdHVkZW50X25hbWUiO3M6MTg6IlBoYW0gSG9hbmcgTmFtIEFuaCI7czo4OiJtYWpvcl9pZCI7czo0OiJDRTAxIjtzOjg6InBhc3N3b3JkIjtzOjYwOiIkMnkkMTIkcGZMdThRdWZoTnMudi5uamd5dC9KLnRqMkc5aTk5cVY3WmNMVTNKUTViOFBWSDcza1UubS4iO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjUtMDQtMDcgMDc6Mjk6NDMiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjUtMDQtMTEgMDE6NTc6MjgiO31zOjExOiIAKgBvcmlnaW5hbCI7YTo2OntzOjEwOiJzdHVkZW50X2lkIjtzOjg6IklUSVRDRTAxIjtzOjEyOiJzdHVkZW50X25hbWUiO3M6MTg6IlBoYW0gSG9hbmcgTmFtIEFuaCI7czo4OiJtYWpvcl9pZCI7czo0OiJDRTAxIjtzOjg6InBhc3N3b3JkIjtzOjYwOiIkMnkkMTIkcGZMdThRdWZoTnMudi5uamd5dC9KLnRqMkc5aTk5cVY3WmNMVTNKUTViOFBWSDcza1UubS4iO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjUtMDQtMDcgMDc6Mjk6NDMiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjUtMDQtMTEgMDE6NTc6MjgiO31zOjEwOiIAKgBjaGFuZ2VzIjthOjA6e31zOjg6IgAqAGNhc3RzIjthOjA6e31zOjE3OiIAKgBjbGFzc0Nhc3RDYWNoZSI7YTowOnt9czoyMToiACoAYXR0cmlidXRlQ2FzdENhY2hlIjthOjA6e31zOjEzOiIAKgBkYXRlRm9ybWF0IjtOO3M6MTA6IgAqAGFwcGVuZHMiO2E6MDp7fXM6MTk6IgAqAGRpc3BhdGNoZXNFdmVudHMiO2E6MDp7fXM6MTQ6IgAqAG9ic2VydmFibGVzIjthOjA6e31zOjEyOiIAKgByZWxhdGlvbnMiO2E6MDp7fXM6MTA6IgAqAHRvdWNoZXMiO2E6MDp7fXM6MTA6InRpbWVzdGFtcHMiO2I6MTtzOjEzOiJ1c2VzVW5pcXVlSWRzIjtiOjA7czo5OiIAKgBoaWRkZW4iO2E6MDp7fXM6MTA6IgAqAHZpc2libGUiO2E6MDp7fXM6MTE6IgAqAGZpbGxhYmxlIjthOjQ6e2k6MDtzOjEwOiJzdHVkZW50X2lkIjtpOjE7czoxMjoic3R1ZGVudF9uYW1lIjtpOjI7czo4OiJtYWpvcl9pZCI7aTozO3M6ODoicGFzc3dvcmQiO31zOjEwOiIAKgBndWFyZGVkIjthOjE6e2k6MDtzOjE6IioiO319czo4OiJtYWpvcl9pZCI7czo0OiJDRTAxIjt9', 1745910437);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `major_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_name`, `major_id`, `password`, `created_at`, `updated_at`) VALUES
('ITITCE01', 'Pham Hoang Nam Anh', 'CE01', '$2y$12$pfLu8QufhNs.v.njgyt/J.tj2G9i99qV7ZcLU3JQ5b8PVH73kU.m.', '2025-04-07 00:29:43', '2025-04-10 18:57:28'),
('ITITCE02', 'Tra Gia Bao', 'CE01', '$2y$12$eifhy85pBL1jrObzzQ8bKOIpcX3FiXcUUmPlNbmqPIfJFik.EgHK6', '2025-04-07 00:29:50', '2025-04-10 19:07:48'),
('ITITCE03', 'Nguyen Gia Bao', 'CE01', '$2y$12$RiAG4HblJbDdzdJlbDSPYebRtNKrOBNcZiOBPDKeNsMl0zKComSVm', '2025-04-07 00:30:00', '2025-04-10 19:08:13'),
('ITITCE04', 'Le Do Huy Du', 'CE01', '$2y$12$YvnVHf1pzyqpa3kNM.Pm8OatC8TTHevjkQeP3gQGblovX31EFdjZq', '2025-04-07 00:30:11', '2025-04-10 19:08:47'),
('ITITCE05', 'Nguyen Tien Duc', 'CE01', '$2y$12$Ip35ItG8ipLb5gfovoEFLup2T4qBRC5MGTvEW2VJzb4BLlswn4bMi', '2025-04-07 00:30:28', '2025-04-10 19:09:37'),
('ITITCE06', 'Ho Trong Hieu', 'CE01', '$2y$12$vQbQLO3XOMMT2VE0ISAoJ.nr/y4LDB4zh90wFqW36n.3dUaRgK9FS', '2025-04-07 00:30:37', '2025-04-10 19:10:16'),
('ITITCE07', 'Pham Van Hieu', 'CE01', '$2y$12$HHdPgRi/I1dqYsYxc88R9OdHUNo6f2tlSl7ygCc1YgX.pGWPqjrgG', '2025-04-07 00:30:47', '2025-04-10 19:10:43'),
('ITITCE08', 'Pham Huy Hoang', 'CE01', '$2y$12$zTOqodRgH09ijw.ch6uuP.Y1YtsCn.Q998DDw.FeOu0Tz37oyq.2a', '2025-04-07 00:30:58', '2025-04-10 19:13:08'),
('ITITCE09', 'Do Duy Hung', 'CE01', '$2y$12$qUtaqh7ai2agRXazRNG/n.LVUMQUgy01SQkboQ.uUqe7M5xXXybEm', '2025-04-07 00:31:06', '2025-04-10 19:13:54'),
('ITITCE10', 'Dang Ngoc Minh Huy', 'CE01', '$2y$12$rnIRYRPf//QoD1wFACl66evHVVAEw40I/0G7ltoQCel8bHmmUGSh2', '2025-04-07 00:31:21', '2025-04-10 19:15:31'),
('ITITCE11', 'Dang Dinh Khang', 'CE01', '$2y$12$mZUu123T41oTZUbtlwoR/.LC09s5eyFGw.KOAHDSY26o7SwzoRt4K', '2025-04-07 00:31:45', '2025-04-10 19:16:05'),
('ITITCE12', 'Nguyen Duy Khang', 'CE01', '$2y$12$B1Zh22enFwTvYRbG0lr7Cu0DmqZ3PAhh6DWPD9rMHhqwyY5hB.bxG', '2025-04-07 00:31:59', '2025-04-07 00:31:59'),
('ITITCS13', 'Le Hoang Dang Khoa', 'CS01', '$2y$12$Xzy/PutEQANj.7j5zIYGAucBHeZVwaKgR7d7J3InncTWnD7q6ovCu', '2025-04-07 00:32:19', '2025-04-07 00:32:19'),
('ITITCS14', 'Nguyen Duc Dang Khoi', 'CS01', '$2y$12$j5AEbgrqgyGXBuQBhO4FWeEQ/xj6bM4yRxJklcLMJdZXhNuVr46li', '2025-04-07 00:32:35', '2025-04-07 00:32:35'),
('ITITCS15', 'Huynh Anh Kiet', 'CS01', '$2y$12$LAiF3lB.nZDyZVvEHpsIpOO6fOuI0tttQLuQjRd.oJ.UV85iZ4cm6', '2025-04-07 00:32:43', '2025-04-07 00:32:43'),
('ITITCS16', 'Nguyen Tuan Kiet', 'CS01', '$2y$12$vsSa2TcJYMIU.R2lW3hqReJgT9W5Y8v4I5px2Y7TyO2GOQhCM3PZW', '2025-04-07 00:32:55', '2025-04-07 00:32:55'),
('ITITCS17', 'Phung Khanh Linh', 'CS01', '$2y$12$KlmxfudeXFQEcdpOYbAdzeDWSegKa1ylqCr8RZs.gWIHnWGqPB/wS', '2025-04-07 00:33:30', '2025-04-07 00:33:30'),
('ITITCS18', 'Ma Kim Long', 'CS01', '$2y$12$zrZ.nPjdm6xCxJGJONFXL.vfC7SmuFr757gBrI7dLURtR4yGR7pJ.', '2025-04-07 00:33:48', '2025-04-07 00:33:48'),
('ITITCS19', 'Luu Minh Long', 'CS01', '$2y$12$BanfLayqPQHN.02XaGfXSeHt5uvQ1fMtJuzyH3rxTP1bgcA/pGC72', '2025-04-07 00:33:57', '2025-04-07 00:33:57'),
('ITITCS20', 'Nguyen Nhat Minh', 'CS01', '$2y$12$Zsy324yC52uD3UBRY1LP6.tMYKBXWZ5oX9F3qMxCLe8gfBATjfNXq', '2025-04-07 00:34:07', '2025-04-07 00:34:07'),
('ITITCS21', 'Ngo Thanh Son', 'CS01', '$2y$12$uV4Tzc5/owjPpUTH/6XvFOz6wFiB4D2atplAmjs7R/IPRbAl3rdES', '2025-04-07 00:34:15', '2025-04-07 00:34:15'),
('ITITCS22', 'Nguyen Le Thanh Tam', 'CS01', '$2y$12$I2lPEHw7nfRk.cHYetowBuOKYvhK0zKUFk4y.a9tUxslj4Irfm8AK', '2025-04-07 00:34:24', '2025-04-07 00:34:24'),
('ITITDS23', 'Tran Bao Thanh', 'DS01', '$2y$12$XkLu/zOKWo5/0h8CxZan3ei3juQryfH.LAeC7y8NBdsJY9Gom3VIi', '2025-04-07 00:34:40', '2025-04-07 00:34:40'),
('ITITDS24', 'Ly Bao Thoai', 'DS01', '$2y$12$Y4dCMl5zyEJJu2slXSkDp.Gh/OHrRdrl5yAAa3CADOVXv.QqPEXIa', '2025-04-07 00:34:53', '2025-04-07 00:34:53'),
('ITITDS25', 'Tran Trong Thuc', 'DS01', '$2y$12$s9FNeq9QDGT7y8J51zraV.OHLDCGGc1zPSIQQ74acJOjRecVL6LtG', '2025-04-07 00:35:23', '2025-04-07 00:35:23'),
('ITITDS26', 'Tran Duc Tri', 'DS01', '$2y$12$XUcrcIo8IvyTu5ZnIZmAYupKeesPgdOx7tHEv0j09dCmvT4UMC38u', '2025-04-07 00:35:38', '2025-04-07 00:35:38'),
('ITITDS27', 'Lê Thi Tuong Vi', 'DS01', '$2y$12$9/EbNkMVfLjdQshr6IijYuivDrtYbkePzJQR1zhAGfi95b5Ftdo1S', '2025-04-07 00:35:49', '2025-04-07 00:35:49'),
('ITITDS28', 'Nguyen Hoang Long', 'DS01', '$2y$12$80gFXfJR.O5iguUY3Ht0E.QVACQ2TH72nUNSUmKPlXb06q/ldkZ7m', '2025-04-07 00:36:01', '2025-04-07 00:36:01');

-- --------------------------------------------------------

--
-- Table structure for table `student_courses`
--

CREATE TABLE `student_courses` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_courses`
--

INSERT INTO `student_courses` (`id`, `student_id`, `course_id`, `semester`, `status`, `created_at`, `updated_at`) VALUES
(25, 'ITITCE01', 'IT116IU', '1', 1, NULL, NULL),
(26, 'ITITCE01', 'IT064IU', '1', 1, NULL, NULL),
(27, 'ITITCE01', 'IT067IU', '2', 1, NULL, NULL),
(28, 'ITITCE01', 'IT091IU', '2', 1, NULL, NULL),
(29, 'ITITCE01', 'IT153IU', '2', 1, NULL, NULL),
(30, 'ITITCE01', 'IT069IU', '2', 1, NULL, NULL),
(31, 'ITITCE02', 'IT116IU', '1', 1, NULL, NULL),
(32, 'ITITCE02', 'IT064IU', '1', 1, NULL, NULL),
(33, 'ITITCE02', 'IT067IU', '2', 1, NULL, NULL),
(34, 'ITITCE02', 'IT091IU', '2', 1, NULL, NULL),
(35, 'ITITCE02', 'IT153IU', '2', 1, NULL, NULL),
(36, 'ITITCE02', 'IT069IU', '2', 1, NULL, NULL),
(37, 'ITITCE03', 'IT116IU', '1', 1, NULL, NULL),
(38, 'ITITCE03', 'IT064IU', '1', 1, NULL, NULL),
(39, 'ITITCE03', 'IT067IU', '2', 1, NULL, NULL),
(40, 'ITITCE03', 'IT091IU', '2', 1, NULL, NULL),
(41, 'ITITCE03', 'IT153IU', '2', 1, NULL, NULL),
(42, 'ITITCE03', 'IT069IU', '2', 1, NULL, NULL),
(43, 'ITITCE03', 'IT068IU', '3', 1, NULL, NULL),
(44, 'ITITCE03', 'IT013IU', '3', 1, NULL, NULL),
(45, 'ITITCE03', 'IT154IU', '3', 1, NULL, NULL),
(46, 'ITITCE03', 'IT074IU', '4', 1, NULL, NULL),
(47, 'ITITCE03', 'IT089IU', '4', 1, NULL, NULL),
(48, 'ITITCE04', 'IT116IU', '1', 1, NULL, NULL),
(49, 'ITITCE04', 'IT064IU', '1', 1, NULL, NULL),
(50, 'ITITCE04', 'IT067IU', '2', 1, NULL, NULL),
(51, 'ITITCE04', 'IT091IU', '2', 1, NULL, NULL),
(52, 'ITITCE04', 'IT153IU', '2', 1, NULL, NULL),
(53, 'ITITCE04', 'IT069IU', '2', 1, NULL, NULL),
(54, 'ITITCE04', 'IT068IU', '3', 1, NULL, NULL),
(55, 'ITITCE04', 'IT013IU', '3', 1, NULL, NULL),
(56, 'ITITCE04', 'IT154IU', '3', 1, NULL, NULL),
(57, 'ITITCE04', 'IT074IU', '4', 1, NULL, NULL),
(58, 'ITITCE04', 'IT089IU', '4', 1, NULL, NULL),
(70, 'ITITCE05', 'IT116IU', '1', 1, NULL, NULL),
(71, 'ITITCE05', 'IT064IU', '1', 1, NULL, NULL),
(72, 'ITITCE05', 'IT067IU', '2', 1, NULL, NULL),
(73, 'ITITCE05', 'IT091IU', '2', 1, NULL, NULL),
(74, 'ITITCE05', 'IT153IU', '2', 1, NULL, NULL),
(75, 'ITITCE05', 'IT069IU', '2', 1, NULL, NULL),
(76, 'ITITCE05', 'IT068IU', '3', 1, NULL, NULL),
(77, 'ITITCE05', 'IT013IU', '3', 1, NULL, NULL),
(78, 'ITITCE05', 'IT154IU', '3', 1, NULL, NULL),
(79, 'ITITCE05', 'IT074IU', '4', 1, NULL, NULL),
(80, 'ITITCE05', 'IT089IU', '4', 1, NULL, NULL),
(81, 'ITITCE06', 'IT116IU', '1', 1, NULL, NULL),
(82, 'ITITCE06', 'IT064IU', '1', 1, NULL, NULL),
(83, 'ITITCE06', 'IT067IU', '2', 1, NULL, NULL),
(84, 'ITITCE06', 'IT091IU', '2', 1, NULL, NULL),
(85, 'ITITCE06', 'IT153IU', '2', 1, NULL, NULL),
(86, 'ITITCE06', 'IT069IU', '2', 1, NULL, NULL),
(87, 'ITITCE06', 'IT068IU', '3', 1, NULL, NULL),
(88, 'ITITCE06', 'IT013IU', '3', 1, NULL, NULL),
(89, 'ITITCE06', 'IT154IU', '3', 1, NULL, NULL),
(90, 'ITITCE06', 'IT074IU', '4', 1, NULL, NULL),
(91, 'ITITCE06', 'IT089IU', '4', 1, NULL, NULL),
(92, 'ITITCE06', 'IT128IU', '5', 1, NULL, NULL),
(93, 'ITITCE06', 'IT017IU', '5', 1, NULL, NULL),
(94, 'ITITCE06', 'IT079IU', '5', 1, NULL, NULL),
(95, 'ITITCE06', 'IT174IU', '6', 1, NULL, NULL),
(96, 'ITITCE06', 'IT105IU', '6', 1, NULL, NULL),
(97, 'ITITCE06', 'IT115IU', '6', 1, NULL, NULL),
(98, 'ITITCE06', 'IT056IU', '6', 1, NULL, NULL),
(99, 'ITITCE11', 'IT116IU', '1', 1, NULL, NULL),
(100, 'ITITCE11', 'IT064IU', '1', 1, NULL, NULL),
(101, 'ITITCE11', 'IT067IU', '2', 1, NULL, NULL),
(102, 'ITITCE11', 'IT091IU', '2', 1, NULL, NULL),
(103, 'ITITCE11', 'IT153IU', '2', 1, NULL, NULL),
(104, 'ITITCE11', 'IT069IU', '2', 1, NULL, NULL),
(105, 'ITITCE11', 'IT068IU', '3', 1, NULL, NULL),
(106, 'ITITCE11', 'IT013IU', '3', 1, NULL, NULL),
(107, 'ITITCE11', 'IT154IU', '3', 1, NULL, NULL),
(108, 'ITITCE11', 'IT074IU', '4', 1, NULL, NULL),
(109, 'ITITCE11', 'IT089IU', '4', 1, NULL, NULL),
(110, 'ITITCE11', 'IT128IU', '5', 1, NULL, NULL),
(111, 'ITITCE11', 'IT017IU', '5', 1, NULL, NULL),
(112, 'ITITCE11', 'IT079IU', '5', 1, NULL, NULL),
(113, 'ITITCE11', 'IT174IU', '6', 1, NULL, NULL),
(114, 'ITITCE11', 'IT105IU', '6', 1, NULL, NULL),
(115, 'ITITCE11', 'IT115IU', '6', 1, NULL, NULL),
(116, 'ITITCE11', 'IT056IU', '6', 1, NULL, NULL),
(117, 'ITITCE07', 'IT116IU', '1', 1, NULL, NULL),
(118, 'ITITCE07', 'IT064IU', '1', 1, NULL, NULL),
(119, 'ITITCE07', 'IT067IU', '2', 1, NULL, NULL),
(120, 'ITITCE07', 'IT091IU', '2', 1, NULL, NULL),
(121, 'ITITCE07', 'IT153IU', '2', 1, NULL, NULL),
(122, 'ITITCE07', 'IT069IU', '2', 1, NULL, NULL),
(123, 'ITITCE07', 'IT068IU', '3', 1, NULL, NULL),
(124, 'ITITCE07', 'IT013IU', '3', 1, NULL, NULL),
(125, 'ITITCE07', 'IT154IU', '3', 1, NULL, NULL),
(126, 'ITITCE07', 'IT074IU', '4', 1, NULL, NULL),
(127, 'ITITCE07', 'IT089IU', '4', 1, NULL, NULL),
(128, 'ITITCE07', 'IT128IU', '5', 1, NULL, NULL),
(129, 'ITITCE07', 'IT017IU', '5', 1, NULL, NULL),
(130, 'ITITCE07', 'IT079IU', '5', 1, NULL, NULL),
(131, 'ITITCE07', 'IT174IU', '6', 1, NULL, NULL),
(132, 'ITITCE07', 'IT105IU', '6', 1, NULL, NULL),
(133, 'ITITCE07', 'IT115IU', '6', 1, NULL, NULL),
(134, 'ITITCE07', 'IT096IU', '6', 1, NULL, NULL),
(135, 'ITITCE08', 'IT116IU', '1', 1, NULL, NULL),
(136, 'ITITCE08', 'IT064IU', '1', 1, NULL, NULL),
(137, 'ITITCE08', 'IT067IU', '2', 1, NULL, NULL),
(138, 'ITITCE08', 'IT091IU', '2', 1, NULL, NULL),
(139, 'ITITCE08', 'IT153IU', '2', 1, NULL, NULL),
(140, 'ITITCE08', 'IT069IU', '2', 1, NULL, NULL),
(141, 'ITITCE08', 'IT068IU', '3', 1, NULL, NULL),
(142, 'ITITCE08', 'IT013IU', '3', 1, NULL, NULL),
(143, 'ITITCE08', 'IT154IU', '3', 1, NULL, NULL),
(144, 'ITITCE08', 'IT074IU', '4', 1, NULL, NULL),
(145, 'ITITCE08', 'IT089IU', '4', 1, NULL, NULL),
(146, 'ITITCE08', 'IT128IU', '5', 1, NULL, NULL),
(147, 'ITITCE08', 'IT017IU', '5', 1, NULL, NULL),
(148, 'ITITCE08', 'IT079IU', '5', 1, NULL, NULL),
(149, 'ITITCE08', 'IT174IU', '6', 1, NULL, NULL),
(150, 'ITITCE08', 'IT105IU', '6', 1, NULL, NULL),
(151, 'ITITCE08', 'IT115IU', '6', 1, NULL, NULL),
(152, 'ITITCE08', 'IT024IU', '6', 1, NULL, NULL),
(153, 'ITITCE09', 'IT116IU', '1', 1, NULL, NULL),
(154, 'ITITCE09', 'IT064IU', '1', 1, NULL, NULL),
(155, 'ITITCE09', 'IT067IU', '2', 1, NULL, NULL),
(156, 'ITITCE09', 'IT091IU', '2', 1, NULL, NULL),
(157, 'ITITCE09', 'IT153IU', '2', 1, NULL, NULL),
(158, 'ITITCE09', 'IT069IU', '2', 1, NULL, NULL),
(159, 'ITITCE09', 'IT068IU', '3', 1, NULL, NULL),
(160, 'ITITCE09', 'IT013IU', '3', 1, NULL, NULL),
(161, 'ITITCE09', 'IT154IU', '3', 1, NULL, NULL),
(162, 'ITITCE09', 'IT074IU', '4', 1, NULL, NULL),
(163, 'ITITCE09', 'IT089IU', '4', 1, NULL, NULL),
(164, 'ITITCE09', 'IT128IU', '5', 1, NULL, NULL),
(165, 'ITITCE09', 'IT017IU', '5', 1, NULL, NULL),
(166, 'ITITCE09', 'IT079IU', '5', 1, NULL, NULL),
(167, 'ITITCE09', 'IT174IU', '6', 1, NULL, NULL),
(168, 'ITITCE09', 'IT105IU', '6', 1, NULL, NULL),
(169, 'ITITCE09', 'IT115IU', '6', 1, NULL, NULL),
(170, 'ITITCE09', 'IT114IU', '6', 1, NULL, NULL),
(171, 'ITITCE10', 'IT116IU', '1', 1, NULL, NULL),
(172, 'ITITCE10', 'IT064IU', '1', 1, NULL, NULL),
(173, 'ITITCE10', 'IT067IU', '2', 1, NULL, NULL),
(174, 'ITITCE10', 'IT091IU', '2', 1, NULL, NULL),
(175, 'ITITCE10', 'IT153IU', '2', 1, NULL, NULL),
(176, 'ITITCE10', 'IT069IU', '2', 1, NULL, NULL),
(177, 'ITITCE10', 'IT068IU', '3', 1, NULL, NULL),
(178, 'ITITCE10', 'IT013IU', '3', 1, NULL, NULL),
(179, 'ITITCE10', 'IT154IU', '3', 1, NULL, NULL),
(180, 'ITITCE10', 'IT074IU', '4', 1, NULL, NULL),
(181, 'ITITCE10', 'IT089IU', '4', 1, NULL, NULL),
(182, 'ITITCE10', 'IT128IU', '5', 1, NULL, NULL),
(183, 'ITITCE10', 'IT017IU', '5', 1, NULL, NULL),
(184, 'ITITCE10', 'IT079IU', '5', 1, NULL, NULL),
(185, 'ITITCE10', 'IT174IU', '6', 1, NULL, NULL),
(186, 'ITITCE10', 'IT105IU', '6', 1, NULL, NULL),
(187, 'ITITCE10', 'IT115IU', '6', 1, NULL, NULL),
(188, 'ITITCE10', 'IT144IU', '6', 1, NULL, NULL),
(189, 'ITITCE10', 'IT103IU', '7', 1, NULL, NULL),
(190, 'ITITCE10', 'IT110IU', '7', 1, NULL, NULL),
(191, 'ITITCE10', 'IT159IU', '7', 1, NULL, NULL),
(192, 'ITITCE12', 'IT116IU', '1', 1, NULL, NULL),
(193, 'ITITCE12', 'IT064IU', '1', 1, NULL, NULL),
(194, 'ITITCE12', 'IT067IU', '2', 1, NULL, NULL),
(195, 'ITITCE12', 'IT091IU', '2', 1, NULL, NULL),
(196, 'ITITCE12', 'IT153IU', '2', 1, NULL, NULL),
(197, 'ITITCE12', 'IT069IU', '2', 1, NULL, NULL),
(198, 'ITITCE12', 'IT068IU', '3', 1, NULL, NULL),
(199, 'ITITCE12', 'IT013IU', '3', 1, NULL, NULL),
(200, 'ITITCE12', 'IT154IU', '3', 1, NULL, NULL),
(201, 'ITITCE12', 'IT074IU', '4', 1, NULL, NULL),
(202, 'ITITCE12', 'IT089IU', '4', 1, NULL, NULL),
(203, 'ITITCE12', 'IT128IU', '5', 1, NULL, NULL),
(204, 'ITITCE12', 'IT017IU', '5', 1, NULL, NULL),
(205, 'ITITCE12', 'IT079IU', '5', 1, NULL, NULL),
(206, 'ITITCE12', 'IT174IU', '6', 1, NULL, NULL),
(207, 'ITITCE12', 'IT105IU', '6', 1, NULL, NULL),
(208, 'ITITCE12', 'IT115IU', '6', 1, NULL, NULL),
(210, 'ITITCS13', 'IT064IU', '1', 1, NULL, NULL),
(211, 'ITITCS13', 'IT116IU', '1', 1, NULL, NULL),
(212, 'ITITCS13', 'IT091IU', '2', 1, NULL, NULL),
(213, 'ITITCS13', 'IT153IU', '2', 1, NULL, NULL),
(214, 'ITITCS13', 'IT069IU', '2', 1, NULL, NULL),
(215, 'ITITCS14', 'IT064IU', '1', 1, NULL, NULL),
(216, 'ITITCS14', 'IT116IU', '1', 1, NULL, NULL),
(217, 'ITITCS14', 'IT091IU', '2', 1, NULL, NULL),
(218, 'ITITCS14', 'IT153IU', '2', 1, NULL, NULL),
(219, 'ITITCS14', 'IT069IU', '2', 1, NULL, NULL),
(220, 'ITITCS15', 'IT064IU', '1', 1, NULL, NULL),
(221, 'ITITCS15', 'IT116IU', '1', 1, NULL, NULL),
(222, 'ITITCS15', 'IT091IU', '2', 1, NULL, NULL),
(223, 'ITITCS15', 'IT153IU', '2', 1, NULL, NULL),
(224, 'ITITCS15', 'IT069IU', '2', 1, NULL, NULL),
(225, 'ITITCS15', 'IT079IU', '3', 1, NULL, NULL),
(226, 'ITITCS15', 'IT013IU', '3', 1, NULL, NULL),
(227, 'ITITCS15', 'IT154IU', '3', 1, NULL, NULL),
(228, 'ITITCS15', 'IT090IU', '4', 1, NULL, NULL),
(229, 'ITITCS15', 'IT089IU', '4', 1, NULL, NULL),
(230, 'ITITCS15', 'IT093IU', '4', 1, NULL, NULL),
(231, 'ITITCS16', 'IT064IU', '1', 1, NULL, NULL),
(232, 'ITITCS16', 'IT116IU', '1', 1, NULL, NULL),
(233, 'ITITCS16', 'IT091IU', '2', 1, NULL, NULL),
(234, 'ITITCS16', 'IT153IU', '2', 1, NULL, NULL),
(235, 'ITITCS16', 'IT069IU', '2', 1, NULL, NULL),
(236, 'ITITCS16', 'IT079IU', '3', 1, NULL, NULL),
(237, 'ITITCS16', 'IT013IU', '3', 1, NULL, NULL),
(238, 'ITITCS16', 'IT154IU', '3', 1, NULL, NULL),
(239, 'ITITCS16', 'IT090IU', '4', 1, NULL, NULL),
(240, 'ITITCS16', 'IT089IU', '4', 1, NULL, NULL),
(241, 'ITITCS16', 'IT093IU', '4', 1, NULL, NULL),
(242, 'ITITCS17', 'IT064IU', '1', 1, NULL, NULL),
(243, 'ITITCS17', 'IT116IU', '1', 1, NULL, NULL),
(244, 'ITITCS17', 'IT091IU', '2', 1, NULL, NULL),
(245, 'ITITCS17', 'IT153IU', '2', 1, NULL, NULL),
(246, 'ITITCS17', 'IT069IU', '2', 1, NULL, NULL),
(247, 'ITITCS17', 'IT079IU', '3', 1, NULL, NULL),
(248, 'ITITCS17', 'IT013IU', '3', 1, NULL, NULL),
(249, 'ITITCS17', 'IT154IU', '3', 1, NULL, NULL),
(250, 'ITITCS17', 'IT090IU', '4', 1, NULL, NULL),
(251, 'ITITCS17', 'IT089IU', '4', 1, NULL, NULL),
(252, 'ITITCS17', 'IT093IU', '4', 1, NULL, NULL),
(253, 'ITITCS17', 'IT156IU', '4', 1, NULL, NULL),
(254, 'ITITCS18', 'IT064IU', '1', 1, NULL, NULL),
(255, 'ITITCS18', 'IT116IU', '1', 1, NULL, NULL),
(256, 'ITITCS18', 'IT091IU', '2', 1, NULL, NULL),
(257, 'ITITCS18', 'IT153IU', '2', 1, NULL, NULL),
(258, 'ITITCS18', 'IT069IU', '2', 1, NULL, NULL),
(259, 'ITITCS18', 'IT079IU', '3', 1, NULL, NULL),
(260, 'ITITCS18', 'IT013IU', '3', 1, NULL, NULL),
(261, 'ITITCS18', 'IT154IU', '3', 1, NULL, NULL),
(262, 'ITITCS18', 'IT090IU', '4', 1, NULL, NULL),
(263, 'ITITCS18', 'IT089IU', '4', 1, NULL, NULL),
(264, 'ITITCS18', 'IT093IU', '4', 1, NULL, NULL),
(265, 'ITITCS18', 'IT156IU', '4', 1, NULL, NULL),
(266, 'ITITCS19', 'IT064IU', '1', 1, NULL, NULL),
(267, 'ITITCS19', 'IT116IU', '1', 1, NULL, NULL),
(268, 'ITITCS19', 'IT091IU', '2', 1, NULL, NULL),
(269, 'ITITCS19', 'IT153IU', '2', 1, NULL, NULL),
(270, 'ITITCS19', 'IT069IU', '2', 1, NULL, NULL),
(271, 'ITITCS19', 'IT079IU', '3', 1, NULL, NULL),
(272, 'ITITCS19', 'IT013IU', '3', 1, NULL, NULL),
(273, 'ITITCS19', 'IT154IU', '3', 1, NULL, NULL),
(274, 'ITITCS19', 'IT090IU', '4', 1, NULL, NULL),
(275, 'ITITCS19', 'IT089IU', '4', 1, NULL, NULL),
(276, 'ITITCS19', 'IT093IU', '4', 1, NULL, NULL),
(277, 'ITITCS19', 'IT044IU', '4', 1, NULL, NULL),
(278, 'ITITCS20', 'IT064IU', '1', 1, NULL, NULL),
(279, 'ITITCS20', 'IT116IU', '1', 1, NULL, NULL),
(280, 'ITITCS20', 'IT091IU', '2', 1, NULL, NULL),
(281, 'ITITCS20', 'IT153IU', '2', 1, NULL, NULL),
(282, 'ITITCS20', 'IT069IU', '2', 1, NULL, NULL),
(283, 'ITITCS20', 'IT079IU', '3', 1, NULL, NULL),
(284, 'ITITCS20', 'IT013IU', '3', 0, NULL, NULL),
(285, 'ITITCS20', 'IT154IU', '3', 1, NULL, NULL),
(286, 'ITITCS20', 'IT090IU', '4', 1, NULL, NULL),
(287, 'ITITCS20', 'IT089IU', '4', 1, NULL, NULL),
(288, 'ITITCS20', 'IT093IU', '4', 1, NULL, NULL),
(289, 'ITITCS20', 'IT044IU', '4', 1, NULL, NULL),
(290, 'ITITCS21', 'IT064IU', '1', 1, NULL, NULL),
(291, 'ITITCS21', 'IT116IU', '1', 1, NULL, NULL),
(292, 'ITITCS21', 'IT091IU', '2', 1, NULL, NULL),
(293, 'ITITCS21', 'IT153IU', '2', 1, NULL, NULL),
(294, 'ITITCS21', 'IT069IU', '2', 1, NULL, NULL),
(295, 'ITITCS21', 'IT079IU', '3', 1, NULL, NULL),
(296, 'ITITCS21', 'IT013IU', '3', 1, NULL, NULL),
(297, 'ITITCS21', 'IT154IU', '3', 1, NULL, NULL),
(298, 'ITITCS21', 'IT090IU', '4', 1, NULL, NULL),
(299, 'ITITCS21', 'IT089IU', '4', 1, NULL, NULL),
(300, 'ITITCS21', 'IT093IU', '4', 1, NULL, NULL),
(301, 'ITITCS21', 'IT056IU', '4', 1, NULL, NULL),
(302, 'ITITCS22', 'IT064IU', '1', 1, NULL, NULL),
(303, 'ITITCS22', 'IT116IU', '1', 1, NULL, NULL),
(304, 'ITITCS22', 'IT091IU', '2', 1, NULL, NULL),
(305, 'ITITCS22', 'IT153IU', '2', 1, NULL, NULL),
(306, 'ITITCS22', 'IT069IU', '2', 1, NULL, NULL),
(307, 'ITITCS22', 'IT079IU', '3', 1, NULL, NULL),
(308, 'ITITCS22', 'IT013IU', '3', 1, NULL, NULL),
(309, 'ITITCS22', 'IT154IU', '3', 1, NULL, NULL),
(310, 'ITITCS22', 'IT090IU', '4', 1, NULL, NULL),
(311, 'ITITCS22', 'IT089IU', '4', 1, NULL, NULL),
(312, 'ITITCS22', 'IT093IU', '4', 1, NULL, NULL),
(313, 'ITITCS22', 'IT056IU', '4', 1, NULL, NULL),
(314, 'ITITDS23', 'IT149IU', '1', 1, NULL, NULL),
(315, 'ITITDS23', 'IT135IU', '1', 1, NULL, NULL),
(316, 'ITITDS23', 'IT154IU', '2', 1, NULL, NULL),
(317, 'ITITDS23', 'IT069IU', '2', 1, NULL, NULL),
(318, 'ITITDS24', 'IT149IU', '1', 1, NULL, NULL),
(319, 'ITITDS24', 'IT135IU', '1', 1, NULL, NULL),
(320, 'ITITDS24', 'IT154IU', '2', 1, NULL, NULL),
(321, 'ITITDS24', 'IT069IU', '2', 1, NULL, NULL),
(322, 'ITITDS25', 'IT149IU', '1', 1, NULL, NULL),
(323, 'ITITDS25', 'IT135IU', '1', 1, NULL, NULL),
(324, 'ITITDS25', 'IT154IU', '2', 1, NULL, NULL),
(325, 'ITITDS25', 'IT069IU', '2', 1, NULL, NULL),
(326, 'ITITDS25', 'IT079IU', '3', 1, NULL, NULL),
(327, 'ITITDS25', 'IT013IU', '3', 1, NULL, NULL),
(328, 'ITITDS25', 'IT140IU', '3', 1, NULL, NULL),
(329, 'ITITDS25', 'IT151IU', '3', 1, NULL, NULL),
(330, 'ITITDS25', 'IT136IU', '4', 1, NULL, NULL),
(331, 'ITITDS25', 'IT171IU', '4', 1, NULL, NULL),
(332, 'ITITDS25', 'IT159IU', '4', 1, NULL, NULL),
(333, 'ITITDS26', 'IT149IU', '1', 1, NULL, NULL),
(334, 'ITITDS26', 'IT135IU', '1', 1, NULL, NULL),
(335, 'ITITDS26', 'IT154IU', '2', 1, NULL, NULL),
(336, 'ITITDS26', 'IT069IU', '2', 1, NULL, NULL),
(337, 'ITITDS26', 'IT079IU', '3', 1, NULL, NULL),
(338, 'ITITDS26', 'IT013IU', '3', 1, NULL, NULL),
(339, 'ITITDS26', 'IT140IU', '3', 1, NULL, NULL),
(340, 'ITITDS26', 'IT151IU', '3', 1, NULL, NULL),
(341, 'ITITDS26', 'IT136IU', '4', 1, NULL, NULL),
(342, 'ITITDS26', 'IT171IU', '4', 1, NULL, NULL),
(343, 'ITITDS26', 'IT159IU', '4', 1, NULL, NULL),
(344, 'ITITDS27', 'IT149IU', '1', 1, NULL, NULL),
(345, 'ITITDS27', 'IT135IU', '1', 1, NULL, NULL),
(346, 'ITITDS27', 'IT154IU', '2', 1, NULL, NULL),
(347, 'ITITDS27', 'IT069IU', '2', 1, NULL, NULL),
(348, 'ITITDS27', 'IT079IU', '3', 1, NULL, NULL),
(349, 'ITITDS27', 'IT013IU', '3', 1, NULL, NULL),
(350, 'ITITDS27', 'IT140IU', '3', 1, NULL, NULL),
(351, 'ITITDS27', 'IT151IU', '3', 1, NULL, NULL),
(352, 'ITITDS27', 'IT136IU', '4', 0, NULL, NULL),
(353, 'ITITDS27', 'IT171IU', '4', 1, NULL, NULL),
(354, 'ITITDS27', 'IT159IU', '4', 1, NULL, NULL),
(355, 'ITITDS27', 'IT139IU', '5', 1, NULL, NULL),
(356, 'ITITDS27', 'IT137IU', '5', 0, NULL, NULL),
(357, 'ITITDS27', 'IT160IU', '5', 1, NULL, NULL),
(358, 'ITITDS27', 'IT138IU', '5', 1, NULL, NULL),
(359, 'ITITDS28', 'IT149IU', '1', 1, NULL, NULL),
(360, 'ITITDS28', 'IT135IU', '1', 1, NULL, NULL),
(361, 'ITITDS28', 'IT154IU', '2', 1, NULL, NULL),
(362, 'ITITDS28', 'IT069IU', '2', 1, NULL, NULL),
(363, 'ITITDS28', 'IT079IU', '3', 1, NULL, NULL),
(364, 'ITITDS28', 'IT013IU', '3', 1, NULL, NULL),
(365, 'ITITDS28', 'IT140IU', '3', 1, NULL, NULL),
(366, 'ITITDS28', 'IT151IU', '3', 0, NULL, NULL),
(367, 'ITITDS28', 'IT136IU', '4', 1, NULL, NULL),
(368, 'ITITDS28', 'IT171IU', '4', 1, NULL, NULL),
(369, 'ITITDS28', 'IT159IU', '4', 1, NULL, NULL),
(370, 'ITITDS28', 'IT139IU', '5', 1, NULL, NULL),
(371, 'ITITDS28', 'IT137IU', '5', 1, NULL, NULL),
(372, 'ITITDS28', 'IT160IU', '5', 0, NULL, NULL),
(373, 'ITITDS28', 'IT138IU', '5', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_preferences`
--

CREATE TABLE `student_preferences` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preferences` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_preferences`
--

INSERT INTO `student_preferences` (`id`, `student_id`, `preferences`, `created_at`, `updated_at`) VALUES
(42, 'ITITCE01', 'Python/R. ', '2025-04-07 06:08:49', '2025-04-07 06:08:49'),
(43, 'CS0118031', 'I like to learn about blocktrain. Python/R, PyCharm/Visual Studio. ', '2025-04-09 23:34:18', '2025-04-09 23:34:18'),
(44, 'CS0118031', 'i like to learn about blockchain. ', '2025-04-09 23:36:29', '2025-04-09 23:36:29'),
(45, 'CS0118031', 'Python/R. ', '2025-04-09 23:37:26', '2025-04-09 23:37:26'),
(46, 'CS0118031', 'Python or R. ', '2025-04-09 23:41:27', '2025-04-09 23:41:27'),
(47, 'CS0118031', 'Python or R. Build network protocols (TCP/IP, HTTP). ', '2025-04-09 23:41:45', '2025-04-09 23:41:45'),
(48, 'ITITCE01', 'I want to build an integrated business process management system that automates internal operations.. AWS or Google Cloud, SQL or NoSQL. Information systems management, business analysis, decision support systems. Design distributed systems (Cloud, Distributed Systems). Design software architecture (UML). I am passionate about information technology, aiming to develop a career in system administration and coordination in enterprises.. ', '2025-04-22 02:05:28', '2025-04-22 02:05:28'),
(49, 'ITITCE01', 'I want to build a business process management system that integrates automation of internal operations.. AWS or Google Cloud, SQL or NoSQL. Information system management, business process analysis, decision support systems. Design distributed systems (Cloud, Distributed Systems). Design software architecture (UML). I am passionate about IT and aim to build a career in enterprise system administration and coordination. ', '2025-04-25 01:54:02', '2025-04-25 01:54:02'),
(50, 'ITITCE01', 'I dream of creating a mobile application to track daily health metrics.. Python or R, PyCharm or Visual Studio. Mobile application development, object-oriented programming. Develop AR or VR applications. Develop cross-platform mobile applications. I want to become an expert in Android/iOS mobile app development.. ', '2025-04-25 01:56:09', '2025-04-25 01:56:09'),
(51, 'ITITCE01', 'I want to create an intuitive user interface for a project management software.. Unity or Unreal Engine, Wireshark or Postman. User interface design, HCI, user experience design. Develop AR or VR applications. Design software architecture (UML). I am passionate about UX design and aim to pursue a career in HCI.. ', '2025-04-25 01:57:44', '2025-04-25 01:57:44'),
(52, 'ITITCE01', 'I want to build a network security monitoring system for enterprises.. Wireshark or Postman, Docker or Kubernetes. Network security, system security, risk management. Implement virtual networks (VPN, IPSec). Debug and test software. I aim to specialize in IT security and cybersecurity.. ', '2025-04-25 01:59:35', '2025-04-25 01:59:35'),
(53, 'ITITCE01', 'I dream of creating an educational video game.. Python or R, Unity or Unreal Engine. Game development, object-oriented programming, player experience design. Develop AR or VR applications. Write image or graphics processing algorithms. I want to work in the gaming and digital entertainment industry.. ', '2025-04-25 02:07:23', '2025-04-25 02:07:23'),
(54, 'ITITCE01', 'I want to research and develop data mining algorithms for customer behavior analysis.. Python or R, SQL or NoSQL. Data mining, machine learning, data analysis. Build data mining algorithms. Debug and test software. I aim to become a data analytics specialist. ', '2025-04-25 02:08:59', '2025-04-25 02:08:59'),
(55, 'ITITCE01', 'I want to create a cloud system for parallel data processing for enterprises.. AWS or Google Cloud, Docker or Kubernetes. Cloud computing, DevOps, system administration. Design distributed systems (Cloud, Distributed Systems). Debug and test software. I am passionate about developing cloud solutions.. ', '2025-04-25 02:11:20', '2025-04-25 02:11:20'),
(56, 'ITITCE01', 'I plan to develop a professional image processing application.. Python or R, PyCharm or Visual Studio. Digital image processing, computer graphics, image data mining. Create data visualization dashboards (Tableau, Power BI). Write image or graphics processing algorithms. I want to pursue a career in image processing and graphics.. ', '2025-04-25 02:13:48', '2025-04-25 02:13:48'),
(57, 'ITITCE01', 'I dream of building project management software with automated reporting.. PyCharm or Visual Studio, SQL or NoSQL. Project management, object-oriented programming, information systems. Build data mining algorithms. Debug and test software. I want to work in IT project management.. ', '2025-04-25 02:15:10', '2025-04-25 02:15:10'),
(58, 'ITITCE01', 'I want to develop a communication application using advanced network protocols.. Wireshark or Postman, Docker or Kubernetes. Network programming, TCP/IP, network security. Implement virtual networks (VPN, IPSec). Build network protocols (TCP/IP, HTTP). I aim to pursue a career in network development and security.. ', '2025-04-25 02:18:45', '2025-04-25 02:18:45'),
(59, 'ITITCE01', 'I dream of a mobile app integrating AI to analyze user data.. Python or R, PyCharm or Visual Studio. Mobile application development, AI, machine learning. Build data mining algorithms. Develop cross-platform mobile applications. I plan to pursue a career in AI and mobile development.. ', '2025-04-25 02:20:38', '2025-04-25 02:20:38'),
(60, 'ITITCE01', 'I want to create software to forecast market trends via time series analysis.. Python or R, SQL or NoSQL. Time series analysis, forecasting, data analysis. Build data mining algorithms. Debug and test software. I aim for a career in business data research and analysis.. ', '2025-04-25 02:23:49', '2025-04-25 02:23:49'),
(61, 'ITITCE01', 'I dream of building optimization models to improve urban traffic flow.. Python or R, PyCharm or Visual Studio. Optimization, numerical methods, data analysis. Build data mining algorithms. Debug and test software. I plan to research urban optimization solutions.. ', '2025-04-25 02:25:04', '2025-04-25 02:25:04'),
(62, 'ITITCE01', 'I want to build a secure transaction system for banking.. Wireshark or Postman, Docker or Kubernetes. Network security, system security, software quality assurance. Implement virtual networks (VPN, IPSec). Debug and test software. I aim to specialize in information security for banking.. ', '2025-04-25 02:26:36', '2025-04-25 02:26:36'),
(63, 'ITITCE01', 'I dream of a tool to assist in designing software architecture diagrams.. PyCharm or Visual Studio, SQL or NoSQL. Software architecture, UML, project management. Design distributed systems (Cloud, Distributed Systems). Design software architecture (UML). I want to become a professional software architect. ', '2025-04-25 02:29:44', '2025-04-25 02:29:44'),
(64, 'ITITCE01', 'I want to develop a blockchain platform for supply chain transaction tracking.. Python or R, Docker or Kubernetes. Blockchain, network security, information systems. Build data mining algorithms. Debug and test software. I am passionate about blockchain technology in logistics.. ', '2025-04-25 02:31:34', '2025-04-25 02:31:34'),
(65, 'ITITCE01', 'I dream of a tool to manage and track IT project progress.. PyCharm or Visual Studio, SQL or NoSQL. Project management, information systems, business process analysis. Design distributed systems (Cloud, Distributed Systems). Design software architecture (UML). I plan to work in IT project management.. ', '2025-04-25 02:34:13', '2025-04-25 02:34:13'),
(66, 'ITITCE01', 'I want to create an educational mobile game.. Python or R, Unity or Unreal Engine. Game development, mobile apps, user experience design. Develop AR or VR applications. Develop cross-platform mobile applications. I aim for a career in educational gaming.. ', '2025-04-25 02:37:02', '2025-04-25 02:37:02'),
(67, 'ITITCE01', 'I want to build an NLP tool to support automated translation.. Python or R, PyCharm or Visual Studio. Natural language processing, machine learning, data analysis. Build data mining algorithms. Debug and test software. plan to work in AI and NLP. ', '2025-04-25 02:39:52', '2025-04-25 02:39:52'),
(68, 'ITITCE01', 'I want to develop a security monitoring app for large government systems.. Wireshark or Postman, Docker or Kubernetes. Network security, system security, network programming. Implement virtual networks (VPN, IPSec). Build network protocols (TCP/IP, HTTP). I aim to protect large-scale government IT systems.. ', '2025-04-25 02:42:05', '2025-04-25 02:42:05'),
(69, 'ITITCE01', 'I  want to build an automated software testing system to reduce bugs.. Python or R, PyCharm or Visual Studio. Software quality assurance, object-oriented programming, automation. Build data mining algorithms. Debug and test software. I want to become an expert in QA and test automation.. ', '2025-04-25 02:44:34', '2025-04-25 02:44:34'),
(70, 'ITITCE01', 'I dream of a mobile learning and quiz application.. PyCharm or Visual Studio, Unity or Unreal Engine. Mobile application development, HCI, educational gaming. Develop AR or VR applications. Develop cross-platform mobile applications. I want a career in e-learning and mobile development.. ', '2025-04-25 02:47:52', '2025-04-25 02:47:52'),
(71, 'ITITCE01', 'I dream of a healthcare data monitoring and analysis app to predict outbreaks.. Python or R, SQL or NoSQL. Data analysis, decision support systems, machine learning. Build data mining algorithms. Debug and test software. I aim to apply technology in healthcare research.. ', '2025-04-25 02:49:48', '2025-04-25 02:49:48'),
(72, 'ITITCE01', 'I want to build an integrated business process management system that automates internal operations.. AWS or Google Cloud, SQL or NoSQL. Information systems management, business analysis, decision support systems. Design distributed systems (Cloud, Distributed Systems). Design software architecture (UML). I am passionate about information technology, aiming to develop a career in system administration and coordination in enterprises. ', '2025-04-29 00:07:15', '2025-04-29 00:07:15');

-- --------------------------------------------------------

--
-- Table structure for table `student_registrations`
--

CREATE TABLE `student_registrations` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_registrations`
--

INSERT INTO `student_registrations` (`id`, `student_id`, `course_id`, `status`, `semester`, `created_at`, `updated_at`) VALUES
(17, 'DS0119001', 'IT150IU', 1, '2', '2025-03-30 03:01:02', '2025-03-30 03:01:02'),
(18, 'DS0119001', 'IT149IU', 1, '2', '2025-03-31 00:34:19', '2025-03-31 00:34:19'),
(24, 'ITITCE01', 'IT013IU', 1, '3', '2025-04-07 04:08:54', '2025-04-07 04:08:54'),
(25, 'ITITCE01', 'IT154IU', 1, '3', '2025-04-07 04:10:42', '2025-04-07 04:10:42'),
(26, 'ITITCE01', 'IT138IU', 1, '3', '2025-04-07 05:20:23', '2025-04-07 05:20:23'),
(27, 'ITITCS20', 'IT157IU', 1, '5', '2025-04-12 22:09:45', '2025-04-12 22:09:45'),
(28, 'ITITDS27', 'IT137IU', 1, '6', '2025-04-12 22:23:40', '2025-04-12 22:23:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_staff`
--
ALTER TABLE `academic_staff`
  ADD UNIQUE KEY `academic_staff_staff_id_unique` (`staff_id`),
  ADD UNIQUE KEY `academic_staff_email_unique` (`email`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD UNIQUE KEY `admins_admin_id_unique` (`admin_id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `courses_lecturer_id_foreign` (`lecturer_id`);

--
-- Indexes for table `course_major`
--
ALTER TABLE `course_major`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_major_course_id_foreign` (`course_id`),
  ADD KEY `course_major_major_id_foreign` (`major_id`);

--
-- Indexes for table `curriculum`
--
ALTER TABLE `curriculum`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `curriculum_curriculum_id_unique` (`curriculum_id`),
  ADD KEY `curriculum_major_id_foreign` (`major_id`),
  ADD KEY `curriculum_course_id_foreign` (`course_id`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`lecturer_id`);

--
-- Indexes for table `lecturer_courses`
--
ALTER TABLE `lecturer_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lecturer_courses_lecturer_id_foreign` (`lecturer_id`),
  ADD KEY `lecturer_courses_course_id_foreign` (`course_id`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`major_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prerequisites`
--
ALTER TABLE `prerequisites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prerequisites_course_id_foreign` (`course_id`),
  ADD KEY `prerequisites_prerequisite_course_id_foreign` (`prerequisite_course_id`),
  ADD KEY `prerequisites_major_id_foreign` (`major_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedules_course_id_foreign` (`course_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `semesters_semester_id_unique` (`semester_id`);

--
-- Indexes for table `semester_courses`
--
ALTER TABLE `semester_courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `semester_courses_semester_id_course_id_unique` (`semester_id`,`course_id`),
  ADD KEY `semester_courses_course_id_foreign` (`course_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `students_major_id_foreign` (`major_id`);

--
-- Indexes for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_courses_student_id_foreign` (`student_id`),
  ADD KEY `student_courses_course_id_foreign` (`course_id`);

--
-- Indexes for table `student_preferences`
--
ALTER TABLE `student_preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_registrations`
--
ALTER TABLE `student_registrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course_major`
--
ALTER TABLE `course_major`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `curriculum`
--
ALTER TABLE `curriculum`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lecturer_courses`
--
ALTER TABLE `lecturer_courses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `prerequisites`
--
ALTER TABLE `prerequisites`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `semester_courses`
--
ALTER TABLE `semester_courses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `student_courses`
--
ALTER TABLE `student_courses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=374;

--
-- AUTO_INCREMENT for table `student_preferences`
--
ALTER TABLE `student_preferences`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `student_registrations`
--
ALTER TABLE `student_registrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_lecturer_id_foreign` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`lecturer_id`) ON DELETE SET NULL;

--
-- Constraints for table `course_major`
--
ALTER TABLE `course_major`
  ADD CONSTRAINT `course_major_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_major_major_id_foreign` FOREIGN KEY (`major_id`) REFERENCES `majors` (`major_id`) ON DELETE CASCADE;

--
-- Constraints for table `curriculum`
--
ALTER TABLE `curriculum`
  ADD CONSTRAINT `curriculum_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `curriculum_major_id_foreign` FOREIGN KEY (`major_id`) REFERENCES `majors` (`major_id`) ON DELETE CASCADE;

--
-- Constraints for table `lecturer_courses`
--
ALTER TABLE `lecturer_courses`
  ADD CONSTRAINT `lecturer_courses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lecturer_courses_lecturer_id_foreign` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`lecturer_id`) ON DELETE CASCADE;

--
-- Constraints for table `prerequisites`
--
ALTER TABLE `prerequisites`
  ADD CONSTRAINT `prerequisites_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prerequisites_major_id_foreign` FOREIGN KEY (`major_id`) REFERENCES `majors` (`major_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prerequisites_prerequisite_course_id_foreign` FOREIGN KEY (`prerequisite_course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE;

--
-- Constraints for table `semester_courses`
--
ALTER TABLE `semester_courses`
  ADD CONSTRAINT `semester_courses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `semester_courses_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_major_id_foreign` FOREIGN KEY (`major_id`) REFERENCES `majors` (`major_id`) ON DELETE CASCADE;

--
-- Constraints for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD CONSTRAINT `student_courses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_courses_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
