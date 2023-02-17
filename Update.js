import React, {useEffect, useState} from 'react';
import axios from "axios";
import { Link, useLocation, useParams, useNavigate } from "react-router-dom";
function Update(){
  const { state } = useLocation();
 
console.log('data status',state.item)
  const navigate = useNavigate();

  var config = {
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
      'accept': '*/*',
    },
  };
  
   const handleChangeInput = (e) => {
    let key = e.target.name;
    let value = e.target.value;
    const _currentData = { ...eventDetails, [key]: value };
    setEventDetails(_currentData);
    
  };
   const [eventDetails, setEventDetails] = useState({
    id: "",
    fullname: "",
    officialemail: "",
    personalemail: "",
    phoneNo: "",
    position: "",
    gender: "",
    joiningdate: "",
    role: "",
    dateofbirth: "",
    starttime: "",
    endtime: "",
    address: "",
  });
  console.log('events',eventDetails)
   const [eventTableDetails, setEventTableDetails] = useState(null);
   const initializeEvent = () => {
    axios
      .get(`http://192.168.1.3/apis/api/Chat/getData/${state.item.id}`)
      .then((response) => {
        setEventTableDetails(response.data);
        //console.log(response)
         if (response.data != null) {
           let requestForSet = {
            id: response.data.id,
            fullname: response.data.fullname,
            officialemail: response.data.officialemail,
            personalemail: response.data.personalemail,
            phoneNo: response.data.phoneNo,
            position: response.data.position,
            gender: response.data.gender,
            joiningdate: response.data.joiningdate,
            role: response.data.role,
            dateofbirth: response.data.dateofbirth,
            starttime: response.data.starttime,
            endtime: response.data.endtime,
            address: response.data.address,
           };
           setEventDetails(requestForSet);

         }
      })
      .catch((e) => {});
  };
  useEffect(() => initializeEvent(), []);
  console.log('response',eventTableDetails)

  const updateData =()=>{
        let formdata = {
          'id':eventDetails.id,
          'fullname':eventDetails.fullname,
          'officialemail':eventDetails.officialemail,
          'personalemail':eventDetails.personalemail,
          'phoneNo':eventDetails.phoneNo,
          'position':eventDetails.position,
          'gender':eventDetails.gender,
          'joiningdate':eventDetails.joiningdate,
          'role':eventDetails.role,
          'dateofbirth':eventDetails.dateofbirth,
          'starttime':eventDetails.starttime,
          'endtime':eventDetails.endtime,
          'address':eventDetails.address
        }
  console.log('submitdata',formdata);
  axios.post("http://192.168.1.5/apis/api/Chat/student/", formdata, config)
  .then((res) => {
  console.log(res)
  if (res.status === 200) {
    alert("Employee Updated Successfully");
    } else Promise.reject();
     })
  .catch((err) => alert("Something went wrong"));
    console.log(formdata)
    }

return(
<>
    <div className="app">
    <div className="main-blockk">
<div class="form_wrapper">
  <div class="form_container">
  <div class="row clearfix">
  <div class="">
    <form>
    <h1>Update Page</h1>
<hr></hr>
<div id='dcc' onClick={()=>navigate("/FurtherDetails",{state:state})}>
          <button  className="button is-primary">Further Details</button>
          </div>
      <div className="register-form">
      <div className="form">
      <div class="row clearfix">
          <label>Full Name </label><br />
          <div class="input_field"> <span id='sal'><i aria-hidden="true" class="fa fa-user" id='id'></i></span>
          <input type="text"  value={eventDetails.fullname} name="fullname" onChange={handleChangeInput} required />
        </div>
        </div>

        <div class="row clearfix">
        <div class="col_half">
          <label>Official Email</label>
          <div class="input_field"> <span id='sal'><i aria-hidden="true" class="fa fa-envelope" id='id'></i></span>
          <input type="text" value={eventDetails.officialemail} name="officialemail" onChange={handleChangeInput} required />
          </div>
        </div>
        <div class="col_half">
          <label>Personal Email</label>
          <div class="input_field"> <span id='sal'><i aria-hidden="true" class="fa fa-envelope" id='id'></i></span>
          <input type="text" value={eventDetails.personalemail} name="personalemail" onChange={handleChangeInput} required />
          </div>
        </div>
        </div>

        <div class="row clearfix">
        <div class="col_half">
        <label>Contact Number</label>
        <div class="input_field"> <span id='sal'><i aria-hidden="true" class="fa fa-phone" id='id'></i></span>
          <input type="text" value={eventDetails.phoneNo} name="phoneNo" onChange={handleChangeInput} required />
          </div>
        </div>
        <div class="col_half">
        <label>Gender</label>
        <div class="input_field"> <span id='sal'><i aria-hidden="true" class="fa fa-genderless" id='id'></i></span>
          <input type="text" value={eventDetails.gender} name="gender" onChange={handleChangeInput} required />
          </div>
        </div>
        </div>
        <div class="row clearfix">
        <div class="col_half">
        <label>Date Of Birth</label>
        <div class="input_field"> <span id='sal'><i aria-hidden="true" class="fa fa-birthday-cake" id='id'></i></span>
          <input type="date" value={eventDetails.dateofbirth} name="dateofbirth" onChange={handleChangeInput} required />
          </div>
        </div>
        <div class="col_half">
        <label>Joining Date</label>
        <div class="input_field"> <span id='sal'><i aria-hidden="true" class="far fa-calendar-alt" id='id'></i></span>
          <input type="date" value={eventDetails.joiningdate} name="joiningdate" onChange={handleChangeInput} required />
          </div>
        </div>
        </div>
        <div class="row clearfix">
        <div class="col_half">
        <label for="role">Role : </label>
  <select value={eventDetails.role} name="role" onChange={handleChangeInput} required>
  <option value="developer" size={10}>Select</option>
    <option value="developer">Software developer</option>
    <option value="data scientist">Data Scientist</option>
    <option value="IT project managers">IT project managers</option>
  </select>
        </div>
        <div class="col_half">
        <label for="position">Position : </label>
  <select value={eventDetails.position} name="position" onChange={handleChangeInput} required >
    <option value="INTERN">Select</option>
    <option value="HR">HR</option>
    <option value="CEO">CEO</option>
    <option value="Software Architect">Software Architect</option>
    <option value="Technical Lead">Technical Lead</option>
  </select>
        </div>
        </div>
        <br />
        <div class="row clearfix">
        <div class="col_half"><br />
        <label>Start Time</label>
          <input type="time" value={eventDetails.starttime} name="starttime" onChange={handleChangeInput} required />
        </div>
        <div class="col_half"><br />
        <label>End Time</label>
          <input type="time" value={eventDetails.endtime} name="endtime" onChange={handleChangeInput} required />
        </div>
        </div>
        <br />
        <div class="row clearfix"><br />
          <label>Address</label><br />
          <textarea rows="3" cols="58" type="text" value={eventDetails.address} name="address" onChange={handleChangeInput} required/>
          </div>
          <div className="btn-blockkk">
         <div onClick={()=>navigate("/table")}> 
           <button type="submit" value="Update" onClick={()=>updateData()}> Update</button>
           </div> 
        </div>
    </div>
      </div>
      </form>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>  
  </>

);
}
export default Update;