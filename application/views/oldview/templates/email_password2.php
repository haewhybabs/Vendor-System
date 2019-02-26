<?php
//This file is a template for sending email
?>
<!DOCTYPE html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext" rel="stylesheet">
    <style>
      
        body{
            font-family: 'Didact Gothic', sans-serif;
            font-size: 120%;
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
            border: 3px solid #000;
            padding: 20px;
        }
        .header{
            background-color: #eee;
            text-align: center;
            padding: 10px;
            font-size: 120%;
        }
        table{
            border: none;
            width: 60%;
            text-align: center;
        }
        #company-table{
            text-align: justify;
        }
        thead{
            padding: 5px;
            background-color: #eee;
        }
    </style>
</head>
<body>
    <div id="company">
        <img src="http://e-procure.lfcww.org/assets/global/images/logo/new_logo.jpg" alt="LFC logo" >
    </div>
    <h5 class="header"> New registration login details into LFC e-procurement vendors' Portal. Kindly activate account before login.</h5>
    <div class="details-box">
        <table id="company-table">
            <tr>
                <td>
                    <strong>Company Name:</strong>
                </td>
                <td>
                    <?php echo ucfirst($company_name); ?>
                </td>
            </tr>
           <tr>
                <td>
                    <strong>Phone:</strong> 
                </td>
                <td>
                    <?php echo $phone; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Email/Username:</strong>
                </td>
                <td>
                    <?php echo $email; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Password:</strong> 
                </td>
                <td>
                    <?php echo $password; ?>
                </td>
            </tr>
        </table>
    </div>
     <h5>On activation of your account, you are required to complete your application registration as incomplete registration will automtically be rejected for further processes. Thanks</h5>

   <p>Activate Your Vendor Account Here <a href="http://procure.lfcww.org/registration/activate/<?php echo $code;?>">Living Faith Vendors' Portal Login</a></p>
    
    <div id="footer">
       
    </div>
</body>