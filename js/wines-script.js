// Working
function createGrid(count){
    var content = document.getElementsByClassName("wine-holder");
    // console.log(content);
    if(content.length > 0)
    {
        content[0].innerHTML = "";
        for(var i = 0; i < count; i++)
        {
            var content =`<div class="card h-100">
                <img class="card-img-top wine-img" alt="Card image cap" style="width: 100px; height=300px;"/>
                <div class="card-body text-center">
                    <h3 class="card-title"></h3>
                    <p class="card-text"></p>
                </div>
                <div class="card-footer text-center">
                    <button type="button" class="btn btn-outline-success wine-button" data-bs-toggle="modal" data-bs-target="#wineModal">More info...</button>
                </div>
            </div>`;
            
            document.getElementsByClassName("wine-holder")[0].innerHTML += content;
        }
    }
    
}

// Working
function generateWineriesAndReviews(data){
    let headersList = {
        "Accept": "*/*",
        "User-Agent": "Thunder Client (https://www.thunderclient.com)",
        "Content-Type": "application/json"
    }

    let bodyContent = JSON.stringify({
        "type":"getWineries"
    });

    fetch("http://localhost://COS216/UP_COS221/backend/api.php", { 
        method: "POST",
        body: bodyContent,
        headers: headersList
    })
    .then(response => {
        return response.json();  
    })
    .then(wineries => {
        var wineModal = document.getElementById('wineModal');
        if(wineModal)
        {
            wineModal.addEventListener('show.bs.modal', event =>{
            
                const button = event.relatedTarget;
                const wineId = button.getAttribute('data-bs-wine');
                
                var wine = data.data.filter(function(wine){
                    return wine.wine_id == wineId;
                });
                if(wine[0].winery_id)
                {
                    const wineryId = wine[0].winery_id;
                    var winery = wineries.data.filter(function(winery) {
                        return winery.winery_id == wineryId;
                    });
                }
                else
                {
                    //Default winery
                    var winery = wineries.data.filter(function(winery) {
                        return winery.winery_id == 1;
                    });
                }

                wineModal.querySelector('.modal-title').textContent = wine[0].name;
                wineModal.querySelector('.modal-image').setAttribute("src", wine[0].image);
                if(wineModal.querySelector('#addReviewButton'))
                {
                    wineModal.querySelector('#addReviewButton').setAttribute("data-bs-wine", wineId);
                }
                wineModal.querySelector('.modal-details').innerHTML = `
                    <p><b>Name:</b> ${wine[0].name}</p>
                    <p><b>Type:</b> ${wine[0].type}</p>
                    <p><b>Year:</b> ${wine[0].year}</p>
                    <p><b>Winery:</b> ${winery[0].name}</p>
                    <p><b>Description:</b> ${wine[0].description}</p>
                    <p><b>Price:</b> R${wine[0].price}.00</p>

                `;


                // Getting reviews
                bodyContent = JSON.stringify({
                    "type":"getReviews",
                    "wine_id": wineId
                });

                fetch("http://localhost://COS216/UP_COS221/backend/api.php", { 
                    method: "POST",
                    body: bodyContent,
                    headers: headersList
                })
                .then(response => {
                    return response.json();  
                })
                .then(reviews => {
                    if(reviews.data.length > 0)
                    {
                        wineModal.querySelector('.modal-reviews').innerHTML = `
                            <h3>Reviews</h3>
                        `;

                        for(var i = 0; i < reviews.data.length; i++)
                        {
                            wineModal.querySelector('.modal-reviews').innerHTML += `
                                <h4><i><span class="quote fa fa-quote-left"></i></span></h4>
                            `;
                            wineModal.querySelector('.modal-reviews').innerHTML += `
                                <p class="quote"><i>${reviews.data[i].comment}</i></p>
                            `;
                            for(var j=0; j< 5; j++)
                            {
                                if( j < reviews.data[i].rating)
                                {
                                    wineModal.querySelector('.modal-reviews').innerHTML += `
                                        <span class="fa fa-star checked"></span>
                                    `;
                                }
                                else
                                {
                                    wineModal.querySelector('.modal-reviews').innerHTML += `
                                        <span class="fa fa-star unchecked"></span>
                                    `;
                                }
                            }
                            
                        }
                    }
                    else
                    {
                        wineModal.querySelector('.modal-reviews').innerHTML = `
                            <h3>No Reviews</h3>
                        `;
                    }
                    
                });
            });
        }
    });
}
console.log(document.cookie);
// Working
function loadWines(){
    
    let headersList = {
        "Accept": "*/*",
        "User-Agent": "Thunder Client (https://www.thunderclient.com)",
        "Content-Type": "application/json"
    }
        
    let bodyContent = JSON.stringify({
        "type":"getWines"
    });
        
    fetch("http://localhost://COS216/UP_COS221/backend/api.php", { 
        method: "POST",
        body: bodyContent,
        headers: headersList
    })
    .then(res => {
        return res.json();  
    })
    .then(data => { 

        createGrid(data.data.length);

        for(var i = 0; i < data.data.length; i++)
        {
            //Debugging
            //console.log("Number of elements with class 'card-img-top':", document.getElementsByClassName("card-img-top").length);
            // console.log("Value of 'i':", i);
            // console.log("Value of 'data':", data);
            
                document.getElementsByClassName("card-img-top")[i].setAttribute("src", data.data[i].image);
                
                document.getElementsByClassName("card-title")[i].innerHTML = data.data[i].name;
                document.getElementsByClassName("card-text")[i].innerHTML = data.data[i].description;
                document.getElementsByClassName("wine-button")[i].setAttribute("data-bs-wine", data.data[i].wine_id);
            
        }

        generateWineriesAndReviews(data);

    });
}


