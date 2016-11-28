project setup
1. paste "slim-test-app" folder in htdocs folder
2. open command prompt and goto "slim-test-app" folder
3. run command composer install (make sure you already have the composer installed on computer)
4. php -S 127.0.0.1:8080 -t public public/index.php

User management Web services 

GET http://127.0.0.1:8080/api/users
    Request JSON: ''
    Response JSON: '{"message":"success","data":[{"user_guid":"583bd7bb3fadd","first_name":"Robert","last_name":"D","email":"robertd@mailinator.com","phone":"123456789"}]}'

POST http://127.0.0.1:8080/api/users 
    Request JSON: '{"first_name":"Robert","last_name":"D","email":"robertd@mailinator.com","phone":"123456789"}'
    Response JSON: '{"message":"success","data":{"user_guid":"583bd7bb3fadd","first_name":"Robert","last_name":"D","email":"robertd@mailinator.com","phone":"123456789"}}'

GET http://127.0.0.1:8080/api/users/583bd7bb3fadd
    Request JSON: ''
    Response JSON: '{"message":"success","data":{"user_guid":"583bd7bb3fadd","first_name":"Robert","last_name":"D","email":"robertd@mailinator.com","phone":"123456789"}}'

PUT http://127.0.0.1:8080/api/users/583bd7bb3fadd 
    Request JSON: '{"first_name":"Robertu","last_name":"Du","email":"robertdu@mailinator.com","phone":"123456789"}'
    Response JSON: '{"message":"success","data":{"user_guid":"583bd7bb3fadd","first_name":"Robertu","last_name":"Du","email":"robertdu@mailinator.com","phone":"123456789"}}'

DELETE http://127.0.0.1:8080/api/users/583bd7bb3fadd 
    Request JSON: ''
    Response JSON: '{"message":"success","data":[]}'


Order management Web services 
GET http://127.0.0.1:8080/api/orders
    Request JSON: ''
    Response JSON: '{"message":"success","data":[{"order_guid":"583bd9ba1e429","order_total":"100","created_at":"2016-11-28 07:16:10","status":"ORDERED","user":{"user_guid":"583bd98fe43b2","first_name":"Robertu","last_name":"Du","email":"robertdu@mailinator.com","phone":"123456789"}}]}'

POST http://127.0.0.1:8080/api/orders 
    Request JSON: '{"user_guid":"583bd98fe43b2","order_total":"100"}'
    Response JSON: '{"message":"success","data":{"order_guid":"583bd9ba1e429","order_total":"100","created_at":"2016-11-28 07:16:10","status":"ORDERED","user":{"user_guid":"583bd98fe43b2","first_name":"Robertu","last_name":"Du","email":"robertdu@mailinator.com","phone":"123456789"}}}'

GET http://127.0.0.1:8080/api/orders/583bd9ba1e429
    Request JSON: ''
    Response JSON: '{"message":"success","data":{"order_guid":"583bd9ba1e429","order_total":"100","created_at":"2016-11-28 07:16:10","status":"ORDERED","user":{"user_guid":"583bd98fe43b2","first_name":"Robertu","last_name":"Du","email":"robertdu@mailinator.com","phone":"123456789"}}}'

PUT http://127.0.0.1:8080/api/orders/583bd7bb3fadd 
    Request JSON: '{"status":"CANCELLED"}'
    Response JSON: '{"message":"success","data":{"order_guid":"583bd9ba1e429","order_total":"100","created_at":"2016-11-28 07:16:10","status":"CANCELLED","user":{"user_guid":"583bd98fe43b2","first_name":"Robertu","last_name":"Du","email":"robertdu@mailinator.com","phone":"123456789"}}}'

DELETE http://127.0.0.1:8080/api/orders/583bd7bb3fadd 
    Request JSON: ''
    Response JSON: '{"message":"success","data":[]}'