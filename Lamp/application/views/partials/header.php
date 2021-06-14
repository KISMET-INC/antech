<header>
    <div id='nav' class = 'wrapper flex nav'></div>
</header>
<div class='antech_nav wrapper'>
        <img class='logo' src = '../../assets/antech_logo.jpg' alt='antech logo'>
</div>

<script>
var nav = document.getElementById('nav');

if (document.title == 'Antech Necropsy Service'){

    nav.innerHTML = 
    "<p class='bgreen'><a href='#answers'>Frequently Asked Questions </br> (**Please Read!!**)</a></p>"
    +"<p> More Info</p>"
    +"<p><a href='#calculator'> Estimate Necropsy</a> </p>"
}
if (document.title == 'Order Approval'){

    nav.innerHTML = 
    "<a href='/Lamp/index.php/order_controller/populateForm'>Test Info</a>"
    +"<p onclick='clearForm()'> Clear Form </p>"
    +"<p><a href='/Lamp/#calculator'> Go Back To Estimate</a> </p>"
}

if (document.title == 'SUCCESS'){

    nav.innerHTML = 
    "<a href='/Lamp/success_controller/return_home'>Return Home </a>"
    }



</script>