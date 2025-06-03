#!/bin/bash
service mysqld start
service httpd start
tail -f /dev/null 