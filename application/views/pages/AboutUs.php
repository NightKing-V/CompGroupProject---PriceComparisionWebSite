
<body>
  <style>
    /* aboutus-style.css */

    /* Style for the about-image */
    .about-image img {
      width: 100%;
      height: auto;
      border-radius: 10px;
    }

    /* Style for the about-content */
    .about-content {
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 10px;
      margin-top: 0%;
    }

    /* Style for the h1 */
    h1 {
      color: #333;

    }

    /* Style for paragraphs */
    p {
      color: #555;
      line-height: 1.6;
    }

    /* Style for text-center class */
    .text-center {
      text-align: center;
    }


    .mt-5 {
      margin-top: 3rem !important;
    }

    .mb-4 {
      margin-bottom: 1.5rem !important;
    }
  </style>


  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="about-image">
          <img src="<?php echo base_url("Assets/IMG/abtus.jpg") ?>" alt="About Us Image">
        </div>
      </div>
      <div class="col-md-6">
        <div class="about-content">
          <h1 class="text-center mt-5 mb-4">ABOUT PRICE PAL</h1>
          <p>Welcome to PRICE PAL! We are your go-to destination for finding the best deals on a wide range of products
            and services. Our platform is dedicated to helping you save time and money by providing accurate and
            up-to-date price comparisons from various retailers and service providers.
            At PRICE PAL, we understand the importance of making informed purchasing decisions. That's why we
            meticulously gather pricing data from trusted sources and present it in an easy-to-navigate format, allowing
            you to compare prices effortlessly.
            Whether you're searching for best electronics, home appliances or any other product or service, you can rely
            on us to help you find the best value for your money. Our user-friendly interface and powerful search tools
            make it simple to locate the best deals tailored to your specific needs and budget.
            With PRICE PAL, shopping smarter has never been easier. Join our community of savvy shoppers today and start
            saving on your favorite products and services!</p>


          <h2 class="mt-5" id="universityHeader">WHO WE ARE </h2>
          <p id="universityParagraph" style="display: none;">PRICE PAL is a project developed by group of computer
            science students from Plymouth University ,united by our passion for technology and innovation. We aim to
            apply our knowledge and skills to create practical solutions that benefit users.

          <h2 class="mt-5" id="developersHeader">OUR TEAM</h2>
          <p id="developersParagraph" style="display: none;">Our team of developers are passionate about technology and
            innovation.Each member of our team brings a unique perspective and skill set to the table, contributing to
            the success of our projects. From coding wizards to creative problem-solvers, we collaborate seamlessly to
            deliver high-quality results.

            We work tirelessly to enhance the functionality and user experience of PRICE PAL. Meet our dedicated team:
          </p>
          <ul id="developersList" style="display: none;">
            <li>Weeraman Dissanayaka</li>
            <li>Robalge Lenora </li>
            <li>Gunandawadu Zoysa</li>
            <li>Ravindu Peiris</li>
            <li>Laknidu Thilakawardhana</li>
            <li>Molligoda Kaushalee</li>
          </ul>


          <button id="toggleButton" class="btn btn-primary mt-3">Show More</button>


        </div>
      </div>
    </div>
  </div>



  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="script.js"></script>

<script>

  document.addEventListener("DOMContentLoaded", function () {
    // Function to toggle visibility of university and developers content
    document.getElementById("toggleButton").addEventListener("click", function () {
      var universityParagraph = document.getElementById("universityParagraph");
      var developersParagraph = document.getElementById("developersParagraph");
      var developersList = document.getElementById("developersList");
      var toggleButton = document.getElementById("toggleButton");

      // Toggle visibility of university and developers content and update button text
      if (universityParagraph.style.display === "none") {
        universityParagraph.style.display = "block";
        developersParagraph.style.display = "block";
        developersList.style.display = "block";
        toggleButton.textContent = "Show Less";
      } else {
        universityParagraph.style.display = "none";
        developersParagraph.style.display = "none";
        developersList.style.display = "none";
        toggleButton.textContent = "Show More";
      }
    });
  });
</script>

