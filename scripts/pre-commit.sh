#!/bin/bash

echo "Running Code Sniffer..."
make phpcbf
# shellcheck disable=SC2181
if [ $? != 0 ]
then
    echo "Coding standards errors have been detected. Fix it before commit..."
    exit 1
fi

echo "Running Code Analysis..."
make phpstan
# shellcheck disable=SC2181
if [ $? != 0 ]
then
    echo "Coding standards errors have been detected. Fix it before commit..."
    exit 1
fi

exit $?
