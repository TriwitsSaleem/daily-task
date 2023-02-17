import React, {useEffect,useState} from 'react';
import axios from "axios";
import {Link, useLocation, useParams,useNavigate} from 'react-router-dom';
import Avatar from "@material-ui/core/Avatar";
import { DynamicStar } from 'react-dynamic-star';

function Report() {

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
  let navigate = useNavigate();
  console.log('statedata',state)
  
  const [eventDetails, setEventDetails] = useState({
    id: "",
    fullname: "",
    behaviourrating: "",
    attituderating: "",
    regularityrating: "",
    projectrating: "",
    date: "",
 });
  console.log('events',eventDetails)
  const [eventTableDetails, setEventTableDetails] = useState(null);
        const initializeEvent = () => {
         axios
           .get(`http://192.168.1.5/apis/api/Chat/getEmployee/${state.id}`)
           .then((response) => {
             setEventTableDetails(response.data);
             //console.log(response)
              if (response.data != null) {
                let requestForSet = {
                  id: response.data.id,
            fullname: response.data.fullname,
            behaviourrating: response.data.behaviourrating,
            attituderating: response.data.attituderating,
            regularityrating: response.data.regularityrating,
            projectrating: response.data.projectrating,
            date: response.data.date,
                };
                setEventDetails(requestForSet);
              }
           })
           .catch((e) => {});
        };
       
/*
       const usenavigate = useNavigate();
useEffect(()=>{

},[]);
const navigate = useNavigate();

const [data,setData] = useState([])
useEffect(()=>{
axios.get(`http://192.168.43.131/apis/api/Chat/FetchEmployee/`)
.then((res) => {
//console.log(res.data);
setData(res.data)
})
});
*/
    return(
        <>
         <div id='zzg' onClick={() => navigate("/EmployeePerformance")}>
         <i id="bck" class="fa fa-arrow-circle-left"></i>                         
    </div>
        <div id='list'>
        <table className="table table-bordered" id="dataTable" width="130%" height="130%" cellSpacing="20">
  <thead>
      <tr>
          <th id='hh' width="15%" height="30px"><strong>Employee Name</strong></th>
          <th id='hh' width="15%">Date</th>
          <th id='hh' width="10%">Behaviour</th>
          <th id='hh' width="8%">Attitude</th>
          <th id='hh' width="6%">Regularity</th>
          <th id='hh' width="10%">Project</th>
          <th id='hh' width="10%" colSpan="2">Average</th>
      </tr>
  </thead>
  <tbody>
      {
           state.map(state => (
                  <tr id='tbl' key={state.id}>
                      <td id='tbll' width="5%" height="30px"><strong>{state.fullname}</strong></td>
                      <td width="15%" height="30px">{state.date}</td>
                      <td width="10%" height="30px">{state.behaviourrating}</td>
                      <td width="10%" height="30px">{state.attituderating}</td>
                      <td width="8%" height="30px">{state.regularityrating}</td>
                      <td width="6%" height="30px">{state.projectrating}</td>
                      <td id='tt' width="6%" height="30px"><strong>{state.total}</strong></td>
                      <td width="15%" height="30px"><DynamicStar 

rating={parseFloat((state.total))}
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
export default Report;