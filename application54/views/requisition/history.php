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
                

                   <?php foreach ($get_comments as $detaill):?> 
                                      <?php
                                                     if ($detaill->req_status_check_ID==1):
                                                      $x="Rejected By HOD";
                                                     elseif ($detaill->req_status_check_ID==2):
                                                         $x="HOD";
                                                     elseif ($detaill->req_status_check_ID==3):
                                                        $x= "Technical Review";
                                                      elseif ($detaill->req_status_check_ID==4):
                                                        $x= "Church Administrator";
                                                      elseif ($detaill->req_status_check_ID==5):
                                                        $x= "store has checked";
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
                                                   <?php
                                                      if ($detaill->req_status_check_ID==1):
                                                         echo "Rejected By HOD";
                                                      elseif ($detaill->req_status_check_ID==2):
                                                         echo "HOD";
                                                     elseif ($detaill->req_status_check_ID==3):
                                                        echo "Technical Review";
                                                      elseif ($detaill->req_status_check_ID==4):
                                                        echo "Church Administrator";
                                                      elseif ($detaill->req_status_check_ID==5):
                                                        echo "store has checked";
                                                   ?>
                                                  <?php endif;?>
                                                </td>
                                            </tr>


                                           </tbody>
                    
                                  </table>
                                <?php endforeach;?>
                              </div>

                                         
                                </div>