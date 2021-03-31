require('./bootstrap');
require('select2');
//import Vue from 'vue';

$(document).ready(
  function() {

    // Select 2
    $("#categories").select2(
      {
        maximumSelectionLength: 5,
        placeholder: "inserisci categoria",
        width: 'resolve',
        height: 'resolve',
      });

  }
);
