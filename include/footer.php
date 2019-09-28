



<!-- BEGIN VENDOR JS-->
<script src="vendors/js/vendors.min.js" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="vendors/js/charts/chart.min.js" type="text/javascript"></script>
<script src="vendors/js/charts/raphael-min.js" type="text/javascript"></script>
<script src="vendors/js/charts/morris.min.js" type="text/javascript"></script>
<script src="vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js"
type="text/javascript"></script>
<script src="vendors/js/charts/jvector/jquery-jvectormap-world-mill.js"
type="text/javascript"></script>

<script src="vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
<script src="vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>

<script src="js/scripts/extensions/block-ui.js" type="text/javascript"></script>

<!-- END PAGE VENDOR JS-->
<!-- BEGIN MODERN JS-->
<script src="js/core/app-menu.js" type="text/javascript"></script>
<script src="js/core/app.js" type="text/javascript"></script>
<script src="js/scripts/customizer.js" type="text/javascript"></script>
<!-- END MODERN JS-->
<!-- BEGIN PAGE LEVEL JS-->


<script src="js/scripts/tables/datatables-extensions/datatables-sources.js"
type="text/javascript"></script>

<script src="js/scripts/tables/datatables-extensions/datatable-select.js"></script>

<script src="vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
<script src="vendors/js/tables/datatable/dataTables.responsive.min.js"
type="text/javascript"></script>
<script src="vendors/js/tables/datatable/dataTables.select.min.js"
type="text/javascript"></script>
<script src="vendors/js/tables/datatable/dataTables.buttons.min.js"
type="text/javascript"></script>
<script src="vendors/js/tables/datatable/buttons.bootstrap4.min.js"
type="text/javascript"></script>

<script src="js/scripts/tables/datatables/datatable-advanced.js"></script>
<script src="vendors/js/tables/buttons.flash.min.js" type="text/javascript"></script>
<script src="vendors/js/tables/jszip.min.js" type="text/javascript"></script>
<script src="vendors/js/tables/pdfmake.min.js" type="text/javascript"></script>
<script src="vendors/js/tables/vfs_fonts.js" type="text/javascript"></script>
<script src="vendors/js/tables/buttons.html5.min.js" type="text/javascript"></script>
<script src="vendors/js/tables/buttons.print.min.js" type="text/javascript"></script>
  

<script src="vendors/js/tables/datatable/dataTables.select.min.js" type="text/javascript"></script>


<script src="js/scripts/forms/select/form-select2.js" type="text/javascript"></script>
<script src="js/scripts/modal/components-modal.js" type="text/javascript"></script>

<script src="js/scripts/tables/datatables-extensions/datatable-button/datatable-html5.js"
type="text/javascript"></script>

<script src="js/scripts/tables/datatables/datatable-api.js" type="text/javascript"></script>


<script src="vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="js/scripts/forms/checkbox-radio.js" type="text/javascript"></script>


<script src="js/scripts/modal/components-modal.js" type="text/javascript"></script>

<script src="js/canvasjs.min.js"></script>


<!-- END PAGE LEVEL JS-->

    <script type="text/javascript">

      $(document).ready(function () {

        $('#chequediv').hide();

        $("#multiOptions").change(function () {
          if ($(this).val() == "200032" ) {
           $('#chequediv').show();
           $('#disdiv').hide();

         }
         else { 
          $('#chequediv').hide();
          $('#disdiv').show();
        }
      });
      });

    </script>

<style type="text/css">
	table{
		width: 100%;
	}
</style>



<script type="text/javascript">

    function wrt(x) {
      var a=parseFloat(document.getElementsByName('qty1[]')[x].value);
      var b=parseFloat(document.getElementsByName('price1[]')[x].value);
      var c=a*b;
      document.getElementsByName('item_total1[]')[x].value=c;
      var n=0;
      
      var everyChild = document.querySelectorAll("#c");
      for (var i = 0; i<everyChild.length; i++) {
         m=everyChild[i].value;
         m=+m;
         n=n+m;
      }

      document.getElementById('d').value = n.toLocaleString( "en-US" );
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
                $(wrapper).append('<tr><td> <select class="form-control select2" name="item[]"> <?php $rows =mysqli_query($con,"SELECT * FROM items WHERE pause =0 ORDER BY name" ) or die(mysqli_error($con)); while($row=mysqli_fetch_array($rows)){ $id = $row['id']; $brand = $row['brand']; $name = $row['name']; ?> <option value="<?php echo $id ?>"><?php $rows1 =mysqli_query($con,"SELECT * FROM itemsb WHERE id=$brand ORDER BY name" ) or die(mysqli_error($con));while($row1=mysqli_fetch_array($rows1)){ $bname = $row1['name']; ?><?php echo $bname ?> <?php echo $name ?></option><?php } } ?></select> </td><td><input class="form-control" type="number" name="pprice[]" id="pprice" value=""></td><td><input class="form-control"  type="number" oninput="wrt('+x+')" name="qty1[]" ></td><td><input class="form-control"  type="number" oninput="wrt('+x+')" name="price1[]" ></td><td><input class="form-control"  type="number" name="item_total1[]" id="c" disabled="" ></td><td><a href="#" class="delete btn btn-danger"><i class="la la-remove"></i></a></td></tr>'); //add input box

                $('.select2:last').select2();
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