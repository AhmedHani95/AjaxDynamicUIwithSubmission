<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">   
     $(document).ready(function(){
        $('#addRow').click(function(){
            $('#myTable tbody').append("<tr class='table-active'><td><div class='form-group'>"+
                        "<select class='form-control'>"+
                        "<option value=' '></option>"+
                        "<?php if(count($products)>0):?>"+
                        "<?php foreach($products as $product):?>"+
                            "<option value='<?php echo $product->unitPrice.'-'.$product->qty ?>'><?php echo $product->name; ?></option>"+
                            +"<?php endforeach;?>"+
                        "<?php endif;?>"+
                        "<select></div>"
                        +"</td><td>0</td><td><input class='numberin' type='number' min='0' max='0' value='0' ></td><td>0</td><td>"+
                        "<a class='btn btn-danger' onclick='DeleteRow(this)'>delete-Row</a></td></tr>");          
        });
    });
    // function submit(){
    //     $(function() {
    //     $('form').submit(function(e) {
    //         $.ajax({
    //             url: "paidamt.php", 
    //             type: 'POST',
    //             data: $(this).serialize(),
    //             success: function(data) {
    //                 $("#divShow").html(data);
    //                 }); 
    //             });
    //         });
    //     });
    // }
    $(document).on('keyup mouseup', '.numberin', function() {                                                                                                                     
        var qty=this.value;
        var tableRow=this.parentElement.parentElement;
        var price=tableRow.cells[1].innerHTML;
        tableRow.cells[3].innerHTML=qty*price;
    });
    $(document).on("change",".form-control", function(){
            var productdetails = this.options[this.selectedIndex].value;
            var productArr = productdetails.split("-");
            var temp=this;
            for(i=0 ;i<3;i++){
                temp=temp.parentElement;
            }
            if(productArr[0]==" "){
            temp.cells[1].innerHTML=0;
            temp.cells[2].firstChild.min=0;
            temp.cells[2].firstChild.max=-0;
            temp.cells[2].firstChild.value=-0;       //check product qty
            temp.cells[3].innerHTML=0;
            }
            else{
            temp.cells[1].innerHTML=productArr[0];
            temp.cells[2].firstChild.max=productArr[1];      //check product qty
            temp.cells[2].firstChild.min=0;
            temp.cells[2].firstChild.value=productArr[1];
            temp.cells[3].innerHTML=productArr[0]*productArr[1];
            }
            return false;
        });

    function DeleteRow(button){
        $(button).parent().parent().remove();
    }
    </script>
  <form id="myForm">    
    <button type="button" id="addRow" class="btn btn-primary" href="javascript:void(0);">Add-New-Rows</button>
        <table id="myTable" class="table table-hover">
        <thead>
            <tr>
            <th scope="col">Product name</th>
            <th scope="col">Product Unit Price</th>
            <th scope="col">product Quantity </th>
            
            <th scope="col">Product Total</th>
            <th scope="col">Remove Row</th>
            </tr>
        </thead>
        <tbody>
            <tr class="table-sucess">
                <td>
                    <div class="form-group">
                        <select class="form-control">
                        <?php if(count($products)>0):?>
                        <option value=" "></option>
                            <?php foreach($products as $product):?>
                            <option value="<?php echo $product->unitPrice.'-'.$product->qty ?>"><?php echo $product->name; ?></option>
                            <?php endforeach;?>
                            
                        <?php endif;?>
                        <select>
                    </div>
                </td>
                <td></td>
                <td><input class="numberin" type="number" min="0" max="0" value="0"></td>
                <td></td>
                <td><a class="btn btn-danger" onclick="DeleteRow(this)">delete row</a></td>
            </tr>
        </tbody>
        </table>
        </form>