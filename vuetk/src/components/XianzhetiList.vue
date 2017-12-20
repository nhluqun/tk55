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

     //this.$ajax({
this.$axios({
      url:'/api/index',
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
