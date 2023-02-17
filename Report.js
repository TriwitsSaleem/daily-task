import React, {useEffect,useState} from 'react';
import axios from "axios";
import {Link, useLocation, useParams,useNavigate} from 'react-router-dom';
import Avatar from "@material-ui/core/Avatar";

function Report() {
    
  const { state } = useLocation();
  let navigate = useNavigate();
  console.log('statedata',state)
  
  const [eventDetails, setEventDetails] = useState({
    fullname: "",
    behaviourrating: "",
    attituderating: "",
    regularityrating: "",
    projectrating: "",
    from: "",
    to: "",
 });
  console.log('events',eventDetails)
  const [eventTableDetails, setEventTableDetails] = useState(null);
        const initializeEvent = () => {
         axios
           .get(`http://192.168.1.12/apis/api/Chat/getUser/${state.fullname}`)
           .then((response) => {
             setEventTableDetails(response.data);
             //console.log(response)
              if (response.data != null) {
                let requestForSet = {
            fullname: response.data.fullname,
            behaviourrating: response.data.behaviourrating,
            attituderating: response.data.attituderating,
            regularityrating: response.data.regularityrating,
            projectrating: response.data.projectrating,
            from: response.data.from,
            to: response.data.to,
                };
                setEventDetails(requestForSet);
              }
           })
           .catch((e) => {});
       };
    return(
        <>
        <div>
        <table className="table table-bordered" id="dataTable" width="100%" cellSpacing="0">
  <thead>
      <tr>
          <th width="10%">Employee Name</th>
          <th width="15%">From</th>
          <th width="15%">To</th>
          <th width="10%">Behaviour</th>
          <th width="8%">Attitude</th>
          <th width="6%">Regularity</th>
          <th width="10%">Project</th>
      </tr>
  </thead>
  <tbody>
      {
          state.map(state => (
                  <tr id='tbl' key={state.id}>
                      <td width="5%">{state.fullname}</td>
                      <td width="18%">{state.from}</td>
                      <td width="15%">{state.to}</td>
                      <td width="15%">{state.behaviourrating}</td>
                      <td width="10%">{state.attituderating}</td>
                      <td width="8%">{state.regularityrating}</td>
                      <td width="6%">{state.projectrating}</td>
                  </tr>))
      }
  </tbody>
  </table>
    </div>
  </>
    );
}
export default Report;