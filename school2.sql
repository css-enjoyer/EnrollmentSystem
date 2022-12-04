CREATE DATABASE school;
USE school;

-- ---------- TABLE CREATION ----------

CREATE TABLE student_account(
    STU_ID INT NOT NULL AUTO_INCREMENT,
    ENRL_YEAR INT NOT NULL,
    STU_ACCT_PASSWORD VARCHAR(255) NOT NULL,
    PRIMARY KEY (STU_ID, ENRL_YEAR)
);
ALTER TABLE student_account AUTO_INCREMENT = 100;

-- for instructor login
CREATE TABLE instructor_account(
	INSTR_ID INT NOT NULL AUTO_INCREMENT,
    EMPL_YEAR INT NOT NULL,
    INSTR_ACCT_PASSWORD VARCHAR(255) NOT NULL,
    PRIMARY KEY (INSTR_ID, EMPL_YEAR)
);
ALTER TABLE instructor_account AUTO_INCREMENT = 500;

-- create department table
CREATE TABLE department(
	DEPT_ID INT NOT NULL AUTO_INCREMENT KEY,
    DEPT_NAME VARCHAR(10) NOT NULL,
    DEPT_DESC VARCHAR(255) NOT NULL,
    INSTR_ID INT NOT NULL -- department chair
    -- will get referenced later after instructors are available
	-- FOREIGN KEY (INSTR_ID) REFERENCES instructor(INSTR_ID)
);

CREATE TABLE specialization(
	SPEC_ID INT NOT NULL AUTO_INCREMENT KEY,
    SPEC_NAME VARCHAR(50) NOT NULL,
    SPEC_SECTION CHAR(1) NOT NULL,
    DEPT_ID INT NOT NULL,
    FOREIGN KEY (DEPT_ID) REFERENCES department(DEPT_ID)
);
ALTER TABLE specialization AUTO_INCREMENT = 50;

-- create student table
CREATE TABLE student(
	STU_ID INT NOT NULL, 
	ENRL_YEAR INT NOT NULL, 
    STU_FNAME VARCHAR(50) NOT NULL, 
    STU_MI VARCHAR(10) DEFAULT "N.M.I",
    STU_LNAME VARCHAR(50) NOT NULL,
    STU_BDAY DATE NOT NULL,
    STU_GENDER VARCHAR(20) NOT NULL,
    DEPT_ID INT NOT NULL,
    SPEC_ID INT NOT NULL,
    STU_EMAIL VARCHAR(255) NOT NULL,
    STU_TYPE VARCHAR (15) DEFAULT "Unenrolled",
    FOREIGN KEY (STU_ID, ENRL_YEAR) REFERENCES student_account(STU_ID, ENRL_YEAR),
    FOREIGN KEY (DEPT_ID) REFERENCES department(DEPT_ID),
    FOREIGN KEY (SPEC_ID) REFERENCES specialization(SPEC_ID),
    PRIMARY KEY (STU_EMAIL)
);


-- create instructor table
CREATE TABLE instructor(
	INSTR_ID INT NOT NULL, 
    EMPL_YEAR INT NOT NULL, 
    INSTR_FNAME VARCHAR(50) NOT NULL, 
    INSTR_MI VARCHAR(10) DEFAULT "N.M.I",
    INSTR_LNAME VARCHAR(50) NOT NULL,
    INSTR_BDAY DATE NOT NULL,
    INSTR_GENDER VARCHAR(20) NOT NULL,
    DEPT_ID INT NOT NULL,
    INSTR_EMAIL VARCHAR(255) NOT NULL,
	FOREIGN KEY (INSTR_ID, EMPL_YEAR) REFERENCES instructor_account(INSTR_ID, EMPL_YEAR), 
    FOREIGN KEY (DEPT_ID) REFERENCES department(DEPT_ID),
    PRIMARY KEY (INSTR_EMAIL)
);


