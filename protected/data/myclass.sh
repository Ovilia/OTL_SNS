# This path is for Mac OS X
PATH=$PATH:/usr/local/mysql/bin/
export PATH
mysql -uroot -p31415 OTL_SNS < class.sql
