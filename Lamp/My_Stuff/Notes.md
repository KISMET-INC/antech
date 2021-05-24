- Design Models
  - Move validations to models
  - DB logic in model
- Protected routes
- Secure Filtered Posts
- Calculation routes

- MODELS
  - HOSPITAL MODEL
    - Add to DB Logic
    - Validation Functions
      - Lookup
        - ID
      - Calculate / Approve
        - ID, HospName,  
      - Submit
        - ID, hosp_name, address, phone, doctor, email
  - ESTIMATE MODEL
    - Add to DB Logic
    - Validation Functions
      - Calculate 
        - weight
      - Approve
        - weight, Necropsy Cost
      - Submit
        - weight, owner, pet_name, species, breed, sex, age, frozen, euth, summary, approved_total






  - Lookup Validation Model
  - Calculate Validation Model
  - Order Validation Model
  - Full Estimate Validation and Add to DB Logic


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
  

  HOSPITAL
  antech_id 
  hosp_name 
  address 
  phone 
  email 
  area_code *
  doctor  
  ---
  updated_at
  created_at


  ESTIMATE
  pet_name 
  species 
  breed
  sex
  age
  weight
  frozen
  euth
  summary
  necroCost
  shipCost
  cremCost
  totalCost
  shipApproved
  cremApproved
  totalApproved
  ---
  updated_at
  created_at