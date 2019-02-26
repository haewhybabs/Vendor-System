 <link href="<?= base_url(); ?>assets/global/plugins/datatables/dataTables.min.css" rel="stylesheet">
           <div class="row">
           <?php
             if ($this->session->userdata('error') <> '') {
                echo '<div class="alert alert-dismissable alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                         <p>' . $this->session->userdata("error") . '</p>
                    </div>';
            }
             if ($this->session->userdata('message') <> '') {
                echo '<div class="alert alert-dismissable alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                         <p>' . $this->session->userdata("message") . '</p>
                    </div>';
            }
        ?>
            <style>
               .modal-backdrop {
                display:none;
               }
            </style>
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="container">
              <?php if($get_comments==false):?>
                No History Yet
              <?php else:?>
                

                   <?php foreach ($get_comments as $detaill):?> 
                                      <?php if ($detaill->req_status_check_ID==1):
                                                      $x="Rejected By HOD";
                                                     elseif ($detaill->req_status_check_ID==2):
                                                         $x="HOD";
                                                     elseif ($detaill->req_status_check_ID==3):
                                                        $x= "Technical Review";
                                                      elseif ($detaill->req_status_check_ID==4):
                                                        $x= "Store";
                                                      elseif ($detaill->req_status_check_ID==5):
                                                        $x= "Church Administrator";
                                                      elseif ($detaill->req_status_check_ID==6):
                                                        $x= "Budget Control";
                                                      elseif ($detaill->req_status_check_ID==7):
                                                        $x= "Procurement Committee";
                                                      elseif ($detaill->req_status_check_ID==8):
                                                        $x= "Forensic ";

                                                       elseif ($detaill->req_status_check_ID==9):
                                                        $x= "Sap";
                                                        elseif ($detaill->req_status_check_ID==10):
                                                        $x= "Final Approval";
                                                   ?>
                                       <?php endif;?>

                                 
                                   <h3><?=$x;?></h3>
                                  
                                     <table class="table" data-table-name="Total users">
                                        <thead>
                                          <tr>
                                               
                                                <th>Comment</th>
                                                <th>Response</th>
                                                 <th>Current Requisition Stage</th>
                                                 
                                          </tr>






                                          </thead>
                                          <tbody>
                                            <tr>
                                              
                                                <td>
                                                  <?php if($detaill->comments==false):?>
                                                     <?php $detaill->comments="No comment";?>
                                                  <?php endif;?>
                                                      <?=$detaill->comments;?>
                                                </td>

                                                <td>
                                                    <?php if($detaill->response==1):
                                                        echo "Concurred";
                                                      ?>
                                                    <?php else:
                                                      echo "Rejected";
                                                    endif;?>

                                                </td>
                                                   
                                                <td>
                                                   <?=$x;?>
                                                </td>
                                            </tr>


                                           </tbody>
                    
                                  </table>
                                <?php endforeach;?>
                              </div>

                                         
                                </div>   
                        <?php endif;?>           
