create schema STUDENT_CARE;
use STUDENT_CARE;

create table STUDENT (
    ID char(7),
    Name varchar(55) not null,
    Address varchar(64),
    Sex char(4),
    DoB date not null,
    primary key (ID)
);

create table STUDENT_UNDER_18 (
    ID char(7),
    primary key (ID),
    foreign key (ID) references STUDENT(ID) on delete cascade on update cascade
);

create table STUDENT_FROM_18 (
    ID char(7),
    Phone char(10),
    Email char(32),
    primary key (ID),
    foreign key (ID) references STUDENT(ID) on delete cascade on update cascade
);

create table GUARDIAN (
    StudentID char(7),
    Name varchar(55),
    Relationship char(10) not null,
    Phone char(10),
    Email char(32),
    primary key (StudentID, Name),
    foreign key (StudentID) references STUDENT_UNDER_18(ID) 
                on delete cascade on update cascade
);

create table BRANCH (
    Number int, 
    Address char(64) not null,
    primary key (Number)
);

create table CLASSROOM (
    BNum int,
    Name varchar(25),
    Capacity int,
    Building varchar(25) not null,
    Floor char(10) not null,
    primary key (BNum, Name),
    foreign key (BNum) references BRANCH(Number) on delete cascade on update cascade
);

create table COURSE (
    CID char(15),
    Tuition decimal(10) not null,
    Level char(20) not null,
    Duration int not null,
    StartDate date,
    CTime time,
    primary key (CID)
);

create table EMPLOYEE (
    EID char(7),
    Name varchar(55) not null,
    DoB date not null,
    Address varchar(64),
    Sex char(4),
    Job char(25) not null,
    Phone char(10),
    Email char(32),
    primary key (EID)
);

create table MANAGER ( 
    ID char(7),
    primary key (ID),
    foreign key (ID) references EMPLOYEE(EID) on delete cascade on update cascade
);

create table COURSE_MNG ( 
    ID char(7),
    primary key (ID),
    foreign key (ID) references MANAGER(ID) on delete cascade on update cascade
);

create table BRANCH_MNG ( 
    ID char(7),
    primary key (ID),
    foreign key (ID) references MANAGER(ID) on delete cascade on update cascade
);

create table STUDENT_CARE (
    ID char(7),
    primary key (ID),
    foreign key (ID) references EMPLOYEE(EID) on delete cascade on update cascade
);

create table TEACHER (
    ID char(7),
    Type varchar(25),
    primary key (ID),
    foreign key (ID) references EMPLOYEE(EID) on delete cascade on update cascade,
    check( Type = 'Trong nuoc' or  Type = 'Ngoai nuoc')
);

create table REQUEST (
    RID int auto_increment,
    CID char(15) not null,
    StudentID char(7) not null,
    Time time not null,
    Content varchar(256),
    Status varchar(15),
    primary key (RID),
    unique (CID, StudentID, Time),
    foreign key (CID) references COURSE(CID)
		on delete cascade on update cascade,
    foreign key (StudentID) references STUDENT(ID)
		on delete cascade on update cascade
);

alter table BRANCH
add (
    MNGID char(7) unique, 
    foreign key (MNGID) references BRANCH_MNG(ID) on update cascade
);

alter table COURSE
add (
    MNGID char(7) not null,
    foreign key (MNGID) references COURSE_MNG(ID) on update cascade
);

alter table EMPLOYEE
add (
    Branch int not null,
    foreign key (Branch) references BRANCH(Number) on update cascade
);

alter table REQUEST
add (
    Approver char(7), 
    foreign key (Approver) references COURSE_MNG(ID) on update cascade
);

create table LearningDate (
    CID char(15),
    Date varchar(10),
    primary key (CID, Date),
    foreign key (CID) references COURSE(CID) on delete cascade on update cascade,
    check (Date = 'Thu 2' or Date = 'Thu 3' or Date = 'Thu 4' or Date = 'Thu 5' or 
			Date = 'Thu 6' or Date = 'Thu 7'or Date = 'Chu nhat')
);

