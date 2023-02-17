import React, { useState } from "react";
import {useNavigate} from 'react-router-dom';
import "../App.css";

function Admin() {
  const [errorMessages, setErrorMessages] = useState({});
  const [isSubmitted, setIsSubmitted] = useState(false);

  const database = [
    {
      username: "Admin",
      password: "Admin@123"
    },
  ];

  const errors = {
    uname: <span id="err">invalid name</span>,
    pass: <span id="err">invalid password</span>
  };

  const navigate = useNavigate();
  const handleSubmit = (event) => {
    //Prevent page reload
    event.preventDefault();

    var { uname, pass } = document.forms[0];

    // Find user login info
    const userData = database.find((user) => user.username === uname.value);

    // Compare user info
    if (userData) {
      if (userData.password !== pass.value) {
        // Invalid password
        setErrorMessages({ name: "pass", message: errors.pass });
      } else {
        setIsSubmitted(true);
      }
    } else {
      // Username not found
      setErrorMessages({ name: "uname", message: errors.uname });
    }
  };

  // Generate JSX code for error message
  const renderErrorMessage = (name) =>
    name === errorMessages.name && (
      <div className="error">{errorMessages.message}</div>
    );

  // JSX code for login form
  const renderForm = (
    <div className="app">
      <div className="main-blockinggg">
    <div class="form_wrapper">
  <div class="form_container">
  <div class="row clearfix">
      <div class=""></div>
      <div className="register-form">
      <form onSubmit={handleSubmit}>
      <h1><div className="title">Admin Login</div></h1>
      <hr></hr>
      <div className="form">
      
        <div className="input-container">
        <label>Name :</label>
          <div class="input_field"> <span id='sal'><i aria-hidden="true" class="fa fa-user" id='id'></i></span>
          <input type="text" name="uname" placeholder="Name" required />
          </div>
          {renderErrorMessage("uname")}
        </div>
        <div className="input-container">
        <label>Password :</label>
          <div class="input_field"> <span id='sal'><i aria-hidden="true" class="fas fa-key" id='id'></i></span>
          <input type="password" name="pass" placeholder="Password" required />
          </div>
          {renderErrorMessage("pass")}
        </div>
        <div className="button-container">
          <button type="submit">Login</button>
        </div>
        </div>
      </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    
    </div>
  );

  return (
    <div className="app">
      <div className="login-form">
        
        {isSubmitted ? <div onClick={navigate("/table")}></div> : renderForm}
      </div>
    </div>
  );
}
export default Admin;