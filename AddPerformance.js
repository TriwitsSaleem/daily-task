import React, {useEffect, useState} from 'react';
import axios from "axios";
import { Link, useLocation, useParams, useNavigate } from "react-router-dom";
import { DynamicStar } from 'react-dynamic-star';
function AddPerformance(){

  const [star, setStar] = useState({
    rating: 2,
    totalStars: 5,
    sharpness: 2.5,
    width: 25,
    height: 25,
    outlined: true,
    outlinedColor: "",
    fullStarColor: "#FFBC00",
    emptyStarColor: "transparent"
  });

  const handleFloatValue = (e, property) => {
    const float = e.target.value.replace(/,/g, ".");
    setStar((prev) => ({ ...prev, [property]: float }));
  };
  const { state } = useLocation();
 
console.log('data status',state.item)
  const navigate = useNavigate();

  var config = {
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
      'accept': '*/*',
    },
  };
  
   const handleChangeInput = (e, property) => {
    let key = e.target.name;
    let value = e.target.value;
    const _currentData = { ...eventDetails, [key]: value };
    setEventDetails(_currentData);
    const float = e.target.value.replace(/,/g, ".");
    setStar((prev) => ({ ...prev, [property]: float }));
    
  };
   const [eventDetails, setEventDetails] = useState({
    id: "",
    behaviour: "",
    attitude: "",
    regularity: "",
    project: "",
    behaviourrating: "",
    attituderating: "",
    regularityrating: "",
    projectrating: "",

  });
  console.log('events',eventDetails)
   const [eventTableDetails, setEventTableDetails] = useState(null);
   const initializeEvent = () => {
    axios
      .get(`http://192.168.1.6/apis/api/Chat/getData/${state.id}`)
      .then((response) => {
        setEventTableDetails(response.data);
        //console.log(response)
         if (response.data != null) {
           let requestForSet = {
            id: response.data.id,
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
          'behaviour':eventDetails.behaviour,
          'attitude':eventDetails.attitude,
          'regularity':eventDetails.regularity,
          'project':eventDetails.project,
          'behaviourrating':eventDetails.behaviourrating,
          'attituderating':eventDetails.attituderating,
          'regularityrating':eventDetails.regularityrating,
          'projectrating':eventDetails.projectrating,
        }
  console.log('submitdata',formdata);
  axios.post("http://192.168.1.6/apis/api/Chat/review/", formdata, config)
  .then((res) => {
  console.log(res)
  if (res.status === 200) {
    alert("Employee Performance Added Successfully");
    } else Promise.reject();
     })
  .catch((err) => alert("Something went wrong"));
    console.log(formdata)
    }

return(
<>

    <div className="app">
    <div className="main-blockkcc">
<div class="form_wrapper">
  <div class="form_container">
  <div class="row clearfix">
  <div class="">
    <form>
    <h1>Add Performance</h1>
<hr></hr>
<div id='view' onClick={() => navigate("/ViewPerformance",{state:state})}>
    <button type="submit">View</button>                         
    </div>
      <div className="register-form">
      <div className="form">
                    <label>Behaviour </label>
                    <label id='lab'>Attitude</label>
        <div class="row clearfix">
        <div class="col_half">
        <input id='in' type="text" value={eventDetails.behaviourrating} name="behaviourrating" onChange={(e) => handleChangeInput(e, "behaviourrating")} required />
        <DynamicStar
        rating={parseFloat(star.behaviourrating)}
        width={parseFloat(star.width)}
        height={parseFloat(star.height)}
        outlined={star.outlinedColor ? star.outlinedColor : star.outlined}
        totalStars={star.totalStars}
        sharpnessStar={star.sharpness}
        fullStarColor={star.fullStarColor}
        emptyStarColor={star.emptyStarColor}
      />
       <textarea type="text" rows="2" cols="25"  value={eventDetails.behaviour} name="behaviour" placeholder='Comment' onChange={handleChangeInput} required />
       </div>
       
       <div class="col_half">
       
        <input id='in' value={eventDetails.attituderating} name="attituderating" onChange={(e) => handleChangeInput(e, "attituderating")} required />
      <DynamicStar
        rating={parseFloat(star.attituderating)}
        width={parseFloat(star.width)}
        height={parseFloat(star.height)}
        outlined={star.outlinedColor ? star.outlinedColor : star.outlined}
        totalStars={star.totalStars}
        sharpnessStar={star.sharpness}
        fullStarColor={star.fullStarColor}
        emptyStarColor={star.emptyStarColor}
      />
          <textarea type="text" rows="2" cols="25" value={eventDetails.attitude} name="attitude" placeholder='Comment' onChange={handleChangeInput} required />
          </div>
          </div>

          <label>Regularity</label>
          <label>Project</label>
        <div class="row clearfix">
        <div class="col_half">
        <input id='in' value={eventDetails.regularityrating} name="regularityrating" onChange={(e) => handleChangeInput(e, "regularityrating")} required />
        <DynamicStar
        rating={parseFloat(star.regularityrating)}
        width={parseFloat(star.width)}
        height={parseFloat(star.height)}
        outlined={star.outlinedColor ? star.outlinedColor : star.outlined}
        totalStars={star.totalStars}
        sharpnessStar={star.sharpness}
        fullStarColor={star.fullStarColor}
        emptyStarColor={star.emptyStarColor}
      />
       <textarea type="text" rows="2" cols="25" value={eventDetails.regularity} name="regularity" placeholder='Comment' onChange={handleChangeInput} required />
       </div>
       <div class="col_half">
       <input id='in' value={eventDetails.projectrating} name="projectrating" onChange={(e) => handleChangeInput(e, "projectrating")} required />
      <DynamicStar
        rating={parseFloat(star.projectrating)}
        width={parseFloat(star.width)}
        height={parseFloat(star.height)}
        outlined={star.outlinedColor ? star.outlinedColor : star.outlined}
        totalStars={star.totalStars}
        sharpnessStar={star.sharpness}
        fullStarColor={star.fullStarColor}
        emptyStarColor={star.emptyStarColor}
      />
          <textarea type="text" rows="2" cols="25" value={eventDetails.project} name="project" placeholder='Comment' onChange={handleChangeInput} required />
          </div>
          </div>
          <br />
          <div className="btn-blockkk">
         <div id='rep' onClick={()=>navigate("/table")}> 
           <button type="submit" value="Update" onClick={()=>updateData()}>Add</button>
           </div> 
        </div>
        <div id='rep' onClick={()=>navigate("/AdminReport",{state:state})}> 
           <button type="submit">Report</button>
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
export default AddPerformance;