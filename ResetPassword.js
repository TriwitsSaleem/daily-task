import React, {useEffect, useState} from 'react';
import axios from "axios";
import { Link, useLocation, useParams, useNavigate } from "react-router-dom";
function Reset(){

  const [password , setpassword] = useState('');
  const handleChangeInput =(e)=>{
    setpassword(e.target.value);
  }
  const navigate = useNavigate();

  var config = {
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
      'accept': '*/*',
    },
  };

  const updateUser =()=>{
    let formdata = {
    'password':password,
    }
    axios
    .post(
    "http://192.168.1.5/apis/api/Chat/reset",
    formdata, config)
    .then((res) => {
    console.log(res)
    if (res.status === 200) {
    alert("Password Changed Successfully");
    } else Promise.reject();
    })
    .catch((err) => alert("Something went wrong"));
    }
return(
<>
    <div className="app">
    <div className="main-blockku">
<div class="form_wrapper">
  <div class="form_container">
  <div class="row clearfix">
  <div class="">
    <form>
    <h1>Reset Password</h1>
<hr></hr>
      <div className="register-form">
      <div className="form">
      <div class="row clearfix">
          <label>Enter Password </label><br />
          <div class="input_field"> <span id='sal'><i aria-hidden="true" class="fa fa-lock" id='id'></i></span>
          <input type="text"  value={password} name="password" onChange={handleChangeInput} required />
        </div>
        </div>

        <div class="row clearfix">
          <label>Confirm Password</label>
          <div class="input_field"> <span id='sal'><i aria-hidden="true" class="fa fa-lock" id='id'></i></span>
          <input type="text" value={password} name="password" onChange={handleChangeInput} required />
          </div>
        </div>
        </div>
        </div>
        <br />
         
         <div> 
           <button type="submit" value="Update" onClick={()=>updateUser()}>Reset Password</button>
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
export default Reset;