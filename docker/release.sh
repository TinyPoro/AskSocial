#!/bin/bash
echo "___________________________________________"
echo "### Login AWS"
login_cmd=$(aws ecr get-login --no-include-email --region ap-southeast-1)
echo "$login_cmd"
eval "sudo $login_cmd"

echo "___________________________________________"
echo "### Create Repository"
aws ecr create-repository --repository-name $NAME --region ap-southeast-1

echo "___________________________________________"
echo "### Delete Tag $NAME:$VERSION"
aws ecr batch-delete-image --repository-name $NAME --image-ids imageTag=$VERSION


echo "___________________________________________"
echo "### Re-tag : 922969856207.dkr.ecr.ap-southeast-1.amazonaws.com/$NAME:$VERSION"
docker tag 922969856207.dkr.ecr.ap-southeast-1.amazonaws.com/$NAME.$CI_PIPELINE_ID:$VERSION 922969856207.dkr.ecr.ap-southeast-1.amazonaws.com/$NAME:$VERSION

echo "___________________________________________"
echo "### push to respository : 922969856207.dkr.ecr.ap-southeast-1.amazonaws.com/$NAME:$VERSION"
docker push 922969856207.dkr.ecr.ap-southeast-1.amazonaws.com/$NAME:$VERSION

echo "___________________________________________"
echo "### DONE."
