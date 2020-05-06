$(document).ready(function () {
    var isMouseDown = false;
    var lastTr = -1;
    
    $('td.roomCell').mousedown(function() {
      isMouseDown = true;
      $('td.roomCell').removeClass('highlight');
    })
    .mouseup(function(event) {
      
      isMouseDown = false;
  //   var x = event.clientX;
  //   var y = event.clientY;
  //   var coords = "X coords: " + x + ", Y coords: " + y;
  //   document.getElementById("demo").innerHTML = coords;
    });
  
    $("td.roomCell").hover(function(){
      $(this).toggleClass('highlight');
      var ctr = $(this).closest('tr').index();
      // document.write(ctr);
      lastTr = lastTr === -1 ? ctr : lastTr;
      
      if (isMouseDown)
        if (lastTr !== ctr){
          $('td.roomCell').removeClass('highlight1');
        }
          
        else{
          $(this).addClass("highlight1");
          var cellvalue=$(this).val("td").index();//to get cell value
          alert(tr.lastIndex());
          // $(this).text(cellvalue);
        }
      lastTr = $(this).closest('tr').index();
  
     
    });
    
   
    // $("table td").click(function(){
    //   $(this).toggleClass('highlight');
    // });
  });
  