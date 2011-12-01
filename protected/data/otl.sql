/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2011/11/30 21:46:14                          */
/*==============================================================*/


drop table if exists ATOMCLASS;

drop table if exists CLASS;

drop table if exists CLASSLOCATION;

drop table if exists CLASSTIME;

drop table if exists COMMENTS;

drop table if exists COURSE;

drop table if exists FEEDS;

drop table if exists MESSAGE;

drop table if exists STATUS;

drop table if exists TAKES;

drop table if exists TEACHER;

drop table if exists TEACHES;

drop table if exists USER;

/*==============================================================*/
/* Table: ATOMCLASS                                             */
/*==============================================================*/
create table ATOMCLASS
(
   ACID                 int not null,
   CID                  int,
   BUILDING_NUMBER      int not null,
   CLASSROOM            varchar(8) not null,
   TIMEID               int not null,
   primary key (ACID)
);

/*==============================================================*/
/* Table: CLASS                                                 */
/*==============================================================*/
create table CLASS
(
   CID                  int not null,
   COURSE_CODE          varchar(16),
   YEAR                 char(4),
   SEMESTER             varchar(16),
   primary key (CID)
);

/*==============================================================*/
/* Table: CLASSLOCATION                                         */
/*==============================================================*/
create table CLASSLOCATION
(
   BUILDING_NUMBER      int not null,
   CLASSROOM            varchar(8) not null,
   primary key (BUILDING_NUMBER, CLASSROOM)
);

/*==============================================================*/
/* Table: CLASSTIME                                             */
/*==============================================================*/
create table CLASSTIME
(
   TIMEID               int not null,
   START_TIME           time not null,
   END_TIME             time not null,
   DAY_OF_WEEK          smallint,
   WEEK_OF_SEMESTER     int,
   primary key (TIMEID)
);

/*==============================================================*/
/* Table: COMMENTS                                              */
/*==============================================================*/
create table COMMENTS
(
   UID                  int not null,
   SID                  int not null,
   COMID                int not null,
   COMMENT_TIME         timestamp not null,
   COTENT               text not null,
   primary key (UID, SID)
);

/*==============================================================*/
/* Table: COURSE                                                */
/*==============================================================*/
create table COURSE
(
   COURSE_CODE          varchar(16) not null,
   YEAR                 char(4) not null,
   SEMESTER             varchar(16) not null,
   COURSE_NAME          varchar(32) not null,
   primary key (COURSE_CODE, YEAR, SEMESTER)
);

/*==============================================================*/
/* Table: FEEDS                                                 */
/*==============================================================*/
create table FEEDS
(
   UID                  int not null,
   USE_UID              int not null,
   FEED_TIME            timestamp not null,
   primary key (UID, USE_UID)
);

/*==============================================================*/
/* Table: MESSAGE                                               */
/*==============================================================*/
create table MESSAGE
(
   MID                  int not null,
   UID                  int,
   USE_UID              int,
   SEND_TIME            timestamp not null,
   ISREAD               bool not null,
   CONTENT              text not null,
   primary key (MID)
);

/*==============================================================*/
/* Table: STATUS                                                */
/*==============================================================*/
create table STATUS
(
   SID                  int not null,
   UID                  int not null,
   UPDATE_TIME          timestamp not null,
   CONTENT              text not null,
   primary key (SID)
);

/*==============================================================*/
/* Table: TAKES                                                 */
/*==============================================================*/
create table TAKES
(
   UID                  int not null,
   CID                  int not null,
   RATE                 float,
   RATE_TIME            timestamp,
   primary key (UID, CID)
);

/*==============================================================*/
/* Table: TEACHER                                               */
/*==============================================================*/
create table TEACHER
(
   TID                  int not null,
   TEACHER_NAME         varchar(32) not null,
   primary key (TID)
);

/*==============================================================*/
/* Table: TEACHES                                               */
/*==============================================================*/
create table TEACHES
(
   TID                  int not null,
   CID                  int not null,
   SCORE                float,
   primary key (TID, CID)
);

/*==============================================================*/
/* Table: USER                                                  */
/*==============================================================*/
create table USER
(
   UID                  int not null,
   USER_NAME            varchar(32) not null,
   EMAIL                varchar(64) not null,
   PASSWORD             varchar(64) not null,
   REGISTER_TIME        timestamp not null,
   ISADMIN              char(1) not null,
   primary key (UID)
);

alter table ATOMCLASS add constraint FK_OCCUPY foreign key (TIMEID)
      references CLASSTIME (TIMEID) on delete restrict on update restrict;

alter table ATOMCLASS add constraint FK_RELATIONSHIP_6 foreign key (BUILDING_NUMBER, CLASSROOM)
      references CLASSLOCATION (BUILDING_NUMBER, CLASSROOM) on delete restrict on update restrict;

alter table ATOMCLASS add constraint FK_RELATIONSHIP_7 foreign key (CID)
      references CLASS (CID) on delete restrict on update restrict;

alter table CLASS add constraint FK_INVOLVE foreign key (COURSE_CODE, YEAR, SEMESTER)
      references COURSE (COURSE_CODE, YEAR, SEMESTER) on delete restrict on update restrict;

alter table COMMENTS add constraint FK_COMMENTS foreign key (UID)
      references USER (UID) on delete restrict on update restrict;

alter table COMMENTS add constraint FK_COMMENTS2 foreign key (SID)
      references STATUS (SID) on delete restrict on update restrict;

alter table FEEDS add constraint FK_FEEDS foreign key (UID)
      references USER (UID) on delete restrict on update restrict;

alter table FEEDS add constraint FK_FEEDS2 foreign key (USE_UID)
      references USER (UID) on delete restrict on update restrict;

alter table MESSAGE add constraint FK_RECEIVE foreign key (USE_UID)
      references USER (UID) on delete restrict on update restrict;

alter table MESSAGE add constraint FK_SEND foreign key (UID)
      references USER (UID) on delete restrict on update restrict;

alter table STATUS add constraint FK_UPDATE foreign key (UID)
      references USER (UID) on delete restrict on update restrict;

alter table TAKES add constraint FK_TAKES foreign key (UID)
      references USER (UID) on delete restrict on update restrict;

alter table TAKES add constraint FK_TAKES2 foreign key (CID)
      references CLASS (CID) on delete restrict on update restrict;

alter table TEACHES add constraint FK_TEACHES foreign key (TID)
      references TEACHER (TID) on delete restrict on update restrict;

alter table TEACHES add constraint FK_TEACHES2 foreign key (CID)
      references CLASS (CID) on delete restrict on update restrict;

