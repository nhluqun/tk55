<template>
<div >
<el-button v-on:click= "load()">载入数据</el-button>
<p>{{message}}</p>
<el-table
     :data="tableData"
     style="width: 100%">
     <el-table-column
       prop="date"
       label="日期"
       width="180">
     </el-table-column>
     <el-table-column
       prop="name"
       label="姓名"
       width="180">
     </el-table-column>
     <el-table-column
       prop="address"
       label="地址">
     </el-table-column>
   </el-table>

   </div>
 </template>

 <script>
   export default {
     data() {
       return {
         tableData: [{
           date: '2016-05-02',
           name: '王小虎',
           address: '上海市普陀区金沙江路 1518 弄'
         }, {
           date: '2016-05-04',
           name: '王小虎',
           address: '上海市普陀区金沙江路 1517 弄'
         }, {
           date: '2016-05-01',
           name: '王小虎',
           address: '上海市普陀区金沙江路 1519 弄'
         }, {
           date: '2016-05-03',
           name: '王小虎',
           address: '上海市普陀区金沙江路 1516 弄'
         }],
         message:"sdfljkkfsadklj"

       }
     },
methods: {
    load () {
    var data = new Object();
  var self = this;

     this.$ajax({
//axios({
      url:'api/index',
      headers: {
        'Authorization': 'Bearer ' + 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjdmOWFhZWE1NDZhODAyNDZhOTUzMzA2Nzk2NzMwNzNlMjY5YmJhNjY4YWI4NzA3ZmM1ZGRhNTZlYTlhYmZhYjY5ZjRjMzcxMWM3YTQ0YzJkIn0.eyJhdWQiOiI3IiwianRpIjoiN2Y5YWFlYTU0NmE4MDI0NmE5NTMzMDY3OTY3MzA3M2UyNjliYmE2NjhhYjg3MDdmYzVkZGE1NmVhOWFiZmFiNjlmNGMzNzExYzdhNDRjMmQiLCJpYXQiOjE1MTQ2OTUzNDUsIm5iZiI6MTUxNDY5NTM0NSwiZXhwIjoxNTE0NzAyNTQ1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.qRiVKCJ3CXqHxwGQ-YjGgvXQBmbeYzB3OJ1JbhWqJyo6aMJAmnBJEqbYnfe0mYQkE0imzosqaC-lkWNtmHo1nOsBZUzddvol4qJe8Kcdms86EE42Oc-4uvXHnlxEWs5W-QYlc_RxtfCNpMmWJwQLXCIkPk-Uz91G4P7LhxRI5h6OK5K4ANNCMVN82IhlegjsXp8FaY3zbrMmaySWu-yN69hllha3nagQHjM2l8cg5F7_yvtviAfaYUDFucIhNR3xyKsV_9d2Fn1xXbiINO-Ki0kYZgHfHGr7cE6XhGBLInekYHMvqRDG01dDJqzpRFPD8XTOj7mmuJ367L8P_yM5CiANGnnJWe8mDhMGTA75JH7M2sWWVmy_YUTVw4-qLMp0H-QB1SQySxnMEnPRhzauBLm6b2-5ZBWotZXkIt5MDipkPVQUeLNOCzSINRH2XGG6l1yv0IR0tdjxtUyt4H7UQ9_rA1SYy0dH_zWdcmxEmmEclkCIIwPLTzCoesXOC98Dc4E_O-Ljbn8JnrF2IhwO_GfM4B7pD7Dw8KLaRagPwY9Kdgep-J1IlUoChJsokMy7aFSGETd4UUf-C8MW45ap8aGoVg2AGVL9osruIamKmZ_3-vRrIt5UMOUdzX2Jc7clfUKDP6uLG5u3w9xn8DDIdXCxRvUiH07ROLLheWJ-10o'
      },
      method:'get',
      withCredentials:true
     }).then(function (data){
  //  console.log( data.data.message);
  //  self.message=data.data.message;
self.tableData=data.data;
     }).catch(function(err){
        console.log(err)
     })


 //this.$data.message="改动";
 //return this.$data.message;
    }


   }
   }


 </script>
