### TRIGGER: giảng viên chỉ có thể dạy những khóa học được tổ chức tại chi nhánh của mình
delimiter $$
create trigger check_teacher_course_I
before insert on teach
for each row
begin
    declare Cbranch int; 
    declare Tbranch int;
    select Branch into Cbranch
    from takeplacein 
    where CID = new.CID;
    select Branch into Tbranch
    from EMPLOYEE
    where EID = new.TID;
    if (Cbranch != Tbranch) then
		signal sqlstate '12345'
		set message_text = 'Teacher can\'t teach course in another branch';
	end if;
end$$
delimiter ;

delimiter $$
create trigger check_teacher_course_U
before update on teach
for each row
begin
    declare Cbranch int; 
    declare Tbranch int;
    select Branch into Cbranch
    from takeplacein 
    where CID = new.CID;
    select Branch into Tbranch
    from EMPLOYEE
    where EID = new.TID;
    if (Cbranch != Tbranch) then
		signal sqlstate '12345'
		set message_text = 'Teacher can\'t teach course in another branch';
	end if;
end$$
delimiter ;

### TRIGGER: tự động thêm vào học viên dưới 18 và trên 18
delimiter $$
create trigger check_student_age
after insert on STUDENT
for each row
begin
    declare standard_date date;
    set standard_date = date_sub(now(), interval 18 year);
    if (new.DoB > standard_date) then
		insert STUDENT_UNDER_18 values (new.ID);
	end if ;
end$$
delimiter ;


### TRIGGER: học viên chỉ có thể đánh giá khóa học của mình 
delimiter $$
create trigger check_student_rate_course_I
before insert on RateCourse
for each row
begin
    if (new.CID, new.StudentID) not in (select CID, StudentID from learn) then
		signal sqlstate '12345'
		set message_text = 'Student can\'t rate this course';
	end if;
end$$
delimiter ;

delimiter $$
create trigger check_student_rate_course_U
before update on RateCourse
for each row
begin
    if (new.CID, new.StudentID) not in (select CID, StudentID from learn) then
		signal sqlstate '12345'
		set message_text = 'Error. Can\'t update this rating';
	end if;
end$$
delimiter ;


### TRIGGER: học viên chỉ có thể đánh giá giáo viên dạy ở khóa học của mình
delimiter $$
create trigger check_student_rate_teacher_I
before insert on RateTeacher
for each row
begin
    if (new.CID, new.StudentID) not in (select CID, StudentID from learn) then
		signal sqlstate '12345'
		set message_text = 'Student can\'t rate in this course';
	end if;
    if (new.CID, new.TID) not in (select CID, TID from teach) then
		signal sqlstate '12345'
		set message_text = 'This teacher isn\'t in this course';
	end if;
end$$
delimiter ;

delimiter $$
create trigger check_student_rate_teacher_U
before update on RateTeacher
for each row
begin
    if (new.CID, new.StudentID) not in (select CID, StudentID from learn) then
		signal sqlstate '12345'
		set message_text = 'Student can\'t rate in this course';
	end if;
    if (new.CID, new.TID) not in (select CID, TID from teach) then
		signal sqlstate '12345'
		set message_text = 'This teacher isn\'t in this course';
	end if;
end$$
delimiter ;


### TRIGGER: Quản lý chi nhánh chỉ quản lý chi nhánh hiện tại của mình
delimiter $$
create trigger check_branch_manager_I
before insert on branch
for each row
begin
    if new.MNGID != null then
		if (new.MNGID) not in (select EID from EMPLOYEE
							where Job = "Quản lý chi nhánh" and Branch = new.Number) 
		then
			signal sqlstate '12345'
			set message_text = 'Unallowed manager or branch';
		end if;
	end if ;

end$$
delimiter ;

delimiter $$
create trigger check_branch_manager_U
before update on branch
for each row
begin
    if new.MNGID != null then
		if (new.MNGID) not in (select EID from EMPLOYEE
							where Job = "Quản lý chi nhánh" and Branch = new.Number) 
		then
			signal sqlstate '12345'
			set message_text = 'Unallowed manager or branch';
		end if;
	end if ;

end$$
delimiter ;

delimiter $$
create trigger check_branch_manager_U_emp
before update on employee
for each row
begin
    if (new.Job = "Quản lý chi nhánh") and exists (select MNGID from branch where MNGID = new.EID)
	then
		if new.Branch not in (select Number from branch where MNGID = new.EID) then
			signal sqlstate '12345'
			set message_text = 'Can\'t update this branch manager into another branch';
		end if ;
	end if ;
