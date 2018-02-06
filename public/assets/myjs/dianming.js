// prepare the form when the DOM is ready 
$(document).ready(function() { 
    // bind form using ajaxForm 
    $('#htmlForm').ajaxForm({ 
        // target identifies the element(s) to update with the server response 
        //target: '#htmlExampleTarget', 
         dataType:'json',
        // success identifies the function to invoke when the server response 
        // has been received; here we apply a fade-in effect to the new content 
        success: processJson 
   //         function() { 
 //           $('#htmlExampleTarget').fadeIn('slow'); 
 //$('#output1').fadeTo("slow",0.25);
 //$('#output1').fadeTo("slow",1);
   //     } ;
    }); 
   
 function processJson(data){
         document.getElementById("output1").innerHTML="<div style=\"background-color:#ffa; padding:20px\">"+data.xh+" "+data.name+"   同学</div>";
         document.getElementById("jfxh").value=data.xh;
      //   document.getElementById("jfth").value=document.getElementById("th").value     
    }
      
 //   $("button").click(function(){
  //          alert('ddffd');
    //   $("lable#da").style.visibility="visible"; 
   // });
   
    $('#daForm').ajaxForm({ 
        // target identifies the element(s) to update with the server response 
        //target: '#htmlExampleTarget', 
         // success identifies the function to invoke when the server response 
        // has been received; here we apply a fade-in effect to the new content 
  // dataType: 'HTML',
     target: '#output2',            
   success:function(){ 
 //$('#output2').hide();      
 $('#output2').fadeTo("slow",0.25);
 $('#output2').fadeTo("slow",1);
 //$('#output2').fadeIn('slow');
 } 
        }); 
     
    
   
    $("p.flip").click(function(){
    $("div.panel").slideDown("slow");
  });
      $("p.flip2").click(function(){
    $("div.panel2").slideDown("slow");
  });

});

 function c1click(){
       if(document.getElementById('das1').checked){
document.getElementById('cc1').style.color='red';}
else {
document.getElementById('cc1').style.color='black';}
           if(document.getElementById('das2').checked){
document.getElementById('cc2').style.color='red';}
else {
document.getElementById('cc2').style.color='black';}
       if(document.getElementById('das3').checked){
document.getElementById('cc3').style.color='red';}
else {
document.getElementById('cc3').style.color='black';}
       if(document.getElementById('das4').checked){
document.getElementById('cc4').style.color='red';}
else {
document.getElementById('cc4').style.color='black';}
}