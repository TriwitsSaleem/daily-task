import React, {useEffect,useState} from 'react';
import axios from "axios";
import {Link, useLocation, useParams,useNavigate} from 'react-router-dom';
import Avatar from "@material-ui/core/Avatar";

function User() {
    
  const { state } = useLocation();
  let navigate = useNavigate();
  console.log('statedata',state)
  const logout=()=>{
  axios.post("http://192.168.1.7/apis/api/Chat/logout")
  .then(res => {
    console.log(res.data);
  })
  .catch(err => {
     console.log(err);
   });
  }
  const [eventDetails, setEventDetails] = useState({
    fullname: "",
    position: "",
    role: "",
    officialemail: "",
    personalemail: "",
    phoneNo: "",
    dateofbirth: "",
    gender: "",
    joiningdate: "",
    starttime: "",
    endtime: "",
    address: "",
    behaviour: "",
    attitude: "",
    regularity: "",
    project: "",
 });
  console.log('events',eventDetails)
  const [eventTableDetails, setEventTableDetails] = useState(null);
        const initializeEvent = () => {
         axios
           .get(`http://192.168.1.7/apis/api/Chat/getUser/${state.fullname}`)
           .then((response) => {
             setEventTableDetails(response.data);
             //console.log(response)
              if (response.data != null) {
                let requestForSet = {
            fullname: response.data.fullname,
            position: response.data.position,
            role: response.data.role,
            officialemail: response.data.officialemail,
            personalemail: response.data.personalemail,
            phoneNo: response.data.phoneNo,
            dateofbirth: response.data.dateofbirth,
            gender: response.data.gender,
            joiningdate: response.data.joiningdate,
            starttime: response.data.starttime,
            endtime: response.data.endtime,
            address: response.data.address,
            behaviour: response.data.behaviour,
            attitude: response.data.attitude,
            regularity: response.data.regularity,
            project: response.data.project,
                };
                setEventDetails(requestForSet);
              }
           })
           .catch((e) => {});
       };
    return(
        <>
        <div>
        <div className="main-blocc">
    <div class="form_wrapper">
  <div class="form_container">
  <div class="row clearfix">
      <div class=""></div>
        <section id='sec'>
            <div class="container py-5">
    <div class="row">
      <div class="col">
      <div class='division13' id="bck"  onClick={() => navigate("/Welcome")}>
    <i class="fa fa-arrow-circle-left"></i>                        
    </div>
    <div id='jpg' class='division13'>
            <p id="pirri">My Profile</p> 
        </div>
      </div>
      <hr></hr>
    </div>
        </div>
        <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <div class='division12' >
          <Avatar id="avatt">LM</Avatar>
          </div>
          <div id='edp' class='division12' onClick={() => navigate("/Profile",{state:state})}>
    <button type="submit">Edit Profile</button>                         
    </div> 
          
            <h5 class="my-3"><span id='hh'>{state.fullname}</span></h5>
            <p class="text-muted mb-4" id='pla'>{state.position}</p>
            <p class="text-muted mb-1" id='pla'>{state.role}</p>
          </div>
        </div>
        </div>
        </div>
        <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <hr></hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0" id='head'>Official Email : {state.officialemail}</p>
              </div>
            </div>
            <hr></hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0" id='head'>Personal Email : {state.personalemail}</p>
              </div>
            </div>
            <hr></hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0" id='head'>Phone : {state.phoneNo}</p>
              </div>
            </div>
            <hr></hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0" id='head'>Date Of Birth : {state.dateofbirth}</p>
              </div>
            </div>
            <hr></hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0" id='head'>Gender :{state.gender}</p>
              </div>
            </div>
            <hr></hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0" id='head'>Joining Date :{state.joiningdate}</p>
              </div>
            </div>
            <hr></hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0" id='head'>Start Time : {state.starttime}</p>
              </div>
            </div>
            <hr></hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0" id='head'>End Time :{state.endtime}</p>
              </div>
            </div>
            <hr></hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0" id='head'>Address :{state.address}</p>
              </div>
            </div>
          </div>
        </div>
        </div>
        </section>
        </div>
        </div>
        </div>
    </div>
    <div>
    </div>
    </div>
  </>
    );
}
export default User;