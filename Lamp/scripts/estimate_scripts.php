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
                input.value = e.target.value
            }
            break;
    }
}

//************************************************* */
// POPULATE AREA CODE SELECT DROPDOWN
//************************************************* */
var area_codes = [818,747,310,626,323,213,714,949,951,909,760,562,619,858]
var select = document.getElementById('area_code')

for(var code of area_codes){
    // Create option tag and text, append to select 
    var option_tag = document.createElement('option')
    option_tag.setAttribute('code', code)
    var text_node = document.createTextNode(code)
    option_tag.appendChild(text_node)
    select.appendChild(option_tag)
}

//************************************************* */
// ACTIVATE CURRENT AREA CODE BASED ON SESSION
//************************************************* */
var option_tags = document.getElementsByTagName('option');
var area = <?php echo $hospital['area_code'] ?> 
    for (option of option_tags){
    if(option.getAttribute('code') == area){
        option.selected = true;
    }
}


</script>

