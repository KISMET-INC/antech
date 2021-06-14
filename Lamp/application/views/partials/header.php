<header>
    <div id='nav' class = 'wrapper flex nav'></div>
</header>
<div class='antech_nav wrapper'>
    <img id='logo' src = '../../assets/antech_logo.jpg' alt='antech logo'>
</div>

<script>
    var nav = document.getElementById('nav');

    if (document.title == 'Antech Necropsy Service'){

        nav.innerHTML = 
        "<a class='faq_link' href='#answers'>Frequently Asked Questions </br> (**Please Read!!**)</a>"
        +"<p> More Info</p>"
        +"<a href='#calculator'> Estimate Necropsy</a>"
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