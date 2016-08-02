CREATE TABLE activity_parameter(
  id_parameter number(10) NOT NULL,
  description varchar2(200) DEFAULT NULL,
  status char(1) DEFAULT NULL,
  PRIMARY KEY (id_parameter)
);

CREATE SEQUENCE activity_parameter_seq START WITH 10 INCREMENT BY 1;
grant select, alter on activity_parameter_seq to fraud;
grant select, alter on activity_parameter_seq to fastel;


CREATE OR REPLACE TRIGGER activity_parameter_seq_tr
 BEFORE INSERT ON activity_parameter FOR EACH ROW
 WHEN (NEW.id_parameter IS NULL)
BEGIN
 SELECT activity_parameter_seq.NEXTVAL INTO :NEW.id_parameter FROM DUAL;
END;

insert  into activity_parameter(id_parameter,description,status)  select 1,'Permintaan Blokir','0' from dual union all  select 2,'Blokir SLI','0' from dual union all  select 3,'Caring Pelanggan','0' from dual union all  select 4,'Respond Pelanggan','0' from dual union all  select 5,'Surat Pelanggan','0' from dual union all  select 6,'Tiketing','1' from dual union all  select 7,'Buka Blokir/Tagih','1' from dual union all  select 9,'Blokir Nomor Telepon','1' from dual;

CREATE TABLE case_parameter(
  id_parameter number(10) NOT NULL,
  description varchar2(200) DEFAULT NULL,
  PRIMARY KEY (id_parameter)
);

CREATE SEQUENCE case_parameter_seq START WITH 9 INCREMENT BY 1;
grant select, alter on case_parameter_seq to fraud;
grant select, alter on case_parameter_seq to fastel;

CREATE OR REPLACE TRIGGER case_parameter_seq_tr
 BEFORE INSERT ON case_parameter FOR EACH ROW
 WHEN (NEW.id_parameter IS NULL)
BEGIN
 SELECT case_parameter_seq.NEXTVAL INTO :NEW.id_parameter FROM DUAL;
END;

insert  into case_parameter(id_parameter,description)  select 1,'One to Many' from dual union all  select 2,'Many to One' from dual union all  select 3,'Many to Many' from dual union all  select 7,'One to One' from dual union all  select 8,'One to Three' from dual;

CREATE TABLE profileuser(
  id number(10) NOT NULL,
  username varchar2(30) DEFAULT NULL,
  password varchar2(1024) DEFAULT NULL,
  previledge char(1) DEFAULT NULL,
  remember_token varchar2(100) DEFAULT NULL,
  PRIMARY KEY (id)
);

CREATE SEQUENCE profileuser_seq START WITH 4 INCREMENT BY 1;
grant select, alter on profileuser_seq to fraud;
grant select, alter on profileuser_seq to fastel;

CREATE OR REPLACE TRIGGER profileuser_seq_tr
 BEFORE INSERT ON profileuser FOR EACH ROW
 WHEN (NEW.id IS NULL)
BEGIN
 SELECT profileuser_seq.NEXTVAL INTO :NEW.id FROM DUAL;
END;

insert  into profileuser(id,username,password,previledge,remember_token)  select 1,'minyman','$2y$10$5nwGenxxxEu2Ggl5IKrIUur0diRxhKl8ROpvYEjYtKkmpZi7WTC9S','1','Kp23LtzYQAnvNFV0qSKtmYcdMxBhxerm7K6jCgq61wT2vfUXDeuAafQxQ2Vu' from dual union all  select 2,'asbun','$2y$10$WlMPY6oqr9aV6A8.x/Ez6uZ6i7DlFC6yjQuPt3ClwEZSpPjv9EpBq','0','Lb0polISJCGo0ZG3xCftWKVEOcwghDqrAgDHd64M9Nwj5ECmEcI1cDvXqfbR' from dual union all  select 3,'Afif Ishamsyah','$2y$10$7qiSA3Lqtw03bAHsHOdNBOzDfQZeka9Si9oBafriifa4tdFPawVrW','0','ElCilbdW1RmOCrrKoIKTelsSFy0oicirRqH9huR7VOJkNQF7bwkalmP58Nuh' from dual;