-- for student login 
-- CREATE TABLE student_account(
-- 	STU_ACCT_ID INT NOT NULL, -- 2022100
--     STU_ACCT_PASSWORD VARCHAR(255) NOT NULL,
-- 	STU_ID INT NOT NULL, -- 100
--     ENRL_YEAR INT NOT NULL, -- 2022
--     PRIMARY KEY (STU_ACCT_ID),
--     FOREIGN KEY (STU_ID, ENRL_YEAR) REFERENCES student(STU_ID, ENRL_YEAR)
-- );





-- create course table
CREATE TABLE course(
	CRS_ID INT NOT NULL AUTO_INCREMENT KEY,
    CRS_NAME VARCHAR(10) NOT NULL, 
    CRS_DESC VARCHAR(255) NOT NULL, 
    CRS_LEVEL INT NOT NULL, 
    CRS_UNIT INT NOT NULL,
    DEPT_ID INT NOT NULL,
    FOREIGN KEY (DEPT_ID) REFERENCES department(DEPT_ID)
);
ALTER TABLE course AUTO_INCREMENT = 1000;

-- create class table
CREATE TABLE class(
	CLASS_ID INT NOT NULL AUTO_INCREMENT KEY,
	CLASS_SECTION CHAR(1) NOT NULL,
    CRS_ID INT NOT NULL,
    INSTR_ID INT NOT NULL,
    EMPL_YEAR INT NOT NULL,
    FOREIGN KEY (CRS_ID) REFERENCES course(CRS_ID),
    FOREIGN KEY (INSTR_ID, EMPL_YEAR) REFERENCES instructor(INSTR_ID, EMPL_YEAR)
);
ALTER TABLE class AUTO_INCREMENT = 2000;

-- create enrollment table
CREATE TABLE enrollment(
	ENRL_ID INT NOT NULL AUTO_INCREMENT KEY,
	STU_ID INT NOT NULL, 
    ENRL_YEAR INT NOT NULL, 
    CLASS_ID INT NOT NULL,
    ENRL_DATE DATE DEFAULT (CURRENT_DATE),
    FOREIGN KEY(STU_ID, ENRL_YEAR) REFERENCES student_account(STU_ID, ENRL_YEAR),
    FOREIGN KEY(CLASS_ID) REFERENCES class(CLASS_ID)
);
ALTER TABLE enrollment AUTO_INCREMENT = 10000;

-- ---------- INSERTING DATA ----------

INSERT INTO department(DEPT_NAME, DEPT_DESC, INSTR_ID)
	VALUES ("CS", "Computer Science", 505),
    ("IT", "Information Technology", 501),
    ("IS", "Information Systems", 502),
    ("TS", "Theologian Studies", 507),
    ("CYPE", "Human Enhancement", 508),
    ("ECS", "Ecological Science", 509),
    ("MDY", "Media Dynamics", 510),
    ("ICS", "Information and Computing Sciences", 504);


INSERT INTO specialization(SPEC_NAME, SPEC_SECTION, DEPT_ID)
	VALUES ("Core Computer Science", "A", 1),
    ("Game Development", "B", 1),
    ("Data Science", "C", 1),
    ("Network and Security", "A", 2),
    ("Web and Mobile App Development", "B", 2),
    ("IT Automation", "C", 3),
    ("Business Analytics", "A", 1),
    ("Service Management", "B", 2);

INSERT INTO student_account(ENRL_YEAR, STU_ACCT_PASSWORD) 
	VALUES (2022, "pw"),
    (2021, "pw"),
    (2020, "pw"),
    (2021, "pw"),
    (2022, "pw");
    -- (2022, "pw");
    
INSERT INTO instructor_account(EMPL_YEAR, INSTR_ACCT_PASSWORD)
	VALUES (2010, "pw"),
    (2011, "pw"),
    (2013, "pw"),
    (2012, "pw"),
    (2012, "pw"),
    (2010, "pw"),
    (2011, "pw"),
    (2014, "pw"),
    (2016, "pw"),
    (2015, "pw"),
    (2017, "pw");

