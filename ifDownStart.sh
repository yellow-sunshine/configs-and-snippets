#!/bin/bash
service=apache2

while read line
  do
      echo $line
      $LINE = $line
  done < /proc/loadavg""
echo ${line *##}

if (( $(ps -ef | grep -v grep | grep $service | wc -l) > 0 ))
then
else
  /etc/init.d/$service start
fi