CREATE TABLE kasus (
  id_case varchar2(100) NOT NULL,
  case_parameter number(10) DEFAULT NULL ,
  case_time date DEFAULT NULL ,
  description varchar2(500) DEFAULT NULL ,
  status varchar(20) DEFAULT NULL,
  destination varchar2(100) DEFAULT NULL,
  destination_number varchar2(15) DEFAULT NULL,
  durasi number(10) DEFAULT NULL,
  number_of_call number(10) DEFAULT NULL,
  input_date date DEFAULT NULL,
  filename varchar2(100) DEFAULT NULL,
  mime varchar2(100) DEFAULT NULL,
  original_filename varchar2(100) DEFAULT NULL,
  PRIMARY KEY (id_case)
 ,
  CONSTRAINT case_ibfk_1 FOREIGN KEY (case_parameter) REFERENCES case_parameter (id_parameter)
) ;

CREATE INDEX case_parameter ON case (case_parameter);

insert  into kasus(id_case,case_parameter,case_time,description,status,destination,destination_number,durasi,number_of_call,input_date,filename,mime,original_filename)  select '33f20dcf-6761-4b78-b814-2d495830cdb9',1,TO_DATE('2016-07-28','YYYY-MM-DD'),'Kasus ini baru baru ini diketahui',NULL,'0','German','09187677777',365,1,TO_DATE('2016-07-28','YYYY-MM-DD'),'php271.tmp.png','image/png','97.png' from dual union all  select '35d9ff51-4c0e-49ce-a3fb-20f3201b916f',2,TO_DATE('2016-07-20','YYYY-MM-DD'),'lagi lagi',NULL,'0','Jepang','42342342342',3600,30,TO_DATE('2016-07-25','YYYY-MM-DD'),'php43AD.tmp.jpg','image/jpeg','96.jpg' from dual union all  select '5489a37f-3508-48be-9515-81344c50a118',2,TO_DATE('2016-05-20','YYYY-MM-DD'),'coba coba',NULL,'0','China','0314666789',60000,600,TO_DATE('2016-07-27','YYYY-MM-DD'),'phpB551.tmp.png','image/png','7.png' from dual union all  select '73c50273-25f4-4ae3-b132-e768687ba74d',3,TO_DATE('2015-07-20','YYYY-MM-DD'),'Kejadian Pertama',NULL,'0','SIngapura','0923565432',3600,20,TO_DATE('2016-07-26','YYYY-MM-DD'),'php6B3C.tmp.jpg','image/jpeg','99.jpg' from dual union all  select '76034255-9401-4fb8-8457-b93174ed6928',1,TO_DATE('2016-05-18','YYYY-MM-DD'),'completed',NULL,'0','Albania Barat','5343534534',7200,30,TO_DATE('2016-07-25','YYYY-MM-DD'),'php9201.tmp.jpg','image/jpeg','12.jpg' from dual union all  select '8a1de699-6fe7-4454-8cb1-71e18122010d',3,TO_DATE('2016-07-15','YYYY-MM-DD'),'Kosongan',NULL,'0','Arab','645611189',540,90,TO_DATE('2016-07-28','YYYY-MM-DD'),'php4344.tmp.jpg','image/jpeg','1.jpg' from dual union all  select '8ed14aea-fb89-4fc8-80ea-7f5400ec92ad',2,TO_DATE('2016-06-20','YYYY-MM-DD'),'Parah',NULL,'1','Indonesia','0314666789',3600,600,TO_DATE('2016-07-25','YYYY-MM-DD'),'php9678.tmp.jpg','image/jpeg','4.jpg' from dual;

