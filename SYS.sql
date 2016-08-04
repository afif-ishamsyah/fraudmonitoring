CREATE USER fraud IDENTIFIED BY fraudmonitoring;

GRANT CONNECT TO fraud;

GRANT CONNECT, RESOURCE, DBA TO fraud;

GRANT CREATE SESSION to fraud;
GRANT ALL PRIVILEGE TO fraud;

GRANT UNLIMITED TABLESPACE TO fraud;

grant select, insert on case to fraud;
grant select, insert on case_parameter to fraud;
grant select, insert on activity_parameter to fraud;
grant select, insert on activity to fraud;
grant select, insert on profil to fraud;
grant select, insert on profileuser to fraud;

grant select, insert on case to fastel;
grant select, insert on case_parameter to fastel;
grant select, insert on activity_parameter to fastel;
grant select, insert on activity to fastel;
grant select, insert on profil to fastel;
grant select, insert on profileuser to fastel;
alter session set current_schema = fraud; 
--setelah selesai bikin fraud

CREATE USER fastel IDENTIFIED BY fastel;

GRANT CONNECT TO fastel;

GRANT CONNECT, RESOURCE, DBA TO fastel;

GRANT CREATE SESSION to fastel;
GRANT ALL PRIVILEGE TO fastel;

GRANT UNLIMITED TABLESPACE TO fastel;

grant select, insert on profil to fastel;
grant select, insert on revenue to fastel;
grant select, insert on profil to fraud;
grant select, insert on revenue to fraud;

alter session set current_schema = fastel; 
alter session set current_schema = system;
 alter system set sec_case_sensitive_logon=false;