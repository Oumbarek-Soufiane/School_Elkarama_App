-- Run All queries
select count(*) as totalColumnsInDatabase FROM information_schema.columns where table_schema='db_aim';
select table_name,count(column_name) from information_schema.columns where table_schema='db_aim' GROUP BY table_name;
select table_name,table_rows from information_schema.tables where table_schema= 'db_aim';
select sum(table_rows) as totalRowsInDatabase from information_schema.tables where table_schema= 'db_aim';

-- If You Wanna see Columns of a specific Table
select DISTINCT COLUMN_NAME from information_schema.columns
NATURAL join etudiants 
where TABLE_NAME="users" AND COLUMN_NAME NOT IN ('CURRENT_CONNECTIONS','MAX_SESSION_TOTAL_MEMORY','MAX_SESSION_CONTROLLED_MEMORY','created_at','updated_at','TOTAL_CONNECTIONS','USER')
