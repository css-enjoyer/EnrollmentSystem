CREATE DATABASE school;
USE school;


-- TABLE INIT --


CREATE TABLE student (
    STU_ID INT NOT NULL AUTO_INCREMENT, 
    STU_FNAME VARCHAR (50) NOT NULL,
    STU_MI VARCHAR(10) DEFAULT "N/A", 
    STU_LNAME VARCHAR(50) NOT NULL, 
    STU_GENDER VARCHAR(10) NOT NULL,
    STU_BDAY DATE NOT NULL,
    STU_PASSWORD VARCHAR(255) NOT NULL,

    -- EDITABLE DETAILS
    STU_ADDRESS VARCHAR(255) NOT NULL,
    STU_CONTACT VARCHAR(11) DEFAULT "N/A",
    STU_TYPE VARCHAR(10) DEFAULT "N/A",
    STU_EMAIL VARCHAR(255) NOT NULL UNIQUE,

    -- KEYS
    PRIMARY KEY (STU_ID)
);
ALTER TABLE student AUTO_INCREMENT = 1000;


CREATE TABLE instructor (
    INSTR_ID INT NOT NULL AUTO_INCREMENT, 
    INSTR_FNAME VARCHAR (50) NOT NULL,
    INSTR_MI VARCHAR(10) DEFAULT "N/A", 
    INSTR_LNAME VARCHAR(50) NOT NULL, 
    INSTR_GENDER VARCHAR(10) NOT NULL, 
    INSTR_BDAY DATE NOT NULL,
    INSTR_PASSWORD VARCHAR(255) NOT NULL,

    -- EDITABLE DETAILS
    INSTR_ADDRESS VARCHAR(255) NOT NULL,
    INSTR_CONTACT VARCHAR(11) DEFAULT "N/A",
    INSTR_EMAIL VARCHAR(255) NOT NULL UNIQUE,

    -- KEYS
    PRIMARY KEY (INSTR_ID)
);
ALTER TABLE instructor AUTO_INCREMENT = 6000;


CREATE TABLE course (
    CRS_ID INT NOT NULL AUTO_INCREMENT,
    CRS_NAME VARCHAR(255) NOT NULL,
    CRS_UNIT INT NOT NULL,

    -- CONNECTING ATT'S
    INSTR_ID INT NOT NULL,

    -- KEYS
    PRIMARY KEY (CRS_ID),
    FOREIGN KEY (INSTR_ID) REFERENCES instructor (INSTR_ID)
);
ALTER TABLE course AUTO_INCREMENT = 100;


CREATE TABLE enrollment (
    ENRL_ID INT NOT NULL AUTO_INCREMENT,
    
    -- CONNECTING ATT'S
    STU_ID INT NOT NULL,
    CRS_ID INT NOT NULL,

    -- KEYS
    PRIMARY KEY (ENRL_ID),
    FOREIGN KEY (STU_ID) REFERENCES student (STU_ID),
    FOREIGN KEY (CRS_ID) REFERENCES course (CRS_ID)
);


-- DATA INSERTION --


INSERT INTO 
    student (STU_FNAME, STU_MI, STU_LNAME, STU_GENDER, STU_BDAY, STU_PASSWORD,
             STU_ADDRESS, STU_CONTACT, STU_EMAIL)
	VALUES 
		("Harvey", "C", "Normanbloom", "Male", "1995-04-12", "pw",
		 "17 Charming St", "09991678012", "harvey@gmail.com"),
		("Rosalita", "B", "Diaz", "Female", "1990-08-25", "pw",
		 "99 Washington St", "09214678912", "rosa@gmail.com"),
		("Speed", "J", "Yeet", "Male", "2007-12-25", "pw",
		 "30 Novuhley St", "09153288011", "speed@gmail.com"),
		("Raymond", "J", "Holt", "Male", "2000-10-17", "pw",
		 "10 Stoic St", "09178985343", "raymond@gmail.com"),
		("Shego", "G", "Xavier", "Female", "2002-07-08", "pw",
		 "21 Goth St", "09186661324", "shego@gmail.com");
    

