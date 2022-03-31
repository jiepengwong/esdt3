<?php


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- Vue Application -->
  <script src="https://unpkg.com/vue@3"></script>
  <!--  Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
</head>

<body>
  <div id="app">
    <div class="container">
  
      <!-- Portfolio Item Heading -->
      <h1 class="my-4">Page Heading
        <small>Secondary Text</small>
      </h1>
  
      <!-- Portfolio Item Row -->
      <div class="row">
  
        <div class="col-md-8">
          <img class="img-fluid" src="https://via.placeholder.com/750x500" alt="">
        </div>
  
        <div class="col-md-4">
          <h3 class="my-3">{{results.item_name}}</h3>
          <p>{{results.description}}</p>
          <h3 class="my-3">Item Details</h3>
          <ul>
            <li>Category: {{results.category}}</li>
            <li>Pick-up location: {{results.location}}</li>
            <li>Date Time: {{results.date_time}}</li>
          </ul>

          <form>

            <h3>Offer?</h3>
    
            <input type="number" v-model="price" required />
            <button class="btn btn-primary">Make Offer Now</button>

          </form>
  
        </div>
  
      </div>
  
    </div>

  </div>
</body>

</html>






























<script>
  const app = Vue.createApp({
    data() {
      return {
        results: [],
        price: 0,
        buyerid: "122323" //Taken from yuxiang side

      };
    },

    methods: {

    },


    async mounted() {
      const queryString = window.location.search;

      if (queryString){

        var itemid = queryString.split("=")[1];
        try {
          var getItemUrl = `http://localhost:5001/items/${itemid}`
          var databaseitems = await fetch(getItemUrl)
          const databaseitemsJson = await databaseitems.json()
  
          if (databaseitems.status === 200) {
            console.log(databaseitemsJson)
            // Get all the databases 
            this.results = databaseitemsJson.Success;
            console.log(this.results)
  
          } else {
            console.log("Database not connected")
          }
        } catch (error) {
          console.log(error)
        }
      }

      else{
        window.location.href="cataloguenew.php"
      }


      // Fetching from NEW items microservice, for a particular item.




    },

    methods: {
      // Invoke the complex microservice here to make an offer
      makeOffer() {
        requiredObjects = {"item_id": this.results._id, "price": this.price, "buyerid": this.buyerid}

      }

    },

    computed: {

    }
  });

  app.mount("#app");
</script>