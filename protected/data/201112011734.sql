ALTER table USER 
CHANGE UID UID int not null AUTO_INCREMENT;

ALTER table USER
CHANGE EMAIL EMAIL varchar(64) not null unique;

insert into user(USER_NAME, EMAIL, PASSWORD, ISADMIN) values("tecton", "tecton69@gmail.com","11edbf240c921a81abbbf84c34c2a68f", "N");
insert into user(USER_NAME, EMAIL, PASSWORD, ISADMIN) values("lastland", "hnkfliyao@gmail.com","21232f297a57a5a743894a0e4a801fc3", "Y");
