require('../../bootstrap');
import Vue from 'vue';

const backend = new Vue({
  el: '#background',
  data: {
    activeAside: "",
    asideClass: "",
    mainClass: "",
    contentAsideClass: "",
    activeSettings: false,
    editForm: false,
    url: null,
    url_one: null,
    year: "2021"
  },
  methods: {

    toggleShowAside(){
      if (this.activeAside === "") {
        this.activeAside = false;
        this.asideClass = "aside_slide_right";
        this.mainClass = "main_slide_left";
        this.contentAsideClass = "fade_out";
      } else {
        if (!this.activeAside) {
          this.activeAside = true;
          this.asideClass = "aside_slide_left";
          this.mainClass = "main_slide_right";
          this.contentAsideClass = "fade_in";
          this.$forceUpdate;
        } else {
          this.activeAside = false;
          this.asideClass = "aside_slide_right";
          this.mainClass = "main_slide_left";
          this.contentAsideClass = "fade_out";
          this.$forceUpdate;
        }
      }
    },

    toggleSettings() {
      this.activeSettings = !this.activeSettings;
    },

    activeEditForm() {
      this.editForm = !this.editForm;
    },

    onFileChange(e) {
      const file = e.target.files[0];
      this.url = URL.createObjectURL(file);
    },
    onFileChangeSecond(e) {
      const file = e.target.files[0];
      this.url_one = URL.createObjectURL(file);
    },

    filterByYear(){
      Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');

      let restaurantSlug = JSON.parse(Vue.prototype.$userId).restaurant.slug;
      let monthsTotalPrice = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
      let yearTotalPrice = 0;

      axios
        .get(`/api/restaurant/${restaurantSlug}/orders`)
        .then(
          (response) => {

            let orders = response.data;
            const self = this;
            let myId = [];

            //Prendo il guadagno totale di tutti i mesi dell'anno selezionato
            orders.forEach(
              (element) => {
                let orderCreateDate = element.created_at; //data creazione dell'ordine
                let orderTotalPrice = element.total_price; //importo totale dell'ordine

                if(orderCreateDate.substr(0, 4) == self.year){
                  for(var i = 1; i <= 12; i++){
                    if(orderCreateDate.substr(5, 2) == '0' + i){
                      monthsTotalPrice[i - 1] += orderTotalPrice;
                    }
                  }
                }
              }
            );

            //Prendo il guadagno totale dell'anno selezionato
            monthsTotalPrice.forEach(
              (element) => {
                yearTotalPrice += element;
              }
            );

            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                label: "€ / months",
                backgroundColor: '#e77b37',
                borderColor: '#be363b',
                data: monthsTotalPrice
              }]
            },

              // Configuration options go here
              options: {
                responsive: true,
              }

            });


          }
        );
      }
  },

  mounted() {
    let currentUrl = window.location.href;

    if(currentUrl == "http://127.0.0.1:8000/admin/restaurants/orders/charts") {
      this.filterByYear();
    }

  }
});
