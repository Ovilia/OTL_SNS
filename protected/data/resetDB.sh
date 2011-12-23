# This path is for Mac OS X
PATH=$PATH:/usr/local/mysql/bin/
export PATH
mysql -uroot -p31415 < otl.sql
mysql -uroot -p31415 OTL_SNS < fakedata.sql
mysql -uroot -p31415 OTL_SNS < auth.sql
#mysql -uroot -p31415 OTL_SNS < class.sql
echo "Please use web browser to visit http://localhost/~ovilia/OTL_SNS/index.php/site/createRoles"
