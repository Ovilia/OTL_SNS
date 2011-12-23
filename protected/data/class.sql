insert into Course values("JA002", 2011, 1, "基础日语(下)");
insert into Course values("LA913", 2011, 1, "经济与法律");
insert into Course values("SE302", 2011, 1, "编译原理与技术");
insert into Course values("SE315", 2011, 1, "操作系统");
insert into Course values("SE319", 2011, 1, "计算机网络");
insert into Course values("SE323", 2011, 1, "面向对象分析与设计");

insert into Teacher() values (100, "黄建香");
insert into Teacher() values (101, "王先林");
insert into Teacher() values (102, "赵建军");
insert into Teacher() values (103, "邹恒明");
insert into Teacher() values (104, "周憬宇");
insert into Teacher() values (105, "陈昊鹏");

insert into Class values(50, "JA002", 2011, 1);
insert into Class values(51, "LA913", 2011, 1);
insert into Class values(52, "SE302", 2011, 1);
insert into Class values(53, "SE315", 2011, 1);
insert into Class values(54, "SE319", 2011, 1);
insert into Class values(55, "SE323", 2011, 1);

insert into Teaches values(100, 50, 90);
insert into Teaches values(101, 51, 90);
insert into Teaches values(102, 52, 90);
insert into Teaches values(103, 53, 90);
insert into Teaches values(104, 54, 90);
insert into Teaches values(105, 55, 90);

insert into AtomClass(CID, BUILDING_NUMBER, CLASSROOM, TIMEID) values(50, 3, 303, 9);
insert into AtomClass(CID, BUILDING_NUMBER, CLASSROOM, TIMEID) values(50, 3, 303, 19);
insert into AtomClass(CID, BUILDING_NUMBER, CLASSROOM, TIMEID) values(51, 3, 303, 10);
insert into AtomClass(CID, BUILDING_NUMBER, CLASSROOM, TIMEID) values(52, 3, 303, 7);
insert into AtomClass(CID, BUILDING_NUMBER, CLASSROOM, TIMEID) values(52, 3, 303, 18);
insert into AtomClass(CID, BUILDING_NUMBER, CLASSROOM, TIMEID) values(53, 3, 303, 3);
insert into AtomClass(CID, BUILDING_NUMBER, CLASSROOM, TIMEID) values(53, 3, 303, 17);
insert into AtomClass(CID, BUILDING_NUMBER, CLASSROOM, TIMEID) values(54, 3, 303, 8);
insert into AtomClass(CID, BUILDING_NUMBER, CLASSROOM, TIMEID) values(55, 3, 303, 2);
insert into AtomClass(CID, BUILDING_NUMBER, CLASSROOM, TIMEID) values(55, 3, 303, 11);
