<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Payment | Cancel</title>
<style type="text/css">
.loader {width: 100%; height: 100%; position: fixed; background: #fff; z-index: 1111; opacity: 0.9; display: none; }
.loading {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  margin:auto;
  width: 700px;
  height: 70px;
  z-index: 1111;
  text-align: center;
}
.loading p {font-size: 15px; font-weight: bold; font-family: 'Arca Majora', sans-serif;}
.loading-bar {
  display: inline-block;
  width: 8px;
  height: 30px;
  border-radius: 4px;
  animation: loading 1s ease-in-out infinite;
}
.loading-bar:nth-child(1) {
  background-color: #CF142B;
  animation-delay: 0;
}
.loading-bar:nth-child(2) {
  background-color: #00247D;
  animation-delay: 0.09s;
}
.loading-bar:nth-child(3) {
  background-color: #CF142B;
  animation-delay: .18s;
}
.loading-bar:nth-child(4) {
  background-color: #00247D ;
  animation-delay: .27s;
}
.pointer {cursor: pointer;}

@keyframes loading {
  0% {
    transform: scale(1);
  }
  20% {
    transform: scale(1, 2.2);
  }
  40% {
    transform: scale(1);
  }
}
</style>
</head>
<body>
<div class="loader">
<div class="loading">
  <div class="loading-bar"></div>
  <div class="loading-bar"></div>
  <div class="loading-bar"></div>
  <div class="loading-bar"></div>
  <p>Payment Cancelled. Your are redirecting <a href="<?php echo base_url(); ?>">Click Here to Redirect Now.</a></p>
</div>
</body>
</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>           
<script>


$(document).ready(function() {
    $(".loader").show(); 
    setTimeout(function(){ window.location.replace('<?php echo base_url(); ?>') }, 5000);
});
</script>