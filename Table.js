import React, {useState, useEffect} from 'react';
import axios from "axios";
import {useNavigate, useLocation} from 'react-router-dom';
import { Link } from "react-router-dom";
//import Update from "./Update";

function Table(){

  const [photo , setphoto] = useState('');
  const [eventDetails, setEventDetails] = useState({
    id: "",
    behaviour: "",
    attitude: "",
    regularity: "",
    project: "",
    behaviourrating: "",
    attituderating: "",
    regularityrating: "",
    projectrating: "",
    photo: "",
    pancard: "",
  });
  console.log('events',eventDetails)
   const [eventTableDetails, setEventTableDetails] = useState(null);
   const initializeEvent = () => {
    axios
      .get(`http://192.168.1.5/apis/api/Chat/getData/`)
      .then((response) => {

        const base64 = btoa(
          new Uint8Array(response.data).reduce(
            (data, byte) => data + String.fromCharCode(byte),
            ''
          )
        )
        setphoto(base64)
        setEventTableDetails(response.data);
        //console.log(response)
         if (response.data != null) {
           let requestForSet = {
            id: response.data.id,
           };
           setEventDetails(requestForSet);
         }
      })
      .catch((e) => {});
  };
  useEffect(() => initializeEvent(), []);
  console.log('response',eventTableDetails)

  const { state } = useLocation();
  
  const usenavigate = useNavigate();
  useEffect(()=>{

  },[]);
  const navigate = useNavigate();

  const [data,setData] = useState([])
  useEffect(()=>{
  axios.get("http://192.168.1.3/apis/api/Chat/FetchData")
  .then((res) => {
  //console.log(res.data);
  setData(res.data)
  })
  });
  const deleteTest = (id) => {
  axios.delete("http://192.168.1.5/apis/api/Chat/deleteRegister/" +id)
  .then((res) => {
  if (res.status === 200) {
    alert("Employee Successfully deleted");
    window.location.reload();
  } else Promise.reject();
  })
    .catch((err) => alert("Something went wrong"));
  };
  const handleEdit = (item) => {
   // console.log(item)
     navigate("/update", {
       state: {item
       },
     });
  };
return (
  <>
  <div  class='division6'>
  <button id='pic'><Link to="/" className="button is-primary mt-5"><span id='ex'>Add New</span></Link></button>
  </div>
  <div  class='division6' onClick={()=>navigate("/AdminReport",{state:state})}> 
           <button type="submit">Performance</button>
           </div>
           <div class='division6' onClick={()=>navigate("/LeaveAllotment")}>
          <button  className="button is-primary">Leave</button>
          </div>
          <div class='division6' onClick={()=>navigate("/LeaveManagement")}>
          <button  className="button is-primary">Leave Mngmt</button>
          </div>
           <div class='division6' id="logi" onClick={()=>navigate("/AdminLogin")}>
          <button  className="button is-primary">LogOut</button>
          </div>
  <div>
  <table className="table table-bordered" id="dataTable" width="100%" cellSpacing="0">
  <thead>
      <tr>
          <th id='hh' width="5%">ID</th>
          <th id='hh' width="8%">Full Name</th>
          <th id='hh' width="10%">Official Email</th>
          <th id='hh' width="12%">Personal Email</th>
          <th id='hh' width="10%">Contact Number</th>
          <th id='hh' width="8%">Position</th>
          <th id='hh' width="6%">Gender</th>
          <th id='hh' width="10%">Joining Date</th>
          <th id='hh' width="10%">Role</th>
          <th id='hh' width="8%">Address</th>
          <th id='hh' width="40%" colSpan="2">Actions</th>
      </tr>
  </thead>
  <tbody>
      {
          data.map(data => (
                  <tr id="tbl" key={data.id}>
                      <td id='hh' width="5%">{data.id}</td>
                      <td id='tbll' width="8%">{data.fullname}</td>
                      <td width="10%">{data.officialemail}</td>
                      <td width="12%">{data.personalemail}</td>
                      <td width="10%">{data.phoneNo}</td>
                      <td width="8%">{data.position}</td>
                      <td width="6%">{data.gender}</td>
                      <td width="10%">{data.joiningdate}</td>
                      <td width="10%">{data.role}</td>
                      <td width="8%">{data.address}</td>
                      <td width="6.5%">
                       <button id='ed' type="submit"  onClick={() => handleEdit(data)}>Edit</button>
                       </td>
                       <td width="20%">
                      <button id='dlt' type="submit" onClick={()=>deleteTest(data.id)}>Delete</button> 
                      </td>
                  </tr>))
      }
  </tbody>
  </table>
  </div>
  </>
);
}
export default Table;
