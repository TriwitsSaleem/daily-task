<main>
    <div class="container-fluid site-width">
        <div class="row">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item">

                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header  justify-content-between align-items-center">              
                     <?php if($this->session->userdata('lang')=='EN') { ?>                
                        <h4 class="card-title">My Orders</h4> 
                         <?php } else {?>
                             <h4 class="card-title">ನನ್ನ ಆಜ್ಞೆಗಳು</h4>
                         <?php }?>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display table dataTable table-striped table-bordered" >
                                <thead>
                                    <?php if($this->session->userdata('lang')=='EN') { ?> 
                                    <tr>
                                        <th>Nursery</th>
                                        <th>Order Id</th>
                                      <!--   <th>Payment Mode</th>
                                        <th>Payment Id</th> -->
                                        <th>Ordered date</th>
                                        <th>Pickup Date</th>
                                        <!-- <th>Pickup Time</th> -->
                                        <th>Saplings</th>
                                        <th>Order Status</th>
                                    </tr>
                                    <?php } else {?>
                                        <tr>
                                        <th>ನರ್ಸರಿ</th>
                                        <th>ಆರ್ಡರ್ ಐಡಿ</th>
                                      <!--   <th>ಪಾವತಿ ಮೋಡ್</th>
                                        <th>ಪಾವತಿ ಐಡಿ</th> -->
                                        <th>ಆದೇಶಿಸಿದ ದಿನಾಂಕ</th>
                                        <th>ಎತ್ತಿಕೊಳ್ಳುವ ದಿನಾಂಕ</th>
                                        <th>ಎತ್ತಿಕೊಳ್ಳುವ ಸಮಯ</th>
                                        <th>ಸಸಿಗಳು</th>
                                        <th>ಆದೇಶ ಸ್ಥಿತಿ</th>
                                    </tr>
                                        <?php }?>
                                </thead>
                                <tbody>

                                    <?php foreach ($orders as $eachOrder) {
                                        $slots = $this->db->where('slot_id',$eachOrder->slot_time)->get('slots')->row();?>
                                        <tr>
                                            <td><?php echo $eachOrder->nursery_name?></td>
                                            <td><?php echo $eachOrder->order_id?></td>
                                      <!--       <td><?php echo $eachOrder->payment_mode?></td>
                                            <td><?php echo $eachOrder->payment_ref_id?></td> -->
                                            <td><?php echo $eachOrder->ordered_date?></td>
                                            <td><?php echo ($eachOrder->accept_reject == 0) ? "Pending" : $eachOrder->slot_date?></td>
                                           <td><?php echo ($eachOrder->accept_reject == 0) ? "Pending" : $eachOrder->time?></td>
                                            <td><a class="btn btn-primary" href="<?php echo base_url('ordered-saplings/'.$eachOrder->order_id)?>">List</a></td>
                                            <td><?php echo ($eachOrder->accept_reject == 0) ? "Pending" : 'Accepted'?></td>
                                            
                                        </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 

            </div>                  
        </div>
    </div>
</main>