// Working
function searchWines(){
    var input = document.getElementById("search-wine").value;
    var dropdown = document.getElementById("wine-type");
    var selection = dropdown.options[dropdown.selectedIndex].value;
    var e = document.getElementById('sort-wines');
    var sort = e.options[e.selectedIndex].value;
    if(sort!="Sort By...")
    {
        sortWines();
    }
    else if(input == "" && selection == "Wine Type" )
    {
        loadWines();
    }
    else
    {
        if(selection == "Wine Type")
        {
            selection = "";
        }
        let headersList = {
            "Accept": "*/*",
            "User-Agent": "Thunder Client (https://www.thunderclient.com)",
            "Content-Type": "application/json"
        }
            
        let bodyContent = JSON.stringify({
            "type":"getWines",
            "filters":{
                "name": input,
                "type": selection
            }
        });
            
        fetch("http://localhost://COS216/UP_COS221/backend/api.php", { 
            method: "POST",
            body: bodyContent,
            headers: headersList
        })
        .then(res => {
            return res.json();  
        })
        .then(data => {
            createGrid(data.data.length);

            for(var i = 0; i < data.data.length; i++)
            {

                if(document.getElementsByClassName("card-img-top").length > i)
                {
                    document.getElementsByClassName("card-img-top")[i].setAttribute("src", data.data[i].image);
                    document.getElementsByClassName("card-img-top")[i].setAttribute("alt", data.data[i].wine_id);
                    document.getElementsByClassName("card-title")[i].innerHTML = data.data[i].name;
                    document.getElementsByClassName("card-text")[i].innerHTML = data.data[i].description;
                    document.getElementsByClassName("wine-button")[i].setAttribute("data-bs-wine", data.data[i].wine_id);
                }
            }
                
            generateWineriesAndReviews(data);
        });
    }

}

