<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Approval</title>
</head>
<body>
    <h2> Order Approval </h2>

    <form >

    <section id='details'>
        <section id='hospital_info'>
            <h2> Hospital Info </h2>
            <div>
                <label for='hosp_name'>Hospital Name </label>
                <input name = 'hosp_name' value ='<?php echo $hosp_name ?>'>
            <div>
            <div>
                <label for='antech_id'>Antech ID# </label>
                <input name = 'antech_id' value ='<?php echo $antech_id ?>'>
            <div>
            <div>
                <label for='address'>Hospital Address </label>
                <input type='text' name = 'address'>
            <div>
            <div>
                <label for='phone'>Hospital Phone # </label>
                <input type='text' name = 'phone'>
            <div>
            <div>
                <label for='doctor'>Doctor's Name</label>
                <input type='text' name = 'doctor'>
            <div>
            <div>
                <label for='email'>Email</label>
                <input type='text' name = 'doctor'>
            <div>
        </section>
        <section id='pet_info'>
            <h2> Pet Info </h2>
            <div>
                <label for='pet_name'>Pet's Name</label>
                <input type='text' name = 'pet_name'>
            <div>
            <div>
                <label for ='species'>Species: </label>
                <select name = 'species'>
                <option>Dog</option>
                <option>Cat</option>
                </select>
            </div>
            <div>
                <label for='breed'>Breed</label>
                <input type='text' name = 'breed'>
            <div>
            <div>
                <label for='sex'>Sex</label>
                <input type='text' name = 'sex'>
            <div>

            <div>
                <label for='age'>Age</label>
                <input type='text' name = 'age'>
            <div>
            <div>
                <label for='weight'>Weight</label>
                <input name = 'weight' value ='<?php echo $weight ?>'>
            <div>
        </section>
    </section>
    <section id='history'>
        <h2>History</h2>
        <div id='euth'>
            <p>Euthanized?</p>
            <label for="yes">Yes</label>
            <input type="radio" name="euth" id='yes' value="yes">
            <label for="no">No</label>
            <input type="radio" name="euth" id='no' value="no">
        </div>
        <div id='frozen'>
            <p>Is the body frozen?</p>
            <label for="yes">Yes</label>
            <input type="radio" name="frozen" id='yes' value="yes">
            <label for="no">No</label>
            <input type="radio" name="frozen" id='no' value="no">
        </div>
        <div id='death_date'>
            <label for='date'>Date of death: </label>
            <input id='date'type='date'>
        </div> 
        <div>
            <label for='summary'>A summarization is REQUIRED</label>
            <textarea id='summary'></textarea>
        </div>
    </section>
    <section id='costs'>
        <div id='necroCost'>
            <p>NecroCost: <?php echo $necroCost ?></p>
            <label for="necro"> Approved</label><br>
            <input type="checkbox" id="necro" name="necro" value=" Necropsy Cost Approved">
        </div>
        <div id='shipCost'>
            <p>Ambulance Delivery: <?php echo $shipCost ?></p>
            <label for="ship"> Approved</label><br>
            <input type="checkbox" id="ship" name="ship" value=" Delivery Cost Approved">
        </div>
        <div id='cremCost'>
            <p>Cremation: <?php echo $cremCost ?></p>
            <label for="crem"> Approved</label><br>
            <input type="checkbox" id="crem" name="crem" value=" Cremation Cost Approved">
        </div>
        <div id='totalCost'>
            <p>Cremation: <?php echo $totalCost ?></p>
            <label for="total"> Approved</label><br>
            <input type="checkbox" id="total" name="total" value=" Total Cost Approved">
        </div>
    </section>
    <input type='submit' value='Submit Neropsy Request'>
    </form>
    <input type='button' value='Cancel'>
</body>
</html>