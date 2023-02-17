import React, {useState, useEffect} from 'react';
import axios from "axios";
import {useNavigate, useLocation} from 'react-router-dom';

  
const Performance= () => {
    const { state } = useLocation();
  var config = {
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
      'accept': '*/*',
    },
  };

  const usenavigate = useNavigate();
  useEffect(()=>{

  },[]);
  const navigate = useNavigate();

  const [data,setData] = useState([])
  useEffect(()=>{
  axios.get("http://192.168.1.12/apis/api/Chat/FetchData")
  .then((res) => {
  //console.log(res.data);
  setData(res.data)
  })
  });

    const [formErrors, setFormErrors] = useState({});

    const validate = () => {
      const errors = {};
      const emailRegex =
      /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  
  
      if (!employeeLogin.fullname) {
        errors.fullname = "Name is required";
      }
      return errors;
    };
    const validateOnChange = (name, value) => {
      const errors = {};
     
  
      if (name == "fullname" && !value) {
        errors.fullname = "Name is required";
      }
      return errors;
    };

 
    const handleEdit = (item) => {
      // console.log(item)
        navigate("/Welcome", {
          state: {item
          },
        });
     };
    const [employeeLogin, setEmployeeLogin] = useState({
      fullname: "",
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
              .post(`http://192.168.1.12/apis/api/Chat/verifyPerformance`, _requestData, config)
              .then((res) => {
                 console.log("response",res.data)
                if (res.data != "Failed") {
                  localStorage.setItem(
                    "user_info",
                    JSON.stringify(res.data)
                  );
                  navigate("/AddPerformance",{state:res.data});
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
    <div className="main-Performance">
    <div class="form_wrapper">
  <div class="form_container">
  <div class="row clearfix">
      <div class=""></div>
      <div className="register-form">
        <form>
        <h1>Employee Performance</h1>
      <hr></hr>
      <div className="form">
      <div className="input-container">
                 
 <label for="role">Select Employee : </label><br />
 <br />
  <select value={employeeLogin.fullname} name="fullname" onChange={handleChangeInput}>
  <option value="">Select</option>
  <option value="Leonel Messi">Leonel Messi</option>
  <option value="MS Dhoni">MS Dhoni</option>
  <option value="Cristiano Ronaldo">Cristiano Ronaldo</option>
  <option value="V Kohli">V Kohli</option>
  
  </select>
        </div><br />
        <div className="button-container">
         <button type="submit" onClick={login}>Continue</button>
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
export default Performance;
