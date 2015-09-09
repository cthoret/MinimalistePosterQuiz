#! /bin/bash

mode="dev"
if [[ -n "$1" ]]
then
   mode=$1
fi

if [ $mode = "prod" ]
then
    chmod a-x reset_db.sh
   app/console assets:install --symlink
   app/console cache:clear --env=prod
   app/console assetic:dump --env=prod
elif [ $mode = "staging" ]
then
   app/console assets:install --symlink
   app/console cache:clear --env=prod
   app/console assetic:dump --env=prod
elif [ $mode = "dev" ]
then
  app/console assets:install --symlink
  app/console cache:clear --env=dev
  app/console assetic:dump --env=dev
fi

