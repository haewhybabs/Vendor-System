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
    background-color: #ddd;
    color: #111;
}
       
    </style>
</head>
<body>
    <div id="company">
        <img src="xownsolutions.com/livingfaith/assets/global/images/logo/new_logo.jpg" alt="healthassur logo" ><br />
    </div>
    <h5 class="header"> REQUEST FOR QUOTATION(RFQ)</h5>
    <p>RFP Number: &nbsp; <?= $message->rfp_number; ?></p>
    <p>Date of Issue: &nbsp; <?= $message->post_date; ?></p>
    <p>Date of Submission: &nbsp; <?= $message->end_date; ?></p>
    
    <p><strong>PURPOSE</strong></p>

    <p>The Procurement Department is seeking quotation for interested candidates to provide various software licenses.</p>

    <p><strong>BACKGROUND</strong></p>

<p>Department of Procurement is department that’s required to procure services, materials, equipment and construction while ensuring that quality, safety, and cost-effectiveness are achieved for Living Faith Church Worldwide Faith Tabernacle Ota.</p>
   <p><strong>REQUIREMENTS</strong></p>
    <div class="details-box">
        <table id="customers">
           <tr>
            <th>S/N</th>
            <th>PRODUCT</th>
            <th>SPECIFICATION</th>
            <th>QTY</th>
            </tr>  
             <?php  $num= 1;
                foreach($material_list as $li){?>
                        <tr>
                          <td><?= $num; ?></td>
                          <td><?= $li->name; ?></td>
                          <td><?= $li->specification; ?></td>
                           <td><?= $li->quantity; ?></td>
                        </tr>
                    <?php $num++; } ?>
        </table>
    </div>
    <p><?= $message->note; ?></p>
    
    <p><strong>SELECTION CRITERIA</strong></p>

<p>Quotation must meet the following criteria:</p>
<ol>
    <li>The quotation should meet the specification required.</li>
    <li> Reasonable pricing, quality not negotiable</li>
    <li>Warranty must be given on all supply.</li>
    <li>Submission within the defined time-window</li>
    <li> You comply with procurement rules as applicable to state and federal law regulation.</li>
</ol>

<p><strong>RFQ PROCESS</strong></p>
<p>The following is the process that Living Faith Church Worldwide procurement team will follow in reviewing and approving quotations, as well as preliminary information on the process that will take place once a quotation is selected.</p>
<ol>
    <li>A copy of this request for Items for quotation will be mailed.</li>
    <li>Once received, completequotation should be sent to purchasingdpt@lfcww.org</li>
    <li>In cases where similar quotations are received from different organizations, the one received first, based on the date and time stamp of the e-mail will receive preference, if all requirements have been met by both quotations.</li>
    <li>If we accept aquotation, then you will be contacted and informed on the decision TO application.</li>
    
</ol>

<p>NB: Final decision for all application decisions are at the sole discretion of the Procurement Department.<br>

CONTACT INFORMATION Please send any questions to purchasingdpt@lfcww.org with your name, email address, and telephone number.</p>
   
    <div id="footer">
       
    </div>
</body>

