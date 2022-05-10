### trả về giáo viên dạy khóa học cho trước
delimiter $$
create procedure GetTeacher (in CourseID char(15)) 
begin
	select TID, Name 
    from Teach join EMPLOYEE on TID = EID
    where CID = CourseID;
end$$
delimiter ;
call GetTeacher('111222333444555');

### trả về khóa học của học viên cho trước
delimiter $$
create procedure GetCourseOfStudent (in Student_ID char(7)) 
begin
    select CID from Learn
    where StudentID = Student_ID;
end$$
delimiter ;
call GetCourseOfStudent('1234567');

### trả về khóa học cùng level với khóa học cho trc tại chi nhánh cho cho trc
delimiter $$
create procedure GetCourseSameLevel (in SourceCourse char(15), in Branch_no int) 
begin
	select CID from COURSE
    where level = (select Level from COURSE c join takeplacein t on c.CID = t.CID 
					where t.CID = SourceCourse and t.branch = branch_no);
end$$
delimiter ;
call GetCourseSameLevel('111222333444555','1');

### trả về thông tin học viên (câu đơn giản nhất từng thấy :”> )
delimiter $$
create procedure GetStudentInfo (in SID char(7)) 
begin
	select * from STUDENT
    where ID = SID;
end$$
delimiter ;
call GetStudentInfo('1122334');

### thay đổi ngày học của khóa học cho trước
delimiter $$
create procedure ChangeSchedule (in CourseID char(15), in old_date varchar(10), in new_date varchar(10)) 
begin
	update learningdate
    set Date = new_date
    where CID = CourseID and Date = old_date;
end$$
delimiter ;
call ChangeSchedule ('111222333444555','Thứ 2', 'Thứ 3');

### thay đổi điểm cho học viên của khóa học cho trước
delimiter $$
create procedure ChangeMark (in CourseID char(15), in Student_ID char(7), in new_mark decimal(3,1)) 
begin
	update studentresult
    set Mark = new_mark
    where CID = CourseID and StudentID = Student_ID;
end$$
delimiter ;
call ChangeMark('111234567891234','1122334','8.0');

### trả về khóa học của giáo viên cho trước
delimiter $$
create procedure GetCourseByTeacher (in TeacherID char(7)) 
begin
	select CID from Teach
    where TID = TeacherID;
end$$
delimiter ;
call GetCourseByTeacher('5522222');

### trả về đánh giá của giáo viên cho trước
delimiter $$
create procedure GetRatingOfTeacher (in TeacherID char(7)) 
begin
	select * from Rateteacher
    where TID = TeacherID;
end$$
delimiter ;
call GetRatingOfTeacher('5533233');

### trả về thông tin khóa học có học phí cao hơn số tiền cho trước
delimiter $$
create procedure TuitionCourseOver (in money decimal(10)) 
begin
	select * from COURSE
    where Tuition > money
    order by Tuition;
end$$
delimiter ;
call TuitionCourseOver('2000000');

### trả về thông tin khóa học có học phí thấp hơn số tiền cho trước
delimiter $$
create procedure TuitionCourseUnder (in money decimal(10)) 
begin
	select * from COURSE
    where Tuition < money
    order by Tuition;
end$$
delimiter ;
call TuitionCourseUnder('2000000');

###Cập nhật kết quả
delimiter $$
create procedure AddResult(CID char(15), StudentID char(7), Mark decimal(4,2), Comment varchar(256))
begin
	insert into StudentResult values (CID, StudentID, Mark, Comment);
end$$
delimiter ;
### Cập nhật điểm
drop procedure if exists UpdMark;
delimiter $$

create procedure UpdMark(CID char(15), StudentID char(7), Mark decimal(4,2))
begin
	update StudentResult s
    set s.Mark=Mark where s.CID=CID and s.StudentID=StudentID;
end$$
delimiter ;
### Cập nhật nhận xét học viên
drop procedure if exists UpdComment;
delimiter $$
create procedure UpdComment(CID char(15), StudentID char(7), Comment varchar(256))
begin
	update StudentResult s
    set s.Comment=Comment where s.CID=CID and s.StudentID=StudentID;
end
$$
delimiter ;


drop procedure if exists AddRateCourse;
###Thêm đánh giá khóa học
delimiter $$
create procedure AddRateCourse(CID char(15), StudentID char(7), Rate varchar(256))
begin
	insert into RateCourse values(CID, StudentID, Rate);
end$$
delimiter ;
###Xóa đánh giá khóa học
drop procedure if exists DeleteCourseRate;
delimiter $$
create procedure DeleteCourseRate(CID char(15), StudentID char(7))
begin
	delete from RateCourse  where RateCourse.StudentID=StudentID and RateCourse.CID=CID;
end$$
delimiter ;
###Cập nhật đánh giá khóa học
drop procedure if exists UpdCourseRate;
delimiter $$
create procedure UpdCourseRate(CID char(15), StudentID char(7), Rate varchar(256))
begin
	update RateCourse r
    set r.Rate=Rate where r.CID=CID and r.StudentID=StudentID;
