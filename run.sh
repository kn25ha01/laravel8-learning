#!/bin/bash

# reference
# https://laravel.com/docs/8.x#getting-started-on-linux

PROJECT_NAME='proj'
curl -s https://laravel.build/${PROJECT_NAME} | bash
cd ${PROJECT_NAME}
./vendor/bin/sail up
