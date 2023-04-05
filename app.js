const users = {};
const submit_button = document.getElementById("submit_button");

// Function to handle form submission
function register() {
    // Get the username and password from the form
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    const height = document.getElementById("height").value;
    const weight = document.getElementById("weight").value;
    const sex = document.getElementById("sex").value;
    
    // Create an object to represent the user
    const user = {
      username: username,
      password: password,
      height: height,
      weight: weight,
      sex: sex
    };
    
    // Store the user's information in the users object
    fetch('users.json')
      .then(response => response.json())
      .then(data => {
        data[username] = user;
        return JSON.stringify(data);
      })
      .then(json => {
        fetch('users.json', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: json
        })
        console.log(user);
        // Clear the form
        document.getElementById("username").value = "";
        document.getElementById("password").value = "";
        document.getElementById("height").value = "";
        document.getElementById("weight").value = "";
      });
  }

submit_button.addEventListener("click", register);
