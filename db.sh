#!/bin/sh

# Change DBPASSWORD, DBUSER, DBHOST and DBNAME to match the values
# your mysql_db_info file on the webdev server.
mysql --password='pBKpQnWwvNhB' --user='cjhewett' --host='dbdev.cs.uiowa.edu' 'db_cjhewett'
