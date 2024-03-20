  </div> <!-- /container -->

</main>

<footer class="container">

</footer>
 
   <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg"  style="">
      <div class="modal-content">
      

        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        

        <div class="modal-body">
            
          
        </div>
        

        <div class="modal-footer">
          <button type="button" id="submit" class="btn btn-primary vazhdo" >Vazhdo</button>
          <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal" style="display:none" >Mbyll</button>
        </div>
        
      </div>
    </div>
  </div> 
  

<script>



function asgje1() {
  
}




var url=window.location.href;
var arr=url.split("/");
var path="/" + arr[arr.length-1];
$(".nav-item").removeClass("active");
$(".nav-item").each(function(){
    var aa=$(this).find("a").attr("href");
    if (path.indexOf(aa)>-1) {
        $(this).addClass("active");
    }
  });



function idleLogout() {
    var t;
    window.onload = resetTimer;
    window.onmousemove = resetTimer;
    window.onmousedown = resetTimer;        
    window.ontouchstart = resetTimer; 
    window.onclick = resetTimer;      
    window.onkeypress = resetTimer;   
    window.addEventListener('scroll', resetTimer, true); 

    function outnow() {
        window.location='logout.php';
    }

    function resetTimer() {
        //clearTimeout(t);
        //t = setTimeout(outnow, 1200000);  
    }
}
//idleLogout();
  
  
</script>
</body>
</html>
