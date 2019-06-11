#!/bin/bash

./vendor/bin/phpmd src html cleancode,codesize,controversial,design,naming,unusedcode > ./public/phpmd.html;

printf "\nYou can find the new mess detector report at http://localhost/vendor/prequel/phpmd.html
        \nNote that 'Avoid using static access to class' errors should be ignored.\n\n"
