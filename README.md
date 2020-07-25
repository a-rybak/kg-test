# kg-test
1. run docker-compose up -d --build
2. run docker-compose exec webserver bash
3. run php yii migrate on webserver-container and exit
4. go to adminer (localhost:8082 in .yml) and create database kgdb (set in config/db.php)
5. use requests examples (may run in Postman)


Examples

----------------------------------------------------------------------------
/create

curl --location --request POST 'http://localhost:8080/account/create' \
--header 'Content-Type: application/json' \
--data-raw '{
    "first_name": "Ivan",
    "last_name": "Petrov"
}'

----------------------------------------------------------------------------
/accrue

curl --location --request POST 'http://localhost:8080/account/accrue' \
--header 'Content-Type: application/json' \
--data-raw '{
    "account_number": "UAFF5BBD520D867A5C8F992E80A8235F69",
    "amount": "26"
}'

----------------------------------------------------------------------------
/lock

curl --location --request POST 'http://localhost:8080/account/lock' \
--header 'Content-Type: application/json' \
--data-raw '{
    "account_number": "UAFF5BBD520D867A5C8F992E80A8235F69",
    "amount": "11"
}'

----------------------------------------------------------------------------
/view

curl --location --request GET 'http://localhost:8080/account/view?account_number=UAFF5BBD520D867A5C8F992E80A8235F69'

----------------------------------------------------------------------------
/transfer

curl --location --request POST 'http://localhost:8080/account/transfer' \
--header 'Content-Type: application/json' \
--data-raw '{
    "donor": "UAF22AB2C0AA94674130257C257F63478D",
    "recipient": "UAF22AB2C0AA94674130257C257F63478D",
    "amount": "10"
}'
