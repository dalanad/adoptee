<?php require_once  dirname(__FILE__) . './_layout/layout.php' ;
require dirname(__FILE__) . "./_layout/header.php"
?>
<style>
table, td, th {  
   
  border: 1px solid #ddd;
  text-align: left;
  padding-left:300px;
  padding-right:300px;
}

table {
    position:relative;
    table-layout:fixed;
    top:80px;
  left:200px;
  right:200px;
  border-collapse: collapse;
  width: 80%;
}

th, td {
  padding: 8px;
}
.btn-green {
	background-color:lightgreen;
	border: 1px solid lightgreen;
}
.btn-red {
	background-color:red;
	border: 1px solid red;
}
.btn-group:after {
  content: "";
  clear: both;
  display: table;
}
.hedd{
    text-align:center;
    padding-top:50px;
    padding-left:550px;
    color: var(--color);
	font-size: 40px;
    font-family:forte,sans serif;
    }

</style>
<span class="hedd" >Accept/Deny Requests</span>
<table>
  <tr>
    <th>Applicant Name</th>
    <th>Pet ID</th>
    <th>Pet Name </th>
    <th>Type of pet</th>
    <th>Requested Time</th>
    <th>Accept / Deny </th>

  </tr>
  <tr>
    <td><input  class="ctrl"  type="text"  name="name" id="name" ></td>
    <td><input  class="ctrl"  type="text"  name="name" id="name" ></td>
    <td><input  class="ctrl"  type="text"  name="name" id="name" ></td>
    <td><input  class="ctrl"  type="text"  name="name" id="name" ></td>
    <td><input  class="ctrl"  type="time"  name="name" id="name" ></td>
    <td><button class="btn btn-green" type="submit">Accept</button><button class="btn btn-red" type="submit">Deny</button></td>
  </tr>
  <tr>
    <td><input  class="ctrl"  type="text"  name="name" id="name" ></td>
    <td><input  class="ctrl"  type="text"  name="name" id="name" ></td>
    <td><input  class="ctrl"  type="text"  name="name" id="name" ></td>
    <td><input  class="ctrl"  type="text"  name="name" id="name" ></td>
    <td><input  class="ctrl"  type="time"  name="name" id="name" ></td>
    <td><button class="btn btn-green" type="submit">Accept</button><button class="btn btn-red" type="submit">Deny</button></td>
  </tr>
  <tr>
    <td><input  class="ctrl"  type="text"  name="name" id="name" ></td>
    <td><input  class="ctrl"  type="text"  name="name" id="name" ></td>
    <td><input  class="ctrl"  type="text"  name="name" id="name" ></td>
    <td><input  class="ctrl"  type="text"  name="name" id="name" ></td>
    <td><input  class="ctrl"  type="time"  name="name" id="name" ></td>
    <td><button class="btn btn-green" type="submit">Accept</button><button class="btn btn-red" type="submit">Deny</button></td>
  </tr>
  <tr>
    <td><input  class="ctrl"  type="text"  name="name" id="name" ></td>
    <td><input  class="ctrl"  type="text"  name="name" id="name" ></td>
    <td><input  class="ctrl"  type="text"  name="name" id="name" ></td>
    <td><input  class="ctrl"  type="text"  name="name" id="name" ></td>
    <td><input  class="ctrl"  type="time"  name="name" id="name" ></td>
    <td><button class="btn btn-green" type="submit">Accept</button><button class="btn btn-red" type="submit">Deny</button></td> 
  </tr>
  <tr>
    <td><input  class="ctrl"  type="text"  name="name" id="name" ></td>
    <td><input  class="ctrl"  type="text"  name="name" id="name" ></td>
    <td><input  class="ctrl"  type="text"  name="name" id="name" ></td>
    <td><input  class="ctrl"  type="text"  name="name" id="name" ></td>
    <td><input  class="ctrl"  type="time"  name="name" id="name" ></td>
    <td><button class="btn btn-green" type="submit">Accept</button><button class="btn btn-red" type="submit">Deny</button></td>
  </tr>
</table>
