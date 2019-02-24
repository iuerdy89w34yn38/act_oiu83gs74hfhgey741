<html>
	<head>
		<title> My JS </title>
	</head>

<body>
	
	<button class="add_form_field">Add New Field &nbsp;</button>

<table>
	<thead>
		<tr>
			<td>Value of A </td>
			<td>Value of B </td>
			<td>Sum </td>
		</tr>
	</thead>
	<tbody>
		<tr><td><select name="item[]"><option value="<?php echo 'hello' ?>"><?php echo 'hello' ?></option></select></td><td><input type="number" oninput="wrt(0)" name="qty1[]" ></td><td><input type="number" oninput="wrt(0)" name="price1[]" ></td><td><input type="number" name="item_total1[]" id="c" disabled="" ></td></tr>
		





	</tbody>

	<tfoot>
		<tr>
			<td></td>
			<td style="text-align: right;">Total:</td>
			<td><input type="number" name="sub_total" id="d" value="0" ></td>
		
	</tfoot>
</table>
<br><br>


<input type="number" name="count" style="" >


</body>
</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript">

function wrt(x) {
	var a=parseInt(document.getElementsByName('qty1[]')[x].value);
	var b=parseInt(document.getElementsByName('price1[]')[x].value);
	var c=a*b;
	document.getElementsByName('item_total1[]')[x].value=c;
	var n=0;
	
	var everyChild = document.querySelectorAll("#c");
	for (var i = 0; i<everyChild.length; i++) {
	   m=everyChild[i].value;
	   m=+m;
	   n=n+m;
	}
	document.getElementById('d').value = n;
}



</script>

<script>
$(document).ready(function() {
    var max_fields      = 20;
    var wrapper         = $("tbody"); 
    var add_button      = $(".add_form_field"); 
    
    var x = 0; 
    $(add_button).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
            x++; 
            $(wrapper).append('<tr><td><select name="item[]"><option value="<?php echo 'hello' ?>"><?php echo 'hello' ?></option></select></td><td><input type="number" oninput="wrt('+x+')" name="qty1[]" ></td><td><input type="number" oninput="wrt('+x+')" name="price1[]" ></td><td><input type="number" name="item_total1[]" id="c" disabled="" ><a href="#" class="delete">Delete</a></td></tr>'); //add input box
        }
		else
		{
		alert('You Reached the limits')
		}
    });
    
    $(wrapper).on("click",".delete", function(e){ 
        e.preventDefault(); $(this).parent('td').parent('tr').remove(); x--;
    })
});
</script>