end$$
delimiter ;


###Thêm đánh giá giáo viên
drop procedure if exists AddRateTeacher;
delimiter $$
create procedure AddRateTeacher(TID char(7), CID char(15), StudentID char(7), Morale int, Listening int, Speaking int, Reading int, Writing int)
begin
	insert into RateTeacher 
		values(TID, CID, StudentID, Morale, Listening, Speaking, Reading, Writing);
end$$
delimiter ;
###Xóa đánh giá giáo viên
drop procedure if exists DeleteTeacherRate;
delimiter $$
create procedure DeleteTeacherRate(TID char(7), CID char(15), StudentID char(7))
begin
	delete from RateTeacher where RateTeacher.StudentID=StudentID and RateTeacher.CID=CID and RateTeacher.TID=TID;
end$$
delimiter ;
###Cập nhật đánh giá giáo viên
drop procedure if exists UpdTeacherRate;
delimiter $$
create procedure UpdTeacherRate(TID char(7), CID char(15), StudentID char(7), M int, L int, S int, R int, W int)
begin
	update RateTeacher r
    set r.Morale=M, r.Listening=L, r.Speaking=S, r.Reading=R, r.Writing=W 
    where r.TID=TID and r.CID=CID and r.StudentID=StudentID;
end
$$
delimiter ;



###Thêm yêu cầu
drop procedure if exists AddRequest;
delimiter $$
create procedure AddRequest(RID char(15), CID char(15), StudentID char(7), Time time, Content varchar(256), Status varchar(15), Approver char(7))
begin
	insert into REQUEST
		values(CID, StudentID, Time, Content, Status, Approver);
end$$
delimiter ;


###Thay đổi thông tin học viên
drop procedure if exists UpdSInfo;
delimiter $$
create procedure UpdSInfo(ID char(7), Name varchar(55), Address varchar(64), Sex char(4), DoB date)
begin
	update STUDENT s
    set s.Name=Name, s.Address=Address, s.Sex=Sex, s.DoB=DoB where s.ID=ID;
end$$
delimiter ;
###Thay đổi những thông tin chỉ có ở học viên từ 18 tuổi
drop procedure if exists UpdFrom18SInfo;
delimiter $$
create procedure UpdFrom18SInfo(ID char(7), Phone char(10), Email char(32))
begin
	update STUDENT_FROM_18 s
    set s.Phone=Phone, s.Email=Email where s.ID=ID;
end$$
delimiter ;

###Thêm khóa học cho học viên
drop procedure if exists AddCourse;
delimiter $$
create procedure AddCourse(CID char(15), SID char(7))
begin
	insert into Learn values (CID, SID, 0);
end$$
delimiter ;
###Hủy khóa học cho học viên
drop procedure if exists CancelCourse;
delimiter $$
create procedure CancelCourse(CID char(15), SID char(7))
begin
	delete from Learn where Learn.StudentID=SID and Learn.CID=CID;
end
$$
delimiter ;
###Thay đổi khóa học cho học viên
drop procedure if exists ChangeCourse;
delimiter $$
create procedure ChangeCourse(SID char(7), newCID char(15), oldCID char(15)) 
begin
	update Learn l
	set l.CID=newCID where l.CID=oldCID and l.SID=SID;
end$$
delimiter ;


###Trả về khóa học có chứa chuỗi người dùng nhập
drop procedure if exists FindCoursebystring;
delimiter $$
create procedure FindCoursebystring(Str varchar(256))
begin
	select * from Course where CID like CONCAT('%', Str, '%') 
						or Tuition like CONCAT('%', Str, '%')
                        or Level like CONCAT('%', Str, '%') 
                        or Duration like CONCAT('%', Str, '%') 
                        or StartDate like CONCAT('%', Str, '%') 
                        or CTime like CONCAT('%', Str, '%');
end$$
delimiter ;

###Trả về các học viên có điểm trên điểm cho trước
drop procedure if exists StudentHaveMarkOverGivenMark;
delimiter $$
create procedure StudentHaveMarkOverGivenMark (GivenMark decimal(3,1), BranchNo int) 
begin
	drop table if exists OverGivenMarkStudent;
	create table OverGivenMarkStudent select * from StudentResult join TakePlaceIn using (CID) 
				where Branch = BranchNo and Mark > GivenMark
				group by StudentID;
	select * from OverGivenMarkStudent;
end$$
delimiter ;

###Trả về các giáo viên nước ngoài ở chi nhánh
drop procedure if exists ForeignTeacherinBranch;
delimiter $$
create procedure ForeignTeacherinBranch (BranchNo int) 
begin
	select * from Teacher 
		where Type = 'Ngoai nuoc' and ID in (select TID 
							from Teach join TakePlaceIn using (CID) 
							where Branch=BranchNo group by TID);
end$$
delimiter ;
