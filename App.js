import {BrowserRouter,Routes,Route} from "react-router-dom";
//import {BrowserRouter as BrowserRouter, Router, Routes, Route, Switch, Link} from "react-router-dom";
import './App.css';
import Table from "./components/Table";
import Create from "./components/Create";
import Update from "./components/Update";
import Login from "./components/Login";
import Welcome from "./components/Welcome";
import Profile from "./components/Profile";
import AdminLogin from "./components/AdminLogin";
import UserProfile from "./components/UserProfile";
import User from "./components/User";
import ForgotPassword from "./components/ForgotPassword";
import ResetPassword from "./components/ResetPassword";
import Performance from "./components/Performance";
import AddPerformance from "./components/AddPerformance";
import ViewPerformance from "./components/ViewPerformance";
import Report from "./components/Report";
import AdminReport from "./components/AdminReport";
import EmployeePerformance from "./components/EmployeePerformance";
import EmployeeDetails from "./components/EmployeeDetails";
import EmployeeLogin from "./components/EmployeeLogin";
import EmployeeReport from "./components/EmployeeReport";
import FurtherDetails from "./components/FurtherDetails";
import EmployeeDocuments from "./components/EmployeeDocuments";
import LeaveAllotment from "./components/LeaveAllotment";
import LeaveApplication from "./components/LeaveApplication";
import '../src/components/App.css';

 function App() {
  
  return (
    <>
    <BrowserRouter>
    <Routes>
      <Route exact path="/" element={<Create/>}/>
      <Route exact path="/table" element={<Table/>}/>
        {/* <Route exact path={"/update"} element={<Update/>}/> */}
      <Route exact path={"/update"} element={<Update/>}/>
      <Route exact path={"/Login"} element={<Login/>}/>
      <Route exact path={"/Welcome"} element={<Welcome/>}/>
      <Route exact path={"/Profile"} element={<Profile/>}/>
      <Route exact path={"/AdminLogin"} element={<AdminLogin/>}/>
      <Route exact path={"/User"} element={<User/>}/> 
      <Route exact path={"/UserProfile"} element={<UserProfile/>}/>
      <Route exact path={"/ForgotPassword"} element={<ForgotPassword/>}/>
      <Route exact path={"/ResetPassword"} element={<ResetPassword/>}/>
      <Route exact path={"/Performance"} element={<Performance/>}/>
      <Route exact path={"/AddPerformance"} element={<AddPerformance/>}/>
      <Route exact path={"/ViewPerformance"} element={<ViewPerformance/>}/>
      <Route exact path={"/Report"} element={<Report/>}/>
      <Route exact path={"/AdminReport"} element={<AdminReport/>}/>
      <Route exact path={"/EmployeePerformance"} element={<EmployeePerformance/>}/>
      <Route exact path={"/EmployeeDetails"} element={<EmployeeDetails/>}/>
      <Route exact path={"/EmployeeLogin"} element={<EmployeeLogin/>}/>
      <Route exact path={"/EmployeeReport"} element={<EmployeeReport/>}/>
      <Route exact path={"/FurtherDetails"} element={<FurtherDetails/>}/>
      <Route exact path={"/EmployeeDocuments"} element={<EmployeeDocuments/>}/>
      <Route exact path={"/LeaveAllotment"} element={<LeaveAllotment/>}/>
      <Route exact path={"/LeaveApplication"} element={<LeaveApplication/>}/>
    </Routes>
    </BrowserRouter>
    </>
  );
}
export default App;