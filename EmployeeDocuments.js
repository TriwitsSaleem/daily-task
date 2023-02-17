import React, {useEffect, useState} from 'react';
import axios from "axios";
import { Link, useLocation, useParams, useNavigate } from "react-router-dom";

function EmployeeDocuments(){
  const { state } = useLocation();
  const[card1 , setCard1] = useState('');

  const [File, setFile] = useState();
  const [File1, setFile1] = useState();
  const [File2, setFile2] = useState();
  const [File3, setFile3] = useState();
  const [File4, setFile4] = useState();
  const [File5, setFile5] = useState();
  const [File6, setFile6] = useState();

  const handleFileChangeInput = (e) => {
    let key = e.target.name;
    let value = e.target.value;
    const _currentData = { ...eventDetails, [key]: value };
    setEventDetails(_currentData);
    console.log(e.target.files);
    setFile(URL.createObjectURL(e.target.files[0]));
  };

  const handleFile1ChangeInput = (e) => {
    let key = e.target.name;
    let value = e.target.value;
    const _currentData = { ...eventDetails, [key]: value };
    setEventDetails(_currentData);
    console.log(e.target.files);
    setFile1(URL.createObjectURL(e.target.files[0]));
  };

  const handleFile2ChangeInput = (e) => {
    let key = e.target.name;
    let value = e.target.value;
    const _currentData = { ...eventDetails, [key]: value };
    setEventDetails(_currentData);
    console.log(e.target.files);
    setFile2(URL.createObjectURL(e.target.files[0]));
  };

  const handleFile3ChangeInput = (e) => {
    let key = e.target.name;
    let value = e.target.value;
    const _currentData = { ...eventDetails, [key]: value };
    setEventDetails(_currentData);
    console.log(e.target.files);
    setFile3(URL.createObjectURL(e.target.files[0]));
  };

  const handleFile4ChangeInput = (e) => {
    let key = e.target.name;
    let value = e.target.value;
    const _currentData = { ...eventDetails, [key]: value };
    setEventDetails(_currentData);
    console.log(e.target.files);
    setFile4(URL.createObjectURL(e.target.files[0]));
  };

  const handleFile5ChangeInput = (e) => {
    let key = e.target.name;
    let value = e.target.value;
    const _currentData = { ...eventDetails, [key]: value };
    setEventDetails(_currentData);
    console.log(e.target.files);
    setFile5(URL.createObjectURL(e.target.files[0]));
  };

  const handleFile6ChangeInput = (e) => {
    let key = e.target.name;
    let value = e.target.value;
    const _currentData = { ...eventDetails, [key]: value };
    setEventDetails(_currentData);
    console.log(e.target.files);
    setFile6(URL.createObjectURL(e.target.files[0]));
  };
 
console.log('data status',state)
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
    console.log(e.target.files);
    setFile(URL.createObjectURL(e.target.files[0]));
  };

  
  const [pancard, setpancard] = useState();
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
    photo: "",
    adharcard: "",
    pancard: "",
    identycard: "",
    sslc: "",
    degree: "",
    offerlatter: "",
  });
  console.log('events',eventDetails)
   const [eventTableDetails, setEventTableDetails] = useState(null);
   const initializeEvent = () => {
    axios
      .get(`http://192.168.1.7/apis/api/Chat/getData/${state.id}`)
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
            photo: response.data.photo,
            adharcard: response.data.adharcard,
            pancard: response.data.pancard,
            identycard: response.data.identycard,
            sslc: response.data.sslc,
            degree: response.data.degree,
            offerlatter: response.data.offerlatter,
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
          'address':eventDetails.address,
          'photo':eventDetails.photo,
          'adharcard':eventDetails.adharcard,
          'pancard':eventDetails.pancard,
          'identycard':eventDetails.identycard,
          'sslc':eventDetails.sslc,
          'degree':eventDetails.degree,
          'offerlatter':eventDetails.offerlatter
        }
  console.log('submitdata',formdata);
  axios.post("http://192.168.1.7/apis/api/Chat/student/", formdata, config)
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
    <div className="main-further">
<div class="form_wrapper">
  <div class="form_container">
  <div class="row clearfix">
  <div class="">
    <form>
    <h1>Further Details</h1>
<hr></hr><br />
<p>Upload Documents Here</p>
<br />
      <div className="register-form">
      <div className="form">
      <div class="row clearfix">
            <div class="col_half">
        <div class="division15">
        <input placeholder='Photo' id="doc" type='text'/>
        </div> 
        <div class="division15">
        <input id="image" type="file" name="photo" onChange={handleFileChangeInput} />
        </div>
        <div  class="division15">
        <img  src={File} id="File"/>
        </div>
        </div>
        <div class="col_half">
        <div class="division16">
        <input placeholder='Aadhar' id="doc" type='text' />
        </div> 
        <div class="division16">
          <input id="docc" type="file" name="adharcard" onChange={handleFile1ChangeInput}/>
        </div>
        <div class="division16">
        <img src={File1} value={eventDetails.adharcard} id="File" />
        </div>
        </div>
        </div><br /><br />
        <div class="row clearfix">
            <div class="col_half"><br />
        <div class="division17">
        <input placeholder='Pancard' id="doc" type='text' /> 
        </div>
        <div class="division17">
        <input id="docc" type="file" name="pancard" onChange={handleFile2ChangeInput} />
        </div>
        <div class="division17">
        <img src={File2} id="File"/>
        </div>
        </div>
        <div class="col_half"><br />
        <div class="division18">
        <input placeholder='ID' id="doc" type='text' />
        </div>
        <div class="division18">
        <input id="docc" type="file" name="identycard"  onChange={handleFile3ChangeInput} />
        </div>
        <div class="division18">
        <img src={File3} id="File" />
        </div>
        </div>
        </div>

        <div class="row clearfix">
            <div class="col_half"><br />
        <div class="division19">
        <input placeholder='SSLC' id="doc" type='text' />
        </div>
        <div class="division19">
        <input id="docc" type="file" name="sslc"  onChange={handleFile4ChangeInput} />
        </div>
        <div class="division19">
        <img src={File4} id="File" />
        </div>
        </div>
        <div class="col_half"><br />
        <div class="division20">
        <input placeholder='Degree' id="doc" type='text' />
        </div>
        <div class="division20">
        <input id="docc" type="file" name="degree"  onChange={handleFile5ChangeInput} />
        </div> 
        <div class="division20">
        <img src={File5} id="File" />
        </div>
        </div>
        </div><br />
        <div class="division21">
        <input placeholder='Offer' id="doc" type='text' />
        </div>
        <div class="division21">
        <input id="docc" type="file" name="offerlatter"  onChange={handleFile6ChangeInput} />
        </div>
        <div class="division21"><br />
        <img src={File6} id="File" />
        </div><br />
          <div className="btn-blockkk">
         <div id="upload" onClick={()=>navigate("/table")}> 
           <button type="submit" value="Update" onClick={()=>updateData()}> Upload
           </button>
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
export default EmployeeDocuments;