// Working
function sortWines(){

    var input = document.getElementById("search-wine").value;
    var dropdown = document.getElementById("wine-type");
    var selection = dropdown.options[dropdown.selectedIndex].value;
    var e = document.getElementById('sort-wines');
    var sort = e.options[e.selectedIndex].value;
    
    if(selection == "Wine Type")
    {
        selection = "";
    }
    let headersList = {
        "Accept": "*/*",
        "User-Agent": "Thunder Client (https://www.thunderclient.com)",
        "Content-Type": "application/json"
    }
        
    let bodyContent = JSON.stringify({
        "type":"getWines",
        "filters":{
            "name": input,
            "type": selection
        }
    });
        
    fetch("http://localhost://COS216/UP_COS221/backend/api.php", { 
        method: "POST",
        body: bodyContent,
        headers: headersList
    })
    .then(res => {
        return res.json();  
    })
    .then(data => {
        createGrid(data.data.length);
        var finalData = {data: []};
        // if statements because switch statements don't work with freaking strings
        if(sort == "name-asc")
        {
            finalData.data = data.data.sort((a, b) => {
                if (a.name < b.name) {
                    return -1;
                }
            });
        }
        else if(sort == "name-desc")
        {
            finalData.data = data.data.sort((a, b) => {
                if (a.name > b.name) {
                    return -1;
                }
            });
        }
        else if(sort == "year-asc")
        {
            finalData.data = data.data.sort((a, b) => {
                if (a.year < b.year) {
                    return -1;
                }
            });

        }
        else if(sort == "year-desc")
        {
            finalData.data = data.data.sort((a, b) => {
                if (a.year > b.year) {
                    return -1;
                }
            });
        }
        else if(sort == "price-asc")
        {
            finalData.data = data.data.sort((a, b) => {
                if (a.price < b.price) {
                    return -1;
                }
            });
        }
        else if(sort == "price-desc")
        {
            finalData.data = data.data.sort((a, b) => {
                if (a.price > b.price) {
                    return -1;
                }
            });
        }
        else if(sort == "Sort By...")
        {
            finalData.data = data.data;
        }
        createGrid(finalData.data.length);

        for(var i = 0; i < finalData.data.length; i++)
        {

            if(document.getElementsByClassName("card-img-top").length > i)
            {
                document.getElementsByClassName("card-img-top")[i].setAttribute("src", finalData.data[i].image);
                document.getElementsByClassName("card-img-top")[i].setAttribute("alt", finalData.data[i].wine_id);
                document.getElementsByClassName("card-title")[i].innerHTML = finalData.data[i].name;
                document.getElementsByClassName("card-text")[i].innerHTML = finalData.data[i].description;
                document.getElementsByClassName("wine-button")[i].setAttribute("data-bs-wine", finalData.data[i].wine_id);
            }
        }
        generateWineriesAndReviews(finalData);
    });

}

// Working
function clearFilter(){
    loadWines();
    document.getElementById("search-wine").value = "";
    document.getElementById("wine-type").selectedIndex = 0;
    document.getElementById('sort-wines').selectedIndex = 0;
}

