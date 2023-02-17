import React, {useEffect,useState} from 'react';
import axios from "axios";
import {Link, useLocation, useParams,useNavigate} from 'react-router-dom';
import Avatar from "@material-ui/core/Avatar";
import { DynamicStar } from 'react-dynamic-star';
import { colors } from '@material-ui/core';
import Popup from 'reactjs-popup';

function LeaveManagement() {
  const [no , setno] = useState('');
  const [result , setresult] = useState('');
  const [Editdata , setEditdata] = useState('');
  const [popup,setPop]=useState(false)
  var config = {
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
      'accept': '*/*',
    },
  };

//   const handleClickOpen=()=>{
//     setPop(!popup)
// }
const closePopup=()=>{
    setPop(false)
}

  const handleChangeInput =(e)=>{
    setresult(e.target.value);
      }
 
const usenavigate = useNavigate();
useEffect(()=>{

},[]);

const navigate = useNavigate();
const [data,setData] = useState([])
useEffect(()=>{
axios.get("http://192.168.1.3/apis/api/Chat/FetchLeave")
.then((res) => {
//console.log(res.data);
setData(res.data)
})
});
const editTest=(no)=>{
  setPop(!popup)
  console.log('getdata',no)
  setEditdata(no);
  setresult(no.result)
  setno(no.no)
  }
  const [style, setStyle] = useState("buttoni");
  
  const changeStyle = () => {
   // console.log("you just clicked");
  
    setStyle("wide");
  };

const updateData =()=>{
  let formdata = {
    'no':no,
    'result':result
  }
axios.post("http://192.168.1.3/apis/api/Chat/holiday/", formdata, config)
.then((res) => {
console.log(res)
if (res.status === 200) {
alert("Response has been submitted");
} else Promise.reject();
})
.catch((err) => alert("Something went wrong"));
console.log(formdata)
}

    return(
        <>
        
        <div class="division35">
        <h1 id="mm"><u>Employees Leave Report</u></h1>
        </div>
        <div class="division35">
        <div className='modal'>
                            <div className='content'>
                            <select value={result} name="result" onChange={(e)=>{handleChangeInput(e)}} required>
  <option value="" size={15}>Select</option>
  <option value="Accepted">Accept</option>
  <option value="Rejected">Reject</option>
  </select>
                            </div>
                            <div>
                                <button type='submit' onClick={()=>updateData()}>
                                </button>
                            </div>
                        </div>
            </div>
            <div>
        <div>
          
    
  <div  id='zzg' onClick={() => navigate("/table")}>
         <i id="bck" class="fa fa-arrow-circle-left"></i>                         
    </div>
   
        <div id='list'>
        <table id="dataTable" width="130%" height="130%" cellSpacing="15">
  <thead>
      <tr>
        <th  id='hh' width="10px" height="30px">S.No</th>
      {/*  <th id='hh' width="30px">Employee</th> */}
        <th id='hh' width="30px">From</th>
        <th id='hh' width="30px">To</th>
        <th id='hh' width="30px">Type</th>
          <th id='hh' width="40px">Duration</th>
          <th id='hh' width="15px">Status</th>
          <th id='hh' width="60px">Action</th>
          
      </tr>
  </thead>
  <tbody>
      {
          data.map((data, index) => (
                  <tr id='tbl' key={index}>
                    <td width="8px" height="20px">{index+1}</td>
                  {/*  <td width="8px" height="20px">{data.fullname}</td>*/}
                    <td width="20%" height="20px">{data.fromdate}</td>
                    <td width="20%" height="20px">{data.todate}</td>
                    <td width="15%" height="20px">{data.leave}</td>
                      <td width="16%">{data.timeDiff} Days</td>
                      <td width="15%" height="20px">{data.result}</td>
                      <td width="60%" height="20px">   <p class="blinking" type='submit' onClick={()=>editTest(data)}>Click here</p>
                </td>  
                  </tr>))
      }
  </tbody>
  </table>
    </div>
    </div>
    </div>
  </>
    );
}
export default LeaveManagement;