rem path to mysql server bin folder
cd "C:\xampp\mysql\bin"

rem credentials to connect to mysql server
set mysql_user=root
set mysql_password=

rem backup file name generation
set backup_path=C:\SysUnigep\SQL
set backup_name=db_unigep

rem backup creation
mysqldump --user=%mysql_user% --password=%mysql_password% --all_databases --routines --events --result-file="%backup_path%\%backup_name%.sql"
if %ERRORLEVEL% neq 0 (
    (echo Backup nao completado: erro durante a criacao) >> "%backup_path%\mysql_backup_log.txt"
) else (echo Backup realizado com sucesso) >> "%backup_path%\mysql_backup_log.txt"