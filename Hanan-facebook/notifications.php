<!DOCTYPE html>
<html lang="en">
	<?php
	session_start();
	if(empty($_session["user_id"])){
	//header('location: login13.html');
	}
	?>
<!-- Mirrored from www.wpkixx.com/html/winku/notifications.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 19 Sep 2021 10:27:41 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>Winku Social Network Toolkit</title>
    <link rel="icon" href="images/fav.png" type="image/png" sizes="16x16"> 
    
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">

</head>
<body>
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">
	<div class="responsive-header">
		<div class="mh-head second">
			<form class="mh-form" >
				<input placeholder="search" id="mysearch"/>
				<a href="#/" class="fa fa-search" id="search"></a>
				 
			</form>
		</div>
		
	</div><!-- responsive header -->
	
	<div class="topbar stick">
		
		<div class="top-area">
				
			<ul class="setting-area">
			
				<div class="mh-head second">
				<form class="mh-form" >
					<input type="text" placeholder="Search Friend" id="search2">
					<a href="#/" class="fa fa-search" id="buttonBig"></a>
				</form>
				</div>
					
				
						
		</div>
	</div><!-- topbar -->
	
	<section>
			<div class="feature-photo">
				<figure><img src="images/resources/timeline-1.jpg" alt=""></figure>
				
			
				<div class="container-fluid">
					<div class="row merged">
						<div class="col-lg-2 col-sm-3">
							<div class="user-avatar">
								<figure>
									<img src="images/resources/user-avatar.jpg" alt="">
									
								</figure>
							</div>
						</div>
						<div class="col-lg-10 col-sm-9">
							<div class="timeline-info">
								<ul>
									<li class="admin-name">
									  <h5 id="name"></h5>  <!-- name is fetched -->
									</li>
									<li>
										<a class="" href="friends_page.html" title="" data-ripple="">Friends</a>
										<a class="" href="edit-profile-basic.html" title="" data-ripple="">Edit Profile</a>
									</li>
									<a href="#" title="" class="add-butn more-action logout" data-ripple="" >Logout</a>

								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section><!-- top area -->

	<section>
		<div class="gap gray-bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="row merged20" id="page-contents">
							<div class="col-lg-3">
								<aside class="sidebar static">
									<h5 class="f-title"><i class="ti-bell" type="button"></i>Notifications</h5>
										<ul class="notification-box">
										
										
						<!--Notifications will be displayed here-->
										</ul>
																	
								</aside>
							</div><!-- sidebar -->
							<div class="col-lg-6">
								<div class="central-meta">
									<div class="frnds">
										<ul class="nav nav-tabs">
											 <li class="nav-item"><a class="active" href="#frends" data-toggle="tab">Search Results</a> <span></span></li>
										</ul>

										<!-- Tab panes -->
										<div class="tab-content">
										  <div class="tab-pane active fade show " id="frends" >
											<ul class="nearby-contct">

													<!--The searched profiles are displayed here-->
											
											</ul>
										  </div>
										 
										</div>
									</div>
								</div>
							</div><!-- centerl meta -->
							<div class="col-lg-3">
								<aside class="sidebar static">
									
										
										
								</aside>
							</div><!-- sidebar -->
						</div>	
					</div>
				</div>
			</div>
		</div>	
	</section>

	
</div>
	
	
	<script src="http://www.wpkixx.com/html/winku/js/main.min.js"></script>
	<script src="http://www.wpkixx.com/html/winku/js/script.js"></script>
