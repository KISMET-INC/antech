<script>
//************************************************* */
// UPDATE CURRENT VALUE ACROSS ALL NAME INSTANCES
//************************************************* */
var value = '';
function updateValue(e){
    var input_list = document.getElementsByName(e.target.name)
    console.log(input_list)
    switch(e.type){
        
        case "keypress":
        
            value += e.key;
            for (var input of input_list){
                input.value == e.key;
            }
            console.log(input.value);
            break;

        case "change":
            for (var input of input_list){
                console.log(input.type)
                console.log(input.value)
                input.value = e.target.value
            }
            break;
    }
}

</script>