-- XBSLOG SQL Dump for Xoops2
-- A Kitson Mar 2006


CREATE TABLE xbslog_log (
logname VARCHAR( 10 ) NOT NULL ,
stage VARCHAR( 10 ) NOT NULL ,
logtime DOUBLE NOT NULL ,
msg VARCHAR( 255 ) NOT NULL ,
PRIMARY KEY ( logname , stage, logtime )
);