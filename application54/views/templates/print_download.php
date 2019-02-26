<?php
//This file is a template for sending email
?>
<!DOCTYPE html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext" rel="stylesheet">
    <style>
      
        body{
            font-family: 'Didact Gothic', sans-serif;
            font-size: 90%;
        }
        #footer { 
            position: fixed;
            bottom: 0px;
            width: 100%;
            border-top: 3px solid #000;
            text-align: center;
            color: #000;
            font-size: 80%;
            font-style: italic;
        }
        #company{
            text-align: center;
        }
        #company img{
            height: 150px;
            width: 200px;
        }
        .details-box{
           
            padding: 10px;
        }
        .header{
            background-color: #eee;
            text-align: center;
            padding: 10px;
            font-size: 120%;
        }
        
        #customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    
    color: #111;
}
        
  

    </style>
</head>
<body>
    <div id="company">
       <img src="http://e-procure.lfcww.org/assets/global/images/logo/new_logo.jpg" alt="LFC logo" >
    </div>
    <h5 class="header"> Proceesed Vendor's Quotation Sheet</h5>
    <div class="details-box">
        <table id="customers">
          <tr>
                          <th>Prod</th>
                          <th>Spec</th>
                           <th>Quan</th>
                            <th>Vendor</th>
                             <th>Status</th>
                           <th>Unit Price</th>
                           <th>Total</th>
                        </tr>
                      <tbody>
                         <?php  
                           // echo $prod->name;
                             foreach($list as $li){ 
                                     $quan=$li->quantity;
                                      $price=$li->price;
                                      $amount=$price * $quan;
                               if($li->approve==1){
                                   $rec='Recommended';
                               }else{
                                   $rec=' ';
                               }   
                            ?>
                        <tr>
                          <td><?= $li->name; ?></td>
                            <td><?php foreach($spec as $s){if($li->product_id == $s->product_id && $li->requisition_id == $s->req_id){ echo $s->specification;}} ?></td>
                          <td><?= $quan; ?></td>
                          <td><?= $li->company_name; ?></td>
                          <td><?= $rec; ?></td>
                           <td>&#8358;<?= number_format($price); ?></td>
                            <td>&#8358;<?= number_format($amount); ?></td>
                         
                        </tr>
                        <?php } ?>
        </table>
         <table id="customers">
          <tr>
                          <th>NB</th>
                          <th>(*) SOME ITEMS ARE BENCH MARKED  ON QUALITY OF PRODUCT RATHER THAN PRICE</th>
                           
            </tr>
          
                         <?php  
                            $total=0;
                           // echo $prod->name;
                             foreach($req_list as $req){ 
                                $total += $req->amount;
                            ?>
                        <tr>
                          <th><?= $req->company_name; ?></th>
                           <th>&#8358;<?= number_format($req->amount); ?></th>
                         
                        </tr>
                        <?php } ?>
                         <tr>
                          <th>Grand Total</th>
                            <th>&#8358;<?= number_format($total); ?></th>
                        </tr>
        </table>
    </div>
    <p></p>
   
    <div id="footer">
        <p>Login here <a href="http://e-procure.lfcww.org/">Living Faith Admin. Portal Login</a></p>
    </div>
</body>

