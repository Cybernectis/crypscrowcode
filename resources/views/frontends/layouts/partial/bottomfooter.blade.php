        <!-- pre loader  -->
        <!-- <div class="preloader"></div> -->

        <!-- jQuery js -->
        <script src="{!! asset('frontends/js/jquery.min.js')!!}"></script>
        <!-- bootstrap js -->
        <script src="{!! asset('frontends/js/bootstrap.min.js')!!}"></script>
        
       <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type="text/javascript" src="{!! asset('frontends/js/script.js')!!}"></script>
        <script type="text/javascript">
            var host = "{{url('/')}}";
            var token = "{{csrf_token()}}";
            window.userId = $('meta[name="userId"]').attr('content');
        </script>
         @if(request()->is('/'))
  
            <script src="https://threejs.org/examples/js/libs/stats.min.js"></script>
            <script type="text/javascript">
                
                particlesJS("particles-js", {"particles":{"number":{"value":58,"density":{"enable":true,"value_area":961.4383117143238}},"color":{"value":"#ffffff"},"shape":{"type":"polygon","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":6},"image":{"src":"","width":100,"height":100}},"opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":true,"speed":10,"size_min":0.1,"sync":false}},"line_linked":{"enable":true,"distance":256.3835497904863,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":2,"direction":"none","random":true,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"grab"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":267.8027997565431,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});var count_particles, stats, update; stats = new Stats; stats.setMode(0); stats.domElement.style.position = 'absolute'; stats.domElement.style.left = '0px'; stats.domElement.style.top = '0px';  
                    count_particles = document.querySelector('.js-count-particles'); 
                update = function() { stats.begin(); stats.end(); if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) { /*count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;*/ } requestAnimationFrame(update); }; requestAnimationFrame(update);
            </script>
        
        @endif  
        <script type="text/javascript">
            {{Helper::getJavascriptApi()}}
        </script>
        
       <!--  <script language="JavaScript" src="https://www.geoplugin.net/javascript.gp" type="text/javascript"></script> -->