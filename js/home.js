document.getElementById("content").style.display = "flex";

var obj = 
{
	"type":"getWineries"
}

obj = JSON.stringify(obj);

loadData(obj);

function loadData(obj) {
	var req = new XMLHttpRequest();
	
	req.onreadystatechange = function()
	{
		if (req.readyState === 4 && req.status === 200)
		{
			var values = JSON.parse(req.responseText);
			
			var dataV = values.data;
			
			for (var i = 0; i < 24; i++)
			{
				const wineryContainer = document.querySelector('#winery-container');			
				var myDiv = document.createElement('div');
				
				myDiv.className = "winery " + values.data[i].name + " " + values.data[i].countryname;
				myDiv.innerHTML =   '<div class="img">' +
									'<img class="image" id="winery'+i+'" src="" alt="">' +
									'</div>' +
									'<div class="info">' +
									'<h2 class="name"></h2>' +
									'<p class="address"></p>' +
									'<p class="country"></p>' +
									'<p class="description"><em></em></p>' +
									'<br/><br/>' +
									'<p class="phone"></p>' +
									'<p class="link"><a id="link'+i+'" href="" target="_blank"></a></p>' +
									'</div>' ;
									
				wineryContainer.appendChild(myDiv);
				
				//NB! check names from db
				document.getElementsByClassName('image')[i].setAttribute('alt', dataV[i].name);
				document.getElementsByClassName('name')[i].innerHTML = dataV[i].name;
				document.getElementsByClassName('address')[i].innerHTML = dataV[i].address;
				//document.getElementsByClassName('country')[i].innerHTML = dataV[i].countryname;
				document.getElementsByClassName('description')[i].innerHTML = dataV[i].description;
				//document.getElementsByClassName('email')[i].innerHTML = dataV[i].email;
				document.getElementsByClassName('phone')[i].innerHTML = "Contact Details: 0" + dataV[i].phone_number + " | " + dataV[i].email;
				//document.getElementById('link'+i)[i].href = dataV[i].web_link;
				document.getElementsByClassName('link')[i].innerHTML = dataV[i].web_link;
				
				var image = document.getElementById('winery'+i);
				image.src = dataV[i].winery_image;
			}
		}
	};
	req.open("POST", '../backend/api.php', true);
	req.send(obj);
	//getCookies();
}

document.getElementById("content").style.display = "none";

function filterDestination(country) {
	var x, i;
	x = document.getElementsByClassName("winery");

	if (country == "ww") 
	{
		country = "";
	}

	for (i = 0; i < x.length; i++) 
	{
		addClass(x[i], "show");

		if (x[i].className.indexOf(country) > -1)
		{
			
			removeClass(x[i], "show");
		}
	}
}
  
function addClass(element, name) {
	var i, arr1, arr2;
	arr1 = element.className.split(" ");
	arr2 = name.split(" ");
	
	for (i = 0; i < arr2.length; i++) 
	{
		if (arr1.indexOf(arr2[i]) == -1) 
		{
			element.className += " " + arr2[i];
		}
	}
}
  
function removeClass(element, name) {
	var i, arr1, arr2;
	arr1 = element.className.split(" ");
	arr2 = name.split(" ");
	
	for (i = 0; i < arr2.length; i++) 
	{
		while (arr1.indexOf(arr2[i]) > -1) 
		{
			arr1.splice(arr1.indexOf(arr2[i]), 1);
		}
	}
	element.className = arr1.join(" ");
}
function getCookies()
{
	var cookies = decodeURIComponent(document.cookie);
	var divorcedcookies = cookies.split(";");
	for(var i = 0; i < divorcedcookies.length; i++)
	{
		console.log(divorcedcookies[i]);
	}
}