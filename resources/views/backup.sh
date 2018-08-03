
mysqldump -u root -pitbs3234 --all-database > /home/backup/backup_`date +%d%m%Y_%H:%M`.sql

find /home/backup/ -name '*.sql' -mtime +30 -type f -delete
