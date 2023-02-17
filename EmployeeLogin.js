import React, {useState} from 'react';
import axios from "axios";
import {useNavigate} from 'react-router-dom';

  
const EmployeeLogin= () => {

  var config = {
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
      'accept': '*/*',
    },
  };

    const [formErrors, setFormErrors] = useState({});

    const validate = () => {
      const errors = {};
      const emailRegex =
      /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  
  
  
      if (!employeeLogin.fullname) {
        errors.fullname = "Name is required";
      }
      if (!employeeLogin.personalemail) {
        errors.personalemail = "Email is required";
      }
      if (
        employeeLogin.personalemail &&
        !emailRegex.test(employeeLogin.personalemail)
      ) {
        errors.personalemail = "Enter a Valid Email";
      }
      return errors;
    };
    const validateOnChange = (name, value) => {
      const errors = {};
      const emailRegex =
      /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
     
      if (name == "fullname" && !value) {
        errors.fullname = "Name is required";
      }
      if (name == "personalemail" && !value) {
        errors.personalemail = "Email is required";
      }
      if (name == "personalemail" && value && !emailRegex.test(value)) {
        errors.phonepersonalemailNo = "Enter a Valid Email";
      }
      return errors;
    };

    let navigate = useNavigate();

    const [data,setData] = useState([])
    const handleEdit = (item) => {
      // console.log(item)
        navigate("/EmployeeReport", {
          state: {item
          },
        });
     };


    const [employeeLogin, setEmployeeLogin] = useState({
      fullname: "",
      personalemail: "",
     // role: "Event Manager",
    });

    const resetEmployeeDetails = () => {
      let _resetEmployee = {
        fullname: "",
        //role: "Event Manager",
      };
      setEmployeeLogin(_resetEmployee);
    };

    const handleChangeInput = (e) => {
      let key = e.target.name;
      let value = e.target.value;
      const _currentData = { ...employeeLogin, [key]: value };
      setEmployeeLogin(_currentData);
  
      const _errors = validateOnChange(e.target.name, e.target.value);
  
      if (Object.keys(_errors).length != 0) {
        let finalErrors = {
          ...formErrors,
          [key]: _errors[key],
        };
        setFormErrors(finalErrors);
      } else {
        let finalErrors = {
          ...formErrors,
          [key]: _errors[key],
        };
        setFormErrors(finalErrors);
      }
    };
    const login = () => {
      const _errors = validate();
      setFormErrors(_errors);
  
      let _requestData = {
        ...employeeLogin,
      };
     console.log(_requestData)
      {
        Object.keys(_errors).length == 0
          ? axios
              .post(`http://192.168.0.151/apis/api/Chat/verifyMe`, _requestData, config)
              .then((res) => {
                 console.log("response",res.data)
                if (res.data != "Failed") {
                  localStorage.setItem(
                    "user_info",
                    JSON.stringify(res.data)
                  );
                  navigate("/EmployeeReport",{state:res.data});
                }
                resetEmployeeDetails();
                setFormErrors({});
              })
              .catch((e) => {
                if (e.res.data.message == "Incorrect Password") {
                  alert("Incorrect Password");
                }
                if (
                  e.response.data.message ==
                  "no account found with this phone number..."
                ) {
                  alert("Account Not Found");
                }
                setFormErrors({});
              })
          : console.log("Please Fill All Details");
            }
    };
  return (
    <>
    <div className="app">
    <div className="main-blocking">
    <div class="form_wrapper">
  <div class="form_container">
  <div class="row clearfix">
      <div class=""></div>
      <div className="register-form">
        <form>
      <h1><div className="title">Employee Log In</div></h1>
      <hr></hr>
      <div className="form">
        <div className="input-container">
          <label>Name :</label>
          <div class="input_field"> <span id='sal'><i aria-hidden="true" class="fa fa-user" id='id'></i></span>
          <input type="text" value={employeeLogin.fullname} name="fullname" placeholder='Enter your Name' onChange={handleChangeInput} error="!employeeLogin.fullname"/>
          </div>
          <p style={{ color: "red" }}>
                {formErrors.fullname}
              </p>
        </div>
        <div className="input-container">
          <label>Email :</label>
          <div class="input_field"> <span id='sal'><i aria-hidden="true" class="fa fa-envelope" id='id'></i></span>
          <input type="text" value={employeeLogin.personalemail} name="personalemail" placeholder='Enter your Email' onChange={handleChangeInput} error="!employeeLogin.personalemail"/>
          </div>
          <p style={{ color: "red" }}>
                {formErrors.personalemail}
              </p>
        </div>
        <div className="button-container">
         <button type="submit" onClick={login}>Login</button>
        <p>If You not register <a  href="" onClick={()=>navigate("/")} >"Click here"</a> to register </p>
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
export default EmployeeLogin;