end$$
delimiter ;


delimiter $$
create trigger check_course_manager_U
before update on course
for each row
begin
	declare Cbranch int;
	select Branch into Cbranch
    from takeplacein 
    where CID = new.CID;
    if (new.MNGID) not in (select EID from EMPLOYEE
							where Job = "Quản lý khóa học" and Branch = Cbranch) 
	then
		signal sqlstate '12345'
		set message_text = 'Unallowed manager or course';
	end if ;
end$$
delimiter ;

### TRIGGER: không cho phép thay đổi chi nhánh mà 1 khóa học được tổ chức
delimiter $$
create trigger check_course_branch
before update on takeplacein
for each row
begin
    if (new.CID != old.CID) or (new.branch != old.branch)
	then
		signal sqlstate '12345'
		set message_text = 'Can\'t change course and branch';
	end if ;
end$$
delimiter ;

### TRIGGER: học sinh đc gửi yêu cầu cho khóa học của mình
delimiter $$
create trigger check_request
before insert on request
for each row
begin
    if (new.CID, new.StudentID) not in (select CID, StudentID from learn) 
    then
		signal sqlstate '12345'
		set message_text = 'Student can\'t add request for this course';
	end if;
    set new.Approver = (select MNGID from course where CID = new.CID);
end$$
delimiter ;

drop trigger if exists check_number_of_students;
###TRIGGER: Khóa học không có quá 30 học viên
delimiter $$
create trigger check_number_of_students
before insert on Learn
for each row
begin
    if CountStudentsofCourse(new.CID) =30
    then
		signal sqlstate '45000'
		set message_text = 'Can\'t add more students to this course';
	end if;
end$$
delimiter ;

drop trigger if exists check_number_of_teachers;
###TRIGGER: Khóa học không có quá 5 giáo viên
delimiter $$
create trigger check_number_of_teachers
before insert on Teach
for each row
begin
    if CountTeachersofCourse(new.CID) =5
    then
		signal sqlstate '45000'
		set message_text = 'Can\'t add more teachers to this course';
	end if;
end$$
delimiter ;

drop trigger if exists check_course_teacher;
###TRIGGER: Khóa học mà học viên đăng kí phải có giáo viên dạy
delimiter $$
create trigger check_course_teacher
before insert on Learn
for each row
begin
    if CountTeachersofCourse(new.CID) =0
    then
		signal sqlstate '45000'
		set message_text = 'This course is taught by noone';
	end if;
end$$
delimiter ;

drop trigger if exists add_employee;
###TRIGGER: Tự động thêm nhân viên vào các bảng con
delimiter $$
create trigger add_employee
after insert on EMPLOYEE
for each row
begin
    if new.Job ='Chăm sóc khách hàng'
    then
		insert into STUDENT_CARE() values (new.EID);
	end if;
	if new.Job ='Giáo viên'
    then
		insert into TEACHER values (new.EID, NULL);
	end if;
    if new.Job ='Quản lý khóa học'
    then
		insert into MANAGER() values (new.EID);
        insert into COURSE_MNG() values (new.EID);
	end if;
    if new.Job ='Quản lý chi nhánh'
    then
		insert into MANAGER() values (new.EID);
        insert into BRANCH_MNG() values (new.EID);
	end if;
end$$
delimiter ;


drop trigger if exists check_request_receiver;
###TRIGGER: Nhân viên tiếp nhận yêu cầu phải thuộc về chi nhánh của khóa học và một yêu cầu chỉ được tiếp nhận bởi một nhân viên 
delimiter $$
create trigger check_request_receiver
before insert on Receive
for each row
begin
	if new.RID in (select RID from Receive where RID=new.RID)
    then
		signal sqlstate '45000'
		set message_text = 'This request has been received';
	end if;
    if new.SCID not in (select ID from STUDENT_CARE join EMPLOYEE on ID=EID 
						where Branch=(select Branch from TakePlaceIn where CID=(select CID from REQUEST 
																				where RID=new.RID)))
    then
		delete from REQUEST where RID=new.RID;
		signal sqlstate '45000'
		set message_text = 'This student care employee can\'t receive this request';
	end if;
end$$
delimiter ;