INSERT INTO 
    instructor (INSTR_FNAME, INSTR_MI, INSTR_LNAME, INSTR_GENDER, INSTR_BDAY, INSTR_PASSWORD,
               INSTR_ADDRESS, INSTR_CONTACT, INSTR_EMAIL)
	VALUES 
		("Janette", "Z", "Sideno", "Female", "1973-07-15", "pw",
		 "101 John St.", "09108700012", "janette.sideno.cics@ust.edu.ph"),
		("Perla", "Y", "Cosme", "Female", "1970-05-23", "pw",
		 "201 Paul St.", "09108710112", "perla.cosme.cics@ust.edu.ph"),
		("Darlene", "W", "Alberto", "Female", "1971-11-03", "pw",
		 "301 Peter St.", "09108812312", "darlene.alberto.cics@ust.edu.ph"),
		("Francis", "X", "Alarcon", "Male", "1990-03-11", "pw",
		 "401 Miami St.", "09104412312", "francis.alarcon.cics@ust.edu.ph"),
		("Lawrence", "G", "Decamora", "Male", "1975-10-19", "pw",
		 "501 Chicago St.", "09105512312", "lawrence.decamora.cics@ust.edu.ph"),
		("Jonathan", "A", "Cabero", "Male", "1970-01-30", "pw",
		 "601 Angeles St.", "09125512312", "jonathan.cabero.cics@ust.edu.ph"),
		("Cecil", "B", "Delfinado", "Male", "1978-08-17", "pw",
		 "701 Tekken St.", "09155512312", "cecil.delfinado.cics@ust.edu.ph"),
		("Sarah", "C", "Ortiz", "Female", "1975-07-08", "pw",
		 "801 Genesis St.", "09161123123", "sarah.ortiz.cics@ust.edu.ph"),
		("Resty", "D", "Oliveros", "Male", "1993-05-11", "pw",
		 "901 Stallone St.", "09871312312", "resty.oliveros.cics@ust.edu.ph"),
		("Sarah", "E", "Zamudio", "Female", "1980-12-10", "pw",
		 "1001 Enearth St.", "09191312312", "sarah.zamudio.cics@ust.edu.ph"),
		("Lawdenmarc", "F", "Decamora", "Male", "1981-07-09", "pw",
		 "2001 Baker St.", "09281312312", "lawdenmarc.decamora.cics@ust.edu.ph");


INSERT INTO 
    course (CRS_NAME, CRS_UNIT, INSTR_ID)
	VALUES 
		("Computer Programming I", 5, 6000),
		("Computer Programming II", 4, 6004),
		("Human-Computer Interaction", 2, 6001),
		("Logic and Digital Circuits Design", 2, 6002),
		("Information Management", 4, 6003),
		("Applications Development and Emerging Technologies I", 3, 6004),
		("College Calculus for Computing Sciences", 3, 6005),
		("Design and Analysis of Algorithms", 3, 6006),
		("Theory of Automata", 3, 6006),
		("Christian Vision of the Church in Society", 3, 6007),
		("Fitness Exercises for Specific Sports", 3, 6008),
		("Environmental Science", 3, 6009),
		("Social Media Dynamics", 3, 6010);
        

INSERT INTO 
    enrollment (STU_ID, CRS_ID)
VALUES
    (1000, 100),
    (1000, 101),
    (1000, 102),
    (1000, 103),
    (1000, 109),
    (1000, 110),
    
    (1001, 100),
    (1001, 101),
    (1001, 102),
    (1001, 103),
    (1001, 109),
    (1001, 110),
    
    (1002, 100),
    (1002, 101),
    (1002, 102),
    (1002, 103),
    (1002, 109),
    (1002, 110),
    
    (1003, 104),
    (1003, 105),
    (1003, 106),
    (1003, 107),
    (1003, 108),
    (1003, 109),
    (1003, 110),
    (1003, 111),
    
    (1004, 104),
    (1004, 105),
    (1004, 106),
    (1004, 107),
    (1004, 108),
    (1004, 109),
    (1004, 110),
    (1004, 111);
    

