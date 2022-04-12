#!/bin/bash
echo "___________________________________________"
echo "### Stop docker and remove container $NAME"
echo "=> docker rm \$(docker stop $NAME)"
docker rm $(docker stop $NAME)

echo "___________________________________________"
echo "### Run docker"
echo "=> docker run -d --net host --name=$NAME --env-file $ENV_PATH --mount type=bind,src=$LOG_PATH/$NAME,target=$APP_LOG_PATH 922969856207.dkr.ecr.ap-southeast-1.amazonaws.com/$NAME.$CI_PIPELINE_ID:$VERSION"
mkdir -p $LOG_PATH/$NAME
docker run -d \
  --net host \
  --name=$NAME \
  --env-file $ENV_PATH \
  --mount type=bind,src=$LOG_PATH/$NAME,target=$APP_LOG_PATH \
 922969856207.dkr.ecr.ap-southeast-1.amazonaws.com/$NAME.$CI_PIPELINE_ID:$VERSION

echo "___________________________________________"
echo "### Checking container status "
IS_RUNNING=$(docker ps -f name=$NAME -q)
echo $IS_RUNNING
if [ -z "$IS_RUNNING" ]
  then
    echo "################ERROR!!!###############"
    docker logs $NAME
    exit 1
  else
    echo "App is running..."
    echo "DONE"
    exit 0
fi
