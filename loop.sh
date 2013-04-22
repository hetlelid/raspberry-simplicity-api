#!/bin/bash

COMMAND=$@
WAIT=0.5
ERR_WAIT=10
while true; do
    $COMMAND
    if [ $? -ne 0 ]
    then
        # Last command failed, sleeping a bit
        sleep $ERR_WAIT
    fi
    sleep $WAIT
done

