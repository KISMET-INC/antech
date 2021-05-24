- Design Models
  - Move validations to models
  - DB logic in model
- Protected routes
- Secure Filtered Posts
- Calculation routes

- MODELS


- ON LOOKUP
  - Look up in DB first
    - Yes 
      - popuate form
    - No
      - Look up in Txt
      - found in text - add hosp to db
      - populate form 

- On Calculate
  - add preliminary calculation to text
  - add preliminary calucation to db (with complete = false)
  
- On Submit
  - update hospital info in database
  - update preliminary quote in database
  - Clear estimate session keys
- 
- Successful Submission View
  - Return to main page

-Admin route
    - See all
    - Search by date
    - Search by complted
    - search by id
    - search by hopital


- Implement Quote history for customer****???
  - See all
  - See completed
  