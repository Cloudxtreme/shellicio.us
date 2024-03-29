#!/bin/bash

# ssh.sh
# This is a CGI script that uses shellinabox in CGI mode.

function connect {
    shellinaboxd --cgi -c /var/lib/shellinabox -s /:SSH:$parms
    if [ $? -ne 0 ]; then
    echo "$res" > /tmp/1.log
    cannot_connect
    fi
}

function default {
     # First time that the CGI script was called. Show initial HTML page.
     printf 'Content-Type: text/html\r\n\r\n'
     cat <<EOF
     <html>
       <head>
         <title>SSH Shell</title>
       </head>
       <body>
         <h1>SSH Shell</h1>

         <p>Enter address to connect to:
         <form method="POST">
           <input type="text" name="cmd" style="width: 40em" value="127.0.0.1" />
         </form>
         </p>
       </body>
EOF
}

function cannot_connect {
     printf 'Content-Type: text/html\r\n\r\n'
     cat <<EOF
     <html>
       <head>
         <title>SSH Shell</title>
       </head>
       <body>
         <h1>SSH Shell</h1>

         <p>Unable to establish connection with $parms</p>
       </body>
EOF
}

case "${REQUEST_METHOD}" in
  GET)
     # Retrieve CGI parameter, then start shellinabox with this address
     parms=`echo $QUERY_STRING`
     if [ "$parms" != "" ]; then
        connect $parms
     else
        default
     fi
     ;;

  POST)
     # Retrieve CGI parameter, then start shellinabox with this address
     read parms
     parms="$(printf "$(echo "${parms}"|sed -e 's/%\(..\)/\\x\1/g;s/%/%%/g')")" #"
     parms="${parms#cmd=}"
     if [ "$parms" != "" ]; then
        connect $parms
     else
        default
     fi
     ;;

  *)
     default
     ;;
esac
