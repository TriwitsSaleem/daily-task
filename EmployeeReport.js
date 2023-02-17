import React, {useEffect,useState} from 'react';
import axios from "axios";
import {Link, useLocation, useParams,useNavigate} from 'react-router-dom';
import Avatar from "@material-ui/core/Avatar";
import { DynamicStar } from 'react-dynamic-star';

function EmployeeReport(){
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

  const { state } = useLocation();
  console.log('statedata',state)


  const navigate = useNavigate();

   var config = {
       headers: {
         'Content-Type': 'application/x-www-form-urlencoded',
         'accept': '*/*',
       },
     };
     
   const [eventDetails, setEventDetails] = useState({
    fullname: "",
    behaviour: "",
    behaviourrating: "",
    attitude: "",
    attituderating: "",
    regularity: "",
    regularityrating: "",
    project: "",
    projectrating: "",
    date: "",
 });

  console.log('events',eventDetails)
   const [eventTableDetails, setEventTableDetails] = useState(null);
   const [data,setData] = useState([])
   useEffect(() => initializeEvent(), []);
   const initializeEvent = () => {
    axios.get(`http://192.168.1.5/apis/api/Chat/getEmployee/${state.id}`)
    .then((res) => {
    console.log('test',res);
    setData(res.data)
    })
    }
console.log('eventDetails',eventDetails)

return (
<>
        <div id='zzg' onClick={() => navigate("/Login")}>
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
                     <td width="13%" height="30px">{data.date}</td>
                     <td width="9.5%" height="30px">{data.behaviour}</td>
                     <td width="7%" height="30px">{data.behaviourrating}</td>
                     <td width="9.5%" height="30px">{data.attitude}</td>
                     <td width="7%" height="30px">{data.attituderating}</td>
                     <td width="9.5%" height="30px">{data.regularity}</td>
                     <td width="7%" height="30px">{data.regularityrating}</td>
                     <td width="9.5%" height="30px">{data.project}</td>
                     <td width="7%" height="30px">{data.projectrating}</td>
                     <td id='tt' width="8%" height="30px"><strong>{data.total}</strong></td>
                     <td width="13%" height="30px"><DynamicStar 

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
export default EmployeeReport;