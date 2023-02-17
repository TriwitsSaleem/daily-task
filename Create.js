//import logo from './logo.svg';
import React, {useState} from 'react';
import './App.css';
import axios from "axios";
import {useNavigate} from 'react-router-dom';
import validator from 'validator'
//import validator from 'validator';
//import Table from './components/Table';

 function Create() {

  const navigate = useNavigate();
    const [fullname , setfullname] = useState('');
    const [password , setpassword] = useState('');
    const [officialemail , setofficialemail] = useState('');
    const [personalemail, setpersonalemail] = useState('');
    const [phoneNo, setphoneNo] = useState('');
    const [position , setposition] = useState('');
    const [gender , setgender] = useState('');
    const [joiningdate, setjoiningdate] = useState('');
    const [role, setrole] = useState('');
    const [dateofbirth , setdateofbirth] = useState('');
    const [starttime , setstarttime] = useState('');
    const [endtime, setendtime] = useState('');
    const [address, setaddress] = useState('');
    const [oemailError, setOEmailError] = useState('')
    const [emailError, setEmailError] = useState('')
    const Navigate = useNavigate();
    
    const handleChange =(e)=>{
      setfullname(e.target.value);
    }
    const handlepasswordChange =(e)=>{
      setpassword(e.target.value);
    }
    const handleofficialemailChange =(e)=>{
      setofficialemail(e.target.value);
      var officialemail = e.target.value
    if (validator.isEmail(officialemail)) {
      setOEmailError('Valid Email')
    } else {
      setOEmailError('Enter valid Email!')
    }
    }
    const handlepersonalemailChange =(e)=>{
      setpersonalemail(e.target.value);
      var personalemail = e.target.value
    if (validator.isEmail(personalemail)) {
      setEmailError('Valid Email')
    } else {
      setEmailError('Enter valid Email!')
    }
    }
    const handlephoneNoChange =(e)=>{
      setphoneNo(e.target.value);
    }
    const handlepositionChange =(e)=>{
        setposition(e.target.value);
      }
      const handlegenderChange =(e)=>{
        setgender(e.target.value);
      }
      const handlejoiningdateChange =(e)=>{
        setjoiningdate(e.target.value);
      }
      const handleroleChange =(e)=>{
        setrole(e.target.value);
      }

      const handledateofbirthChange =(e)=>{
        setdateofbirth(e.target.value);
      }
      const handlestarttimeChange =(e)=>{
        setstarttime(e.target.value);
      }
      const handleendtimeChange =(e)=>{
        setendtime(e.target.value);
      }
      const handleaddressChange =(e)=>{
        setaddress(e.target.value);
      }
    var config = {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'accept': '*/*',
      },
    };

    const submitdata =(e)=>{

      if(fullname.length<3 || dateofbirth>joiningdate || personalemail.length<3 || personalemail.length<3 || phoneNo.length<10 || position.length<1 || role.length<1)
        {
            alert("invalid")
        }
        else if ((validator.isEmail(personalemail))){
        
      let formdata = {
        'fullname':fullname,
        'password':password,
        'officialemail':officialemail,
        'personalemail':personalemail,
        'phoneNo':phoneNo,
        'position':position,
        'gender':gender,
        'joiningdate':joiningdate,
        'role':role,
        'dateofbirth':dateofbirth,
        'starttime':starttime,
        'endtime':endtime,
        'address':address
      }
      axios
      .post(
      "http://192.168.1.6/apis/api/Chat/PostData" ,
      formdata, config)
      .then((res) => {
      console.log(res)
      if (res.status === 200) {
      alert("Employee Successfully Added")
      } else Promise.reject();
      })
      .catch((err) => alert("Something went wrong"));
      console.log(formdata)
    }
      e.preventDefault()
    }
  return (
    <>
    <div className="main-block">
    <div class="form_wrapper">
  <div class="form_container">
  <div class="row clearfix">
      <div class="">
      <form onSubmit={submitdata}>
      <div id='abc'>
      <h1>Employee Registration</h1>
      </div>
      <hr></hr>
      <div id='dc' onClick={()=>navigate("/AdminLogin")}>
          <button  className="button is-primary">Admin</button>
          </div>
          <div class="row clearfix">
            <div class="col_half">
      <div class="input_field"> <span id='sal'><i aria-hidden="true" class="fa fa-user" id='id'></i></span>
            <input type="text" name="fullname" value={fullname} placeholder="Full Name" onChange={(e)=>{handleChange(e)}} required />
          </div>
          </div>
          <div class="col_half">
      <div class="input_field"> <span id='sal'><i aria-hidden="true" class="fa fa-lock" id='id'></i></span>
            <input type="password" name="password" value={password} placeholder="Password" onChange={(e)=>{handlepasswordChange(e)}} required />
          </div>
          </div>
          </div>
          <div class="row clearfix">
            <div class="col_half">
              <div class="input_field"> <span id='sal'><i aria-hidden="true" class="fa fa-envelope" id='id'></i></span>
                <input type="text" name="personalemail" value={personalemail} placeholder="Personal Email" onChange={(e)=>{handlepersonalemailChange(e)}} required/>
              </div>
            </div>
            <div class="col_half">
              <div class="input_field"> <span id='sal'><i aria-hidden="true" class="fa fa-envelope" id='id'></i></span>
                <input type="text" name="officialemail" value={officialemail} placeholder="Official Email" onChange={(e)=>{handleofficialemailChange(e)}} required />
              </div>
            </div>
          </div>
          <span style={{
          color: 'red',
        }}>{emailError}</span>
          <span id='hide'>**********************</span>
          
          <span style={{
          color: 'red',
        }}>{oemailError}</span>
<div class="row clearfix">
            <div class="col_half">
              <div class="input_field"> <span id='sal'><i aria-hidden="true" class="fa fa-phone" id='id'></i></span>
                <input type="text" name="phoneNo" value={phoneNo} placeholder="Contact Number" onChange={(e)=>{handlephoneNoChange(e)}} required/>
              </div>
            </div>
            <div class="col_half">
              <div class="input_field"> <span id='sal'><i aria-hidden="true" class="fa fa-genderless" id='id'></i></span>
                <input type="text" name="gender" value={gender} placeholder="Gender" onChange={(e)=>{handlegenderChange(e)}} required />
              </div>
            </div>
          </div>
          <div class="row clearfix">
            <div class="col_half">
            <label id='sup'>Date Of Birth : </label>
              <div class="input_field"> <span id='sal'><i aria-hidden="true" class="fa fa-birthday-cake" id='id'></i></span>
                <input type="date" value={dateofbirth} name="dateofbirth" placeholder="Date Of Birth" onChange={(e)=>{handledateofbirthChange(e)}} required/>
              </div>
            </div>
            <div class="col_half">
            <label id='sip'>Joining Date : </label>
              <div class="input_field"> <span id='sal'><i aria-hidden="true" class="far fa-calendar-alt" id='id'></i></span>
                <input type="date" name="joiningdate" value={joiningdate} placeholder="Gender" onChange={(e)=>{handlejoiningdateChange(e)}} required />
              </div>
            </div>
          </div>
          <div class="row clearfix">
          <div class="col_half">
          <label for="role">Role : </label><br />
  <select id='moon'  name="role" onChange={(e)=>{handleroleChange(e)}}>
  <option value="developer" size={10}>Select</option>
    <option value="developer">Software developer</option>
    <option value="data scientist">Data Scientist</option>
    <option value="IT project managers">IT project managers</option>
  </select>
          </div>
          <div class="col_half">
          <label for="position">Position : </label><br />
  <select name="position" id='moon1' onChange={(e)=>{handlepositionChange(e)}}>
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
         <label for="appt">Start Time</label>
          <input type="time" value={starttime} name="appt" onChange={(e)=>{handlestarttimeChange(e)}} required />
         </div>
         <div class="col_half"><br />
         <label for="appt">End Time</label>
          <input type="time" value={endtime} name="appt" onChange={(e)=>{handleendtimeChange(e)}} required />
         </div>
         </div>
          <br />
          <br />
          <br />
          <br />
          <div class="row clearfix"><br />
      <label>Address</label><br />
          <textarea rows="3" cols="58" type="text" value={address} name="address" onChange={(e)=>{handleaddressChange(e)}} required />
          </div>
          <div className="btn-block">
          <button className="button is-primary">Register</button>
          </div>
          <div id='lin'>
          <p id='para'>Allready have an Account? <a  href="" onClick={()=>navigate("/Login")} >Login</a></p>
        </div>
        </form>
        </div>
        </div>
        </div>
 </div>
 </div>
 <br />
      </>
  );
}
export default Create;