CREATE TABLE profil (
  id_case varchar2(100) DEFAULT NULL,
  telephone_number varchar2(15) DEFAULT NULL,
  main_number varchar2(15) DEFAULT NULL,
  nipnas number(8,0) DEFAULT NULL,
  customer varchar2(150) DEFAULT NULL,
  nikam number(6,0) DEFAULT NULL,
  am varchar2(100) DEFAULT NULL,
  installation varchar2(100) DEFAULT NULL,
  segmen varchar2(3) DEFAULT NULL,
  revenue number(15,0) DEFAULT NULL
 ,
  CONSTRAINT profile_ibfk_1 FOREIGN KEY (id_case) REFERENCES case (id_case)
) ;

CREATE INDEX id_case ON profil (id_case);

insert  into profil(id_case,telephone_number,main_number,nipnas,customer,nikam,am,installation,segmen,revenue)  select '8ed14aea-fb89-4fc8-80ea-7f5400ec92ad','081383112806','081383112899',51122115,'PT Tunggangjaya',215512,'Yak','Surabaya','DBM',40000000 from dual union all  select '76034255-9401-4fb8-8457-b93174ed6928','08229987096','08229987099',51133115,'Bank BRI',315513,'Ampas','Semarang','DMS',300000 from dual union all  select '35d9ff51-4c0e-49ce-a3fb-20f3201b916f','081383112806','081383112899',9119119,'PT Indra Jaya Tbk',987789,'Isis','Jakarta','FRS',3000000 from dual union all  select '73c50273-25f4-4ae3-b132-e768687ba74d','08145678990','08145678999',8900098,'Institut Lele',654456,'Surya ','Kejawan','BFS',50000 from dual union all  select '5489a37f-3508-48be-9515-81344c50a118','02182608704','081383112888',76661667,'Santoso',986789,'Jones','Sukolilo','FSS',273 from dual union all  select '33f20dcf-6761-4b78-b814-2d495830cdb9','081383112834','081383112888',76661667,'Santoso',986789,'Jones','Sukolilo','FSS',273 from dual union all  select '8a1de699-6fe7-4454-8cb1-71e18122010d','03135766574','03135766598',NULL,NULL,NULL,NULL,NULL,NULL,NULL from dual;

CREATE TABLE activity (
  id_case varchar2(100) DEFAULT NULL,
  activity_number number(10) DEFAULT NULL,
  activity_date date DEFAULT NULL,
  description varchar2(500) DEFAULT NULL,
  input_date date DEFAULT NULL,
  filename varchar2(100) DEFAULT NULL,
  mime varchar2(100) DEFAULT NULL,
  original_filename varchar2(100) DEFAULT NULL
 ,
  CONSTRAINT activity_ibfk_5 FOREIGN KEY (activity_number) REFERENCES activity_parameter (id_parameter),
  CONSTRAINT activity_ibfk_6 FOREIGN KEY (id_case) REFERENCES case (id_case)
) ;

CREATE INDEX activity_number ON activity (activity_number);
CREATE INDEX id_cases ON activity (id_case);

insert  into activity(id_case,activity_number,activity_date,description,input_date,filename,mime,original_filename)  select '8ed14aea-fb89-4fc8-80ea-7f5400ec92ad',6,TO_DATE('2016-06-20','YYYY-MM-DD'),'Blokiiir',TO_DATE('2016-07-25','YYYY-MM-DD'),'php5CBD.tmp.png','image/png','8.png' from dual union all  select '73c50273-25f4-4ae3-b132-e768687ba74d',4,TO_DATE('2016-07-23','YYYY-MM-DD'),'Menunggu Respon',TO_DATE('2016-07-26','YYYY-MM-DD'),'php70CE.tmp.png','image/png','98.png' from dual union all  select '33f20dcf-6761-4b78-b814-2d495830cdb9',4,TO_DATE('2016-07-28','YYYY-MM-DD'),'Respon positif',TO_DATE('2016-07-28','YYYY-MM-DD'),'phpAED3.tmp.jpg','image/jpeg','12.jpg' from dual;

select case_time from case; 

select * from case_parameter where case_parameter.