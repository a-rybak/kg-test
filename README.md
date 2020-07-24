# kg-test

Examples

----------------------------------------------------------------------------
/create

curl --location --request POST 'http://kindgeek/web/account/create' \
--header 'Content-Type: application/json' \
--data-raw '{
    "first_name": "Ivan",
    "last_name": "Petrov"
}'

----------------------------------------------------------------------------
/accrue

curl --location --request POST 'http://kindgeek/web/account/accrue' \
--header 'Content-Type: application/json' \
--data-raw '{
    "account_number": "UAFF5BBD520D867A5C8F992E80A8235F69",
    "amount": "26"
}'

----------------------------------------------------------------------------
/lock

curl --location --request POST 'http://kindgeek/web/account/lock' \
--header 'Content-Type: application/json' \
--data-raw '{
    "account_number": "UAFF5BBD520D867A5C8F992E80A8235F69",
    "amount": "11"
}'

----------------------------------------------------------------------------
/view

curl --location --request GET 'http://kindgeek/web/account/view?account_number=UAFF5BBD520D867A5C8F992E80A8235F69'

----------------------------------------------------------------------------
/transfer

curl --location --request POST 'http://kindgeek/web/account/transfer' \
--header 'Content-Type: application/json' \
--data-raw '{
    "donor": "UAF22AB2C0AA94674130257C257F63478D",
    "recipient": "UAF22AB2C0AA94674130257C257F63478D",
    "amount": "10"
}'
