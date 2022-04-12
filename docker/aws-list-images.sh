#!/usr/bin/env bash


echo "___________________________________________"
echo "### Login AWS"
login_cmd=$(aws ecr get-login --no-include-email --region ap-southeast-1)
echo "$login_cmd"
eval "sudo $login_cmd"


aws ecr list-images --repository-name giaingay-mobile-service
