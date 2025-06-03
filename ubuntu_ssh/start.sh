#!/bin/bash
service ssh start
/usr/sbin/sshd -f /etc/ssh/sshd_config_2222 -p 2222
service xinetd start
tail -f /dev/null 