import React, {useEffect,useState} from 'react';
import axios from "axios";
import {Link, useLocation, useParams,useNavigate} from 'react-router-dom';
import Avatar from "@material-ui/core/Avatar";
import { DynamicStar } from 'react-dynamic-star';

function AdminReport() {

    const [fullname , setfullname] = useState('');
    const [from , setfrom] = useState('');
    const [to, setto] = useState('');
    const [behaviourrating, setbehaviourrating] = useState('');
    const [behaviour , setbehaviour] = useState('');
    const [attituderating , setattituderating] = useState('');
    const [attitude, setattitude] = useState('');
    const [regularityrating, setregularityrating] = useState('');
    const [regularity , setregularity] = useState('');
    const [projectrating , setprojectrating] = useState('');
    const [project, setproject] = useState('');
    const [counter, setCounter] = useState(0);

  const handleClick = () => {
    setCounter(counter + 1);
    console.log(counter);
  };

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
     
    //console.log('data status',state.item)
    
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
        fullname: "",
        behaviour: "",
        attitude: "",
        regularity: "",
        project: "",
        behaviourrating: "",
        attituderating: "",
        regularityrating: "",
        projectrating: "",
        total: "",
      });
    
    const usenavigate = useNavigate();
    useEffect(()=>{
  
    },[]);
    const navigate = useNavigate();
  
    
    const [data,setData] = useState([])
    useEffect(()=>{
    axios.get("http://192.168.1.5/apis/api/Chat/FetchData")
    .then((res) => {
    //console.log(res.data);
    setData(res.data)
    })
    });
   

    const [employeeLogin, setEmployeeLogin] = useState({
        fullname: "",
       // role: "Event Manager",
      });

      const submitdata =(e)=>{

         
        if(eventDetails.behaviourrating>5 || eventDetails.attituderating>5 || eventDetails.regularityrating>5 || eventDetails.projectrating>5)
        {

            alert("Rating should be greater than 0 and less than 5")
        }
        else{
        let formdata = {
          'id':eventDetails.id,
          'fullname':eventDetails.fullname,
          'behaviourrating':eventDetails.behaviourrating,
          'behaviour':eventDetails.behaviour,
          'attituderating':eventDetails.attituderating,
          'attitude':eventDetails.attitude,
          'regularityrating':eventDetails.regularityrating,
          'regularity':eventDetails.regularity,
          'projectrating':eventDetails.projectrating,
          'project':eventDetails.project,
          'total': eventDetails.total
        }
        axios
        .post(
        "http://192.168.1.5/apis/api/Chat/Performance" ,
        formdata, config)
        .then((res) => {
        console.log(res)
        if (res.status === 200) {
        alert("Employee Rating Successfully Added")
        } else Promise.reject();
        })
        .catch((err) => alert("Something went wrong"));
        console.log(formdata)
        e.preventDefault()
      
    }
  }
    return(
        <>
        <div>
  <div className="main-blockkcc">
<div class="form_wrapper">
  <div class="form_container">
  <div class="row clearfix">
  <div class="">
    <form>
    <h1>Add Performance</h1>
<hr></hr>
<div class='division' id="bck"  onClick={() => navigate("/table")}>
    <i class="fa fa-arrow-circle-left"></i>                        
    </div>

<div class='division' id="vv" onClick={()=>navigate("/EmployeePerformance",{state:state})}> 
           <button type="submit">View</button>
           </div> 

           <div class='division' onClick={() => navigate("/ViewPerformance",{state:state})}>
    <button type="submit">Report</button>                         
    </div>
    <div id='plus' onClick={handleClick}><span class="material-symbols-outlined">
add
</span></div>
      <div className="register-form">
      <div className="form"><br />
      <label>Select Employee : </label>
  <select value={eventDetails.fullname} name="fullname" onChange={handleChangeInput}>
  <option value="id">Select</option>
  {data.map(data => (
    <option value={data.id} key={data.id}>{data.fullname}</option>
  ))
  }
  </select><br />
<br />
        <div class="row clearfix">
        <div class="col_half">
        <div class='division1'><label>Behaviour :</label></div>
        <div class='division1'>
          <DynamicStar 
        rating={parseFloat(star.behaviourrating)}
        width={20}
        height={20}
        outlined={star.outlinedColor ? star.outlinedColor : star.outlined}
        totalStars={star.totalStars}
        sharpnessStar={star.sharpness}
        fullStarColor={star.fullStarColor}
        emptyStarColor={star.emptyStarColor}
      /></div>
       <input id='in' type="text" value={eventDetails.behaviourrating} name="behaviourrating" onChange={(e) => handleChangeInput(e, "behaviourrating")} maxlength="3" oninput="(this.value=this.value.replace(/[^1-5]/g,'');" pattern="^0[1-5]|[1-5]\d$" required />
       <div id='area'>
       <textarea type="text" rows="2" cols="15"  value={eventDetails.behaviour} name="behaviour" placeholder='Comment' onChange={handleChangeInput} required />
       </div>
       </div>
       <div class="col_half">
       <div class='division2'><label id='at'>Attitude :</label></div>
        <div class='division2'>
      <DynamicStar
        rating={parseFloat(star.attituderating)}
        width={20}
        height={20}
        outlined={star.outlinedColor ? star.outlinedColor : star.outlined}
        totalStars={star.totalStars}
        sharpnessStar={star.sharpness}
        fullStarColor={star.fullStarColor}
        emptyStarColor={star.emptyStarColor}
      /></div>
       <input id='in' type="text" value={eventDetails.attituderating} name="attituderating" onChange={(e) => handleChangeInput(e, "attituderating")} maxlength="3" oninput="(this.value=this.value.replace(/[^1-5]/g,'');" pattern="^0[1-5]|[1-5]\d$" required />
       <div id='area'>
          <textarea type="text" rows="2" cols="15" value={eventDetails.attitude} name="attitude" placeholder='Comment' onChange={handleChangeInput} required />
          </div>
          </div>
          </div>
        <div class="row clearfix">
        <div class="col_half"><br />
        <div class='division3'><label>Regularity :</label></div>
        <div class='division3'>
        <DynamicStar
        rating={parseFloat(star.regularityrating)}
        width={20}
        height={20}
        outlined={star.outlinedColor ? star.outlinedColor : star.outlined}
        totalStars={star.totalStars}
        sharpnessStar={star.sharpness}
        fullStarColor={star.fullStarColor}
        emptyStarColor={star.emptyStarColor}
      /></div>
       <input id='in' type="text" value={eventDetails.regularityrating} name="regularityrating" onChange={(e) => handleChangeInput(e, "regularityrating")} maxlength="3" oninput="(this.value=this.value.replace(/[^1-5]/g,'');" pattern="^0[1-5]|[1-5]\d$" required />
       <div id='area'><textarea type="text" rows="2" cols="15" value={eventDetails.regularity} name="regularity" placeholder='Comment' onChange={handleChangeInput} required />
       </div>
       </div>
       <div class="col_half"><br />
       <div class='division4'><label>Project :</label></div>
       <div class='division4'>
      <DynamicStar
        rating={parseFloat(star.projectrating)}
        width={20}
        height={20}
        outlined={star.outlinedColor ? star.outlinedColor : star.outlined}
        totalStars={star.totalStars}
        sharpnessStar={star.sharpness}
        fullStarColor={star.fullStarColor}
        emptyStarColor={star.emptyStarColor}
      /></div>
       <input id='in' type="text" value={eventDetails.projectrating}name="projectrating" onChange={(e) => handleChangeInput(e, "projectrating")} maxlength="3" oninput="(this.value=this.value.replace(/[^1-5]/g,'');" pattern="^0[1-5]|[1-5]\d$" required />
       <div id='area'>
          <textarea type="text" rows="2" cols="15" value={eventDetails.project} name="project" placeholder='Comment' onChange={handleChangeInput} required /><br />
          <br /> </div>
          </div>
          <div class="row clearfix">
        <div class="col_half">
       {Array.from(Array(counter)).map((c, index) => {
        return  <div class='division8'> <label>Label :</label></div>;
      })}
        {Array.from(Array(counter)).map((c, index) => {
        return  <div class='division8'><DynamicStar 
        value={star}
      rating={parseFloat((eventDetails.total))}
      width={20}
      height={20}
      outlined={star.outlinedColor ? star.outlinedColor : star.outlined}
      totalStars={star.totalStars}
      sharpnessStar={star.sharpness}
      fullStarColor={star.fullStarColor}
      emptyStarColor={star.emptyStarColor}
    /></div>;
      })}
      {Array.from(Array(counter)).map((c, index) => {
        return  <div id="txt" class='division9'> <textarea type="text"  rows="2" cols="15" placeholder='Comment' onChange={handleChangeInput} required /></div>;
      })}
{Array.from(Array(counter)).map((c, index) => {
        return <div class='division9'> <input id='in' key={c} type="text"></input></div>;
      })}
        </div>
        <div class="col_half">
          <div id="avg" class='division5'>
          <labell>Average :</labell>
          </div>
          <div class='division5'>
          <DynamicStar 
          value={star}
        rating={parseFloat((eventDetails.total))}
        width={20}
        height={20}
        outlined={star.outlinedColor ? star.outlinedColor : star.outlined}
        totalStars={star.totalStars}
        sharpnessStar={star.sharpness}
        fullStarColor={star.fullStarColor}
        emptyStarColor={star.emptyStarColor}
      /></div><br />
          <input id='ine' type="text" value={(eventDetails.total)=(parseFloat(eventDetails.behaviourrating)+parseFloat(eventDetails.attituderating)+parseFloat(eventDetails.regularityrating)+parseFloat(eventDetails.projectrating)) / (4) } name="total" maxlength="4" size="4"/>
          </div>
          </div>
          </div>
        </div>
          <br />
          <div id='chil' onClick={()=>navigate("/AdminReport")}> 
           <button type="submit" value="Update" onClick={submitdata}>Submit</button>
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
export default AdminReport;