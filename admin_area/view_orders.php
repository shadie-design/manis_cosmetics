<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<div class="row"><!-- row 1 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <ol class="breadcrumb"><!-- breadcrumb begin -->
            <li class="active"><!-- active begin -->
                
                <i class="fa fa-dashboard"></i> Dashboard / View Orders
                
            </li><!-- active finish -->
        </ol><!-- breadcrumb finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 1 finish -->

<div class="row"><!-- row 2 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <div class="panel panel-default"><!-- panel panel-default begin -->
            <div class="panel-heading"><!-- panel-heading begin -->
               <h3 class="panel-title"><!-- panel-title begin -->
               
               <div class="row">
                <div>
                         <h3 class="panel-title"><!-- panel-title begin -->
                      <i class="fa fa-tags"></i>  View Orders
                    </h3><!-- panel-title finish --> 
                    </div>
                    <div>
                    <a href="orders_details.php">
                                     
                                     <i class="fa fa-notes"></i> Generate Orders Report
                                 
                                  </a> 
                    </div>
                   </div>
                
               </h3><!-- panel-title finish --> 
            </div><!-- panel-heading finish -->
            
            <div class="panel-body"><!-- panel-body begin -->
                <div class="table-responsive"><!-- table-responsive begin -->
                    <table class="table table-striped table-bordered table-hover"><!-- table table-striped table-bordered table-hover begin -->
                        
                        <thead><!-- thead begin -->
                            <tr><!-- tr begin -->
                                <th> No: </th>
                                <th> Customer Email: </th>
                                <th> Customer Phone No:</th>
                                <th> Invoice No: </th>
                                <th> Product Name: </th>
                                <th> Product Qty: </th>
                                <th> Shipping_county: </th>
                                <th> Order Date: </th>
                                <th> Total Amount: </th>
                                <th> Status: </th>
                                <th>Action: </th>
                                <!--<th> Delete: </th>--> <!--currently disabled-->
                            </tr><!-- tr finish -->
                        </thead><!-- thead finish -->
                        
                        <tbody><!-- tbody begin -->
                            
                            <?php 
          
                                $i=0;
                            
                                $get_orders = "select * from pending_orders";
                                
                                $run_orders = mysqli_query($con,$get_orders);
          
                                while($row_order=mysqli_fetch_array($run_orders)){
                                    
                                    $order_id = $row_order['order_id'];
                                    
                                    $c_id = $row_order['customer_id'];
                                    
                                    $invoice_no = $row_order['invoice_no'];
                                    
                                    $product_id = $row_order['product_id'];
                                    
                                    $qty = $row_order['qty'];
                                    
                                    $Shipping_county = $row_order['county'];
                                    
                                    $order_status = $row_order['order_status'];
                                    
                                    $get_products = "select * from products where product_id='$product_id'";
                                    
                                    $run_products = mysqli_query($con,$get_products);
                                    
                                    $row_products = mysqli_fetch_array($run_products);
                                    
                                    $product_title = $row_products['product_title'];
                                    
                                    $get_customer = "select * from customers where customer_id='$c_id'";
                                    
                                    $run_customer = mysqli_query($con,$get_customer);
                                    
                                    $row_customer = mysqli_fetch_array($run_customer);
                                    
                                    $customer_email = $row_customer['customer_email'];

                                    $get_phoneNo = "select * from customers where customer_id='$c_id'";

                                    $run_phoneNo = mysqli_query($con,$get_customer);

                                    $row_phoneNo = mysqli_fetch_array($run_phoneNo);

                                    $customer_phoneNo = $row_phoneNo['customer_contact'];
                                    
                                    $get_c_order = "select * from customer_orders where invoice_no='$invoice_no'";
                                    
                                    $run_c_order = mysqli_query($con,$get_c_order);
                                    
                                    $row_c_order = mysqli_fetch_array($run_c_order);
                                    if($row_c_order != null){
                                        $order_date =  substr($row_c_order['order_date'],0,11);
                                    
                                        $order_amount = $row_c_order['due_amount'];
                                    }else{
                                        $order_date = '';
                                    
                                        $order_amount = '';
                                    }
                                   
                                    
                                    $i++;
                            
                            ?>
                            
                            <tr><!-- tr begin -->
                                <td> <?php echo $i; ?> </td>
                                <td> <?php echo $customer_email; ?> </td>
                                <td> <?php echo $customer_phoneNo; ?></td>
                                <td> <?php echo $invoice_no; ?></td>
                                <td> <?php echo $product_title; ?> </td>
                                <td> <?php echo $qty; ?></td>
                                <td> <?php echo $Shipping_county; ?> </td>
                                <td> <?php echo $order_date; ?> </td>
                                <td> <?php echo $order_amount; ?> </td>
                                <td>
                                    
                                    <?php 
                                    
                                        if($order_status=='pending'){
                                            
                                            echo $order_status='pending';
                                            
                                        }else{
                                            
                                            echo $order_status='Complete';
                                            
                                        }
                                    
                                    ?>
                                    
                                </td>
                                                
                            <td>

                            
                            <a href="confirm_order.php?invoice_no=<?php echo $invoice_no; ?>" target="_self" class="btn btn-primary btn-sm green"> Confirmed paid </a>     
                          
                    
                            </td>
                              
                            </tr><!-- tr finish -->
                            
                            <?php } ?>
                            
                        </tbody><!-- tbody finish -->
                        
                    </table><!-- table table-striped table-bordered table-hover finish -->
                </div><!-- table-responsive finish -->
            </div><!-- panel-body finish -->
            
        </div><!-- panel panel-default finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 2 finish -->

<?php } ?>