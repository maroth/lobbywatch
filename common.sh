#!/bin/bash

# Common functions and variables

# Colors,
# http://webhome.csc.uvic.ca/~sae/seng265/fall04/tips/s265s047-tips/bash-using-colors.html
# http://misc.flogisoft.com/bash/tip_colors_and_formatting
# Attribute codes:
# 00=none 01=bold 04=underscore 05=blink 07=reverse 08=concealed
#
# Text color codes:
# 30=black 31=red 32=green 33=yellow 34=blue 35=magenta 36=cyan 37=white
#
# Background color codes:
# 40=black 41=red 42=green 43=yellow 44=blue 45=magenta 46=cyan 47=white

black='\e[0;30m'
blackBold='\e[1;30m'
green='\e[0;32m'
greenBold='\e[1;32m'
red='\e[0;31m'
redBold='\e[1;31m'
blue='\e[0;44m'
blueBold='\e[1;44m'
yellow='\e[0;43m'
yellowBold='\e[1;43m'
reset='\e[0m'


# Asks if [Yn] if script shoud continue, otherwise exit 1
# $1: msg or nothing
# Example call 1: askContinueYn
# Example call 1: askContinueYn "Backup DB?"
askContinueYn() {
  if [[ $1 ]]; then
    msg="$1 "
  else
    msg=""
  fi

  # http://stackoverflow.com/questions/3231804/in-bash-how-to-add-are-you-sure-y-n-to-any-command-or-alias
  read -e -p "${msg}Continue? [Y/n] " response
  response=${response,,}    # tolower
  if [[ $response =~ ^(yes|y|)$ ]] ; then
    # echo ""
    # OK
    :
  else
    echo "Aborted"
    exit 1
  fi
}

# http://superuser.com/questions/878640/unix-script-wait-until-a-file-exists
# Wait at most 5 seconds for the server.log file to appear
#
# Example:
# server_log=/var/log/jboss/server.log
# wait_file "$server_log" 5 || {
#   echo "JBoss log file missing after waiting for $? seconds: '$server_log'"
#   exit 1
# }
wait_file() {
  local file="$1"; shift
  local wait_seconds="${1:-10}"; shift # 10 seconds as default timeout
  local max_wait_seconds=wait_seconds

  until test $((wait_seconds--)) -eq 0 -o -f "$file" ; do sleep 1; done

  ((++wait_seconds))
}

# Wait mysql started
# argument 1: wait seconds, default 10s
wait_mysql() {
  local wait_seconds="${1:-10}"; shift # 10 seconds as default timeout
  local max_wait_seconds=wait_seconds

  mysqladmin -hlocalhost -uroot processlist >/dev/null 2>&1
  until test $((wait_seconds--)) -eq 0 -o $? -eq 0 ; do sleep 1; mysqladmin -hlocalhost -uroot processlist >/dev/null 2>&1; done

  ((++wait_seconds))
}


# Check if local MySQL is running, if not, ask starting
checkLocalMySQLRunning() {
  mysqlSock="/opt/lampp/var/mysql/mysql.sock"
  wait_secs=15
#   if [ ! -f "$mysqlSock" ]; then
  mysqladmin -hlocalhost -uroot processlist >/dev/null 2>&1
  if (($? != 0)); then
    askContinueYn "MySQL not running. Start?"

    sudo /opt/lampp/xampp restart

    sudo mv /usr/bin/mysql /usr/bin/~mysql.bak
    sudo ln -s /opt/lampp/bin/mysql /usr/bin/mysql

    sudo mv /usr/bin/mysqladmin /usr/bin/~mysqladmin.bak
    sudo ln -s /opt/lampp/bin/mysqladmin /usr/bin/mysqladmin

    sudo mv /usr/bin/mysqldump /usr/bin/~mysqldump.bak
    sudo ln -s /opt/lampp/bin/mysqldump /usr/bin/mysqldump

    echo "Wait MySQL starting..."
    wait_mysql $wait_secs || {
      echo "MySQL not running after $wait_secs s"
      exit 1
    }
  fi
}
