document.addEventListener("DOMContentLoaded", function() {
    // Function to toggle visibility of university and developers content
    document.getElementById("toggleButton").addEventListener("click", function() {
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
  