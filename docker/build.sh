#!/bin/bash

echo "___________________________________________"
echo "### Build docker"
echo "=> docker build -t 922969856207.dkr.ecr.ap-southeast-1.amazonaws.com/$NAME.$CI_PIPELINE_ID:$VERSION $HOME_DIR"
docker build  -t 922969856207.dkr.ecr.ap-southeast-1.amazonaws.com/$NAME.$CI_PIPELINE_ID:$VERSION $HOME_DIR

echo "___________________________________________"
echo "### DONE."
