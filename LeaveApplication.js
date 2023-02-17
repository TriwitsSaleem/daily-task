import React, {useEffect,useState} from 'react';
import axios from "axios";
import {Link, useLocation, useParams,useNavigate} from 'react-router-dom';

function LeaveApplication() {
    const { state } = useLocation();
 console.log('profile',state)
    console.log('data status',state)
      const navigate = useNavigate();
  
      const [preliminaryEnd, setPreliminaryEnd] = useState('');
    const [preliminaryStart, setPreliminaryStart] = useState('');
    const [timeDiff, setTimeDiff] = useState('');
    useEffect(() => {
      if (preliminaryEnd !== null && preliminaryStart !== null) {
        let start = new Date(preliminaryEnd);
        let end = new Date(preliminaryStart);
        setTimeDiff((start - end) / (1000 * 60 * 60 * 24));
      }
    }, [preliminaryEnd, preliminaryStart]);

  
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
        
      };
       const [eventDetails, setEventDetails] = useState({
        id: "",
         leave: "",
         fromdate: "",
         todate: "",
         timeDiff: "",
         reason: "",
      });
       console.log('events',eventDetails)
       const [eventTableDetails, setEventTableDetails] = useState(null);
        
       console.log('response',eventTableDetails)
    
       const submitdata =(e)=>{
         
        let formdata = {
          'id':eventDetails.id,
             'leave':eventDetails.leave,
             'fromdate':eventDetails.fromdate,
             'todate':eventDetails.todate,
             'timeDiff':eventDetails.timeDiff,
             'reason':eventDetails.reason
        }
        axios
        .post(
        "http://192.168.1.3/apis/api/Chat/Leave" ,
        formdata, config)
        .then((res) => {
        console.log(res)
        if (res.status === 200) {
        alert("Employee Rating Successfully Added")
        } else Promise.reject();
        })
        .catch((err) => alert("Something went wrong"));
        console.log(formdata)
       
      
  }
        return(
          <>
          <div className="app">
          <div className="main-Leave">
          <div class="form_wrapper">
        <div class="form_container">
          <h1>Leave Application</h1>
          <hr></hr><br />
          <div class="division25">
          <label>Enter Employee ID :</label>
          </div>
          <div class="division25">
        <input type="text" id='inee' name="id" value={eventDetails.id} onChange={handleChangeInput} size="4" height="5px" maxLength="2" minLength="2" required/>
        </div>
          <div class="division26">
         <br />
        <label for="role">Type of Leave: </label>
        <select id='moon' value={eventDetails.leave} name="leave" onChange={handleChangeInput}>
        <option value="" size={10}>Select</option><br />
          <option value="Casual">Casual</option>
          <option value="Paid">Paid</option>
          <option value="Unpaid">Unpaid</option>
          <option value="Stock">Stock</option>
          <option value="Half Day">Half Day</option>
          <option value="Other">Other</option>
        </select>
       
        </div><br />
        <div id="dyte" class="row clearfix"><br />
                  <div class="col_half"><br />
                  <label>From : </label>
                    <div class="input_field"> <span id='sal'><i aria-hidden="true" class="fa fa-calendar-alt" id='id'></i></span>
                     <div onChange={(e) => setPreliminaryStart(e.target.value)}>
                     <input type="date" name="fromdate" value={eventDetails.fromdate} onChange={handleChangeInput} required/>
                      </div> 
                    </div>
                  </div>
                  <div class="col_half"><br />
                  <label>To : </label>
                    <div class="input_field"><span id='sal'><i aria-hidden="true" class="far fa-calendar-alt" id='id'></i></span>
                     <div onChange={(e) => setPreliminaryEnd(e.target.value)}>
                     <input type="date" name="todate" value={eventDetails.todate} onChange={handleChangeInput} required />
                      </div> 
                    </div>
                  </div>
                </div>
                <div id="dyf" class="row clearfix"><br />
                <textarea type="text" rows="4" cols="30" name="reason" value={eventDetails.reason} placeholder='Reason' onChange={handleChangeInput}  required />
                <div id="no" class="division27">
          <p id="preliminary-review-total"><strong>No.Of.Days</strong></p>
          </div>
          <div class="division27">
      <input type="text" id='ine' value={(eventDetails.timeDiff)=(timeDiff)} name="timeDiff" size="4" />
        </div>
        </div>
                <div id="ll">
                <button type="submit" onClick={()=>submitdata()}> Submit</button>
                </div>
            </div>
            </div>
            </div>
            </div>
            </>
            
            );

}
export default LeaveApplication;