import React, {useState} from 'react';
import axios from "axios";
import {useNavigate} from 'react-router-dom';

  
const Forgot= () => {

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
        navigate("/Welcome", {
          state: {item
          },
        });
     };


    const [employeeLogin, setEmployeeLogin] = useState({
      personalemail: "",
     // role: "Event Manager",
    });

    const resetEmployeeDetails = () => {
      let _resetEmployee = {
        personalemail: "",
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
    const forgot = () => {
      const _errors = validate();
      setFormErrors(_errors);
  
      let _requestData = {
        ...employeeLogin,
      };
     console.log(_requestData)
      {
        Object.keys(_errors).length == 0
          ? axios
              .post(`http://192.168.1.5/apis/api/Chat/verifyForgot`, _requestData, config)
              .then((res) => {
                 console.log("response",res.data)
                if (res.data != "Failed") {
                  localStorage.setItem(
                    "user_info",
                    JSON.stringify(res.data)
                  );
                  navigate("/ResetPassword",{state:res.data});
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
      <h1><div className="title">Forgot Password</div></h1>
      <hr></hr>
      <div className="form">
      <h1><div className="title">Enter Your Regsitered Email</div></h1>
        <div className="input-container">
          <div class="input_field"> <span id='sal'><i aria-hidden="true" class="fa fa-envelope" id='id'></i></span>
          <input required type="text" value={employeeLogin.personalemail} name="personalemail" placeholder='Enter your Email' onChange={handleChangeInput} error="!employeeLogin.personalemail"/>
          </div>
          <p style={{ color: "red" }}>
                {formErrors.personalemail}
              </p>
        </div>
        <div className="button-container">
         <button type="submit" onClick={forgot}>Reset Password</button> 
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
export default Forgot;