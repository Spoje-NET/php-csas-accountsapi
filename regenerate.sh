export PHP_POST_PROCESS_FILE="make cs"

deffile=openapi.yml

rm -rf lib docs test README.md composer.json

#First time installation: npm install @openapitools/openapi-generator-cli -g

npx openapi-generator-cli generate -i ${deffile} -g php --git-user-id Spoje-NET --git-repo-id php-csas-webapi -c .openapi-generator/config.yaml #--enable-post-process-file
