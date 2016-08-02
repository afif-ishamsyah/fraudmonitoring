CREATE TABLE profil (
  notel varchar2(15) NOT NULL,
  nipnas number(8,0) DEFAULT NULL,
  namacc varchar2(150) DEFAULT NULL,
  alamat varchar2(150) DEFAULT NULL,
  nikam number(6,0) DEFAULT NULL,
  namaam varchar2(100) DEFAULT NULL,
  segmen varchar2(3) DEFAULT NULL,
  PRIMARY KEY (notel)
) ;

insert  into profil(notel,nipnas,namacc,alamat,nikam,namaam,segmen)  select '02182608708',43211234,'Asboen','Malaysia Barat',123432,'Zig','DSS' from dual union all  select '081383112888',76661667,'Santoso','Sukolilo',986789,'Jones','FSS' from dual;


CREATE TABLE revenue (
  notel varchar2(15) DEFAULT NULL,
  rev1 number(15,0) DEFAULT NULL,
  rev2 number(15,0) DEFAULT NULL,
  rev3 number(15,0) DEFAULT NULL,
  average number(15,0) DEFAULT NULL
 ,
  CONSTRAINT revenue_ibfk_1 FOREIGN KEY (notel) REFERENCES profile (notel)
) ;

CREATE INDEX notel ON revenue (notel);

insert  into revenue(notel,rev1,rev2,rev3,average)  select '02182608708',30,30,30,30 from dual union all  select '081383112888',40,700,80,273 from dual;