-- insert student data
INSERT INTO student(STU_ID, ENRL_YEAR, STU_FNAME, STU_MI, STU_LNAME, STU_BDAY, STU_GENDER, DEPT_ID, SPEC_ID, STU_EMAIL)
	VALUES (100, 2022, "Kendrick", "L", "Duckworth", "1987-06-17", "Male", 1, 51, "sitDownBtch.cics@ust.humble"),
    (101, 2021, "Jermaine", "L", "Cole", "1985-01-28", "Male", 3, 57, "getOffMyD.cics@ust.dreamville"),
    (102, 2020, "Kanye", "O", "West", "1977-06-08", "Male", 1, 53, "yeezus.cics@ust.edu.calabasas"),
    (103, 2021, "Aubrey", "D", "Graham", "1986-10-24", "Male", 1, 52, "certifiedTeuBoi.cics@ust.knifetalk"),
    (104, 2022, "Gazzy", "Z", "Garcia", "2000-08-17", "Male", 2, 54, "skrrt.prrrt.cics@ust.iluvit");
    -- (105, 2022, 'John', 'A', 'Smith', '2022-12-04', 'Male', 1, 55, 'js@gmail.com');

INSERT INTO instructor(INSTR_ID, EMPL_YEAR, INSTR_FNAME, INSTR_MI, INSTR_LNAME, INSTR_BDAY, INSTR_GENDER, DEPT_ID, INSTR_EMAIL)
	VALUES (500, 2010, "Janette", "Z", "Sideno", "1973-07-15", "Female", 2, "janette.sideno.cics@ust.edu.ph"),
    (501, 2011, "Perla", "Y", "Cosme", "1970-05-23", "Female", 2, "perla.cosme.cics@ust.edu.ph"),
    (502, 2013, "Darlene", "W", "Alberto", "1971-11-03", "Female", 3, "darlene.alberto.cics@ust.edu.ph"),
    (503, 2012, "Francis", "X", "Alarcon", "1990-03-11", "Male", 3, "francis.alarcon.cics@ust.edu.ph"),
    (504, 2012, "Lawrence", "G", "Decamora", "1975-10-19", "Male", 1, "lawrence.decamora.cics@ust.edu.ph"),
    (505, 2010, "Jonathan", "A", "Cabero", "1970-01-30", "Male", 1, "jonathan.cabero.cics@ust.edu.ph"),
    (506, 2011, "Cecil", "B", "Delfinado", "1978-08-17", "Male", 1, "cecil.delfinado.cics@ust.edu.ph"), 
    (507, 2014, "Sarah", "C", "Ortiz", "1975-07-08", "Female", 4, "sarah.ortiz..cics@ust.edu.ph"),
    (508, 2016, "Resty", "D", "Oliveros", "1993-05-11", "Male", 5, "resty.oliveros.cics@ust.edu.ph"),
    (509, 2015, "Sarah", "E", "Zamudio", "1980-12-10", "Female", 6, "sarah.zamudio.cics@ust.edu.ph"),
    (510, 2017, "Lawdenmarc", "F", "Decamora", "1981-07-09", "Male", 7, "lawdenmarc.decamora.cics@ust.edu.ph");
-- add foreign key to department since instructor is now available
ALTER TABLE department ADD CONSTRAINT FOREIGN KEY (INSTR_ID) REFERENCES instructor(INSTR_ID);

INSERT INTO course(CRS_NAME, CRS_DESC, CRS_LEVEL, CRS_UNIT, DEPT_ID)
	VALUES ("ICS 2602", "Computer Programming I", 1, 5, 8),
    ("ICS 2606", "Computer Programming II", 1, 4, 8),
    ("CS 2612", "Human-Computer Interaction", 1, 2, 1),
    ("CS 2613", "Logic and Digital Circuits Design", 1, 2, 1),
    ("ICS 2607", "Information Management", 2, 4, 8),
    ("ICS 2608", "Applications Development and Emerging Technologies I", 2, 3, 8),
    ("CS 2614", "College Calculus for Computing Sciences", 2, 3, 1),
    ("CS 2615", "Design and Analysis of Algorithms", 2, 3, 1),
    ("CS 2616", "Theory of Automata", 2, 3, 1),
    ("THY 3", "Christian Vision of the Church in Society", 2, 3, 4),
    ("PATH-FIT", "Fitness Exercises for Specific Sports", 2, 3, 5),
    ("ELE ES", "Environmental Science", 2, 3, 6),
    ("ELE SMD", "Social Media Dynamics", 2, 3, 7);

