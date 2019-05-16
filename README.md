# symfony-rest-api

Steps to install:

1. Clone the project
2. Run composer install
3. 
Am create un DB freelancing-test dupa cum se observa in .env
DATABASE_URL=pgsql://root:root@127.0.0.1:5432/freelancing-test

RUN php bin/console doctrine:migrations:migrate

4. Run : php bin/console server:run

5. I've used Postman to test my api

   Ex Create Event:
   
   POST: http://localhost:8000/events
   
   BODY: 
   {
        "name": "ndsmandms",
        "nr_slots": 6,
        "start_date": "2019-01-01 00:00:00",
        "end_date": "2019-01-02 00:00:00"
   }
         
   RESPONSE:
    
   {
       "id": 3,
       "name": "ndsmandms",
       "nr_slots": 6,
       "start_date": "2019-01-01T00:00:00+00:00",
       "end_date": "2019-01-02T00:00:00+00:00"
   }
   
   
   EX: Get all Events:
   
   GET : http://localhost:8000/events
   
   RESPONSE:
   [
       {
           "id": 2,
           "name": "ndsmandms",
           "nr_slots": 6,
           "start_date": "2019-01-01T00:00:00+00:00",
           "end_date": "2019-01-02T00:00:00+00:00"
       }
   ]
   
   EX: Get all Events:
      
   DELETE : http://localhost:8000/events/1
  
   RESPONSE:
   {
       "propertyPath": "event",
       "message": "The Event was not found"
   }
  
   EX: Get all Events:
   
   DELETE : http://localhost:8000/events/1
    
   RESPONSE: empty
   
   EX: Update
   
   PUT http://localhost:8000/events/2
   
   BODY:
   {
       "name": "ndsmsdsdsadsdssdsadsdandms",
       "nr_slots": 6,
       "start_date": "2019-01-04 00:00:00",
       "end_date": "2019-01-06 00:00:00"
   }
   
   RESPONSE:
   {
       "id": 2,
       "name": "ndsmsdsdsadsdssdsadsdandms",
       "nr_slots": 6,
       "start_date": "2019-01-04T00:00:00+00:00",
       "end_date": "2019-01-06T00:00:00+00:00"
   }
   
   EX: MAKE reservation:
   
   POST http://localhost:8000/events/2/reservation
   
   BODY:
   {
       "first_name": "ushdjsds",
       "last_name": "sdsdsdad",
       "email": "raluaonca@gmail.com",
       "phone": "0745603796",
       "nr_people" : 1
   }
   
   RESPONSE:
   {
       "id": 1,
       "event": {
           "id": 2,
           "name": "ndsmsdsdsadsdssdsadsdandms",
           "nr_slots": 5,
           "start_date": "2019-01-04T00:00:00+00:00",
           "end_date": "2019-01-06T00:00:00+00:00"
       },
       "first_name": "ushdjsds"
   }