<script>
$(document).ready(getName);
	async function getInfo(){
				 const response = await fetch('http://localhost/facebook/getUserInfo.php');
				 if (!response.ok){
					 const message = "An error occured";
					 throw new Error(message);
				 }
				 const results = await response.json();  
				 return results;
			}


	function getName(){

			getInfo().then(results => {
			// the result is an asspciative array, we only need the value at key first name
			$("#name").html(results["fname"]+" "+results["lname"]);
			});

			//we also add the on click notification

			$(".ti-bell").click( function(){
				Display().then(results => {
				//should loop over result and create profile elements

					for(var i=0; i<results.length; i++){
					//give row an id
					var profile = $('<li><figure></figure><div class="notifi-meta"><p>'+results[i].text+'</p><span></span></div></li>');	
					$(".notification-box").append(profile);
				}
				});	
			});

	}
	async function getUsers(){
				 const response = await fetch('http://localhost/facebook/searchApi.php',{
					method: 'POST',
					body: new URLSearchParams({
						"search": $("#search2").val() 
					})
				 });
				 if (!response.ok){
					 const message = "An error occured";
					 throw new Error(message);
				 }
				 const results = await response.json();  
				 return results;
			}
	function search(){

			// first we remove all the profiles from the previous search.

			$(".nearby-contct").empty();

			getUsers().then(results => {
			// should be looping over the array and displaying the fname + lname and the 2 buttons.
			//gave add ids for the buttons from results.
			for(var i=0; i<results.length; i++ ){
				var profile = $('<li><div class="nearly-pepls"><figure></figure><div class="pepl-info"><h4><a href="time-line.html" title="">'+results[i].first_name+" "+results[i].last_name +'</a></h4><span>Profile</span><a href="#" title="" class="add-butn more-action block" data-ripple="" id ='+ ("block_"+results[i].id)+'>Block</a><a href="#" title="" class="add-butn add" data-ripple="" id='+ ("add_"+results[i].id)+'>add friend</a></div></div></li>');
				$(".nearby-contct").append(profile);
			    }
				$(".add").click(function() {
				var friend = $(this).attr("id");
				send_request(friend).then(results => {
				//we need to change the add button to "Request Sent" after finishing.
				$("#"+friend).html("sent!");
			    
			});
			});

			$(".block").click(function() {
				var friend = $(this).attr("id");
				block(friend).then(results => {
				//we need to change the add button to "Blocked" after finishing.
				$("#"+friend).html("Blocked");
			    });
			});
			});
			
	}
	async function getUsers2(){
				 const response = await fetch('http://localhost/facebook/searchApi.php',{
					method: 'POST',
					body: new URLSearchParams({
						"search": $("#mysearch").val() 
					})
				 });
				 if (!response.ok){
					 const message = "An error occured";
					 throw new Error(message);
				 }
				 const results = await response.json();  
				 return results;
			}

	function search2(){
			getUsers2().then(results => {
			// should be looping over the array and displaying the fname + lname and the 2 buttons.
			//gave add ids for the buttons from results.
			for(var i=0; i<results.length; i++ ){
				
				var profile = $('<li><div class="nearly-pepls"><figure></figure><div class="pepl-info"><h4><a href="time-line.html" title="">'+results[i].first_name+" "+results[i].last_name +'</a></h4><span>Profile</span><a href="#" title="" class="add-butn more-action block" data-ripple="" id ='+ ("block_"+results[i].id)+'>Block</a><a href="#" title="" class="add-butn add" data-ripple="" id='+ ("add_"+results[i].id)+'>add friend</a></div></div></li>');
				$(".nearby-contct").append(profile);
			    }
			$(".add").click(function() {
				var friend = $(this).attr("id");
				send_request(friend).then(results => {
				//we need to change the add button to "Request Sent" after finishing.
				$("#"+friend).html("Requested");
			    
			});
		});
		$(".block").click(function() {
				var friend = $(this).attr("id");
				block(friend).then(results => {
				//we need to change the add button to "Blocked" after finishing.
				$("#"+friend).html("Blocked");
			    });
			});

		});
			
	}

	$("#search").click(search2);
	$("#buttonBig").click(search);
	
	


	async function send_request(id){
		const response = await fetch("http://localhost/facebook/AddApi.php",{
					method: 'POST',
					body: new URLSearchParams({
						"id": id
					})
		})
		if (!response.ok){
					 const message = "An error occured";
					 throw new Error(message);
				 }
		const results = await response.json();  
		return results;			
	}
	
	async function block(friend){
				 const response = await fetch('http://localhost/facebook/Block.php',{
					method: 'POST',
					body: new URLSearchParams({
						"id": friend
					})
                })
				 if (!response.ok){
					 const message = "An error occured";
					 throw new Error(message);
				 }
				 const results = await response.json();  
				 return results;
			}
	
	async function Display(friend){
				 const response = await fetch('http://localhost/facebook/Displaynotifications.php',{
					method: 'POST',
					body: new URLSearchParams({
						"id": friend
					})
                })
				 if (!response.ok){
					 const message = "An error occured";
					 throw new Error(message);
				 }
				 const results = await response.json();  
				 return results;
			}

	$(".logout").click(function(){
		logout().then(results=>{
			$(location).attr('href', 'login13.html');
		});
	})


	async function logout(){
				 const response = await fetch('http://localhost/facebook/logout.php');
            
				 if (!response.ok){
					 const message = "An error occured";
					 throw new Error(message);
				 }
				 const results = await response.json();  
				 return results;
			}
	

</script>
</body>	


<!-- Mirrored from www.wpkixx.com/html/winku/notifications.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 19 Sep 2021 10:27:42 GMT -->




</html>