-- CHECKING
SELECT * FROM student;
SELECT * FROM instructor;
SELECT * FROM course;
SELECT * FROM enrollment;


-- STUDENT VIEW --


-- PROFILE
SELECT 
	s.STU_ID AS "STUDENT ID", 
    CONCAT(s.STU_LNAME, ", ", s.STU_FNAME, " ", s.STU_MI) AS "NAME",
    s.STU_GENDER AS "GENDER",
    s.STU_BDAY AS "BIRTHDAY",
    s.STU_CONTACT AS "CONTACT NO.",
    s.STU_EMAIL AS "PERSONAL EMAIL",
    s.STU_ADDRESS AS "ADDRESS",
    s.STU_TYPE AS "STUDENT TYPE"
FROM 
	student AS s
WHERE
	-- REPLACE W/ $STU_ID
	s.STU_ID = 1000;


-- ENROLLED COURSES
SELECT 
    c.CRS_NAME AS "COURSE NAME", 
    c.CRS_UNIT AS "UNITS", 
    CONCAT(i.INSTR_LNAME, ", ", i.INSTR_FNAME, " ", i.INSTR_MI) AS "INSTRUCTOR"
FROM enrollment AS e
	INNER JOIN 
		course AS c
	ON 
		e.CRS_ID = c.CRS_ID
	INNER JOIN
		instructor AS i
	ON
		c.INSTR_ID = i.INSTR_ID
WHERE 
	-- REPLACE W/ $STU_ID
	STU_ID = 1002
        
-- UNENROLLED COURSES
SELECT DISTINCT
    c.CRS_NAME AS "COURSE NAME", 
    c.CRS_UNIT AS "UNITS", 
    CONCAT(i.INSTR_LNAME, ", ", i.INSTR_FNAME, " ", i.INSTR_MI) AS "INSTRUCTOR"
FROM course AS c
	INNER JOIN 
		enrollment AS e
	ON 
		c.CRS_ID = e.CRS_ID
	INNER JOIN
		instructor AS i
	ON c.INSTR_ID = i.INSTR_ID
    INNER JOIN
		student AS s
	ON e.STU_ID = s.STU_ID
WHERE 
	c.CRS_ID NOT IN (SELECT c.CRS_ID FROM course AS c 
    INNER JOIN enrollment AS e 
    ON c.CRS_ID = e.CRS_ID 
    INNER JOIN student AS s 
    ON e.STU_ID = s.STU_ID
    WHERE s.STU_ID = 1002);
        
-- INSTRUCTOR VIEW --


-- PROFILE
SELECT 
	i.INSTR_ID AS "INSTRUCTOR ID",
    CONCAT(i.INSTR_LNAME, ", ", i.INSTR_FNAME, " ", i.INSTR_MI) AS "NAME",
    i.INSTR_GENDER AS "GENDER",
    i.INSTR_BDAY AS "BIRTHDATE",
    i.INSTR_CONTACT AS "CONTACT NO.",
    i.INSTR_EMAIL AS "EMAIL",
    i.INSTR_ADDRESS AS "ADDRESS"
    -- Add DEPARTMENT table (?)
FROM
	instructor AS i
WHERE 
	-- REPLACE WITH $INSTR_ID.
	INSTR_ID = 6006;

-- CURRENT STUDENTS
SELECT 
	CONCAT(s.STU_FNAME, ", ", s.STU_FNAME, " ", s.STU_MI) AS "STUDENT NAME",
	c.CRS_NAME AS "COURSE NAME",
    c.CRS_UNIT AS "UNITS"
FROM enrollment AS e
	INNER JOIN 
		student AS s
	ON
		e.STU_ID = s.STU_ID
	INNER JOIN
		course AS c
	ON 
		e.CRS_ID = c.CRS_ID
WHERE 
	-- REPLACE WITH $INSTR_ID.
	INSTR_ID = 6006;
    
    
-- ADMIN VIEW -- 


-- Student Table
SELECT * FROM student;

-- Instructor Table
SELECT * FROM instructor;

-- Course Table
SELECT * FROM school.course;

-- Enrollment Table
SELECT * FROM enrollment;