// Working
function addWine(){
    
    var inputWineName= document.getElementById("inputName");
    var inputWineTypeIndex=document.getElementById("add-wine-type").selectedIndex;
    var inputWineType = document.getElementById("add-wine-type").options[inputWineTypeIndex].value;
    var inputWineYear= document.getElementById("inputYear");
    var inputWinePrice= document.getElementById("inputPrice");
    var inputWineDescription= document.getElementById("inputDesc");
    var inputWineImage= document.getElementById("inputLink");
    var inputWineAlcohol= document.getElementById("inputAlc");
    //Error handling
    if(!inputWineName.value || !inputWineYear.value || !inputWinePrice.value || !inputWineDescription.value)
    {
        alert("Please fill in all the fields!");
    }
    else
    {
        var wineName = inputWineName.value;
        var wineYear = inputWineYear.value;
        var winePrice = inputWinePrice.value;
        var wineDescription = inputWineDescription.value;
       
        var wineAlcohol = inputWineAlcohol.value;

        //get from cookie
        var inputWineWinery;
        let x = document.cookie;
        const wineryIdRegex = /Manager=([^;]+)/;
        const matches = x.match(wineryIdRegex);
        if (matches && matches.length > 1) {
            inputWineWinery = matches[1];
        }

        var price =parseInt(winePrice);
        var wineryId = parseInt(inputWineWinery);
        var year = parseInt(wineYear);
        var alc = parseFloat(wineAlcohol);
        //Default image
        var wineImage = inputWineImage.value;
        if(wineImage == "")
        {
            wineImage = "https://unlabelledwine.co.za/wp-content/uploads/2020/09/Unlabelled-Wine-Cab-Sauv.png";
        }
        
        //Default winery
        if(wineryId == 0)
        {
            wineryId = 1;
        }
        let headersList = {
            "Accept": "*/*",
            "User-Agent": "Thunder Client (https://www.thunderclient.com)",
            "Content-Type": "application/json"
        }
            
        let bodyContent = JSON.stringify({
            "type":"addWines",
            "properties":{
                "name": wineName,
                "description": wineDescription,
                "price": price,
                "winery_id": wineryId,
                "alcohol_content": alc,
                "type": inputWineType,
                "year": year,
                "image": wineImage 

            }
        });
            
        fetch("http://localhost://COS216/UP_COS221/backend/api.php", { 
            method: "POST",
            body: bodyContent,
            headers: headersList
        })
        .then(res => {
            alert("Wine added successfully!");
            return res.json();  
        }).then(data => {
            
        });
        document.getElementById("inputName").value = "";
        document.getElementById("inputYear").value = "";
        document.getElementById("inputPrice").value = "";
        document.getElementById("inputDesc").value = "";
        document.getElementById("inputLink").value = "";
        document.getElementById("inputAlc").value = "";
        loadWines();
    }
}

// Rating
var stars = document.querySelectorAll('.star-rating .star');
var selectedRating = 0;

// Functions
function highlightStars(index) {
    resetStars();
    for (var i = 0; i < index; i++) {
        stars[i].classList.add('selected');
    }
}

function resetStars() {
    stars.forEach(function(star) {
        star.classList.remove('selected');
    });
}

function setRating(rating) {
    selectedRating = rating;
    var index = 0;
    stars.forEach(function(star) {
    
        if( index < rating)
        {
            star.classList.add('selected');
            index++;
        }
        else
        {
            star.classList.remove('selected');
            index++;
        }
    });
}

// ADD REVIEW
function addReview(){
    var inputReview = document.getElementById("wineComment");
    
    var inputRating = selectedRating;
    if(selectedRating == 0)
    {
        alert("Please Add your Rating!");
    }
    else if(!inputReview)
    {
        alert("Please Add your Review!");
    }
    else
    {

        var comment = inputReview.value;
        let x = document.cookie;
        
        const userIdRegex = /user_id=([^;]+)/;
        const matches = x.match(userIdRegex);
        var userId;
        if (matches && matches.length > 1) {
            userId = matches[1];
        }
        
        var wineId = this.event.target.getAttribute('data-bs-wine');
        console.log(wineId);

        let headersList = {
            "Accept": "*/*",
            "User-Agent": "Thunder Client (https://www.thunderclient.com)",
            "Content-Type": "application/json"
        }
        
        let bodyContent = JSON.stringify({
            "type": "addReview",
            "user_id": userId,
            "wine_id": wineId,
            "comment": comment,
            "rating":selectedRating
        });
        
        let response = fetch("http://localhost://COS216/UP_COS221/backend/api.php", { 
            method: "POST",
            body: bodyContent,
            headers: headersList
        });
        
        alert("Review Added!");
        var inputReview = document.getElementById("wineComment");
        inputReview.value = "";
        setRating(0);
        loadWines();
        
    }
    
}

// Initial function - When the page loads
loadWines();




