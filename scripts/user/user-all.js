$(document).ready(function() { 
	$("input[type='text'].personal-basic-info").on("keyup", function(){
		$(this).val($(this).val().toUpperCase());
	});
	$("input[type].name").on("keypress", function(event) {
		var charcode = (event.which) ? event.which : event.keyCode;
		if (charcode >= 48 && charcode <= 57)
		{
			return false;
		}
	});
	$("input[type='text']#bdate-picker").datepicker({startDate:'-99y',endDate:'-18y'});
	$("input[type='text']#contact").attr("maxlength","11");
	$("input[type='text']#contact").on("keypress", function(event) {
		var charcode = (event.which) ? event.which : event.keyCode;
		// charcode 46 = backspace, charcode 37 = left arrow and charcode 39 = right arrow
		if ((charcode != 37 && charcode != 39) && charcode > 31 && (charcode < 48 || charcode > 57))
		{
			return false;
		}
	});
	// new user
	$("form#new-user-form button[name='signup']").on("click", function() {
		var user_error_msg = "";
		// generating error message for blank fields
		if ($("input[name='lnametxt']").val() == "")
		{
			user_error_msg += "Last Name <br/>";
		}
		if ($("input[name='fnametxt']").val() == "")
		{
			user_error_msg += "First Name <br/>";
		}
		if ($("input[name='bdatetxt']").val() == "")
		{
			user_error_msg += "Birth Date <br/>";
		}
		if ($("input[name='addresstxt']").val() == "")
		{
			user_error_msg += "Address <br/>";
		}
		if ($("input[name='contacttxt']").val() == "")
		{
			user_error_msg += "Contact No <br/>";
		}
		if ($("input[name='unametxt']").val() == "")
		{
			user_error_msg += "Username <br/>";
		}
		if ($("input[name='pwordtxt']").val() == "")
		{
			user_error_msg += "Password <br/>";
		}
		if ($("input[name='confrm_pwordtxt']").val() == "")
		{
			user_error_msg += "Confirm Password <br/>";
		}
		// showing error message for blank fields
		if (user_error_msg != "")
		{
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if(this.readyState == 4 && this.status == 200)
				{
					$("#new-user-error-dialog-wrapper").html(this.responseText);
					$("#user-error-dialog #user-error-msg").html("Please fill up the following fields: <br/>" + 
					user_error_msg);
					$("#user-error-dialog").modal({backdrop: false, keyboard: false});
				}
			};
			xhttp.open("GET", "/user/new_user_error_dialog.php", true);
			xhttp.send();
		}
		else
		{	
			// error message for not selecting gender
			if ($("select[name='gender'] option:selected").val() == "Select Gender")
			{
				user_error_msg = "Please select gender.";
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if(this.readyState == 4 && this.status == 200)
					{
						$("#new-user-error-dialog-wrapper").html(this.responseText);
						$("#user-error-dialog #user-error-msg").html(user_error_msg);
						$("#user-error-dialog").modal({backdrop: false, keyboard: false});
					}
				};
				xhttp.open("GET", "/user/new_user_error_dialog.php", true);
				xhttp.send();
			}
			// error message for not selecting role
			else if ($("select[name='role'] option:selected").val() == "Select Role")
			{
				user_error_msg = "Please select role.";
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if(this.readyState == 4 && this.status == 200)
					{
						$("#new-user-error-dialog-wrapper").html(this.responseText);
						$("#user-error-dialog #user-error-msg").html(user_error_msg);
						$("#user-error-dialog").modal({backdrop: false, keyboard: false});
					}
				};
				xhttp.open("GET", "/user/new_user_error_dialog.php", true);
				xhttp.send();
			}
			else
			{
				// error message for string value of contact no
				if (!$.isNumeric($("input[name='contacttxt']").val()))
				{
					user_error_msg = "Contact number is not in a valid format.";
					var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
						if(this.readyState == 4 && this.status == 200)
						{
							$("#new-user-error-dialog-wrapper").html(this.responseText);
							$("#user-error-dialog h5").html("Contact No.");
							$("#user-error-dialog #user-error-msg").html(user_error_msg);
							$("#user-error-dialog").modal({backdrop: false, keyboard: false});
						}
					};
					xhttp.open("GET", "/user/new_user_error_dialog.php", true);
					xhttp.send();
				}
				else
				{
					if ($("input[name='contacttxt']").val().length == 7 ||
						$("input[name='contacttxt']").val().length == 11)
					{
						if ($("input[name='pwordtxt']").val().length < 8)
						{
							user_error_msg = "Password must be atleast 8 alphanumeric characters.";
							var xhttp = new XMLHttpRequest();
							xhttp.onreadystatechange = function() {
								if(this.readyState == 4 && this.status == 200)
								{
									$("#new-user-error-dialog-wrapper").html(this.responseText);
									$("#user-error-dialog h5").html("Password");
									$("#user-error-dialog #user-error-msg").html(user_error_msg);
									$("#user-error-dialog").modal({backdrop: false, keyboard: false});
								}
							};
							xhttp.open("GET", "/user/new_user_error_dialog.php", true);
							xhttp.send();
						}
						else
						{
							if ($("input[name='confrm_pwordtxt']").val() != 
								$("input[name='pwordtxt']").val())
							{
								user_error_msg = "Confirm password does not match.";
								var xhttp = new XMLHttpRequest();
								xhttp.onreadystatechange = function() {
									if(this.readyState == 4 && this.status == 200)
									{
										$("#new-user-error-dialog-wrapper").html(this.responseText);
										$("#user-error-dialog h5").html("Confirm Password");
										$("#user-error-dialog #user-error-msg").html(user_error_msg);
										$("#user-error-dialog").modal({backdrop: false, keyboard: false});
									}
								};
								xhttp.open("GET", "/user/new_user_error_dialog.php", true);
								xhttp.send();
							}
							else
							{
								// last name handling spacing issue(one space or more than one space) 
								// when checking if existing or not
								var lname_word = $("input[name='lnametxt']").val().split(" ");
								var fname_word = $("input[name='fnametxt']").val().split(" ");
								var mname_word = $("input[name='mnametxt']").val().split(" ");
								var uname_word = $("input[name='unametxt']").val().split(" ");
								var lnametxt_val = "";
								var lname_word_counter = 0;
								for(count = 0;count < lname_word.length;count++)
								{
									if(count == 0)
									{
										if(lname_word[count] != "")
										{	
											lname_word_counter += 1;
											//alert(counter);
											lnametxt_val += lname_word[count];
										}
									}
									else
									{
										if (lname_word[count] != "")
										{
											lname_word_counter += 1;
											//alert(counter);
											if (lname_word_counter == 1)
											{
												lnametxt_val += lname_word[count];
											}
											else
											{
												lnametxt_val += " " + lname_word[count];
											}	
										}
									}
								}
								// first name handling space issues
								var fnametxt_val = "";
								var fname_word_counter = 0;
								for(count = 0;count < fname_word.length;count++)
								{
									if(count == 0)
									{
										if(fname_word[count] != "")
										{	
											fname_word_counter += 1;
											//alert(counter);
											fnametxt_val += fname_word[count];
										}
									}
									else
									{
										if (fname_word[count] != "")
										{
											fname_word_counter += 1;
											//alert(counter);
											if (fname_word_counter == 1)
											{
												fnametxt_val += fname_word[count];
											}
											else
											{
												fnametxt_val += " " + fname_word[count];
											}	
										}
									}
								}
								// middle name handling space issues
								var mnametxt_val = "";
								var mname_word_counter = 0;
								for(count = 0;count < mname_word.length;count++)
								{
									if(count == 0)
									{
										if(mname_word[count] != "")
										{	
											mname_word_counter += 1;
											//alert(counter);
											mnametxt_val += mname_word[count];
										}
									}
									else
									{
										if (mname_word[count] != "")
										{
											mname_word_counter += 1;
											//alert(counter);
											if (mname_word_counter == 1)
											{
												mnametxt_val += mname_word[count];
											}
											else
											{
												mnametxt_val += " " + mname_word[count];
											}	
										}
									}
								}
								// username handling space issues
								var unametxt_val = "";
								var uname_word_counter = 0;
								for(count = 0;count < uname_word.length;count++)
								{
									if(count == 0)
									{
										if(uname_word[count] != "")
										{	
											uname_word_counter += 1;
											//alert(counter);
											unametxt_val += uname_word[count];
										}
									}
									else
									{
										if (uname_word[count] != "")
										{
											uname_word_counter += 1;
											//alert(counter);
											if (uname_word_counter == 1)
											{
												unametxt_val += uname_word[count];
											}
											else
											{
												unametxt_val += " " + uname_word[count];
											}	
										}
									}
								}
								//alert($("input[name='bdatetxt']").val());
								var xhttp = new XMLHttpRequest();
								xhttp.onreadystatechange = function() {
									if(this.readyState == 4 && this.status == 200)
									{
										//alert(this.responseText);
										if (this.responseText.trim() == "")
										{
											//alert(this.responseText);
											// append user save modal to its wrapper and show it - success message
											var xhttp = new XMLHttpRequest();
											xhttp.onreadystatechange = function() {
												if (this.readyState == 4 && this.status == 200)
												{
													$("#user-save-dialog-wrapper").html(this.responseText);
													$("#user-save-dialog").modal({backdrop:false, keyboard:false});
												}
											};
											xhttp.open("GET","../user/user_save_dialog.php", true);
											xhttp.send();
										}
										else
										{ 
											// append error modal to its wrapper and show it - success message
											user_error_msg = this.responseText;
											var xhttp = new XMLHttpRequest();
											xhttp.onreadystatechange = function() {
												if(this.readyState == 4 && this.status == 200)
												{
													$("#new-user-error-dialog-wrapper").html(this.responseText);
													$("#user-error-dialog h5").html("Existing");
													$("#user-error-dialog #user-error-msg").html(user_error_msg);
													$("#user-error-dialog").modal({backdrop: false, keyboard: false});
												}
											};
											xhttp.open("GET", "/user/new_user_error_dialog.php", true);
											xhttp.send();
										}
									}
								};
								xhttp.open("POST", "/user/insert.php", true);
								xhttp.setRequestHeader("Content-type", 
													   "application/x-www-form-urlencoded");
								xhttp.send("lnametxt=" + lnametxt_val +
									      "&fnametxt=" + fnametxt_val +
										  "&mnametxt=" + mnametxt_val +
										  "&gender=" + $("select[name='gender'] option:selected").val() +
										  "&bdatetxt=" + $("input[name='bdatetxt']").val() +
										  "&addresstxt=" + $("input[name='addresstxt']").val() +
										  "&contacttxt=" + $("input[name='contacttxt']").val() +
										  "&unametxt=" + unametxt_val +
										  "&pwordtxt=" + $("input[name='pwordtxt']").val() +
										  "&role=" + $("select[name='role'] option:selected").val());
							}
							
						}
					}
					// error message for number of digit of contact no
					else
					{
						user_error_msg = "Contact number is not in a valid format. <br/>" +
										 "Must be a 7-digit number for telephone or 11-digit number for cellphone.";
						var xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function() {
							if(this.readyState == 4 && this.status == 200)
							{
								$("#new-user-error-dialog-wrapper").html(this.responseText);
								$("#user-error-dialog h5").html("Contact No.");
								$("#user-error-dialog #user-error-msg").html(user_error_msg);
								$("#user-error-dialog").modal({backdrop: false, keyboard: false});
							}
						};
						xhttp.open("GET", "/user/new_user_error_dialog.php", true);
						xhttp.send();
					}
				}
			}
		}
	});
	//in view's update button
	$("button[name='Update']").on("click",function() {
		if ($(this).attr("id") != null && $(this).attr("id") != "")
		{
			if ($("input[name='user']").length == 0)
			{
				$(this).before("<input type='hidden' name='user' />");
				$("input[name='user']").val($(this).attr("id"));
				$(this).val($(this).attr("id"));
			}
			else
			{
				$("input[name='user']").remove();
				$(this).before("<input type='hidden' name='user' />");
				$("input[name='user']").val($(this).attr("id"));
				$("button[name='Update']").val("");
				$(this).val($(this).attr("id"));
			}
			$(this).parent().submit();
		} 
	});
	// in update user and profile page
	$("button[name='upload-pic-btn']").on("click", function() {
		//$("input[name='profile_pic_image']").trigger("click");
		// $("input[name='profile_pic_image']").on("change", function() {
		// 	$("input[name='ff']").attr("value",$("input[name='profile_pic_image']").val());
		// });
	});
	// update user
	$("form#update-user-form button[name='signup']").on("click", function() {
		var user_error_msg = "";
		// generating error message for blank fields
		if ($("input[name='lnametxt']").val() == "")
		{
			user_error_msg += "Last Name <br/>";
		}
		if ($("input[name='fnametxt']").val() == "")
		{
			user_error_msg += "First Name <br/>";
		}
		if ($("input[name='bdatetxt']").val() == "")
		{
			user_error_msg += "Birth Date <br/>";
		}
		if ($("input[name='addresstxt']").val() == "")
		{
			user_error_msg += "Address <br/>";
		}
		if ($("input[name='contacttxt']").val() == "")
		{
			user_error_msg += "Contact No <br/>";
		}
		if ($("input[name='unametxt']").val() == "")
		{
			user_error_msg += "Username <br/>";
		}
		if ($("input[name='pwordtxt']").val() == "")
		{
			user_error_msg += "Password <br/>";
		}
		if ($("input[name='confrm_pwordtxt']").val() == "")
		{
			user_error_msg += "Confirm Password <br/>";
		}
		// showing error message for blank fields
		if (user_error_msg != "")
		{
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if(this.readyState == 4 && this.status == 200)
				{
					$("#update-user-error-dialog-wrapper").html(this.responseText);
					$("#user-error-dialog #user-error-msg").html("Please fill up the following fields: <br/>" + 
					user_error_msg);
					$("#user-error-dialog").modal({backdrop: false, keyboard: false});
				}
			};
			xhttp.open("GET", "/user/new_user_error_dialog.php", true);
			xhttp.send();
		}
		else
		{	
			
				// error message for string value of contact no
				if (!$.isNumeric($("input[name='contacttxt']").val()))
				{
					user_error_msg = "Contact number is not in a valid format.";
					var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
						if(this.readyState == 4 && this.status == 200)
						{
							$("#update-user-error-dialog-wrapper").html(this.responseText);
							$("#user-error-dialog h5").html("Contact No.");
							$("#user-error-dialog #user-error-msg").html(user_error_msg);
							$("#user-error-dialog").modal({backdrop: false, keyboard: false});
						}
					};
					xhttp.open("GET", "/user/new_user_error_dialog.php", true);
					xhttp.send();
				}
				else
				{
					if ($("input[name='contacttxt']").val().length == 7 ||
						$("input[name='contacttxt']").val().length == 11)
					{
						if ($("input[name='pwordtxt']").val().length < 8)
						{
							user_error_msg = "Password must be atleast 8 alphanumeric characters.";
							var xhttp = new XMLHttpRequest();
							xhttp.onreadystatechange = function() {
								if(this.readyState == 4 && this.status == 200)
								{
									$("#update-user-error-dialog-wrapper").html(this.responseText);
									$("#user-error-dialog h5").html("Password");
									$("#user-error-dialog #user-error-msg").html(user_error_msg);
									$("#user-error-dialog").modal({backdrop: false, keyboard: false});
								}
							};
							xhttp.open("GET", "/user/new_user_error_dialog.php", true);
							xhttp.send();
						}
						else
						{
							if ($("input[name='confrm_pwordtxt']").val() != 
								$("input[name='pwordtxt']").val())
							{
								user_error_msg = "Confirm password does not match.";
								var xhttp = new XMLHttpRequest();
								xhttp.onreadystatechange = function() {
									if(this.readyState == 4 && this.status == 200)
									{
										$("#update-user-error-dialog-wrapper").html(this.responseText);
										$("#user-error-dialog h5").html("Confirm Password");
										$("#user-error-dialog #user-error-msg").html(user_error_msg);
										$("#user-error-dialog").modal({backdrop: false, keyboard: false});
									}
								};
								xhttp.open("GET", "/user/new_user_error_dialog.php", true);
								xhttp.send();
							}
							else
							{
								
								// last name handling spacing issue(one space or more than one space) 
								// when checking if existing or not
								var lname_word = $("input[name='lnametxt']").val().split(" ");
								var fname_word = $("input[name='fnametxt']").val().split(" ");
								var mname_word = $("input[name='mnametxt']").val().split(" ");

								var lnametxt_val = "";
								var lname_word_counter = 0;
								for(count = 0;count < lname_word.length;count++)
								{
									if(count == 0)
									{
										if(lname_word[count] != "")
										{	
											lname_word_counter += 1;
											//alert(counter);
											lnametxt_val += lname_word[count];
										}
									}
									else
									{
										if (lname_word[count] != "")
										{
											lname_word_counter += 1;
											//alert(counter);
											if (lname_word_counter == 1)
											{
												lnametxt_val += lname_word[count];
											}
											else
											{
												lnametxt_val += " " + lname_word[count];
											}	
										}
									}
								}
								
								// first name handling space issues
								var fnametxt_val = "";
								var fname_word_counter = 0;
								for(count = 0;count < fname_word.length;count++)
								{
									if(count == 0)
									{
										if(fname_word[count] != "")
										{	
											fname_word_counter += 1;
											//alert(counter);
											fnametxt_val += fname_word[count];
										}
									}
									else
									{
										if (fname_word[count] != "")
										{
											fname_word_counter += 1;
											//alert(counter);
											if (fname_word_counter == 1)
											{
												fnametxt_val += fname_word[count];
											}
											else
											{
												fnametxt_val += " " + fname_word[count];
											}	
										}
									}
								}
								// middle name handling space issues
								var mnametxt_val = "";
								var mname_word_counter = 0;
								for(count = 0;count < mname_word.length;count++)
								{
									if(count == 0)
									{
										if(mname_word[count] != "")
										{	
											mname_word_counter += 1;
											//alert(counter);
											mnametxt_val += mname_word[count];
										}
									}
									else
									{
										if (mname_word[count] != "")
										{
											mname_word_counter += 1;
											//alert(counter);
											if (mname_word_counter == 1)
											{
												mnametxt_val += mname_word[count];
											}
											else
											{
												mnametxt_val += " " + mname_word[count];
											}	
										}
									}
								}
								alert("success");
								//alert($("input[name='bdatetxt']").val());
								var xhttp = new XMLHttpRequest();
								xhttp.onreadystatechange = function() {
									if(this.readyState == 4 && this.status == 200)
									{
										//alert(this.responseText);
										if (this.responseText.trim() == "")
										{
											//alert(this.responseText);
											// append user save modal to its wrapper and show it - success message
											var xhttp = new XMLHttpRequest();
											xhttp.onreadystatechange = function() {
												if (this.readyState == 4 && this.status == 200)
												{
													$("#user-save-dialog-wrapper").html(this.responseText);
													$("#user-save-dialog").modal({backdrop:false, keyboard:false});
												}
											};
											xhttp.open("GET","../user/user_save_dialog.php", true);
											xhttp.send();
										}
										else
										{ 
											// append error modal to its wrapper and show it - success message
											user_error_msg = this.responseText;
											var xhttp = new XMLHttpRequest();
											xhttp.onreadystatechange = function() {
												if(this.readyState == 4 && this.status == 200)
												{
													$("#update-user-error-dialog-wrapper").html(this.responseText);
													$("#user-error-dialog h5").html("Existing");
													$("#user-error-dialog #user-error-msg").html(user_error_msg);
													$("#user-error-dialog").modal({backdrop: false, keyboard: false});
												}
											};
											xhttp.open("GET", "/user/new_user_error_dialog.php", true);
											xhttp.send();
										}
									}
								};
								xhttp.open("POST", "/user/insert.php", true);
								xhttp.setRequestHeader("Content-type", 
													   "application/x-www-form-urlencoded");
								xhttp.send("lnametxt=" + lnametxt_val +
									      "&fnametxt=" + fnametxt_val +
										  "&mnametxt=" + mnametxt_val +
										  "&gender=" + $("select[name='gender'] option:selected").val() +
										  "&bdatetxt=" + $("input[name='bdatetxt']").val() +
										  "&addresstxt=" + $("input[name='addresstxt']").val() +
										  "&contacttxt=" + $("input[name='contacttxt']").val() +
										  "&pwordtxt=" + $("input[name='pwordtxt']").val() +
										  "&role=" + $("select[name='role'] option:selected").val());
							}
							
						}
					}
					// error message for number of digit of contact no
					else
					{
						user_error_msg = "Contact number is not in a valid format. <br/>" +
										 "Must be a 7-digit number for telephone or 11-digit number for cellphone.";
						var xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function() {
							if(this.readyState == 4 && this.status == 200)
							{
								$("#update-user-error-dialog-wrapper").html(this.responseText);
								$("#user-error-dialog h5").html("Contact No.");
								$("#user-error-dialog #user-error-msg").html(user_error_msg);
								$("#user-error-dialog").modal({backdrop: false, keyboard: false});
							}
						};
						xhttp.open("GET", "/user/new_user_error_dialog.php", true);
						xhttp.send();
					}
				}
		}
	});
});