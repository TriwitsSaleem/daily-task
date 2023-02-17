import React, {useEffect,useState} from 'react';
import axios from "axios";
import {Link, useLocation, useParams,useNavigate} from 'react-router-dom';

function Welcome() {
  const { state } = useLocation();
  let navigate = useNavigate();
  console.log('statedata',state)
  const logout=()=>{
  axios.post("http://192.168.1.6/apis/api/Chat/logout")
  .then(res => {
    console.log(res.data);
  })
  .catch(err => {
     console.log(err);
   });
  }

  const [eventDetails, setEventDetails] = useState({
    fullname: "",
 });
  console.log('events',eventDetails)
  const [eventTableDetails, setEventTableDetails] = useState(null);
        const initializeEvent = () => {
         axios
           .get(`http://192.168.1.6/apis/api/Chat/getUser/${state.fullname}`)
           .then((response) => {
             setEventTableDetails(response.data);
             //console.log(response)
              if (response.data != null) {
                let requestForSet = {
            fullname: response.data.fullname,
                };
                setEventDetails(requestForSet);
              }
           })
           .catch((e) => {});
       };
    return(
        <>
         <div className="app">
          <div id='grd'>
    <div className="main-blockingg">
    <div class="form_wrapper">
  <div class="form_container">
  <div class="row clearfix">
      <div class=""></div>
      <form>
      <h1><div className="title" id='ho'>Home</div></h1>
      <p id="leave"><a href="" id="anchor" onClick={()=>navigate("/LeaveApplication", {state:state})} >Click here </a>  to Apply for Leave Application</p> 
      <hr></hr>

      <div class='division12' onClick={() => navigate("/UserProfile",{state:state})}>
    <button id='nb' type="submit">My Profile</button>                         
    </div>
    <div class='division12' onClick={()=>navigate("/EmployeeReport",{state:state})}> 
           <button id='nb' type="submit">My Report</button>
           </div>
           <div class='division12' onClick={()=>navigate("/EmpoloyeeLeaves",{state:state})}> 
           <button id='nb' type="submit">My Leaves</button>
           </div>
           <div id="wl" class='division12'onClick={()=>navigate("/Login")}>
    <button  id='nb'  type="submit" value="LogOut"  onClick={logout}>Log out</button>
    </div>
<div>
        <h1 id='come'><i id='smile' class="fa fa-smile-o"></i> Welcome <span id='pho'>{state.fullname}</span></h1>
        <br /></div>
        <div id='ll'>
          <p id='lorem'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nibh orci, imperdiet quis sapien aliquam, porttitor congue lectus. Donec mattis quam a felis ultricies vehicula. Nam pellentesque et nunc nec semper. Aliquam euismod enim ac augue sodales, ut egestas purus tincidunt. Nulla et sem scelerisque, pretium diam in, tempus erat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla in metus ac urna molestie finibus. Aliquam ut velit ac orci rutrum suscipit vel nec tortor.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nibh orci, imperdiet quis sapien aliquam, porttitor congue lectus. Donec mattis quam a felis ultricies vehicula. Nam pellentesque et nunc nec semper. Aliquam euismod enim ac augue sodales, ut egestas purus tincidunt. Nulla et sem scelerisque, pretium diam in, tempus erat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla in metus ac urna molestie finibus. Aliquam ut velit ac orci rutrum suscipit vel nec tortor.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nibh orci, imperdiet quis sapien aliquam, porttitor congue lectus. Donec mattis quam a felis ultricies vehicula. Nam pellentesque et nunc nec semper. Aliquam euismod enim ac augue sodales, ut egestas purus tincidunt. Nulla et sem scelerisque, pretium diam in, tempus erat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla in metus ac urna molestie finibus. Aliquam ut velit ac orci rutrum suscipit vel nec tortor.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nibh orci, imperdiet quis sapien aliquam, porttitor congue lectus. Donec mattis quam a felis ultricies vehicula. Nam pellentesque et nunc nec semper. Aliquam euismod enim ac augue sodales, ut egestas purus tincidunt. Nulla et sem scelerisque, pretium diam in, tempus erat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla in metus ac urna molestie finibus. Aliquam ut velit ac orci rutrum suscipit vel nec tortor.</p>
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

export default Welcome;
