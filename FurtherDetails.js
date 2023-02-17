import React, {useEffect, useState} from 'react';
import axios from "axios";
import { Link, useLocation, useParams, useNavigate } from "react-router-dom";


function FurtherDetails(){

  const { state } = useLocation();

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

  const [popup,setPop]=useState(false)
  const [aadhar,setaadhar]=useState(false)
  const [pancard,setpancard]=useState(false)
  const [id,setid]=useState(false)
  const [sslc,setsslc]=useState(false)
  const [degree,setdegree]=useState(false)
  const [offer,setoffer]=useState(false)
  const handleClickOpen=()=>{
      setPop(!popup)
  }
  const closePopup=()=>{
      setPop(false)
  }

  const handleClickaadharOpen=()=>{
    setaadhar(!aadhar)
}
const closeaadhar=()=>{
    setaadhar(false)
}

const handleClickpancardOpen=()=>{
  setpancard(!pancard)
}
const closepancard=()=>{
  setpancard(false)
}

const handleClickidOpen=()=>{
  setid(!id)
}
const closeid=()=>{
  setid(false)
}

const handleClicksslcOpen=()=>{
  setsslc(!sslc)
}
const closesslc=()=>{
  setsslc(false)
}
const handleClickdegreeOpen=()=>{
  setdegree(!degree)
}
const closedegree=()=>{
  setdegree(false)
}
const handleClickofferOpen=()=>{
  setoffer(!offer)
}
const closeoffer=()=>{
  setoffer(false)
}
 
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
      .get(`http://192.168.0.151/apis/api/Chat/getData/${state.item.id}`)
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

  const download = e => {
    console.log(e.target.href);
    fetch(e.target.href, {
      method: "GET",
      headers: {}
    })
    .then(response => {
      response.arrayBuffer().then(function(buffer) {
        const url = window.URL.createObjectURL(new Blob([buffer]));
        const link = document.createElement("a");
        link.href = url;
        link.setAttribute("download", "image.jpg"); //or any other extension
        document.body.appendChild(link);
        link.click();
      });
    })
    .catch(err => {
      console.log(err);
    });
};


  useEffect(() => initializeEvent(), []);
  console.log('response',eventTableDetails)

   /*
  function handleApi() { // you need to create a button likk <button onClick={handleApi}>submit</button>
    const formData = new FormData()
    formData.append('file', file)
    axios.post('url', formData).then((res) => {
      console.log(res)
    })
  }
  */
  const updateData =()=>{
    const formData = new FormData()
    formData.append('File', File)
    formData.append('File1', File1)
    formData.append('File2', File2)
    formData.append('File3', File3)
    formData.append('File4', File4)
    formData.append('File5', File5)
    formData.append('File6', File6)
           
  axios.post("http://192.168.0.151/apis/api/Chat/student/", formData, config)
  .then((res) => {
  console.log(res)
  if (res.status === 200) {
    alert("Employee Updated Successfully");
    } else Promise.reject();
     })
  .catch((err) => alert("Something went wrong"));
    console.log(formData)
    }

return(
<>
<div>
                {
                    popup?
                    <div className="main">
                        <div className="main">
                            <div className="popup-header">
                                <h1 id="close" onClick={closePopup}><strong>x</strong></h1>
                            </div>
                            <img className="size" src={File}/>
                        </div>
                    </div>:""
                }
            </div>
            <div>
                {
                    aadhar?
                    <div className="main">
                        <div className="main">
                            <div className="popup-header">
                                <h1 id="close" onClick={closeaadhar}><strong>x</strong></h1>
                            </div>
                            <img className="size" src={File1}/>
                        </div>
                    </div>:""
                }
            </div>
            <div>
                {
                    pancard?
                    <div className="main">
                        <div className="main">
                            <div className="popup-header">
                                <h1 id="close" onClick={closepancard}><strong>x</strong></h1>
                            </div>
                            <img className="size" src={File2}/>
                        </div>
                    </div>:""
                }
            </div>
            <div>
                {
                    id?
                    <div className="main">
                        <div className="main">
                            <div className="popup-header">
                                <h1 id="close" onClick={closeid}><strong>x</strong></h1>
                            </div>
                            <img className="size" src={File3}/>
                        </div>
                    </div>:""
                }
            </div>
            <div>
                {
                    sslc?
                    <div className="main">
                        <div className="main">
                            <div className="popup-header">
                                <h1 id="close" onClick={closesslc}><strong>x</strong></h1>
                            </div>
                            <img className="size" src={File4}/>
                        </div>
                    </div>:""
                }
            </div>
            <div>
                {
                    degree?
                    <div className="main">
                        <div className="main">
                            <div className="popup-header">
                                <h1 id="close" onClick={closedegree}><strong>x</strong></h1>
                            </div>
                            <img className="size" src={File5}/>
                        </div>
                    </div>:""
                }
            </div>
            <div>
                {
                    offer?
                    <div className="main">
                        <div className="main">
                            <div className="popup-header">
                                <h1 id="close" onClick={closeoffer}><strong>x</strong></h1>
                            </div>
                            <img className="size" src={File6}/>
                        </div>
                    </div>:""
                }
            </div>
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
        <input
                  name="File"
                  type="file"
                  onChange={handleFileChangeInput}
                />
        </div>
        <div  class="division15">
        <img  src={File} id="File" onClick={handleClickOpen}/>
        </div>
        <span><a href="messi.jpg" download><i id="dow" class="fa fa-download" src={File} onClick={download}></i></a></span>
        </div>
        <div class="col_half">
        <div class="division16">
        <input placeholder='Aadhar' id="doc" type='text' />
        </div> 
        <div class="division16">
          <input id="docc" type="file" name="File1" onChange={handleFile1ChangeInput}/>
        </div>
        <div class="division16">
        <img src={File1}  id="File" onClick={handleClickaadharOpen} />
        </div>
        <span><a href="aadharcard.jpg" download><i id="dow" class="fa fa-download" src={File1} onClick={download}></i></a></span>
        </div>
        </div><br /><br />
        <div class="row clearfix">
            <div class="col_half"><br />
        <div class="division17">
        <input placeholder='Pancard' id="doc" type='text' /> 
        </div>
        <div class="division17">
        <input id="docc" type="file" name="File2" onChange={handleFile2ChangeInput} />
        </div>
        <div class="division17">
         <img src={File2} id="File" onClick={handleClickpancardOpen}/>
        </div>
        <span><a href="pancard.jpg" download><i id="dow" class="fa fa-download" src={File2} onClick={download}></i></a></span>
        </div>
        <div class="col_half"><br />
        <div class="division18">
        <input placeholder='ID' id="doc" type='text' />
        </div>
        <div class="division18">
        <input id="docc" type="file" name="File3"  onChange={handleFile3ChangeInput} />
        </div>
        <div class="division18">
         <img src={File3} id="File" onClick={handleClickidOpen}/>
        </div>
        <span><a href="identycard.jpg" download><i id="dow" class="fa fa-download" src={File3} onClick={download}></i></a></span>
        </div>
        </div>
        <div class="row clearfix">
            <div class="col_half"><br />
        <div class="division19">
        <input placeholder='SSLC' id="doc" type='text' />
        </div>
        <div class="division19">
        <input id="docc" type="file" name="File4"  onChange={handleFile4ChangeInput} />
        </div>
        <div class="division19">
        <img src={File4} id="File" onClick={handleClicksslcOpen} />
        </div>
        <span><a href="sslc.jpg" download><i id="dow" class="fa fa-download" src={File4} onClick={download}></i></a></span>
        </div>
        <div class="col_half"><br />
        <div class="division20">
        <input placeholder='Degree' id="doc" type='text' />
        </div>
        <div class="division20">
        <input id="docc" type="file" name="File5"  onChange={handleFile5ChangeInput} />
        </div> 
        <div class="division20">
          <img src={File5} id="File" onClick={handleClickdegreeOpen} />
        </div>
        <span><a href="degree.jpg" download><i id="dow" class="fa fa-download" src={File5} onClick={download}></i></a></span>
        </div>
        </div><br />
        <div class="division21">
        <input placeholder='Offer' id="doc" type='text' />
        </div>
        <div class="division21">
        <input id="docc" type="file" name="File6"  onChange={handleFile6ChangeInput} />
        </div>
        <div class="division21"><br />
          <img src={File6} id="File" onClick={handleClickofferOpen} />
        </div>
        <span><a href="offerlatter.jpg" download><i id="dow"class="fa fa-download" src={File6} onClick={download}></i></a></span><br />
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
export default FurtherDetails;