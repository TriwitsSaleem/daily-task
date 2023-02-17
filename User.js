import React, {useState, useEffect} from 'react';
import axios from "axios";
import {useNavigate} from 'react-router-dom';
import { Link } from "react-router-dom";
//import Update from "./Update";

function User(){
  const navigate = useNavigate();
  var config = {
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
      'accept': '*/*',
    },
  };

  
  const [data,setData] = useState([])
  useEffect(()=>{
  axios.get("http://192.168.1.8/apis/api/Chat/FetchUser")
  .then((res) => {
  console.log(res.data);
  setData(res.data)
  })
  });
  /*

const fetchUser=()=>{
axios.get("http://192.168.1.5/apis/api/Chat/FetchUser", config)
.then((res) => {
console.log(res.data);
setData(res.data)
})
}
*/
  const handleEdit = (item) => {
   // console.log(item)
     navigate("/update", {
       state: {item
       },
     });
  };
return (
  <>
  <div>
  <table className="table table-bordered" id="dataTable" width="100%" cellSpacing="0">
  <thead>
      <tr>
          <th width="5%">ID</th>
          <th width="10%">Full Name</th>
          <th width="15%">Official Email</th>
          <th width="15%">Personal Email</th>
          <th width="10%">Contact Number</th>
          <th width="8%">Position</th>
          <th width="6%">Gender</th>
          <th width="10%">Joining Date</th>
          <th width="10%">Role</th>
          <th width="10%">Date of Birth</th>
          <th width="10%">Start Time</th>
          <th width="10%">End time</th>
          <th width="40%">Address</th>
          <th width="40%">Actions</th>
          <th width="40%"></th>

      </tr>
  </thead>
  <tbody>
      {
          data.map(data => (
                  <tr key={data.id}>
                      <td width="5%">{data.id}</td>
                      <td width="18%">{data.fullname}</td>
                      <td width="15%">{data.officialemail}</td>
                      <td width="15%">{data.personalemail}</td>
                      <td width="10%">{data.phoneNo}</td>
                      <td width="8%">{data.position}</td>
                      <td width="6%">{data.gender}</td>
                      <td width="10%">{data.joiningdate}</td>
                      <td width="10%">{data.role}</td>
                      <td width="10%">{data.dateofbirth}</td>
                      <td width="10%">{data.starttime}</td>
                      <td width="10%">{data.endtime}</td>
                      <td width="40%">{data.address}</td>
                      <td width="40%">
                       <button id='ed' type="submit"  onClick={() => handleEdit(data)}>Edit</button>
                       </td>
                  </tr>))
      }
  </tbody>
  </table>
 
  <div id='tbl' onClick={()=>navigate("/Login")}>
          <button  className="button is-primary">LogOut</button>
          </div>
   
  </div>
  </>
);
}
export default User;