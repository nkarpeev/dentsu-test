# dentsu-test

cd ./docker && sudo docker-compose up -d

1. Запрос на запуск процесса формирования пакета данных

REQUEST

`curl --location --request POST 'http://localhost:8083/run' \
--header 'Content-Type: application/json' \
--data-raw '{
    "content": "data",
    "email": "nekarpeev@yandex.ru"
}'`

RESPONSE

`{
    "processID": "60d46e5e64927"
}`



2. Запрос на получение статуса процесса

REQUEST 
`curl --location --request GET 'http://localhost:8083/status/60d46adaaf5ad'`

RESPONSE
`{
    "status": 1,
    "comment": "processing is finished"
}`
