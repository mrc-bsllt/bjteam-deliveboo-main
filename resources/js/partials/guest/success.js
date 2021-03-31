require('../../bootstrap');

import Vue from 'vue'

var success = new Vue({
   el: '#loading_container',
   data: {
      checking: true,
      countdown: 5
   },

   mounted(){
      console.log('Vue è OK');
      const self = this;
      setTimeout(function(){
         self.checking = false;
         
         setTimeout(function(){
            window.location.href = 'http://127.0.0.1:8000/';
         }, 5000);

      
         setInterval(function(){
            self.countdown = self.countdown - 1;
            this.$forceUpdate();
         }, 1000);
        
      }, 4000);

   }
})