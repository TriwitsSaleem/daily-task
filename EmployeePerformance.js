import React, {useState, useEffect} from 'react';
import axios from "axios";
import {useNavigate, useLocation} from 'react-router-dom';

  
const EmployeePerformance= () => {

    const [joiningdate, setjoiningdate] = useState('');
    const [dateofbirth , setdateofbirth] = useState('');

    const handlejoiningdateChange =(e)=>{
        setjoiningdate(e.target.value);
      }

      const handledateofbirthChange =(e)=>{
        setdateofbirth(e.target.value);
      }
    const { state } = useLocation();
  var config = {
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
      'accept': '*/*',
    },
  };

  const usenavigate = useNavigate();
  /*
  useEffect(()=>{

  },[]);
  */
  const navigate = useNavigate();
  /*
  useEffect(()=>{
  axios.get("http://192.168.1.12/apis/api/Chat/FetchData")
  .then((res) => {
  //console.log(res.data);
  setData(res.data)
  })
  });
*/
const [data,setData] = useState([])
    useEffect(()=>{
    axios.get("http://192.168.1.5/apis/api/Chat/FetchData")
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
        navigate("/EmployeeDetails", {
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
              .post(`http://192.168.1.5/apis/api/Chat/verifyEmp`, _requestData, config)
              .then((res) => {
                 console.log("response",res.data)
                if (res.data != "Failed") {
                  localStorage.setItem(
                    "user_info",
                    JSON.stringify(res.data)
                  );
                  navigate("/EmployeeDetails",{state:res.data});
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
        <div class='division10' onClick={() => navigate("/AdminReport")}>
      <i id="bck" class="fa fa-arrow-circle-left"></i>                         
    </div>
          <div class='division10'><h1>Performance</h1></div>
    <hr></hr><br />
        <div class="row clearfix">
            <div class="col_half">
            <label>From : </label>
              <div class="input_field"> <span id='sal'><i aria-hidden="true" class="fa fa-birthday-cake" id='id'></i></span>
                <input type="date" value={employeeLogin.date} name="date" onChange={(e)=>{handleChangeInput(e)}} required/>
              </div>
            </div>
            <div class="col_half">
            <label>To : </label>
              <div class="input_field"> <span id='sal'><i aria-hidden="true" class="far fa-calendar-alt" id='id'></i></span>
                <input type="date" name="to" value={employeeLogin.to} onChange={(e)=>{handleChangeInput(e)}} required />
              </div>
            </div>
          </div>
          <label>Select Employee : </label>
  <select value={employeeLogin.fullname} name="fullname" onChange={handleChangeInput}>
  <option value="id">Select</option>
  {data.map(data => (
    <option value={data.id} key={data.id}>{data.fullname}</option>
  ))
  }
  </select>

  <div id='biti' className="button-container">
         <button type="submit" onClick={login}>Continue</button>
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
export default EmployeePerformance;