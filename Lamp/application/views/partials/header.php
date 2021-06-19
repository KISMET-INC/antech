<header>
    <div id='nav' class = 'wrapper flex nav'></div>
</header>
<div class='antech_nav wrapper'>
    <img id='logo' src = '../../assets/antech_logo.jpg' alt='antech logo'>
</div>

<script>
    var nav = document.getElementById('nav');

    if (document.title == 'Antech Necropsy Service'){

    }
    if (document.title == 'Order Approval'){
        var estimate ='estimate'
        nav.innerHTML = 
        "<a href='/index.php/order_controller/populateForm'>Test Info</a>"
        +"<p onclick='clearForm(estimate)'> Clear Form </p>"
        +"<p><a href='/#calculator'> Go Back To Estimate</a> </p>"
    }

    if (document.title == 'SUCCESS'){

        nav.innerHTML = 
        "<a href='/success_controller/return_home'>Return Home </a>"
        }

</script>