-- each course is available to all sections(A, B, C)
INSERT INTO class(CLASS_SECTION, CRS_ID, INSTR_ID, EMPL_YEAR)
	VALUES ("A", 1000, 500, 2010),
    ("B", 1001, 500, 2010),
    ("C", 1002, 501, 2011),
    ("A", 1003, 502, 2013),
    ("B", 1004, 503, 2012),
    ("C", 1005, 504, 2012),
    ("A", 1006, 505, 2010),
    ("B", 1007, 506, 2011),
    ("C", 1008, 506, 2011),
    ("A", 1009, 507, 2014),
    ("B", 1010, 508, 2016),
    ("C", 1011, 509, 2015),
    ("A", 1012, 510, 2017);
    
-- the student can enroll to the available classes, his selection may be filtered by the his section based on his specialization
INSERT INTO enrollment(STU_ID, ENRL_YEAR, CLASS_ID)
	VALUES (100, 2022, 2000),
	(100, 2022, 2001),
    (100, 2022, 2002),
    (100, 2022, 2003),
    (100, 2022, 2004),
    (100, 2022, 2005),
    
    
    (101, 2021, 2002),
    (101, 2021, 2003),
    (102, 2020, 2004),
    (102, 2020, 2005);

-- SELECT * FROM student_account AS sa
-- 	INNER JOIN student AS s
-- 		ON sa.STU_ID = s.STU_ID;
--         
-- SELECT * FROM student WHERE STU_ID = 100 AND ENRL_YEAR = 2022;

SELECT * FROM student AS s
	INNER JOIN enrollment AS e
		ON s.STU_ID = e.STU_ID AND s.ENRL_YEAR = e.ENRL_YEAR
	INNER JOIN class AS c
		ON e.CLASS_ID = c.CLASS_ID
	INNER JOIN course AS co
		ON c.CRS_ID = co.CRS_ID
	INNER JOIN instructor AS i
		ON c.INSTR_ID = i.INSTR_ID
	INNER JOIN department AS d
		ON s.DEPT_ID = d.DEPT_ID
	INNER JOIN specialization AS sp
		ON s.SPEC_ID = sp.SPEC_ID
			WHERE s.STU_ID = 100 AND e.ENRL_YEAR = 2022;
            
SELECT * FROM student AS s
	INNER JOIN enrollment AS e
		ON s.STU_ID = e.STU_ID AND s.ENRL_YEAR = e.ENRL_YEAR
	INNER JOIN class AS c
		ON e.CLASS_ID = c.CLASS_ID
	INNER JOIN course AS co
		ON c.CRS_ID = co.CRS_ID
	INNER JOIN instructor AS i
		ON c.INSTR_ID = i.INSTR_ID
			WHERE s.STU_ID = 100 AND e.ENRL_YEAR = 2022;
            
SELECT * FROM student AS s
	INNER JOIN department AS d
		ON s.DEPT_ID = d.DEPT_ID
	INNER JOIN specialization AS sp
		ON s.SPEC_ID = sp.SPEC_ID
			WHERE s.STU_ID = 100 AND s.ENRL_YEAR = 2022;
            


-- SELECT * FROM enrollment as e
-- INNER JOIN class as cl
-- ON e.CLASS_ID = cl.CLASS_ID
-- INNER JOIN student as s
-- ON s.STU_ID = e.STU_ID
-- LEFT
-- WHERE ;

SELECT * FROM student AS s
INNER JOIN enrollment AS e
ON s.STU_ID = e.STU_ID
INNER JOIN class AS c
WHERE s.STU_ID = 100;

SELECT * FROM ENROLLMENT WHERE STU_ID = 100;
