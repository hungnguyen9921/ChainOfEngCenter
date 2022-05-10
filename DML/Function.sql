### FUNCTION: trả về học phí trung bình của các khóa học tại chi nhánh cho trước
delimiter $$
create function TuitionCourseAvg (branch_no int) 
returns decimal(10)
deterministic
reads sql data
begin
	declare avg_tuition decimal(10);
	select avg(Tuition) into avg_tuition 
    from COURSE c join takeplacein t on c.CID = t.CID
    where Branch = branch_no;
    return avg_tuition;
end$$
delimiter ;
select TuitionCourseAvg('1') as 'Học phí trung bình';

### FUNCTION: trả về số giáo viên tại chi nhánh cho trước
delimiter $$
create function SumTeacher (branch_no int) 
returns int
deterministic
reads sql data
begin
	declare cnt int;
	select count(*) into cnt
    from EMPLOYEE 
    where Branch = branch_no and Job = "Giảng viên";
    return cnt;
end$$
delimiter ;
select SumTeacher('2') as "Tổng giảng viên";

### FUNCTION: trả về số học viên học tại chi nhánh cho trước
delimiter $$
create function SumStudent (branch_no int) 
returns int
deterministic
reads sql data
begin
	declare cnt int;
	select count(*) into cnt
    from STUDENT 
    where ID in (select StudentID
				from learn l join takeplacein t on l.CID = t.CID 
				where Branch = branch_no
				group by StudentID);
    return cnt;
end$$
delimiter ;
select SumStudent('1') as "Tổng học viên";

### FUNCTION: số học viên có điểm số cao hơn hơn điểm cho trước ở mỗi khóa học tại một chi nhánh cho trước 
delimiter $$
create function StudentHaveMarkOver (s_mark decimal(3,1), branch_no int) 
returns int
deterministic
reads sql data
begin
	declare cnt int;
	select count(*) into cnt
    from STUDENT 
    where ID in (select StudentID
				from StudentResult s join takeplacein t on s.CID = t.CID 
				where Branch = branch_no and Mark > s_mark
				group by StudentID);
    return cnt;
end$$
delimiter ;

###FUNCTION: Tính tuổi học viên
drop function if exists Age;
delimiter $$
create function Age(SID char(7))
returns int
DETERMINISTIC
READS SQL DATA
begin
	declare age int;
    set age=(curdate()-(select DoB from STUDENT where ID=SID))/10000;
    return age;
end
$$

delimiter ;


###FUNCTION: Đếm số học viên của khóa học
drop function if exists CountStudentsofCourse;
delimiter $$
create function CountStudentsofCourse(CourseID char(15))
returns int
DETERMINISTIC
READS SQL DATA
begin
	declare sNumber int;
    set sNumber=(select count(*) from Learn where CID=CourseID);
    return sNumber;
end$$
delimiter ;

###FUNCTION: Đếm số giáo viên của khóa học
drop function if exists CountTeachersofCourse;
delimiter $$
create function CountTeachersofCourse(CourseID char(15))
returns int
DETERMINISTIC
READS SQL DATA
begin
	declare tNumber int;
    set tNumber=(select count(*) from Teach where CID=CourseID);
    return tNumber;
end$$
delimiter ;


###FUNCTION: Tính điểm trung bình trên từng lĩnh vực và điểm trung bình chung của giáo viên
drop function if exists CalcAvgMoraleRateTeacher;
delimiter $$
create function CalcAvgMoraleRateTeacher(ID char(7))
returns decimal(2,1)
DETERMINISTIC
READS SQL DATA
begin
	declare CalcAvg decimal(2,1);
    set CalcAvg=(select avg(Morale) from RateTeacher where TID=ID);
    return CalcAvg;
end$$

delimiter ;

drop function if exists CalcAvgListeningRateTeacher;
delimiter $$
create function CalcAvgListeningRateTeacher(ID char(7))
returns decimal(2,1)
DETERMINISTIC
READS SQL DATA
begin
	declare CalcAvg decimal(2,1);
    set CalcAvg=(select avg(Listening) from RateTeacher where TID=ID);
    return CalcAvg;
end
$$

delimiter ;

drop function if exists CalcAvgSpeakingRateTeacher;
delimiter $$
create function CalcAvgSpeakingRateTeacher(ID char(7))
returns decimal(2,1)
DETERMINISTIC
READS SQL DATA
begin
	declare CalcAvg decimal(2,1);
    set CalcAvg=(select avg(Speaking) from RateTeacher where TID=ID);
    return CalcAvg;
end
$$

delimiter ;

drop function if exists CalcAvgReadingRateTeacher;
delimiter $$
create function CalcAvgReadingRateTeacher(ID char(7))
returns decimal(2,1)
DETERMINISTIC
READS SQL DATA
begin
	declare CalcAvg decimal(2,1);
    set CalcAvg=(select avg(Reading) from RateTeacher where TID=ID);
    return CalcAvg;
end
$$

delimiter ;

drop function if exists CalcAvgWritingRateTeacher;
delimiter $$
create function CalcAvgWritingRateTeacher(ID char(7))
returns decimal(2,1)
DETERMINISTIC
READS SQL DATA
begin
	declare CalcAvg decimal(2,1);
    set CalcAvg=(select avg(Writing) from RateTeacher where TID=ID);
    return CalcAvg;
end
$$

delimiter ;

drop function if exists CalcAvgRateTeacher;
delimiter $$
create function CalcAvgRateTeacher(ID char(7))
returns decimal(2,1)
DETERMINISTIC
READS SQL DATA
begin
	declare CalcAvg decimal(2,1);
    set CalcAvg=((select CalcAvgMoraleTeacher(ID))+(select CalcAvgListeningTeacher(ID))+(select CalcAvgSpeakingTeacher(ID))+(select CalcAvgReadingTeacher(ID))+(select CalcAvgWritingTeacher(ID)))/5;
    return CalcAvg;
end
$$

delimiter ;