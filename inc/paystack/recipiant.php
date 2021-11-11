<?php

curl -X POST -H "Authorization: Bearer sk_test_b9fb3e6e692d9d7e3eafe2c688b791f558059a10" -H "Content-Type: application/json" -d '{ 
   "type": "nuban",
   "name": "Zombie",
   "description": "Zombier",
   "account_number": "01000000010",
   "bank_code": "044",
   "currency": "NGN",
   "metadata": {
      "job": "Flesh Eater"
    }
 }' "https://api.paystack.co/transferrecipient"

?>