require('../../bootstrap');

import axios from 'axios';
import Vue from 'vue';

const frontEndHeader = new Vue({
  el: '#header',
  data: {
    headerStatus: false,
    searchBarPlaceholder: "",
    searched: "",
    searchedResults: [],
    activeLogOut: false,
    activeHamburger: false,
    displayNone: false,
    actualUser: null
  },

  mounted() {
    const self = this;
    let user;
    window.addEventListener('scroll', () => {
      if (window.scrollY > 1) {
        this.headerStatus = true;
      } else {
        this.headerStatus = false;
      };
    });

    user = Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');
    this.actualUser = user;
  },

  methods: {
    getRestaurantByName(){
      this.searched = this.searched.toLowerCase();
      axios
        .get(`/api/restaurant/search/${this.searched}`)
        .then(response => {
          this.searchedResults = (response.data);

        })
    },

    toggleActive(ref) {
      this[ref] = !this.[ref];
      if(window.innerWidth < 993 && this.actualUser) {
        console.log(window.innerWidth);
        this.displayNone = !this.displayNone;
      }
    }
  }
});


//hamburger menu
var $menuBtn = document.getElementById('btn-hamburger');
// to attach an event to do more than one task in the same time
$menuBtn.onclick = function(e)
{
  // do something tasks
  // your code here
  // animation for button with cross line on click
  animatedMenu(this);

  // avoid default behavior
  e.preventDefault();
};
function animatedMenu(x)
{
    x.classList.toggle("animeOpenClose");
}
