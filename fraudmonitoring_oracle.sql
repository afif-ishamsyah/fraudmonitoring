--------------------------------------------------------
--  File created - Thursday-August-04-2016   
--------------------------------------------------------
--------------------------------------------------------
--  DDL for Sequence ACTIVITY_PARAMETER_SEQ
--------------------------------------------------------

   CREATE SEQUENCE  "FRAUD"."ACTIVITY_PARAMETER_SEQ"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 30 CACHE 20 NOORDER  NOCYCLE ;
--------------------------------------------------------
--  DDL for Sequence CASE_PARAMETER_SEQ
--------------------------------------------------------

   CREATE SEQUENCE  "FRAUD"."CASE_PARAMETER_SEQ"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 53 CACHE 20 NOORDER  NOCYCLE ;
--------------------------------------------------------
--  DDL for Sequence PROFILEUSER_SEQ
--------------------------------------------------------

   CREATE SEQUENCE  "FRAUD"."PROFILEUSER_SEQ"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 45 CACHE 20 NOORDER  NOCYCLE ;
--------------------------------------------------------
--  DDL for Table ACTIVITY
--------------------------------------------------------

  CREATE TABLE "FRAUD"."ACTIVITY" 
   (	"ID_CASE" VARCHAR2(100 BYTE) DEFAULT NULL, 
	"ACTIVITY_NUMBER" NUMBER(10,0) DEFAULT NULL, 
	"ACTIVITY_DATE" DATE DEFAULT NULL, 
	"DESCRIPTION" VARCHAR2(500 BYTE) DEFAULT NULL, 
	"INPUT_DATE" TIMESTAMP (6) DEFAULT NULL, 
	"FILENAME" VARCHAR2(100 BYTE) DEFAULT NULL, 
	"MIME" VARCHAR2(100 BYTE) DEFAULT NULL, 
	"ORIGINAL_FILENAME" VARCHAR2(100 BYTE) DEFAULT NULL
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Table ACTIVITY_PARAMETER
--------------------------------------------------------

  CREATE TABLE "FRAUD"."ACTIVITY_PARAMETER" 
   (	"ID_PARAMETER" NUMBER(10,0), 
	"DESCRIPTION" VARCHAR2(200 BYTE) DEFAULT NULL, 
	"STATUS" CHAR(1 BYTE) DEFAULT NULL, 
	"AKRONIM" VARCHAR2(3 BYTE)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Table CASE_PARAMETER
--------------------------------------------------------

  CREATE TABLE "FRAUD"."CASE_PARAMETER" 
   (	"ID_PARAMETER" NUMBER(10,0), 
	"DESCRIPTION" VARCHAR2(200 BYTE) DEFAULT NULL
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Table KASUS
--------------------------------------------------------

  CREATE TABLE "FRAUD"."KASUS" 
   (	"ID_CASE" VARCHAR2(100 BYTE) DEFAULT NULL, 
	"CASE_PARAMETER" NUMBER(10,0) DEFAULT NULL, 
	"CASE_TIME" DATE DEFAULT NULL, 
	"DESCRIPTION" VARCHAR2(500 BYTE) DEFAULT NULL, 
	"STATUS" VARCHAR2(20 BYTE) DEFAULT NULL, 
	"DESTINATION" VARCHAR2(100 BYTE) DEFAULT NULL, 
	"DESTINATION_NUMBER" VARCHAR2(15 BYTE) DEFAULT NULL, 
	"DURASI" NUMBER(10,0) DEFAULT NULL, 
	"NUMBER_OF_CALL" NUMBER(10,0) DEFAULT NULL, 
	"INPUT_DATE" TIMESTAMP (6) DEFAULT NULL, 
	"FILENAME" VARCHAR2(100 BYTE) DEFAULT NULL, 
	"MIME" VARCHAR2(100 BYTE) DEFAULT NULL, 
	"ORIGINAL_FILENAME" VARCHAR2(100 BYTE) DEFAULT NULL, 
	"LAST_ACTIVITY" NUMBER
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Table PROFIL
--------------------------------------------------------

  CREATE TABLE "FRAUD"."PROFIL" 
   (	"ID_CASE" VARCHAR2(100 BYTE) DEFAULT NULL, 
	"TELEPHONE_NUMBER" VARCHAR2(15 BYTE) DEFAULT NULL, 
	"MAIN_NUMBER" VARCHAR2(15 BYTE) DEFAULT NULL, 
	"NIPNAS" NUMBER(8,0) DEFAULT NULL, 
	"CUSTOMER" VARCHAR2(150 BYTE) DEFAULT NULL, 
	"NIKAM" NUMBER(6,0) DEFAULT NULL, 
	"AM" VARCHAR2(100 BYTE) DEFAULT NULL, 
	"INSTALLATION" VARCHAR2(100 BYTE) DEFAULT NULL, 
	"SEGMEN" VARCHAR2(3 BYTE) DEFAULT NULL, 
	"REVENUE" NUMBER(15,0) DEFAULT NULL
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Table PROFILEUSER
--------------------------------------------------------

  CREATE TABLE "FRAUD"."PROFILEUSER" 
   (	"ID" NUMBER(10,0), 
	"USERNAME" VARCHAR2(30 BYTE) DEFAULT NULL, 
	"PASSWD" VARCHAR2(1024 BYTE) DEFAULT NULL, 
	"PREVILEDGE" CHAR(1 BYTE) DEFAULT NULL, 
	"REMEMBER_TOKEN" VARCHAR2(100 BYTE) DEFAULT NULL
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Index ID_CASES
--------------------------------------------------------

  CREATE INDEX "FRAUD"."ID_CASES" ON "FRAUD"."ACTIVITY" ("ID_CASE") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Index CASE_PARAMETER
--------------------------------------------------------

  CREATE INDEX "FRAUD"."CASE_PARAMETER" ON "FRAUD"."KASUS" ("CASE_PARAMETER") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Index ACTIVITY_NUMBER
--------------------------------------------------------

  CREATE INDEX "FRAUD"."ACTIVITY_NUMBER" ON "FRAUD"."ACTIVITY" ("ACTIVITY_NUMBER") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Index ID_CASE
--------------------------------------------------------

  CREATE INDEX "FRAUD"."ID_CASE" ON "FRAUD"."PROFIL" ("ID_CASE") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  Constraints for Table CASE_PARAMETER
--------------------------------------------------------

  ALTER TABLE "FRAUD"."CASE_PARAMETER" ADD PRIMARY KEY ("ID_PARAMETER")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM"  ENABLE;
  ALTER TABLE "FRAUD"."CASE_PARAMETER" MODIFY ("ID_PARAMETER" NOT NULL ENABLE);
--------------------------------------------------------
--  Constraints for Table PROFILEUSER
--------------------------------------------------------

  ALTER TABLE "FRAUD"."PROFILEUSER" ADD PRIMARY KEY ("ID")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM"  ENABLE;
  ALTER TABLE "FRAUD"."PROFILEUSER" MODIFY ("ID" NOT NULL ENABLE);
--------------------------------------------------------
--  Constraints for Table KASUS
--------------------------------------------------------

  ALTER TABLE "FRAUD"."KASUS" MODIFY ("MIME" NOT NULL ENABLE);
  ALTER TABLE "FRAUD"."KASUS" ADD PRIMARY KEY ("ID_CASE")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM"  ENABLE;
  ALTER TABLE "FRAUD"."KASUS" MODIFY ("ID_CASE" NOT NULL ENABLE);
--------------------------------------------------------
--  Constraints for Table ACTIVITY_PARAMETER
--------------------------------------------------------

  ALTER TABLE "FRAUD"."ACTIVITY_PARAMETER" ADD PRIMARY KEY ("ID_PARAMETER")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM"  ENABLE;
  ALTER TABLE "FRAUD"."ACTIVITY_PARAMETER" MODIFY ("ID_PARAMETER" NOT NULL ENABLE);
--------------------------------------------------------
--  Ref Constraints for Table ACTIVITY
--------------------------------------------------------

  ALTER TABLE "FRAUD"."ACTIVITY" ADD CONSTRAINT "ACTIVITY_IBFK_5" FOREIGN KEY ("ACTIVITY_NUMBER")
	  REFERENCES "FRAUD"."ACTIVITY_PARAMETER" ("ID_PARAMETER") ENABLE;
  ALTER TABLE "FRAUD"."ACTIVITY" ADD CONSTRAINT "ACTIVITY_IBFK_6" FOREIGN KEY ("ID_CASE")
	  REFERENCES "FRAUD"."KASUS" ("ID_CASE") ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table KASUS
--------------------------------------------------------

  ALTER TABLE "FRAUD"."KASUS" ADD CONSTRAINT "CASE_IBFK_1" FOREIGN KEY ("CASE_PARAMETER")
	  REFERENCES "FRAUD"."CASE_PARAMETER" ("ID_PARAMETER") ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table PROFIL
--------------------------------------------------------

  ALTER TABLE "FRAUD"."PROFIL" ADD CONSTRAINT "PROFILE_IBFK_1" FOREIGN KEY ("ID_CASE")
	  REFERENCES "FRAUD"."KASUS" ("ID_CASE") ENABLE;
--------------------------------------------------------
--  DDL for Trigger ACTIVITY_PARAMETER_SEQ_TR
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "FRAUD"."ACTIVITY_PARAMETER_SEQ_TR" 
 BEFORE INSERT ON activity_parameter FOR EACH ROW
  WHEN (NEW.id_parameter IS NULL) BEGIN
 SELECT activity_parameter_seq.NEXTVAL INTO :NEW.id_parameter FROM DUAL;
END;
/
ALTER TRIGGER "FRAUD"."ACTIVITY_PARAMETER_SEQ_TR" ENABLE;
--------------------------------------------------------
--  DDL for Trigger CASE_PARAMETER_SEQ_TR
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "FRAUD"."CASE_PARAMETER_SEQ_TR" 
 BEFORE INSERT ON case_parameter FOR EACH ROW
  WHEN (NEW.id_parameter IS NULL) BEGIN
 SELECT case_parameter_seq.NEXTVAL INTO :NEW.id_parameter FROM DUAL;
END;
/
ALTER TRIGGER "FRAUD"."CASE_PARAMETER_SEQ_TR" ENABLE;
--------------------------------------------------------
--  DDL for Trigger PROFILEUSER_SEQ_TR
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "FRAUD"."PROFILEUSER_SEQ_TR" 
 BEFORE INSERT ON profileuser FOR EACH ROW
  WHEN (NEW.id IS NULL) BEGIN
 SELECT profileuser_seq.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/
ALTER TRIGGER "FRAUD"."PROFILEUSER_SEQ_TR" ENABLE;