create table ContactStudentUnder18 (
    SCID char(7),
    StudentID char(7),	
    GuardianName varchar(55),
    primary key (SCID, StudentID, GuardianName),
    foreign key (SCID) references STUDENT_CARE(ID) on delete cascade on update cascade,
    foreign key (StudentID, GuardianName) references GUARDIAN(StudentID, Name)
	       on delete cascade on update cascade
);

create table ContactRecordOfUnder18Student(
    SCID char(7),
    StudentID char(7),
    GuardianName varchar(55),
    ContactTime Datetime,
    Content varchar(256),
    primary key (SCID, StudentID, GuardianName, ContactTime, Content),
    foreign key (SCID, StudentID, GuardianName) references 
                ContactStudentUnder18(SCID, StudentID, GuardianName) 
                on delete cascade on update cascade
);

create table ContactStudentFrom18 (
    SCID char(7),
    StudentID char(7),
    primary key (SCID, StudentID),
    foreign key (SCID) references STUDENT_CARE(ID)
            on delete cascade on update cascade,
    foreign key (StudentID) references STUDENT(ID) 
            on delete cascade on update cascade
);

create table ContactRecordOfFrom18Student (
    SCID char(7),
    StudentID char(7),
    ContactTime Datetime,
    Content varchar(256),
    primary key (SCID, StudentID, ContactTime, Content),
    foreign key (SCID, StudentID) references ContactStudentFrom18(SCID, StudentID) 
				on delete cascade on update cascade
);

create table Teach (
    TID char(7),
    CID char(15),
    primary key (TID, CID),
    foreign key (TID) references TEACHER(ID)
		on delete cascade on update cascade,
    foreign key (CID) references COURSE(CID)
		on delete cascade on update cascade
);

create table Learn (
    CID char(15),
    StudentID char(7),
    TuitionStatus bool,
    primary key (CID, StudentID),
    foreign key (CID) references COURSE(CID) 
		on delete cascade on update cascade,
    foreign key (StudentID) references STUDENT(ID)
		on delete cascade on update cascade
);

create table StudentResult (
    CID char(15),
    StudentID char(7),
    Mark decimal(3,1),
    Comment varchar(256),
    primary key (CID, StudentID, Mark, Comment),
    foreign key (CID, StudentID) references Learn(CID, StudentID)
		on delete cascade on update cascade
);

create table RateCourse (
    CID char(15),
    StudentID char(7),
    Rate varchar(256) not null,
    primary key (CID, StudentID),
    foreign key (CID) references COURSE(CID)
		on delete cascade on update cascade,
    foreign key (StudentID) references STUDENT(ID)
		on delete cascade on update cascade
);
    
create table RateTeacher (
    TID char(7),
    CID char(15),
    StudentID char(7),
    Morale int not null,
    Listening int not null,
    Speaking int not null,
    Reading int not null,
    Writing int not null,
    primary key (TID, CID, StudentID),
    foreign key (TID) references TEACHER(ID) on delete cascade on update cascade,
    foreign key (CID) references COURSE(CID) on delete cascade on update cascade,
    foreign key (StudentID) references STUDENT(ID) on delete cascade on update cascade,
    check ( Morale <=5 and Morale >= 1
        and Listening <=5 and Listening >= 1
        and Speaking <=5 and Speaking >= 1
        and Reading <=5 and Reading >= 1
        and Writing <=5 and Writing >= 1 )
);

create table Receive (
    SCID char(7),
    RID int,
    ReceivedTime datetime not null,
    primary key (SCID, RID),
    foreign key (SCID) references STUDENT_CARE(ID) on delete restrict on update cascade,
    foreign key (RID) references REQUEST(RID) on delete cascade on update cascade
);

create table TakePlaceIn (
    CID char(15),
    Branch int,
    ClassroomName varchar(25),
    primary key (CID, Branch, ClassroomName),
    foreign key (CID) references COURSE(CID) on delete cascade on update cascade,
    foreign key (Branch, ClassroomName) references CLASSROOM(BNum, Name)
		on delete cascade on update cascade
);


