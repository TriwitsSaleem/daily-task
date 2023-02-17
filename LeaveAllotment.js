import React, {useEffect,useState} from 'react';
import axios from "axios";
import {Link, useLocation, useParams,useNavigate} from 'react-router-dom';


function LeaveAllotment() {
    const navigate = useNavigate();

    return(
        <>
        <div class='division' id="bck"  onClick={() => navigate("/table")}>
    <i class="fa fa-arrow-circle-left"></i>                        
    </div>
        <h1 id="tblhead"><u>Leave Allotment</u></h1>
        <div id='list'>
        <table id="dataTable" width="130%" height="130%" cellSpacing="15">
  <thead>
      <tr>
      <th id='hh' width="110px" height="30px"><strong>Casual</strong></th>
          <th id='hh' width="40px">Paid</th>
          <th id='hh' width="40px">Unpaid</th>
          <th id='hh' width="40px">Stock</th>
          <th id='hh' width="40px">Half Day</th>
          <th id='hh' width="40px">Total</th>
      </tr>
  </thead>
  <tbody>
                  <tr id='tbl'>
                      <td width="13%" height="30px">0</td>
                      <td width="13%" height="30px">0</td>
                      <td width="13%" height="30px">0</td>
                      <td width="13%" height="30px">0</td>
                      <td width="13%" height="30px">0</td>
                      <td width="13%" height="30px">12</td>
                  </tr>
  </tbody>
  </table>
    </div>
  </>
    );
}
export default LeaveAllotment;