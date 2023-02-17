import React, {useEffect,useState} from 'react';
import axios from "axios";
import {Link, useLocation, useParams,useNavigate} from 'react-router-dom';
import Avatar from "@material-ui/core/Avatar";
import { DynamicStar } from 'react-dynamic-star';

function EmpoloyeeLeaves(){
  

  const { state } = useLocation();
  console.log('statedata',state)


  const navigate = useNavigate();

   var config = {
       headers: {
         'Content-Type': 'application/x-www-form-urlencoded',
         'accept': '*/*',
       },
     };
/*
     const [eventDetails, setEventDetails] = useState({
        fullname: "",
        duration: "",
     });
     
  

  console.log('events',eventDetails)*/
   const [eventTableDetails, setEventTableDetails] = useState(null);
   const [data,setData] = useState([])
   useEffect(() => initializeEvent(), []);
   const initializeEvent = () => {
    axios.get(`http://192.168.1.3/apis/api/Chat/getLeaves/${state.id}`)
    .then((res) => {
    console.log('test',res);
    setData(res.data)
    })
    }
//console.log('eventDetails',eventDetails)

return (
<>
        <div id='zzg' onClick={() => navigate("/Welcome")}>
        <i id="bck" class="fa fa-arrow-circle-left"></i>                         
   </div>
       <div id='list'>
       <table id="dataTable" width="130%" height="130%" cellSpacing="15">
 <thead>
     <tr>
     <th  id='hh' width="10px" height="30px">S.No</th>
     {/* <th id='hh' width="30px">Employee</th>  */}
     <th id='hh' width="30px">From</th>
     <th id='hh' width="30px">To</th>
     <th id='hh' width="20px">Type</th>
          <th id='hh' width="110px">Duration</th>
          <th id='hh' width="40px">Status</th>
     </tr>
 </thead>
 <tbody>
     {
          data.map((data, index) => (
                 <tr id='tbl' key={index}>
                    <td>{index+1}</td>
               {/*     <td width="20%" height="30px">{data.fullname}</td> */}
                    <td width="20%" height="30px">{data.fromdate}</td>
                    <td width="20%" height="30px">{data.todate}</td>
                    <td width="12%" height="30px">{data.leave}</td>
                     <td width="13%" height="30px">{data.timeDiff} Days</td>
                     <td width="30%" height="30px">{data.result}</td>
                 </tr>))


     }
 </tbody>
 </table>
   </div>
 </>
);
   }
export default EmpoloyeeLeaves;