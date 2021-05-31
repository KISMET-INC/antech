<script>    

    // Turn error keys into an obj
    var errors_obj = {<?php 
                    if($this->session->flashdata('errors') != null){
                        foreach($this->session->flashdata('errors') as $key => $value){
                            echo '"' . $key .'": "'. $value .'",';
                        }
                    }
                ?>};
                
    if("<?php echo $this->session->flashdata('errors') !== null?>"){
        var error_list = document.getElementById('error_list');
        

        for(error in errors_obj){
            var elements = document.getElementsByClassName(error);
            console.log(elements);

            if(errors_obj[error]!= ''){

                for(item of elements){
                    item.classList.add('red')
                }

                if (document.title != 'Order Approval')
                {
                    error_list.innerHTML += errors_obj[error];
                }
            
                if (document.title == 'Order Approval')
                {
                    error_list.innerHTML = 'All Fields are Required.'
                
                    if(errors_obj['email'].includes('valid')){
                        error_list.innerHTML += errors_obj['email'];
                    };

                    if(errors_obj['phone'].includes('valid')){
                        error_list.innerHTML += errors_obj['phone'];
                    }

                }
            }
        }
}

</script>