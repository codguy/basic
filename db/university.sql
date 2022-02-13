DROP TABLE IF EXISTS tbl_test_user;
CREATE TABLE IF NOT EXISTS tbl_test_user (
    id INT(20) NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    roll_id int(2) NOT NULL,
    dob DATE,
    created_on DATETIME,
    created_by_id int(2),
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS tbl_test_dept;
CREATE TABLE IF NOT EXISTS tbl_test_dept (
    id INT(20) NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    created_on DATETIME NOT NULL,
    created_by_id int(2),
    PRIMARY KEY (id),
    CONSTRAINT tbl_test_user FOREIGN KEY (created_by_id)
    REFERENCES tbl_test_user (id)
);

DROP TABLE IF EXISTS tbl_test_course;
CREATE TABLE IF NOT EXISTS tbl_test_course (
    id INT(20) NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    dept int(20) NOT NULL,
    duration smallint NOT NULL,
    fee int(20) NOT NULL,
    created_on DATETIME NOT NULL,
    created_by_id int(2),
    PRIMARY KEY (id),
    FOREIGN KEY (dept) REFERENCES tbl_test_dept (id),
    FOREIGN KEY (created_by_id) REFERENCES tbl_test_user (id)
);

DROP TABLE IF EXISTS tbl_test_subject;
CREATE TABLE IF NOT EXISTS tbl_test_subject (
    id INT(20) NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    credits smallint NOT NULL,
    course INT(20) NOT NULL,
    sub_code VARCHAR(50) NOT NULL UNIQUE,
    created_on DATETIME NOT NULL,
    created_by_id int(2),
    PRIMARY KEY (id),
    FOREIGN KEY (course) REFERENCES tbl_test_course (id),
    FOREIGN KEY (created_by_id) REFERENCES tbl_test_user (id)
);

DROP TABLE IF EXISTS tbl_test_student;
CREATE TABLE IF NOT EXISTS tbl_test_student (
    id INT(20) NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    dept int(20) NOT NULL,
    course int(20) NOT NULL,
    address VARCHAR(50) NOT NULL,
    father VARCHAR(50),
    mother VARCHAR(50),
    roll_no int(10),
    phone_no int(10),
    section char(3),
    cgpa smallint(2),
    created_on DATETIME NOT NULL,
    created_by_id int(2),
    PRIMARY KEY (id),
    FOREIGN KEY (course) REFERENCES tbl_test_course (id),
    FOREIGN KEY (dept) REFERENCES tbl_test_dept (id),
    FOREIGN KEY (created_by_id) REFERENCES tbl_test_user (id)
);


DROP TABLE IF EXISTS tbl_test_mark;
CREATE TABLE IF NOT EXISTS tbl_test_mark (
    id INT(20) NOT NULL AUTO_INCREMENT,
    student int(20) NOT NULL, 
    subject INT(20) NOT NULL,
    mark VARCHAR(50) NOT NULL,
    total VARCHAR(50) NOT NULL,
    sub_code int(20) NOT NULL,
    created_on DATETIME NOT NULL,
    created_by_id int(2),
    PRIMARY KEY (id),
    FOREIGN KEY (subject) REFERENCES tbl_test_subject (id),
    FOREIGN KEY (student) REFERENCES tbl_test_student (id),
    FOREIGN KEY (created_by_id) REFERENCES tbl_test_user (id)
);

INSERT INTO tbl_user ('name','email','password','roll_id','dob') VALUES ('admin','admin@123.com','admin@123',1,DATE);