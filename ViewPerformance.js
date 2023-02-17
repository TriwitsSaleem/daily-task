import React, {useEffect,useState} from 'react';
import axios from "axios";
import {Link, useLocation, useParams,useNavigate} from 'react-router-dom';
import Avatar from "@material-ui/core/Avatar";
import { DynamicStar } from 'react-dynamic-star';

function ViewPerformance() {

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

  var config = {
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
      'accept': '*/*',
    },
  };
    
  const [eventDetails, setEventDetails] = useState({
    fullname: "",
    from: "",
    to: "",
    behaviour: "",
    attitude: "",
    regularity: "",
    project: "",
    behaviourrating: "",
    attituderating: "",
    regularityrating: "",
    projectrating: "",
    date: "",
    total: "",

  });

const usenavigate = useNavigate();
useEffect(()=>{

},[]);
const navigate = useNavigate();

const [data,setData] = useState([])
useEffect(()=>{
axios.get("http://192.168.1.5/apis/api/Chat/FetchPerformance")
.then((res) => {
//console.log(res.data);
setData(res.data)
})
});
    return(
        <>
        
        <h1 id="tblhead"><u>Employees Performance Report</u></h1>
    
  <div id='zzg' onClick={() => navigate("/AdminReport")}>
         <i id="bck" class="fa fa-arrow-circle-left"></i>                         
    </div>
   
        <div id='list'>
        <table id="dataTable" width="130%" height="130%" cellSpacing="15">
  <thead>
      <tr>
          <th id='hh' width="110px" height="30px"><strong>Employee Name</strong></th>
          <th id='hh' width="110px">Date</th>
          <th id='hh' width="40px">Behaviour</th>
          <th id='hh' width="40px">Rating</th>
          <th id='hh' width="40px">Attitude</th>
          <th id='hh' width="40px">Rating</th>
          <th id='hh' width="40px">Regularity</th>
          <th id='hh' width="40px">Rating</th>
          <th id='hh' width="40px">Project</th>
          <th id='hh' width="40px">Rating</th>
          <th id='hh' width="40px" colSpan="2">Average</th>
      </tr>
  </thead>
  <tbody>
      {
          data.map(data => (
                  <tr id='tbl' key={data.id}>
                      <td id='tbll' width="16%"><strong>{data.fullname}</strong></td>
                      <td width="13%" height="30px" >{data.date}</td>
                      <td width="9.5%" height="30px">{data.behaviour}</td>
                      <td width="7%" height="30px">{data.behaviourrating}</td>
                      <td width="9.5%" height="30px">{data.attitude}</td>
                      <td width="7%" height="30px">{data.attituderating}</td>
                      <td width="9.5%" height="30px">{data.regularity}</td>
                      <td width="7%" height="30px">{data.regularityrating}</td>
                      <td width="9.5%" height="30px">{data.project}</td>
                      <td width="7%" height="30px">{data.projectrating}</td>
                      <td id='tt' width="8%" height="30px"><strong>{data.total}</strong></td>
                      <td width="13%" height="30px" ><DynamicStar 

rating={parseFloat((data.total))}
width={20}
height={20}
outlined={star.outlinedColor ? star.outlinedColor : star.outlined}
totalStars={star.totalStars}
sharpnessStar={star.sharpness}
fullStarColor={star.fullStarColor}
emptyStarColor={star.emptyStarColor}
/></td>
                  </tr>))
      }
  </tbody>
  </table>
    </div>
  </>
    );
}
export default ViewPerformance;