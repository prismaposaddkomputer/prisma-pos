    </div>    
  </body>
</html>
<script>
    range.addEventListener('input', function(){
      document.querySelector('.pace').classList.remove('pace-inactive');
      document.querySelector('.pace').classList.add('pace-active');

      document.querySelector('.pace-progress').setAttribute('data-progress-text', range.value + '%');
      document.querySelector('.pace-progress').setAttribute('style', '-webkit-transform: translate3d(' + range.value + '%, 0px, 0px)');
    });
</script>